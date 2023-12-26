<?php
namespace frontend\controllers;

use DomainException;
use shop\forms\auth\ResendVerificationEmailForm;
use Yii;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use shop\forms\auth\LoginForm;
use shop\forms\auth\PasswordResetRequestForm;
use shop\forms\auth\ResetPasswordForm;
use shop\forms\auth\SignupForm;
use shop\forms\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $this->layout = 'home';
        return $this->render('index');
    }



}
