<?php


namespace frontend\controllers\auth;


use DomainException;
use shop\forms\auth\PasswordResetRequestForm;
use shop\forms\auth\ResetPasswordForm;
use shop\services\auth\PasswordResetService;
use Yii;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

class ResetController extends Controller
{
    //public $layout = 'cabinet';
    private $service;

    public function __construct($id, $module, PasswordResetService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function actionRequest()
    {
        $form = new PasswordResetRequestForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try{
                $this->service->request($form);
                Yii::$app->session->setFlash('success', 'Проверьте свою электронную почту и следуйте инструкции.');
                return $this->goHome();
            }catch (DomainException $e){
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }

        }

        return $this->render('request', [
            'model' => $form,
        ]);
    }

    /**
     * @param $token
     * @return string|\yii\web\Response
     * @throws BadRequestHttpException
     */
    public function actionReset($token)
    {
        try {
            $this->service->validateToken($token);
        } catch (DomainException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        $form = new ResetPasswordForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try{
                $this->service->reset($token,$form);
                Yii::$app->session->setFlash('success', 'Новый пароль сохранён.');
                return $this->goHome();
            }catch (DomainException $e){
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('reset', [
            'model' => $form,
        ]);
    }


}