<?php

namespace app\modules\admin\controllers\import;

use Yii;
use app\modules\admin\models\import\Sites;
use app\modules\admin\models\import\SitesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SitesController implements the CRUD actions for Sites model.
 */
class SitesController extends Controller
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
     * Lists all Sites models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SitesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	public function actionNew()
    {
        $searchModel = new SitesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	public function actionNotdefs()
    {
        $searchModel = new SitesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	public function actionNonexists()
    {
        $searchModel = new SitesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	public function actionLoad()
    {
		$output = shell_exec('iconv -f cp1251 -t utf-8 -o objects_utf8.csv objects.csv');
		Yii::warning($output);
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
		// "
			// LOAD DATA LOW_PRIORITY INFILE 'C:/aiv/web/files/objects.csv' 
			// INTO TABLE rbs_mustang.sites  
			// FIELDS TERMINATED BY ';' ENCLOSED BY '\"' LINES TERMINATED BY '\r\n' IGNORE 1 LINES	(
			// `object`,
			// @planedaddress, 
			// @realaddress,		
			// @juricaladdress, 
			// `contacts`,
			// @startdate,  		
			// @closedate, 
			// @mol, 
			// `status`, 
			// @inventory, 
			// @lastinventorydate,
			// @typeid, 
			// @regionid, 
			// @nr,
			// @siteid,
			// @statusid,
			// @molid
			// )
			// SET 
			// planedaddress=rbs_mustang.replace_symbol(@planedaddress),
			// realaddress=rbs_mustang.replace_symbol(@realaddress),
			// juricaladdress=rbs_mustang.replace_symbol(@juricaladdress),
			// closedate=NULLIF(STR_TO_DATE(@closedate, '%d.%m.%Y'), '0000-00-00'),
			// inventory=IF(@inventory = 'True', 1, NULL),
			// lastinventorydate=NULLIF(STR_TO_DATE(@lastinventorydate, '%d.%m.%Y'), '0000-00-00'), 
			// startdate=NULLIF(STR_TO_DATE(@startdate, '%d.%m.%Y'), '0000-00-00'),
			// object=rbs_mustang.correct_sitename(object),
			// typeid=rbs_mustang.define_typeid(object), 
			// regionid=rbs_mustang.define_regionid(object, typeid), 
			// nr=rbs_mustang.define_nr(object, typeid, regionid),
			// siteid=rbs_sites.definesiteid(typeid, regionid, nr),
			// statusid=rbs_mustang.define_statusid(`status`),
			// mol=rbs_mustang.replace_symbol(@mol),
			// molid=rbs_mustang.define_molid(mol)
		
		
		// "
		
		
		)->execute();
		
		// );
		
		// die();

        // $searchModel = new SitesSearch();
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // return $this->render('index', [
            // 'searchModel' => $searchModel,
            // 'dataProvider' => $dataProvider,
        // ]);
    }

    /**
     * Displays a single Sites model.
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
     * Creates a new Sites model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Sites();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Sites model.
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
     * Deletes an existing Sites model.
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
     * Finds the Sites model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sites the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sites::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
