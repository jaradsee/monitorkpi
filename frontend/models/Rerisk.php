<?php

namespace app\models;

use Yii;
use yii\helpers\Url;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "rerisk".
 *
 * @property string $risk_id
 * @property string $rerisk_date
 * @property string $reviwrisk
 * @property string $ref
 * @property string $date_recive
 * @property string $time_recive
 * @property integer $input_complain
 * @property string $risk_time
 * @property string $safety
 * @property string $sum_solve
 * @property string $risk_level
 * @property string $risk_status
 * @property string $program_text
 * @property string $login_name
 * @property string $risk_sum_dep
 * @property integer $risk_simple
 * @property string $date_input
 * @property string $last_update
 * @property string $staff
 * @property string $last_staff
 * @property string $dep_risk_head
 * @property integer $sentinel
 * @property string $covenant
 * @property string $docs
 */
class Rerisk extends \yii\db\ActiveRecord
{
    const UPLOAD_FOLDER='riskphoto';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rerisk';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rerisk_date', 'reviwrisk'], 'required'],
            [['rerisk_date', 'date_recive', 'time_recive', 'date_input', 'last_update'], 'safe'],
            [['input_complain', 'risk_simple', 'sentinel'], 'integer'],
            [['reviwrisk', 'safety', 'sum_solve', 'program_text', 'risk_sum_dep'], 'string', 'max' => 200],
            [['ref', 'covenant', 'docs'], 'string', 'max' => 50],
            [['risk_time'], 'string', 'max' => 6],
            [['risk_level', 'risk_status'], 'string', 'max' => 1],
            [['login_name', 'staff', 'last_staff'], 'string', 'max' => 100],
            [['dep_risk_head'], 'string', 'max' => 255],
            [['ref'], 'unique']
        ];
    }
public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'date_input',
                'updatedAtAttribute' => 'last_update',
                'value' => new Expression('NOW()'),
            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'risk_id' => 'Risk ID',
            'rerisk_date' => 'Rerisk Date',
            'reviwrisk' => 'Reviwrisk',
            'ref' => '�Ţ fk �Ѻ upload ��Ѻ upload ajax',
            'date_recive' => 'Date Recive',
            'time_recive' => 'Time Recive',
            'input_complain' => 'Input Complain',
            'risk_time' => 'Risk Time',
            'safety' => 'Safety',
            'sum_solve' => 'Sum Solve',
            'risk_level' => 'Risk Level',
            'risk_status' => 'Risk Status',
            'program_text' => 'Program Text',
            'login_name' => 'Login Name',
            'risk_sum_dep' => 'Risk Sum Dep',
            'risk_simple' => 'Risk Simple',
            'date_input' => 'Date Input',
            'last_update' => 'Last Update',
            'staff' => 'Staff',
            'last_staff' => 'Last Staff',
            'dep_risk_head' => 'Dep Risk Head',
            'sentinel' => 'Sentinel',
            'covenant' => 'คู่มือ/วิธีปฏิบัติ',
            'docs' => 'เอการประกอบ',
        ];
    }

public function getArray($value)
    {
        return explode(',', $value);
    }

    public function setToArray($value)
    {   
        return is_array($value)?implode(',', $value):NULL;
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if(!empty($this->social)){
                $this->social = $this->setToArray($this->social);
                
            }
            return true;
        } else {
            return false;
        }
    }

    public static function itemAlias($type,$code=NULL) {
        $_items = array(
            'miss' => array(
                '1' => 'miss',
                '2' => 'nearmiss',
            ),
            'risk_again' => array(
                '1' => 'อุบัติการณ์ซ้ำ',
                
            ),
            'act_st' => array(
                '1' => 'ทบทวนเอง',
                '2' => 'ขอเวที่ทบทวน'
                
            ),
            
            
            
        );
        

        if (isset($code)){
            return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
        }
        else{         
            return isset($_items[$type]) ? $_items[$type] : false;    
        }
    }



    // Inverse Relations  & Virtual attribute

    public function getFullname(){
        return $this->title.$this->name.' '.$this->surname;
    }

    public function getProheads(){
        return @$this->hasOne(Prohead::className(),['PROHEAD_ID'=>'prohead']);
    }
    public function getProheadName(){
        return @$this->proheads->PROHEAD_NAME;
    }

    public function getProdetails(){
        return @$this->hasOne(Prodetail::className(),['PRODETAIL_ID'=>'prodetail']);
    }
    public function getProdetailName(){
        return @$this->prodetails->PRODETAIL_NAME;
    }

    public function getComplains(){
        return @$this->hasOne(Complain::className(),['COMPLAIN_ID'=>'input_complain']);
    }
    public function getComplainName(){
        return @$this->complains->COMPLAIN_NAME;
    }
    
    public function getClinictypes(){
        return @$this->hasOne(Clinictype::className(),['CLINICTYPE_ID'=>'clinictype']);
    }
    public function getClinictypeName(){
        return @$this->clinictypes->CLINIC_NAME;
    }
    
    public function getSimples(){
        return @$this->hasOne(Simple::className(),['SIMPLE_ID'=>'risk_simple']);
    }
    public function getSimpleName(){
        return @$this->simples->SIMPLE_NAME;
    }
    
    public function getLevels(){
        return @$this->hasOne(Level::className(),['LEVEL_ID'=>'risk_level']);
    }
    public function getLevelName(){
        return @$this->levels->LEVEL_NAME;
    }
    
    public function getRiskplaces(){
        return @$this->hasOne(Riskplace::className(),['PLACE_ID'=>'place_id']);
    }
    public function getRiskplaceName(){
        return @$this->riskplaces->PLACE_NAME;
    }
    
   public function getDeps(){
        return @$this->hasOne(Dep::className(),['DEP_ID'=>'dep_risk_head']);
    }
    public function getDepName(){
        return @$this->deps->FULLNAME;
    } 
    
    
    public function getAdddeps(){
        return @$this->hasOne(Adddep::className(),['ADDDEP_ID'=>'department']);
    }
    public function getAdddepName(){
        return @$this->adddeps->DEP_NAME;
    } 
       
   public function getStatuss(){
        return @$this->hasOne(Status::className(),['STATUS_ID'=>'risk_status']);
    }
    public function getStatusName(){
        return @$this->statuss->STATUS_NAME;
    }  
    
  public function getResults(){
        return @$this->hasOne(Result::className(),['RESULT_ID'=>'sum_solve']);
    }
    public function getResultName(){
        return @$this->results->RESULT_NAME;
    }  
    
public static function getUploadPath(){
        return Yii::getAlias('@webroot').'/'.self::UPLOAD_FOLDER.'/';
    }

    public static function getUploadUrl(){
        return Url::base(true).'/'.self::UPLOAD_FOLDER.'/';
    }

    public function getThumbnails($ref,$reviwerisk){
         $uploadFiles   = Uploadsp::find()->where(['ref'=>$ref])->all();
         $preview = [];
        foreach ($uploadFiles as $file) {
            $preview[] = [
                'url'=>self::getUploadUrl(true).$ref.'/'.$file->real_filename,
                'src'=>self::getUploadUrl(true).$ref.'/thumbnail/'.$file->real_filename,
                'options' => ['title' => $reviwerisk]
            ];
        }
        return $preview;
    }

    
}

