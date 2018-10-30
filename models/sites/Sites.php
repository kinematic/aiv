<?php

namespace app\models\sites;

use Yii;
use app\models\address\Addresses;
use app\models\address\Obl;
use app\models\address\Rn;
use app\models\address\Typenp;
use app\models\address\Np;
use app\models\address\Typestr;
use app\models\address\Str;
use app\models\address\Bud;
use app\models\address\Descr;
use app\models\address\Comment;
use app\models\address\Gps;
use app\models\inventory\Discrepancy;
use app\models\people\People;
use app\models\visits\Siteaccess;
use app\models\visits\SiteaccessCodes;
use app\models\address\Contacts;

/**
 * This is the model class for table "sites".
 *
 * @property integer $id
 * @property integer $typeid
 * @property integer $regionid
 * @property string $nr
 * @property integer $objid
 * @property integer $relationid
 * @property string $description
 * @property integer $statusid
 * @property string $opendate
 * @property string $closedate
 * @property integer $molid
 * @property string $inventdate
 */
class Sites extends \yii\db\ActiveRecord
{
//     public $oblid;
//     public $oblname;
	public $oblid;
    public $rnid;
    public $typenpid;
    public $npid;
    public $typestrid;
    public $strid;
    public $budval;
    public $descrval;
    public $commentval;
    public $gpsval;
//     public $searchmode;
    public $searchByNumber;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sites';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['typeid', 'regionid', 'nr'], 'required'],
            [['typeid', 'regionid', 'objid', 'relationid', 'statusid', 'molid'], 'integer'],
            [['description', 'gpsval'], 'string'],
            [['opendate', 'closedate', 'inventdate'], 'safe'],
            [['nr'], 'string', 'max' => 32],
            [['latrad', 'longrad', 'searchByNumber'], 'safe'],
        ];
    }

//     /**
//      * @inheritdoc
//      */
//     public function scenarios()
//     {
//         // bypass scenarios() implementation in the parent class
//         return Model::scenarios();
//     }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sitetype' => 'тип сайта',
            'regionid' => 'регион',
            'nr' => '№',
            'oblid' => 'область',
			'oblid2' => 'область',
            'rnid' => 'район',
            'typenpid' => 'тип НП',
            'npid' => 'НП',
            'typestrid' => 'тип улицы',
            'strid' => 'улица',
            'budval' => 'дом',
            'descrval' => 'расположение',
            'commentval' => 'комментарий',
            'objid' => 'Objid',
            'relationid' => 'совмещение',
            'description' => 'Описание',
            'statusid' => 'статус',
            'opendate' => 'дата открытия',
            'closedate' => 'дата закрытия',
            'molid' => 'Molid',
            'inventdate' => 'инвентаризация',
            'sitename' => 'Сайт',
            'fulladdress' => 'адрес',
            'fullgps' => 'координаты',
            'gpsval' => 'координаты',
            'comment.value' => 'комментарий',
            'status' => 'статус',
            'mol.molname' => 'МОЛ',
            'rel' => 'расположение',
            'mustangaddress' => 'адрес из Мустанга',
			'searchByNumber' => 'поиск по номеру сайта',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSitestype()
    {
        return $this->hasOne(Sitestype::className(), ['id' => 'typeid']);
    }
    
//     public function getType()
//     {
//         return $this->sitestype->name;
//     }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSitesregion()
    {
        return $this->hasOne(Sitesregion::className(), ['id' => 'regionid']);
    }
    
