<?php
namespace backend\controllers\shop;

use shop\forms\manage\Shop\Order\OrderEditForm;
//use shop\forms\manage\Shop\OrderForm;
use shop\services\manage\Shop\OrderManageService;
use Yii;
use shop\entities\Shop\Order\Order;
use backend\forms\Shop\OrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class OrderController extends Controller
{
    private $service;

    public function __construct($id, $module, OrderManageService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'export' => ['POST'],
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @return mixed
     */
    public function actionExport()
    {
        $query = Order::find()->orderBy(['id' => SORT_DESC]);
        $objPHPExcel = new \PHPExcel();
        $worksheet = $objPHPExcel->getActiveSheet();
        foreach ($query->each() as $row => $order) {
            /** @var Order $order */
            $worksheet->setCellValueByColumnAndRow(0, $row + 1, 'Заказ #'.$order->id);
            $worksheet->setCellValueByColumnAndRow(1, $row + 1, date('d-m-Y H:i', $order->delivery_datetime));
            $worksheet->setCellValueByColumnAndRow(2, $row + 1, $order->recipientData->name);
            $worksheet->setCellValueByColumnAndRow(3, $row + 1, $order->recipientData->phone);
            $worksheet->setCellValueByColumnAndRow(4, $row + 1, $order->recipientData->address);
        }
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $file = tempnam(sys_get_temp_dir(), 'export');
        $objWriter->save($file);
        return Yii::$app->response->sendFile($file, 'report.xlsx');
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'order' => $this->findModel($id),
        ]);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $order = $this->findModel($id);
        $form = new OrderEditForm($order);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->edit($order->id, $form);
                return $this->redirect(['view', 'id' => $order->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('update', [
            'model' => $form,
            'order' => $order,
        ]);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        try {
            $this->service->remove($id);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }

    /**
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id): Order
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}