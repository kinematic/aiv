<?php

namespace app\controllers\sites;

use Yii;
use yii\filters\AccessControl;
use app\models\sites\Sites;
use app\models\sites\SitesSearch;
use app\models\address\Addresses;
// use app\models\address\Obl;
// use app\models\address\Rn;
// use app\models\address\Typenp;
// use app\models\address\Np;
// use app\models\address\Typestr;
// use app\models\address\Str;
// use app\models\address\Bud;
// use app\models\address\Descr;
// use app\models\address\Comment;
use app\models\address\Gps;

use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SitesController implements the CRUD actions for Sites model.
 */
class SitesController extends Controller
{

	public $modelsAddress = array(
		1 => 'Obl',
		2 => 'Rn',
		3 => 'Typenp',
		4 => 'Np',
		5 => 'Typestr',
		6 => 'Str',
		7 => 'Bud',
		8 => 'Descr',
		9 => 'Comment',
		10 => 'Gps'
	);
	
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
//                         'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
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

    /**
     * Displays a single Sites model.
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
     * Creates a new Sites model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Sites();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Sites model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        //print_r($_POST);
        //var_dump($_POST);
        //return $this->render('test');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            $post = Yii::$app->request->post('Sites');
            //print_r($post);
            $objid = $post['objid'];
            foreach($post as $key => $value) {
                $value = trim($value);
//                 if ($value == '') $value = null;
                //определяем тип адреса
                $typeid = null;
                if ($key == 'oblid') $typeid = 1;
                if ($key == 'rnid') $typeid = 2; 
                if ($key == 'typenpid') $typeid = 3; 
                if ($key == 'npid') $typeid = 4; 
                if ($key == 'typestrid') $typeid = 5; 
                if ($key == 'strid') $typeid = 6; 
                if ($key == 'budval') $typeid = 7; 
                if ($key == 'descrval') $typeid = 8; 
                if ($key == 'commentval') $typeid = 9;
                if ($key == 'gpsval') $typeid = 10;
                
                $isAddress = null;
                $Addresses = Addresses::find()->where(['objid' => $objid, 'typeid' => $typeid])->one();
                if (isset($Addresses->id)) $isAddress = 1;

                if ($typeid and $value) {
                    //сравниваем есть ли значения в справочниках
                    if ((int)$value and ($typeid == 1 or $typeid == 2 or $typeid == 3 or $typeid == 4 or $typeid == 5 or $typeid == 6)) {
                        if ($isAddress) {
                            if ($Addresses->valueid <> $value) $this->updateAddresses($Addresses, $value);
                        } else $this->newAddresses($objid, $typeid, $value);
                    //если нет, добавляем
                    } else {
                    
                        if ($typeid == 1) $this->recordAddresses($Addresses, $isAddress, $this->modelsAddress[$typeid], $objid, $typeid, $value);
                        if ($typeid == 2) $this->recordAddresses($Addresses, $isAddress, $this->modelsAddress[$typeid], $objid, $typeid, $value);
                        if ($typeid == 4) $this->recordAddresses($Addresses, $isAddress, $this->modelsAddress[$typeid], $objid, $typeid, $value);
                        if ($typeid == 6) $this->recordAddresses($Addresses, $isAddress, $this->modelsAddress[$typeid], $objid, $typeid, $value);
                        if ($typeid == 7) $this->inserStringValues($Addresses, $isAddress, $this->modelsAddress[$typeid], $objid, $typeid, $value);
                        if ($typeid == 8) $this->inserStringValues($Addresses, $isAddress, $this->modelsAddress[$typeid], $objid, $typeid, $value);
                        if ($typeid == 9) $this->inserStringValues($Addresses, $isAddress, $this->modelsAddress[$typeid], $objid, $typeid, $value);
                        if ($typeid == 10) $this->workOnGPS($Addresses, $isAddress, $objid, $value);
//                         print 'typeid = ' . $typeid . ' value = ' . $value . '<br>';
                    }
                } else {
                    if ($isAddress) {
	                    $tmp = $this->modelsAddress[$typeid];
	                    if ($this->countAddresses($this->modelsAddress[$typeid], $Addresses->valueid) < 2) {
	                        $tmp = 'app\\models\\address\\' . $this->modelsAddress[$typeid];
	                        $tmpModel = $tmp::find()->where(['id' => $Addresses->valueid])->one();
	                        $tmpModel->delete();
	                    }
	                    $Addresses->delete();
                    }
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
	    if ($model->objid) return $this->render('update', ['model' => $model]);
	    else return $this->render('relations', ['model' => $model]);
        }
    }

    /**
     * Deletes an existing Sites model.
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
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function newAddresses ($objid, $typeid, $valueid)
    {   
        $othermodel = new Addresses();
        $othermodel->isNewRecord = true;
        $othermodel->objid = $objid;
        $othermodel->typeid = $typeid;
        $othermodel->valueid = $valueid;
        $othermodel->save();
    }
    
    public function updateAddresses ($Addresses, $valueid)
    {
        $Addresses->valueid = $valueid;
        $Addresses->save();
    }
    
    public function newRecordDirectory ($modelname, $typeid, $value)
    {
        $modelname = 'app\\models\\address\\' . $modelname;
        $othermodel = new $modelname;
        $othermodel->isNewRecord = true;
        if ($typeid == 1 or $typeid == 2 or $typeid == 3 or $typeid == 4 or $typeid == 5 or $typeid == 6) $othermodel->name = $value;
        else $othermodel->value = $value;
        $othermodel->save();
        return $othermodel->id;
    }
    
    public function recordAddresses ($Addresses, $isAddress, $directory, $objid, $typeid, $value)
    {
        $newid = $this->newRecordDirectory($directory, $typeid, $value);
        if ($isAddress) $this->updateAddresses($Addresses, $newid);
        else $this->newAddresses($objid, $typeid, $newid);
    }
    
    public function isDirectory ($modelname, $value)
    {
        $modelname = 'app\\models\\address\\' . $modelname;
        $tmp = $modelname::find()->where(['value' => $value])->one();
//         $tmp = $modelname::find()->where(['like', 'value', $value])->one();
        if (isset($tmp->id)) return $tmp->id;
        else return null;
    }
    
    public function countAddresses ($modelname, $valueid)
    {
		$modelname = strtolower($modelname);
		$countAddresses = Addresses::find()
		    ->innerJoinWith($modelname)
		    ->where(['valueid' => $valueid])
		    ->count();
        if (isset($countAddresses)) return $countAddresses;
        else return null;
    }
    
    public function inserStringValues ($Addresses, $isAddress, $modelname, $objid, $typeid, $value) {
        // ищем есть ли такое значение в справочнике
        $isDirectory = $this->isDirectory($modelname, $value);
        // если есть
        if ($isDirectory) {
            // ищем есть ли такая запись в адресе, если есть
            if ($isAddress) {
                // и значение не тоже самое, обновляем
                if ($Addresses->valueid <> $isDirectory) $this->updateAddresses($Addresses, $isDirectory);
                // если нет, создаём запись в адресе
            } else $this->newAddresses($objid, $typeid, $isDirectory);
            // если нет записи в справочнике, создаём
        } else $this->recordAddresses($Addresses, $isAddress, $modelname, $objid, $typeid, $value);
    }
    
    function gradToRad ($grad, $min, $sec) {
        return round($grad + $min/60 + $sec/3600, 6);
    }
    
    public function workOnGPS ($Addresses, $isAddress, $objid, $gpsStirng) 
    {
        if (isset($gpsStirng)) {
            if (preg_match ("/([0-9]{2}\.[0-9]*).*([0-9]{2}\.[0-9]*)/", $gpsStirng, $matches)) {
                    $latrad = $matches[1];
                    $longrad = $matches[2];
            } else {
                $gpsStirng = trim(stripcslashes ($gpsStirng));
                //echo 'исходный: ' . $gpsStirng;
                $gpsStirng = str_replace ('&ll=', " : ", $gpsStirng);
                $gpsStirng = preg_replace("/\s*\"\s*|\s*∞\s*|\s*\'\s*|\s*\`\s*|\s°/", " ", $gpsStirng);
                //echo 'удалили лишние символы: ' . $gpsStirng;
                $gpsStirng = preg_replace("~\s+~", " ", $gpsStirng);
                //print 'преобразованный: ' . $gpsStirng;
                // print $gpsStirng; die();
                if (preg_match ("/([0-9]+)\s([0-9]+)\s([0-9]*)\sN/", $gpsStirng, $matches)) {
                    $latrad = $this->gradToRad($matches[1], $matches[2], $matches[3]);
                    preg_match ("/([0-9]+)\s([0-9]+)\s([0-9]*)\sE/", $gpsStirng, $matches);
                    $longrad =  $this->gradToRad($matches[1], $matches[2], $matches[3]);
                } elseif (preg_match ("/([0-9]{3})N\s([0-9]*)\s(-{0,1}[0-9]*)/", $gpsStirng, $matches)) {
                    if ($matches[3] < 0) $matches[3] = 60 + $matches[3];
                    $latrad =  $this->gradToRad($matches[1], $matches[2], $matches[3]);
                    preg_match ("/([0-9]{3})E\s([0-9]*)\s(-{0,1}[0-9]*)/", $gpsStirng, $matches);
                    if ($matches[3] < 0) $matches[3] = 60 + $matches[3];
                    $longrad =  $this->gradToRad($matches[1], $matches[2], $matches[3]);
                } elseif (preg_match ("/N\s([0-9]{2})\s([0-9]{2})\s([0-9]{2}\,[0-9]{1})/", $gpsStirng, $matches)) {
                    $latrad =  $this->gradToRad($matches[1], $matches[2], $matches[3]);
                    preg_match ("/E\s([0-9]{2})\s([0-9]{2})\s([0-9]{2}\,[0-9]{1})/", $gpsStirng, $matches);
                    $longrad =  $this->gradToRad($matches[1], $matches[2], $matches[3]);
                } elseif (preg_match ("/Latitude:\s([0-9]+)\s°\s([0-9]+)\s'\s([0-9]*)/", $gpsStirng, $matches)) {
                    $latrad =  $this->gradToRad($matches[1], $matches[2], $matches[3]);
                    preg_match ("/Longitude:\s([0-9]+)\s°\s([0-9]+)\s'\s([0-9]*)/", $gpsStirng, $matches);
                    $longrad =  $this->gradToRad($matches[1], $matches[2], $matches[3]);
                }
                
            }
        
        
        }
        if (isset($latrad)) $latint = $latrad * 1000000; 
        else $latint = null;
        if (isset($longrad)) $longint = $longrad * 1000000;
        else $longint = null;
        
        if ($latint and $longint) {

            $gps = Gps::find()->where(['lat' => $latint, 'long' => $longint])->one();
            
            if ($isAddress and isset($gps->id)) {
            
            } elseif ($isAddress and !isset($gps->id)) {
                $gps = Gps::find()->where(['id' => $Addresses->valueid])->one();
                if ($gps->id) {
                    $gps->lat = $latint;
                    $gps->long = $longint;
                    $gps->save();
                } else {
        // 		    $gps = new Gps();
                    $gps->isNewRecord = true;
                    $gps->lat = $latint;
                    $gps->long = $longint;
                    $gps->save();
                    $this->updateAddresses($Addresses, $gps->id);
                }
        
            // если нет, создаём запись в адресе
            } elseif (!$isAddress and isset($gps->id)) {
                $this->newAddresses($objid, 10, $gps->id);
            } elseif (!$isAddress and !isset($gps->id)) {
                $gps = new Gps;
                $gps->isNewRecord = true;
                $gps->lat = $latint;
                $gps->long = $longint;
                $gps->save();
                $this->newAddresses($objid, 10, $gps->id);
            }
        } else {
            if ($isAddress) {
                $gps = Gps::find()->where(['id' => $Addresses->valueid])->one();
                $gps->delete();
                $Addresses->delete();
            }
        
        }
    }
    
	/**
     * Displays a single Sites model.
     * @param integer $id
     * @return mixed
     */
    public function actionRelations($id)
    {
		$model = $this->findModel($id);
		$model->load(Yii::$app->request->queryParams);
// 		if(!$model->searchByNumber) $model->searchByNumber = $model->nr;
		return $this->render('relations', [
			'model' => $model,
		]);
    }
    
