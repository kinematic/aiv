<?php

namespace app\controllers\inventory;

use Yii;
use app\models\inventory\Discrepancy;
use app\models\inventory\DiscrepancySearch;
use app\models\MailerForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;

/**
 * DiscrepancyController implements the CRUD actions for Discrepancy model.
 */
class DiscrepancyController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Discrepancy models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DiscrepancySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Discrepancy model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Discrepancy model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Discrepancy();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//             return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect(['sites/view', 'id' => $model->siteid, '#' => 'discrepancy']);
        } else {
			$model->load(Yii::$app->request->get());
            return $this->render('create', [
                'model' => $model,
                
            ]);
        }
    }

    /**
     * Updates an existing Discrepancy model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['sites/view', 'id' => $model->siteid, '#' => 'discrepancy']);
        } else {
			$model->load(Yii::$app->request->get());
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Discrepancy model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $tmp = $this->findModel($id);
        $siteID = $tmp->siteid;
        $tmp->delete();

//         return $this->redirect(['index']);
        return $this->redirect(['sites/view', 'id' => $siteID, '#' => 'discrepancy']);
    }

    /**
     * Finds the Discrepancy model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Discrepancy the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Discrepancy::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionMailer1($dataP){
        return Yii::$app->response->redirect(array('mailer2',
                        'dataProvider' => $dataP));
    }
    
    public function actionMailer2(){
//                 $dataProvider = Yii:;
// 		\Yii::$app->mailer->getView()->params['userName'] = $this->username;
// 		$model = new MailerForm();
// 		$model->fromEmail = 'neron.marchenko@gmail.com';
// 		$model->fromName = 'Aleksandr Marchenko';
// 		$model->toEmail = 'aleksandr.marchenko@kyivstar.net';
// 		$model->toEmail = 'kinematic@i.ua';
// 		$model->subject = 'test';
// 		$model->body = 'test';
		Yii::$app->mailer->compose('inventory/siteDiscrepancies', ['dataProvider' => $dataProvider])
		->setTo('aleksandr.marchenko@kyivstar.net')
		->setFrom(['neron.marchenko@gmail.com' => 'Aleksandr Marchenko'])
		->setSubject('test')
		->send();
// 		if($model->sendEmail()) {
// 		Yii::$app->session->setFlash('mailerFormSubmitted');
		    //return $this->render('view', [
            //'model' => $this->findModel($id),
        //]);
// 		return $this->refresh();
// 		}
//         if ($model->load(Yii::$app->request->post()) && $model->sendEmail()) {
//             Yii::$app->session->setFlash('mailerFormSubmitted');
            return $this->refresh();
//         }
// 		return $this->render('view', [
// 			'model' => $model,
// 		]);

    }
    
        /**
     * Lists all Discrepancy models.
     * @return mixed
     */
    public function actionMailer()
    {
//         print Yii::$app->request->referrer;
//         print_r (Yii::$app->request->queryParams);
        
//         die();
        
        $searchModel = new DiscrepancySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//         print_r($dataProvider);
//         die();
        Yii::$app->mailer->compose('inventory/siteDiscrepancies', ['dataProvider' => $dataProvider])
		->setTo('av_marchenko@yahoo.com')
		->setFrom(['neron.marchenko@gmail.com' => 'Aleksandr Marchenko'])
		->setSubject('test')
		->send();
        
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
