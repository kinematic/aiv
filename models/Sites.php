<?php

namespace app\models;

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
    public $oblid;
    public $oblname;
    public $rnid;
    public $typenpid;
    public $npid;
    public $typestrid;
    public $strid;
    public $budval;
    public $descrval;
    public $commentval;
    public $gpsval;
    
    
    
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
            [['latrad', 'longrad'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'typeid' => 'тип',
            'regionid' => 'регион',
            'nr' => '№',
            'oblid' => 'область',
            'rnid' => 'район',
            'typenpid' => 'тип НП',
            'npid' => 'НП',
            'typestrid' => 'тип улицы',
            'strid' => 'улица',
            'budval' => 'дом',
            'descrval' => 'расположение',
            'commentval' => 'комментарий',
            'objid' => 'Objid',
            'relationid' => 'Relationid',
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
            'molname' => 'МОЛ',
            'rel' => 'расположение',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSitestype()
    {
        return $this->hasOne(Sitestype::className(), ['id' => 'typeid']);
    }
    
    public function getType()
    {
        return $this->sitestype->name;
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSitesregion()
    {
        return $this->hasOne(Sitesregion::className(), ['id' => 'regionid']);
    }
    
    public function getRegion()
    {
        return $this->sitesregion->name;
    }
    
    public function getSitename()
    {
        return $this->type . ' ' . $this->region . $this->nr;
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
        $address = '';
        if(isset($this->np->name)) $address .= $this->typenp->name . ' ' . $this->np->name;
        if(isset($this->typestr->name) and isset($this->str->name)) {
            if (!isset($this->typestr->position)) $address .= ', ' . $this->typestr->name . ' ' . $this->str->name;
            else $address .= ', ' . $this->str->name . ' ' . $this->typestr->name;
        }
        if(isset($this->bud->value)) $address .= ', ' . $this->bud->value;
        if(isset($this->np->capital)) {
	    if(isset($this->rn->name) and $this->np->capital <> 2) $address .= ', ' . $this->rn->name . ' р-н';
	    if(isset($this->obl->name) and $this->np->capital <> 1) $address .= ', ' . $this->obl->name . ' обл.';
        } else {
	    if(isset($this->rn->name)) $address .= ', ' . $this->rn->name . ' р-н';
	    if(isset($this->obl->name)) $address .= ', ' . $this->obl->name . ' обл.';
        }
        
        
        
        if(isset($this->descr->value)) $address .= ', ' . $this->descr->value;
        
        return $address;
    }

//     public function getGps() {
//          return $this->hasOne(Gps::className(), [ 'id' => 'objid' ]);
//     }
    
    public function getGps() {
         return $this->hasOne(Gps::className(), [ 'id' => 'valueid' ])
                        ->viaTable('addresses', ['objid' => 'objid'], function($query) {
            return $query->onCondition(['typeid' => 10]);
        });
    }
    
    public function getFullgps() {
        if(isset($this->gps->lat)) 
//         return $this->gps->lat / 1000000 . ' : ' . $this->gps->long / 1000000;
        return $this->gps->lat / 1000000 . ' N, ' . $this->gps->long / 1000000 . ' E';
        else return NULL;
        
    }
    
    public function getStatus() {
        if($this->statusid == 3) return 'планируемый';
        if($this->statusid == 4) return 'эксплуатация';
        if($this->statusid == 6) return 'строящийся';
        if($this->statusid == 7) return 'закрыт';
    }

    public function getMol() {
         return $this->hasOne(Users::className(), [ 'id' => 'molid' ]);
    }
    
    public function getMolname() {
        if(isset($this->mol->firstname)) return $this->mol->secondname->name . ' ' . $this->mol->firstname;
        else return NULL;
    }
     
    public function getObjects() {
        return $this->hasMany(Sites::className(), ['objid' => 'objid'])
                ->where('sites.id <> ' . $this->id);
    }
    
    public function getRel() {
        if($this->relationid == 2) return 'на одной площадке';
        if($this->relationid == 3) return 'в другом помещении';
    }
          
    public function getSimilarSites() {
        return $this->hasMany(Sites::className(), ['objid' => 'objid'])
                ->where('sites.id <> ' . $this->id);
    }
    
    public function getOtherstandart() {
        $length = strlen($this->nr);
        if ($length >=3) {
            if ($length >= 4) $nr = substr($this->nr, $length - 4, 4);
            else if ($length == 3) $nr = $this->nr;
        }
        $length = strlen($this->nr);
        $p3 = substr($nr, $length - 2, 2);
        $p2 = substr($nr, $length - 3, 1);
        if ($length == 4) $p1 = substr($nr, 0, 1);
        else $p1 = null;
        if ($p2 == 0) $p2 = 8;
        if ($p2 == 1) $p2 = 9;
        if ($p2 == 2) $p2 = 7;
        if ($p2 == 4) $p2 = 6;
        if ($p2 == 6) $p2 = 4;
        if ($p2 == 7) $p2 = 2;
        if ($p2 == 8) $p2 = 0;
        if ($p2 == 9) $p2 = 1;
        if ($p1 == 0) $p1 = null;
        
        return $p1 . $p2 . $p3;
    }
}
