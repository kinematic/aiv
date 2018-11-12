<?php

namespace app\controllers\letters;

use Yii;
use app\models\letters\Letters;
use app\models\letters\LettersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\people\People;
use app\models\letters\Lists;
/**
 * LettersController implements the CRUD actions for Letters model.
 */
class LettersController extends Controller
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
     * Lists all Letters models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LettersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Letters model.
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
     * Displays a single Letters model.
     * @param integer $id
     * @return mixed
     */
    public function actionViewbyobjid($objid)
    {
		$model = Letters::findOne(['objid' => $objid]);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Letters model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Letters();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Letters model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		// print_r(Yii::$app->request->post());
		// $model->load(Yii::$app->request->post());
		// $model->save();
		// print_r($model->getErrors());
		// die();
		// print_r($model);
			// die();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			// добавление новых людей
			foreach($model->peopleSelect as $item) {
				if(!Lists::find()->where(['letterid' => $model->id, 'manid' => $item])->one()) {
					$record = new Lists();
					$record->letterid = $model->id;
					$record->manid = $item;
					$record->save();
				}
			}
			// $records = Lists::find()->where(['letterid' => $model->id])->all();
			$records = implode(', ', $model->peopleSelect);
			Yii::$app->db->createCommand("
				DELETE 
				FROM letters_lists 
				WHERE letterid = $letterid
				AND manid NOT IN ($records)
			")->execute();
			// die();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Letters model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Letters model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Letters the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Letters::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