//     public function getRegion()
//     {
//         return $this->sitesregion->name;
//     }
    
    public function getSitename()
    {
        return $this->sitestype->name . ' ' . $this->sitesregion->name . $this->nr;
    }
    
    public function getObl() {
         return $this->hasOne(Obl::className(), [ 'id' => 'valueid' ])
                        ->viaTable('addresses', ['objid' => 'objid'], function($query) {
            return $query->onCondition(['typeid' => 1]);
        });
    }
    
    public function getRn() {
         return $this->hasOne(Rn::className(), [ 'id' => 'valueid' ])
                        ->viaTable('addresses', ['objid' => 'objid'], function($query) {
            return $query->onCondition(['typeid' => 2]);
        });
    }
       
    public function getTypenp() {
         return $this->hasOne(Typenp::className(), [ 'id' => 'valueid' ])
                        ->viaTable('addresses', ['objid' => 'objid'], function($query) {
            return $query->onCondition(['typeid' => 3]);
        });
    }
        
    public function getNp() {
         return $this->hasOne(Np::className(), [ 'id' => 'valueid' ])
                        ->viaTable('addresses', ['objid' => 'objid'], function($query) {
            return $query->onCondition(['typeid' => 4]);
        });
    }
        
    public function getTypestr() {
         return $this->hasOne(Typestr::className(), [ 'id' => 'valueid' ])
                        ->viaTable('addresses', ['objid' => 'objid'], function($query) {
            return $query->onCondition(['typeid' => 5]);
        });
    }
        
    public function getStr() {
         return $this->hasOne(Str::className(), [ 'id' => 'valueid' ])
                        ->viaTable('addresses', ['objid' => 'objid'], function($query) {
            return $query->onCondition(['typeid' => 6]);
        });
    }
        
    public function getBud() {
         return $this->hasOne(Bud::className(), [ 'id' => 'valueid' ])
                        ->viaTable('addresses', ['objid' => 'objid'], function($query) {
            return $query->onCondition(['typeid' => 7]);
        });
    }
        
    public function getDescr() {
         return $this->hasOne(Descr::className(), [ 'id' => 'valueid' ])
                        ->viaTable('addresses', ['objid' => 'objid'], function($query) {
            return $query->onCondition(['typeid' => 8]);
        });
    }
        
    public function getComment() {
         return $this->hasOne(Comment::className(), [ 'id' => 'valueid' ])
                        ->viaTable('addresses', ['objid' => 'objid'], function($query) {
            return $query->onCondition(['typeid' => 9]);
        });
    }
    
    public function getFulladdress() {
		$controllerID = Yii::$app->controller->id; //нужно для подгонки вида адреса под потребности страницы
		$address = array();
		if(isset($this->np->name) or isset($this->str->name)) {
			if(isset($this->np->name)) {
				if(isset($this->typenp->name)) $address[0] = $this->typenp->name. ' ' . $this->np->name;
				else $address[0] = $this->np->name;
			}
			if(isset($this->str->name)) {
				if(isset($this->typestr->name)) {
					if (!isset($this->typestr->position)) $address[1] = $this->typestr->name . ' ' . $this->str->name;
					else $address[1] = $this->str->name . ' ' . $this->typestr->name;
				} else $address[1] = $this->str->name;
			}
			if(isset($this->bud->value)) $address[2] = $this->bud->value;
			if(isset($this->np->capital)) {
				if(isset($this->rn->name) and $this->np->capital <> 2) {
					if($controllerID == 'letters/letters') $address[3] = null;
					else $address[3] = $this->rn->name . ' р-н';
				}
				if(isset($this->obl->name) and $this->np->capital <> 1) $address[4] = $this->obl->name . ' обл.';
			} else {
				if(isset($this->rn->name)) $address[3] = $this->rn->name . ' р-н';
				if(isset($this->obl->name)) $address[4] = $this->obl->name . ' обл.';
			}
			if(isset($this->descr->value)) $address[5] = $this->descr->value;
			return implode(', ', $address);
        } else return $this->mustangaddress;
    }
    
    public function getGps() {
         return $this->hasOne(Gps::className(), [ 'id' => 'valueid' ])
                        ->viaTable('addresses', ['objid' => 'objid'], function($query) {
            return $query->onCondition(['typeid' => 10]);
        });
    }
    
    public function getFullgps() {
        if(isset($this->gps->lat)) return $this->gps->lat / 1000000 . ' N, ' . $this->gps->long / 1000000 . ' E';
        else return NULL;
        
    }
    
    public function getStatus() {
        if($this->statusid == 3) return 'планируемый';
        if($this->statusid == 4) return 'эксплуатация';
        if($this->statusid == 6) return 'строящийся';
        if($this->statusid == 7) return 'закрыт';
    }

    public function getMol() {
         return $this->hasOne(People::className(), [ 'id' => 'molid' ]);
    }
     
    public function getRelations() {
// 	    print_r($this);
// 	    print_r(Yii::$app->request);
	    $url = Yii::$app->urlManager->parseRequest(Yii::$app->request);
	    if ($url[0] == 'sites/view') return $this->hasMany(Sites::className(), ['objid' => 'objid'])
	    ->where('sites.id <> ' . $this->id)->orderBy('typeid, nr');
		else return $this->hasMany(Sites::className(), ['objid' => 'objid'])->orderBy('typeid, nr');
    }
    
    public function getRel() {
        if($this->relationid == 2) return 'на площадке RBS';
        if($this->relationid == 3) return 'на отдельной площадке';
    }
          
    public function getSimilarSites() {
        return $this->hasMany(Sites::className(), ['objid' => 'objid'])
                ->where('sites.id <> ' . $this->id);
    }
    
    public function getSearchNr() {
	$length = strlen($this->nr);
// 	if ($length < 8) {
	    $nr = null;
	    if ($length >= 4) $nr = substr($this->nr, $length - 4, 4) + 0;
	    else $nr = $this->nr;
// 	    if ($length == 3) $nr = $this->nr;
// 
// 	    if ($length == 4) {
// 			if (substr($this->nr, 0, 1) == 0) $nr = substr($this->nr, 1, 3);
// 			else $nr = $this->nr;
// 			$nr = $this->nr;
// 	    }
	    
// 	    if (strlen($nr) == 4) {
// 		if (substr($nr, 0, 1) == 0) $nr = substr($nr, 1, 3);
// 	    }
	    return $nr;
// 	} else return $this->nr;
    }
    
    public function getSearchOtherNr() {
        $nr = $this->searchNr;
        $length = strlen($nr);
        if ($length > 7 or $length < 3) return null; 
        $p3 = substr($nr, $length - 2, 2);
        $p2 = substr($nr, $length - 3, 1);
        if ($length == 4) $p1 = substr($nr, 0, 1);
        else $p1 = null;
        
        if ($p2 == 0) $p2 = 8;
        else if ($p2 == 1) $p2 = 9;
        else if ($p2 == 2) $p2 = 7;
        else if ($p2 == 3) return null;
        else if ($p2 == 4) $p2 = 6;
        else if ($p2 == 5) return null;
        else if ($p2 == 6) $p2 = 4;
        else if ($p2 == 7) $p2 = 2;
        else if ($p2 == 8) $p2 = 0;
        else if ($p2 == 9) $p2 = 1;
//         if ($p1 == 0) $p1 = null;
        
        return $p1 . $p2 . $p3;

    }

    public function getContacts() {
		return $this->hasMany(Contacts::className(), [ 'objid' => 'objid' ]);
    }

    public function getDiscrepancy() {
		return $this->hasMany(Discrepancy::className(), [ 'siteid' => 'id' ])
									->viaTable('sites', ['objid' => 'objid'])
									->orderBy('siteid');
    }

    public function getObjectsites() {
		return $this->hasMany(Sites::className(), [ 'objid' => 'objid' ]);
    }
	
    public function getCode() {
		return $this->hasOne(SiteaccessCodes::className(), [ 'siteid' => 'id' ])
									->viaTable('sites', ['objid' => 'objid']);
									// ->orderBy('siteid');
	}
	
    public function getVisits() {
		return $this->hasMany(Siteaccess::className(), [ 'siteid' => 'id' ])
									->viaTable('sites', ['objid' => 'objid'])
									->orderBy('firstoc DESC');
	}
}