	public function actionJoinObject($id, $objID, $siteID, $relationID, $searchByNumber)
    {
		$model = $this->findModel($siteID);
		$model->objid = $objID;
		$model->relationid = $relationID;
		$model->save();
		$model = $this->findModel($id);
		$model->searchByNumber = $searchByNumber;
		return $this->render('relations', ['model' => $model]);
    }
    
	public function actionCreateObject($id)
    {
		// $model = Sites::find()->where(['id' => $id])->one();
		$model = $this->findModel($id);
		$maxObjID = Sites::find()->max('objid');
		$model->objid = $maxObjID + 1;
		$model->relationid = 2;
		$model->save();
		return $this->render('relations', ['model' => $model]);
    }
    
	public function actionDeleteObject($id, $deleteID, $searchByNumber)
    {
		$deleteModel = $this->findModel($deleteID);
		$objID = $deleteModel->objid;
		$objCount = Sites::find()->where(['objid' => $objID])->count();

		if ($objCount == 1) {
			$Addresses = Addresses::find()->where(['objid' => $objID])->all();
			foreach($Addresses as $address) {
	            $typeAddress = $this->modelsAddress[$address->typeid];
	            $valueAddressID = $address->valueid;
	            if ($this->countAddresses($typeAddress, $valueAddressID) == 1) {
	                $tmp = 'app\\models\\address\\' . $typeAddress;
	                $tmpModel = $tmp::find()->where(['id' => $valueAddressID])->one();
	                $tmpModel->delete();
	            }
	            $address->delete();
			}
		}
		$deleteModel->objid = null;
		$deleteModel->relationid = null;
		$deleteModel->save();
		$model = $this->findModel($id);
		$model->searchByNumber = $searchByNumber;
		return $this->render('relations', ['model' => $model]);
    }
    

}
