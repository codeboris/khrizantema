<?php


namespace frontend\controllers\cabinet;


use shop\entities\User\User;
use shop\forms\cabinet\UserUpdateForm;
use shop\forms\manage\User\UserEditForm;
use shop\services\manage\UserManageService;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class DefaultController extends Controller
{
    public $layout = 'cabinet';
    private $service;

    public function __construct($id, $module, UserManageService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {

        return $this->render('index',[
            'user' => $this->findModel()
        ]);
    }

    public function actionUpdate()
    {
        $user = $this->findModel();

        $form = new UserUpdateForm($user);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try{
                $this->service->userEdit($user->id, $form);
                return $this->redirect('index');
            }catch (\DomainException $e){
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('update', [
            'model' => $form,
            'user' => $user,
        ]);
    }

    private function findModel()
    {
        return User::findOne(Yii::$app->user->identity->getId());
    }

}