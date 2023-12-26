<?php


namespace frontend\controllers;


use DomainException;
use shop\forms\ContactForm;
use shop\services\ContactService;
use Yii;
use yii\web\Controller;

class ContactController extends Controller
{
    private $service;

    public function __construct($id, $module, ContactService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function actionIndex()
    {
        $form = new ContactForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try{
                $this->service->send($form);
                Yii::$app->session->setFlash('success', 'Благодарим Вас за обращение к нам. Мы ответим вам как можно скорее.');
                return $this->goHome();
            }catch (DomainException $e){
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', 'Ошибка отправки сообщения. Мы в курсе данной проблемы и работаем над этим.');
            }
            return $this->refresh();
        }

        return $this->render('index', [
            'model' => $form,
        ]);

    }

}