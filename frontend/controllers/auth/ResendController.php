<?php


namespace frontend\controllers\auth;


use DomainException;
use shop\forms\auth\ResendVerificationEmailForm;
use shop\services\auth\ResendService;
use Yii;
use yii\web\Controller;

class ResendController extends Controller
{
    //public $layout = 'cabinet';
    private $service;

    public function __construct($id, $module, ResendService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function actionResend()
    {
        $form = new ResendVerificationEmailForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try{
                $this->service->resend($form);
                Yii::$app->session->setFlash('success', 'Проверьте свою электронную почту и следуйте инструкции.');
                return $this->goHome();
            }catch (DomainException $e){
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
                return $this->goHome();
            }

        }

        return $this->render('resend', [
            'model' => $form
        ]);
    }

}