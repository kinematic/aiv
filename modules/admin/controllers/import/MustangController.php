<?php

namespace app\modules\admin\controllers\import;

use Yii;
use app\modules\admin\models\import\Mustang;
use app\modules\admin\models\import\MustangSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MustangController implements the CRUD actions for Mustang model.
 */
class MustangController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all Mustang models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MustangSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Mustang model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Mustang model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Mustang();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Mustang model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Mustang model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Mustang model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Mustang the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Mustang::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	
	public function actionLoad()
    {
		// $dir = @web;
		// echo 'hello';
		// echo Yii::getAlias('@yii');
		$dir = Yii::getAlias('@webroot') . '/files/';
		$output = shell_exec('iconv -f cp1251 -t utf-8 -o ' . $dir . 'objects_utf8.csv ' . $dir . 'objects.csv');
		// die(Yii::getAlias($output));
		// Yii::warning($output);
		// echo "<pre>$output</pre>";

		Yii::$app->db->createCommand()->truncateTable('mustang')->execute();
		
		Yii::$app->db->createCommand(
			"
				COPY mustang (
					object,
					planedaddress,
					realaddress,
					juricaladdress, 
					contacts, 
					startdate, 
					closedate, 
					mol, 
					status, 
					inventory, 
					lastinventorydate
				) 
				FROM '/var/www/localhost/htdocs/aiv/web/files/objects_utf8.csv' 
				DELIMITER ';' 
				CSV 
				HEADER;
			"
		)->execute();
		
		Yii::$app->db->createCommand(
			"
				UPDATE mustang SET statusid = status(status) WHERE status IS NOT NULL;
			"
		)->execute();
		
		Yii::$app->db->createCommand(
			"
				UPDATE mustang SET mol = REPLACE(mol, '?', 'і') WHERE mol LIKE '%?%';
			"
		)->execute();
		
		Yii::$app->db->createCommand(
			"
				UPDATE mustang SET planedaddress = REPLACE(planedaddress, '?', 'і') WHERE planedaddress LIKE '%?%';
			"
		)->execute();
		
		Yii::$app->db->createCommand(
			"
				UPDATE mustang SET realaddress = REPLACE(realaddress, '?', 'і') WHERE realaddress LIKE '%?%';
			"
		)->execute();
		
		Yii::$app->db->createCommand(
			"
				UPDATE mustang SET juricaladdress = REPLACE(juricaladdress, '?', 'і') WHERE juricaladdress LIKE '%?%';
			"
		)->execute();
		
		Yii::$app->db->createCommand(
			"
				UPDATE mustang SET molid = mol(mol) WHERE mol IS NOT NULL;
			"
		)->execute();
		
		Yii::$app->db->createCommand(
			"
				UPDATE mustang SET typeid = typeid(object);
			"
		)->execute();
		
		Yii::$app->db->createCommand(
			"
				UPDATE mustang SET object = REPLACE(object, (SELECT st.name FROM sitestype st WHERE st.id = typeid), '');
			"
		)->execute();
		
		Yii::$app->db->createCommand(
			"
				UPDATE mustang SET object = TRIM(object);
			"
		)->execute();
		
		Yii::$app->db->createCommand(
			"
				UPDATE mustang SET object = REPLACE(object, (SELECT sr.name FROM sitesregion sr WHERE sr.id = regionid), '');
			"
		)->execute();
		
        $searchModel = new MustangSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
