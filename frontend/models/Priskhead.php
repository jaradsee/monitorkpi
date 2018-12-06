<?php

namespace frontend\models;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\Expression;
use yii\helpers\Json;
use frontend\models\Headmaster;
use frontend\models\Prohead;
use frontend\models\Prodetail;
use frontend\models\Clinictype;
use frontend\models\Level;
use frontend\models\Adddep;
use frontend\models\Complain;
use frontend\models\Dep;
use frontend\models\Sentinel;
use common\models\User;
use common\models\PriskheadQuery;
/**
 * This is the model class for table "priskhead".
 *
 * @property string $risk_id
 * @property string $risk_date
 * @property string $event_name
 * @property string $ref
 * @property string $risk_again
 * @property string $date_complete
 * @property string $risk_ref_no
 * @property integer $input_complain
 */
class Priskhead extends \yii\db\ActiveRecord
{
    const UPLOAD_FOLDER='riskphoto';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'priskhead';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['risk_date', 'risk_time', 'event_name', 'outcome_pt'], 'required'],
            [['risk_date','created_at','receive_date','receive_time','reviwe_date','reviwe_time','time_report', 'updated_at','date_report','dep_risk_head'], 'safe'],
            [['department', 'risk_simple','place_id','input_complain',], 'integer'],
            [['outcome_price'], 'number'],
            [['risk_sum_dep'], 'string'],
            [['event_name','reviwe_detailed',], 'string', 'max' => 200],
            [['ref'], 'string', 'max' => 50],
            [['miss','risk_status','result', 'act_st', 'risk_again'], 'string', 'max' => 1],
            [['safety', 'outcome_pt', 'outcome_guest', 'outcome_staff', 'solve_begin', 'sum_solve', 'program_text', 'print_url'], 'string', 'max' => 200],
            [['risk_ref_no'], 'string', 'max' => 100],
            [['prohead', 'prodetail','headmaster'], 'string', 'max' => 6],
            [['clinictype', 'risk_level'], 'string', 'max' => 6],

            [['sentinel'],'integer'],
            [['covenant'],'file','maxFiles'=>1],
            [['docs'],'file','maxFiles'=>10,'skipOnEmpty'=>true]
        ];
    }
