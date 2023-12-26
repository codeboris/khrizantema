<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use shop\forms\auth\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
                'layout' => 'main-login'
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
}
