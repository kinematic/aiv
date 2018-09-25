<?php

namespace app\controllers\address;

use Yii;
use app\models\address\Contacts;
use app\models\sites\Sites;
// use app\models\ContactsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ContactsController implements the CRUD actions for Contacts model.
 */
class ContactsController extends Controller
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
     * Lists all Contacts models.
     * @return mixed
     */
    public function actionIndex($siteID)
    {
		$site = $this->getSite($siteID);
		$contacts = Contacts::find()->where(['objid' => $site->objid])->all();

        return $this->render('index', [
			'site' => $site,
            'contacts' => $contacts,
        ]);
    }

    /**
     * Displays a single Contacts model.
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
     * Creates a new Contacts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($siteID)
    {
        $model = new Contacts();
		$site = $this->getSite($siteID);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'siteID' => $site->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
				'site' => $site,
            ]);
        }
    }

    /**
     * Updates an existing Contacts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id, $siteID)
    {
        $model = $this->findModel($id);
		$site = $this->getSite($siteID);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'siteID' => $site->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
				'site' => $site,
            ]);
        }
    }

    /**
     * Deletes an existing Contacts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id, $siteID)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index', 'siteID' => $siteID]);
    }

    /**
     * Finds the Contacts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Contacts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Contacts::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

	public function getSite($siteID)
	{
		return Sites::find()->where(['id' => $siteID])->one();
	}
}