public function behaviors()
    {
        return [
            [

                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
           BlameableBehavior::className(),
        ];

    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'risk_id' => 'Risk ID',
            'risk_date' => 'วันที่เกิดอุบัติการณ์',
            'risk_time' => 'เวลา',
            'event_name' => 'บรรยายเหตุการณ์ (แบบสั้นๆ ระบุปัญหา)',
            'ref' => 'Ref',
            'department' => 'แผนกที่รายงาน',
            'adddepName' => 'แผนกที่รายงาน',
            'miss' => 'Miss หมายถึงเหตุการณ์นั้นเกิดขึ้นแล้ว NearMiss หมายถึงเหตุกาณ์ยังไม่เกิดขึ้น',
            'safety' => 'การป้องกันปัญหาไม่ให้เกิดขึ้นซ้ำ(มาตรการป้องกัน)',
            'outcome_pt' => 'ผลลัพธ์ที่เกิดขึ้นกับผู้ป่วย',
            'outcome_guest' => 'ผลลัพธ์ที่เกิดขึ้นกับญาติ',
            'outcome_staff' => 'ผลลัพธ์ที่เกิดขึ้นกับเจ้าหน้าที่',
            'outcome_price' => 'ความเสียหาย(ค่าชดเชย/ค่าซ่อมบำรุง)',
            'solve_begin' => 'การแก้ปัญหาเฉพาะหน้า',
            'sum_solve' => 'สรุปผลการแก้ปัญหา',
            'resultName' => 'สรุปผลการแก้ปัญหา',
            'risk_level' => 'ระดับความรุนแรง',
            'levelName' => 'ระดับความรุนแรง',
            'dep_risk_head' => 'ทีมนำที่เกี่ยวข้อง',
            'depName' => 'หน่วยงานที่เกี่ยวข้อง',
            'risk_status' => 'สถานะรายการ',
            'statusName' => 'สถานะรายการ',
            'headmaster' => 'โปรแกรมความเสี่ยง',
            'headmasterName' => 'โปรแกรมความเสี่ยง',
            'prohead' =>'โปรแกรมย่อยความเสี่ยง',
            'proheadName' => 'โปรแกรมย่อยความเสี่ยง',
            'prodetail' => 'หัวข้ออุบัติการณ์',
            'prodetailName' => 'หัวข้ออุบัติการณ์',
            'program_text' => 'อื่นๆ ระบุ',
            'created_by' => 'Login Name',
            'risk_sum_dep' => 'การทบทวนของหน่วยงาน (มาตรการป้องกัน)',
            'risk_simple' => 'อุบัติการณ์ตาม Simple',
            'simpleName' => 'อุบัติการณ์ตาม Simple',
            'created_at' => 'Date Input',
            'updated_at' => 'Last Update',
            'last_staff' => 'Last Staff',
            'print_url' => 'Print Url',
            'act_st' => 'การทบทวน',
            'clinictype' => 'ประเภทความเสี่ยง',
            'clinictypeName' => 'ประเภทความเสี่ยง',
            'place_id' => 'สถานที่เกิดเหตุ',
            'riskplaceName' => 'สถานที่เกิดเหตุ',
            'dep_risk' => 'หน่วยงานที่เกี่ยวข้อง',
            'updayed_by' => 'Staff',
            'risk_again' => 'อุบัติการณ์ซ้ำ',
            'date_report' => 'วันที่รายงานความเสี่ยง',
            'time_report' =>'เวลาที่รายงานความเสี่ยง',
            'risk_ref_no' => 'Risk Ref No',
            'input_complain' => 'ช่องทางการรับรายงาน',
            'complainName' => 'ช่องทางการรับรายงาน',
            'sentinel'=>'sentinel_event ความเสี่ยงที่เฝ้าระวังเป็นพิเศษหรือเหตุการณ์ไม่พึงประสงค์ที่ก่อให้เกิดการเสียชีวิตหรืออันตรายขั้นรุนแรง ที่ต้องตื่นตัว ใส่ใจ ให้ความสำคัญสูง ',


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
    public function getHeadmasters(){
        return @$this->hasOne(Headmaster::className(),['HEADMASTER_ID'=>'headmaster']);
    }
    public function getHeadmasterName(){
        return @$this->headmasters->HEADMASTER_NAME;
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

    public function getThumbnails($ref,$event_name){
         $uploadFiles   = Uploadsp::find()->where(['ref'=>$ref])->all();
         $preview = [];
        foreach ($uploadFiles as $file) {
            $preview[] = [
                'url'=>self::getUploadUrl(true).$ref.'/'.$file->real_filename,
                'src'=>self::getUploadUrl(true).$ref.'/thumbnail/'.$file->real_filename,
                'options' => ['title' => $event_name]
            ];
        }
        return $preview;
    }
public function listDownloadFiles($type){
     $docs_file = '';
     if(in_array($type, ['docs','covenant'])){
             $data = $type==='docs'?$this->docs:$this->covenant;
             $files = Json::decode($data);
            if(is_array($files)){
                 $docs_file ='<ul>';
                 foreach ($files as $key => $value) {
                    $docs_file .= '<li>'.Html::a($value,['/priskhead/download','id'=>$this->risk_id,'file'=>$key,'file_name'=>$value]).'</li>';
                 }
                 $docs_file .='</ul>';
            }
     }

     return $docs_file;
    }

    public function initialPreview($data,$field,$type='file'){
            $initial = [];
            $files = Json::decode($data);
            if(is_array($files)){
                 foreach ($files as $key => $value) {
                    if($type=='file'){
                        $initial[] = "<div class='file-preview-other'><h2><i class='glyphicon glyphicon-file'></i></h2></div>";
                    }elseif($type=='config'){
                        $initial[] = [
                            'caption'=> $value,
                            'width'  => '120px',
                            'url'    => Url::to(['/priskhead/deletefile','id'=>$this->risk_id,'fileName'=>$key,'field'=>$field]),
                            'key'    => $key
                        ];
                    }
                    else{
                        $initial[] = Html::img(self::getUploadUrl().$this->ref.'/'.$value,['class'=>'file-preview-image', 'alt'=>$model->file_name, 'title'=>$model->file_name]);
                    }
                 }
         }
        return $initial;
    }

    public function getCreateUser(){
        return @$this->hasOne(User::className(),['id'=>'created_by']);
    }

    public function getCreatedBy(){
        return @$this->createUser->username;
    }

    public function getUpdateUser(){
        return @$this->hasOne(User::className(),['id'=>'updated_by']);
    }
    public function getUpdatedBy(){
        return @$this->updateUser->username;
    }
}
