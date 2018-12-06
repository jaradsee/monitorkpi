<?php

namespace frontend\models;

use Yii;
use yii\helpers\Url;


/**
 * This is the model class for table "bmitest".
 *
 * @property integer $id
 * @property string $weight
 * @property string $height
 * @property string $bmi
 * @property string $waistline
 */
class Bmitest extends \yii\db\ActiveRecord
{
  const UPLOAD_FOLDER='fittestphoto';
  /**
   * @inheritdoc
   */
    public static function tableName()
    {
        return 'bmitest';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cid','sex','age','weight', 'height', 'bmi','gradebmi',
            'waistline','gradewaistline','bpsys','bpdi','gradebpsys','gradebpdi','pushup','gradepushup','run2400'
            ,'graderun','heartrate','gradeheart','gripst','griperweight','gradegrip','legpress','legperweight',
          'gradeleg','situp','gradesitup','flexibility','gradeflex','groupid'], 'number'],
            [['dateserv', 'created_at', 'update_at'], 'safe'],
            [['ref'], 'string', 'max' => 50],
            [['fname', 'lname'], 'string', 'max' => 50],
            [[ 'cid','dateserv'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'groupid'=>'กลุ่มทดสอบ',
            'cid'=>'เลขบัตรประชาชน',
            'fname'=>'ชื่อ',
            'lname'=>'นามสกุล',
            'sex' => 'เพศ',
            'age' => 'อายุ',
            'ref' => 'Ref',
            'dateserv'=>'วันที่รับบริการ',
            'weight' => 'น้ำหนัก(กิ่โลกรัม)',
            'height' => 'ส่วนสูง(เมตร)',
            'bmi' => 'ค่าดัชนีมวลกาย',
            'gradebmi'=>'ระดับดัชนีมวลกาย',
            'waistline'=>'รอบเอว',
            'gradewaistlineName'=>'รอบเอว',
            'bpsys'=>'ความดันโลหิตช่วงบน',
            'bpdi'=>'ความดันโลหิตช่วงล่าง',
            'gradebpsys'=>'ค่าระดับความดันโลหิตช่วงบน',
            'gradebpdi'=>'ค่าระดับความดันโลหิตช่วงล่าง',
            'heartrate'=>'อัตราการเต้นหัวใจขณะพัก(ครั้ง/นาที)',
            'gradeheart'=>'แปรผลอัตราการเต้นของหัวใจ',
            'pushup'=>'ดันพื้น',
            'gradepushup'=>'แปรผลดันพื้น',
            'run2400'=>'วิ่งทดสอบ2.4กิโลเมตร',
            'graderun'=>'แปรผลวิ่งทดสอบ2.4กม.',
            'gripst'=>'แรงบีบมือ',
            'griperweight'=>'แรงบีบมือต่อน้าหนักตัว',
            'gradegrip'=>'แปรผลแรงบีบมือ',
            'legpress' =>'แรงเหยียดขา',
            'legperweight' => 'แรงเหยียดขาต่อน้ำหนักตัว',
            'gradeleg' => 'แปรผลแรงเหยียดขาต่อน้ำหนักตัว',
            'situp' =>'ลุกนั่ง 30 วินาที',
            'gradesitup'=>'แปรผลลุกนั่ง 30 วินาที',
            'flexibility'=>'นั่งงอตัวไปข้างหน้า',
            'gradeflex'=>'แปรผลนั่งงอตัวไปข้างหน้า',

        ];
    }
    public function beforeSave($insert){
            $bmi = $this->weight/(($this->height)*2);
            $griperweight = $this->gripst/($this->weight);
            $this->griperweight =$griperweight;

            $legperweight = $this->legpress/($this->weight);
            $this->legperweight =$legperweight;

            $this->bmi =$bmi;
$waistline = $this->waistline;
$sex = $this->sex;
$bpsys = $this->bpsys;
$bpdi = $this->bpdi;
$heartrate = $this->heartrate;
$pushup = $this->pushup;
$age = $this->age;
$run2400 = $this->run2400;
$griperweight= $this->griperweight;
$legperweight= $this->legperweight;
$situp = $this->situp;
$flexibility = $this->flexibility;

			$grade = '';
//	greadebmi	//
			if($bmi >= 30 ){
				$this->gradebmi = '5' ;
      }else if ($bmi >= 25 and $bmi <= 29.9 ){
				$this->gradebmi = '4' ;
			}else if ($bmi >= 23 and $bmi <= 24.9 ){
				$this->gradebmi = '3' ;
      }else if ($bmi >= 18.5 and $bmi <= 22.9 ){
				$this->gradebmi = '2' ;
			}else if($bmi < 18.5) {
				$this->gradebmi = '1' ;
			}else{
				$this->gradebmi = 0;
			}
//	แบ่งระดบค่าดัชนีค่าดัชนีมวลกาย	จบ//
// gradewaistline//
if($sex== 1 and $waistline >90){
  $this->gradewaistline = '2' ;
}else if ($sex== 1 and $waistline <= 90 ){
  $this->gradewaistline = '1' ;
}else if($sex== 2 and $waistline > 80 ){
  $this->gradewaistline = '2' ;
}else if ($sex== 2 and $waistline <= 80 ){
  $this->gradewaistline = '1' ;
}else {
  $this->gradewaistline = 0;
}

// รอบเอว มาตรฐาน ขาย หญิง//

// ความดันโลหิต systolic//

if($bpsys > 120 and $bpsys <= 139){
  $this->gradebpsys = '2' ;
}else if ($bpsys <= 120  ){
  $this->gradebpsys= '1' ;
}else if($bpsys >=140 and $bpsys <= 159) {
  $this->gradebpsys = '3' ;
}else if($bpsys >=160 ) {
  $this->gradebpsys = '4' ;
}else{
  $this->gradebpsys = 0;
}
// ความดันโลหิต systolic//
if($bpdi > 80 and $bpdi <=89){
  $this->gradebpdi = '2' ;
}else if ($bpdi <= 80  ){
  $this->gradebpdi= '1' ;
}else if($bpdi >=90 and $bpdi <= 99) {
  $this->gradebpdi = '3' ;
}else if($bpdi >=100 ) {
  $this->gradebpdi = '4' ;
}else{
  $this->gradebpdi = 0;
}
// จบความดันโลหิต systolic//
// ดันพื้น pushup//
if($sex== 1 and $age >=60 and $pushup >=17){
  $this->gradepushup = '5' ;
}else if ($sex== 1 and $age >=60 and $pushup <= 16 and $pushup >=11 ){
  $this->gradepushup = '4' ;
}else if($sex== 1 and $age>=60 and $pushup <=10 and $pushup>=8){
  $this->gradepushup = '3' ;
}else if ($sex== 1 and $age >=0 and $pushup <= 5 and $pushup >=7 ){
  $this->gradepushup = '2' ;
}else if ($sex== 1 and $age >=60 and $pushup <= 4  ){
  $this->gradepushup = '1' ;
}else if($sex== 2 and $age >=60 and $pushup >=16){
    $this->gradepushup = '5' ;
}else if ($sex== 2 and $age >=60 and $pushup <= 15 and $pushup >=11 ){
    $this->gradepushup = '4' ;
}else if($sex== 2 and $age>=60 and $pushup <=10 and $pushup>=5){
    $this->gradepushup = '3' ;
}else if ($sex== 2 and $age >=60 and $pushup <= 4 and $pushup >=1 ){
    $this->gradepushup = '2' ;
}else if ($sex== 2 and $age >=60 and $pushup <= 0  ){
    $this->gradepushup = '1' ;
}else if($sex== 1 and $age >=50 and $age<=59 and $pushup >=18){
    $this->gradepushup = '5' ;
}else if ($sex== 1 and $age >=50 and $age<=59 and $pushup <= 17 and $pushup >=12 ){
    $this->gradepushup = '4' ;
}else if($sex== 1 and $age >=50 and $age<=59 and $pushup <=11 and $pushup>=10){
    $this->gradepushup = '3' ;
}else if ($sex== 1 and $age >=50 and $age<=59 and $pushup <= 9 and $pushup >=6 ){
    $this->gradepushup = '2' ;
}else if ($sex== 1 and $age >=50 and $age<=59 and $pushup <= 5  ){
    $this->gradepushup = '1' ;
}else if($sex== 2 and $age >=50 and $age<=59 and $pushup >=18){
    $this->gradepushup = '5' ;
}else if ($sex== 2 and $age >=50 and $age<=59 and $pushup <= 17 and $pushup >=11 ){
    $this->gradepushup = '4' ;
}else if($sex== 2 and $age >=50 and $age<=59 and $pushup <=10 and $pushup>=6){
    $this->gradepushup = '3' ;
}else if ($sex== 2 and $age >=50 and $age<=59 and $pushup <= 5 and $pushup >=2 ){
    $this->gradepushup = '2' ;
}else if ($sex== 2 and $age >=50 and $age<=59 and $pushup <= 1  ){
    $this->gradepushup = '1' ;
}else if($sex== 1 and $age >=40 and $age<=49 and $pushup >=22){
    $this->gradepushup = '5' ;
}else if ($sex== 1 and $age >=40 and $age<=49 and $pushup <= 21 and $pushup >=17 ){
    $this->gradepushup = '4' ;
}else if($sex== 1 and $age >=40 and $age<=49 and $pushup <=16 and $pushup>=13){
    $this->gradepushup = '3' ;
}else if ($sex== 1 and $age >=40 and $age<=49 and $pushup <= 12 and $pushup >=9 ){
    $this->gradepushup = '2' ;
}else if ($sex== 1 and $age >=40 and $age<=49 and $pushup <= 8  ){
    $this->gradepushup = '1' ;
}else if($sex== 2 and $age >=40 and $age<=49 and $pushup >=23){
    $this->gradepushup = '5' ;
}else if ($sex== 2 and $age >=40 and $age<=49 and $pushup <= 22 and $pushup >=15 ){
    $this->gradepushup = '4' ;
}else if($sex== 2 and $age >=40 and $age<=49 and $pushup <=14 and $pushup>=11){
    $this->gradepushup = '3' ;
}else if ($sex== 2 and $age >=40 and $age<=49 and $pushup <= 10 and $pushup >=5 ){
    $this->gradepushup = '2' ;
}else if ($sex== 2 and $age >=40 and $age<=49 and $pushup <= 4  ){
    $this->gradepushup = '1' ;
}else if($sex== 1 and $age >=30 and $age<=39 and $pushup >=28){
    $this->gradepushup = '5' ;
}else if ($sex== 1 and $age >=30 and $age<=39 and $pushup <= 27 and $pushup >=22 ){
    $this->gradepushup = '4' ;
}else if($sex== 1 and $age >=30 and $age<=39 and $pushup <=21 and $pushup>=17){
    $this->gradepushup = '3' ;
}else if ($sex== 1 and $age >=30 and $age<=39 and $pushup <= 16 and $pushup >=12 ){
    $this->gradepushup = '2' ;
}else if ($sex== 1 and $age >=30 and $age<=39 and $pushup <= 11  ){
    $this->gradepushup = '1' ;
}else if($sex== 2 and $age >=30 and $age<=39 and $pushup >=25){
    $this->gradepushup = '5' ;
}else if ($sex== 2 and $age >=30 and $age<=39 and $pushup <= 24 and $pushup >=18 ){
    $this->gradepushup = '4' ;
}else if($sex== 2 and $age >=30 and $age<=39 and $pushup <=17 and $pushup>=13){
    $this->gradepushup = '3' ;
}else if ($sex== 2 and $age >=30 and $age<=39 and $pushup <= 12 and $pushup >=8 ){
    $this->gradepushup = '2' ;
}else if ($sex== 2 and $age >=30 and $age<=39 and $pushup <= 7  ){
    $this->gradepushup = '1' ;
}else if($sex== 1 and $age >=20 and $age<=29 and $pushup >=35){
    $this->gradepushup = '5' ;
}else if ($sex== 1 and $age >=20 and $age<=29 and $pushup <= 34 and $pushup >=28 ){
    $this->gradepushup = '4' ;
}else if($sex== 1 and $age >=20 and $age<=29 and $pushup <=27 and $pushup>=22){
    $this->gradepushup = '3' ;
}else if ($sex== 1 and $age >=20 and $age<=29 and $pushup <= 21 and $pushup >=17 ){
    $this->gradepushup = '2' ;
}else if ($sex== 1 and $age >=20 and $age<=29 and $pushup <= 16  ){
    $this->gradepushup = '1' ;
}else if($sex== 1 and $age >=20 and $age<=29 and $pushup >=27){
    $this->gradepushup = '5' ;
}else if ($sex== 2 and $age >=20 and $age<=29 and $pushup <= 26 and $pushup >=21 ){
    $this->gradepushup = '4' ;
}else if($sex== 2 and $age >=20 and $age<=29 and $pushup <=20 and $pushup>=15){
    $this->gradepushup = '3' ;
}else if ($sex== 2 and $age >=20 and $age<=29 and $pushup <=14 and $pushup >=10){
    $this->gradepushup = '2' ;
}else if ($sex== 2 and $age >=20 and $age<=29 and $pushup <= 9  ){
    $this->gradepushup = '1' ;
}else {
  $this->gradepushup = 0;
}
// จบดันพื้นย pushup แบ่งเกณฑ์อายุ และเพศ//
// วิ่งทดสอบ 2.4 กิโลเมตร run 2.4 km//
if($sex== 1 and $age >=60 and $run2400 <11.5){
  $this->graderun = '6' ;
}else if ($sex== 1 and $age >=60 and $run2400 <13.59 and $run2400 >11.15 ){
  $this->graderun = '5' ;
}else if($sex== 1 and $age>=60 and $run2400 <16.15 and $run2400>14.00){
  $this->graderun = '4' ;
}else if ($sex== 1 and $age >=60 and $run2400 <19.00 and $run2400 >16.16 ){
  $this->graderun = '3' ;
}else if ($sex== 1 and $age >=60 and$run2400 <20.00 and $run2400 >19.01){
  $this->graderun = '2' ;
}else if ($sex== 1 and $age >=60 and$run2400 >=20.00){
  $this->graderun = '1' ;
}else if($sex== 2 and $age >=60 and $run2400 <16.30){
    $this->graderun = '6' ;
}else if ($sex== 2 and $age >=60 and $run2400 <17.30 and $run2400 >16.30 ){
  $this->graderun = '5' ;
}else if($sex== 2 and $age>=60 and $run2400 <19.30 and $run2400>17.31){
  $this->graderun = '4' ;
}else if ($sex== 2 and $age >=60 and $run2400 <20.30 and $run2400 >19.31 ){
  $this->graderun = '3' ;
}else if ($sex== 2 and $age >=60 and$run2400 <21.00 and $run2400 >20.31){
  $this->graderun = '2' ;
}else if ($sex== 2 and $age >=60 and$run2400 >=21.01){
  $this->graderun = '1' ;
}else if($sex== 1 and $age >=50 and $age<=59 and $run2400 <11.00){
  $this->graderun = '6' ;
}else if ($sex== 1 and $age >=50 and $age<=59 and $run2400 <12.30 and $run2400 >11.00 ){
  $this->graderun = '5' ;
}else if($sex== 1 and $age >=50 and $age<=59 and $run2400 <14.30 and $run2400>12.31){
  $this->graderun = '4' ;
}else if ($sex== 1 and $age >=50 and $age<=59 and $run2400 <17.00 and $run2400 >14.31 ){
  $this->graderun = '3' ;
}else if ($sex== 1 and $age >=50 and $age<=59 and$run2400 <19.00 and $run2400 >17.01){
  $this->graderun = '2' ;
}else if ($sex== 1 and $age >=50 and $age<=59 and$run2400 >=19.01){
  $this->graderun = '1' ;
}else if($sex== 2 and $age >=50 and $age<=59 and $run2400 <14.30){
    $this->graderun = '6' ;
}else if ($sex== 2 and $age >=50 and $age<=59 and $run2400 <16.30 and $run2400 >14.30 ){
  $this->graderun = '5' ;
}else if($sex== 2 and $age >=50 and $age<=59 and $run2400 <19.30 and $run2400>16.31){
  $this->graderun = '4' ;
}else if ($sex== 2 and $age >=50 and $age<=59 and $run2400 <20.00 and $run2400 >19.31 ){
  $this->graderun = '3' ;
}else if ($sex== 2 and $age >=50 and $age<=59 and $run2400 <20.30 and $run2400 >20.01){
  $this->graderun = '2' ;
}else if ($sex== 2 and $age >=50 and $age<=59 and $run2400 >=20.31){
    $this->graderun = '1' ;
  }else if($sex== 1 and $age >=40 and $age<=49 and $run2400 <10.30){
    $this->graderun = '6' ;
  }else if ($sex== 1 and $age >=40 and $age<=49 and $run2400 <=11.30 and $run2400 >10.30 ){
    $this->graderun = '5' ;
  }else if($sex== 1 and $age >=40 and $age<=49 and $run2400 <13.00 and $run2400>11.31){
    $this->graderun = '4' ;
  }else if ($sex== 1 and $age >=40 and $age<=49 and $run2400 <15.35 and $run2400 >13.01 ){
    $this->graderun = '3' ;
  }else if ($sex== 1 and $age >=40 and $age<=49 and $run2400 <17.30 and $run2400 >15.36){
    $this->graderun = '2' ;
  }else if ($sex== 1 and $age >=40 and $age<=49 and $run2400 >=17.31){
    $this->graderun = '1' ;
  }else if($sex== 2 and $age >=40 and $age<=49 and $run2400 <13.45){
      $this->graderun = '6' ;
  }else if ($sex== 2 and $age >=40 and $age<=49 and $run2400 <15.55 and $run2400 >13.45 ){
    $this->graderun = '5' ;
  }else if($sex== 2 and $age >=40 and $age<=49 and $run2400 <17.30 and $run2400>15.56){
    $this->graderun = '4' ;
  }else if ($sex== 2 and $age >=40 and $age<=49 and $run2400 <19.30 and $run2400 >17.31 ){
    $this->graderun = '3' ;
  }else if ($sex== 2 and $age >=40 and $age<=49 and $run2400 <20.00 and $run2400 >19.31){
    $this->graderun = '2' ;
  }else if ($sex== 2 and $age >=40 and $age<=49 and $run2400 >=20.01){
      $this->graderun = '1' ;
    }else if($sex== 1 and $age >=30 and $age<=39 and $run2400 <10.00){
      $this->graderun = '6' ;
    }else if ($sex== 1 and $age >=30 and $age<=39 and $run2400 <11.00 and $run2400 >10.00 ){
      $this->graderun = '5' ;
    }else if($sex== 1 and $age >=30 and $age<=39 and $run2400 <12.30 and $run2400>11.01){
      $this->graderun = '4' ;
    }else if ($sex== 1 and $age >=30 and $age<=39 and $run2400 <14.45 and $run2400 >12.31 ){
      $this->graderun = '3' ;
    }else if ($sex== 1 and $age >=30 and $age<=39 and $run2400 <16.30 and $run2400 >14.46){
      $this->graderun = '2' ;
    }else if ($sex== 1 and $age >=30 and $age<=39 and $run2400 >=16.31){
      $this->graderun = '1' ;
    }else if($sex== 2 and $age >=30 and $age<=39 and $run2400 <13.00){
        $this->graderun = '6' ;
    }else if ($sex== 2 and $age >=30 and $age<=39 and $run2400 <14.30 and $run2400 >13.00 ){
      $this->graderun = '5' ;
    }else if($sex== 2 and $age >=30 and $age<=39 and $run2400 <16.30 and $run2400>14.31){
      $this->graderun = '4' ;
    }else if ($sex== 2 and $age >=30 and $age<=39 and $run2400 <19.00 and $run2400 >16.31 ){
      $this->graderun = '3' ;
    }else if ($sex== 2 and $age >=30 and $age<=39 and $run2400 <19.30 and $run2400 >19.01){
      $this->graderun = '2' ;
    }else if ($sex== 2 and $age >=30 and $age<=39 and $run2400 >=19.31){
        $this->graderun = '1' ;
      }else if($sex== 1 and $age >=20 and $age<=29 and $run2400 <9.45){
        $this->graderun = '6' ;
      }else if ($sex== 1 and $age >=20 and $age<=29 and $run2400 <10.45 and $run2400 >9.45 ){
        $this->graderun = '5' ;
      }else if($sex== 1 and $age >=20 and $age<=29 and $run2400 <12.00 and $run2400>10.46){
        $this->graderun = '4' ;
      }else if ($sex== 1 and $age >=20 and $age<=29 and $run2400 <14.00 and $run2400 >12.01 ){
        $this->graderun = '3' ;
      }else if ($sex== 1 and $age >=20 and $age<=29 and $run2400 <16.00 and $run2400 >14.01){
        $this->graderun = '2' ;
      }else if ($sex== 1 and $age >=20 and $age<=29 and $run2400 >=16.01){
        $this->graderun = '1' ;
      }else if($sex== 2 and $age >=20 and $age<=29 and $run2400 <12.30){
          $this->graderun = '6' ;
      }else if ($sex== 2 and $age >=20 and $age<=29 and $run2400 <13.30 and $run2400 >12.30 ){
        $this->graderun = '5' ;
      }else if($sex== 2 and $age >=20 and $age<=29 and $run2400 <15.54 and $run2400>13.31){
        $this->graderun = '4' ;
      }else if ($sex== 2 and $age >=20 and $age<=29 and $run2400 <18.30 and $run2400 >15.55 ){
        $this->graderun = '3' ;
      }else if ($sex== 2 and $age >=20 and $age<=29 and $run2400 <19.00 and $run2400 >18.31){
        $this->graderun = '2' ;
      }else if ($sex== 2 and $age >=20 and $age<=29 and $run2400 >=19.01){
          $this->graderun = '1' ;
        }else if($sex== 1 and $age >=13 and $age<=19 and $run2400 <8.37){
          $this->graderun = '6' ;
        }else if ($sex== 1 and $age >=13 and $age<=19 and $run2400 <9.40 and $run2400 >8.37 ){
          $this->graderun = '5' ;
        }else if($sex== 1 and $age >=13 and $age<=19 and $run2400 <10.48 and $run2400>9.41){
          $this->graderun = '4' ;
        }else if ($sex== 1 and $age >=13 and $age<=19 and $run2400 <12.10 and $run2400 >10.49 ){
          $this->graderun = '3' ;
        }else if ($sex== 1 and $age >=13 and $age<=19 and $run2400 <15.30 and $run2400 >12.11){
          $this->graderun = '2' ;
        }else if ($sex== 1 and $age >=13 and $age<=19 and $run2400 >=15.31){
          $this->graderun = '1' ;
        }else if($sex== 2 and $age >=13 and $age<=19 and $run2400 <11.50){
            $this->graderun = '6' ;
        }else if ($sex== 2 and $age >=13 and $age<=19 and $run2400 <12.29 and $run2400 >11.50 ){
          $this->graderun = '5' ;
        }else if($sex== 2 and $age >=13 and $age<=19 and $run2400 <14.30 and $run2400>12.30){
          $this->graderun = '4' ;
        }else if ($sex== 2 and $age >=13 and $age<=19 and $run2400 <16.54 and $run2400 >14.31 ){
          $this->graderun = '3' ;
        }else if ($sex== 2 and $age >=13 and $age<=19 and $run2400 <18.30 and $run2400 >16.55){
          $this->graderun = '2' ;
        }else if ($sex== 2 and $age >=13 and $age<=19 and $run2400 >=18.31){
            $this->graderun = '1' ;
}else {
    $this->gradepushup = 0;
}
// จบตัดเกรดวิ่งทดสอบ 2.4 กิโลเมตร run 2.4 km//
// อัตราการเต้นของหัอัตราการเต้นหัวใจขณะพัก heartrate//
if($sex== 1 and $age > 65 and $heartrate  <=55 and $heartrate >=50){
  $this->gradeheart = '7' ;
}else if ($sex== 1 and $age > 65 and $heartrate <=61 and $heartrate >=58 ){
  $this->gradeheart = '6' ;
}else if ($sex== 1 and $age > 65 and $heartrate <=65 and $heartrate >=62 ){
  $this->gradeheart = '5' ;
}else if($sex== 1 and $age > 65 and $heartrate <=69 and $heartrate >=66){
  $this->gradeheart = '4' ;
}else if ($sex== 1 and $age > 65 and $heartrate <=73 and $heartrate >=70){
  $this->gradeheart = '3' ;
}else if ($sex== 1 and $age > 65 and $heartrate <=79 and $heartrate >=75){
  $this->gradeheart = '2' ;
}else if ($sex== 1 and $age > 65 and $heartrate <=98 and $heartrate >=83){
  $this->gradeheart = '1' ;
}else  if ($sex== 2 and $age > 65 and $heartrate  <=59 and $heartrate >=54){
  $this->gradeheart = '7' ;
}else if ($sex== 2 and $age > 65 and $heartrate <=64 and $heartrate >=60 ){
  $this->gradeheart = '6' ;
}else if ($sex== 2 and $age > 65 and $heartrate <=68 and $heartrate >=66 ){
  $this->gradeheart = '5' ;
}else if($sex== 2 and $age > 65 and $heartrate <=70 and $heartrate >=70){
  $this->gradeheart = '4' ;
}else if ($sex== 2 and $age > 65 and $heartrate <=76 and $heartrate >=73){
  $this->gradeheart = '3' ;
}else if ($sex== 2 and $age > 65 and $heartrate <=84 and $heartrate >=79){
  $this->gradeheart = '2' ;
}else if ($sex== 2 and $age > 65 and $heartrate <=96 and $heartrate >=88){
  $this->gradeheart = '1' ;
}else if($sex== 1 and $age >=56 and $age<=65 and $heartrate  <=56 and $heartrate >=51){
    $this->gradeheart = '7' ;
}else if ($sex== 1 and $age >=56 and $age<=65 and $heartrate <=61 and $heartrate >=59 ){
  $this->gradeheart = '6' ;
}else if ($sex== 1 and $age >=56 and $age<=65 and $heartrate <=67 and $heartrate >=64 ){
  $this->gradeheart = '5' ;
}else if($sex== 1 and $age >=56 and $age<=65 and $heartrate <=71 and $heartrate >=68){
  $this->gradeheart = '4' ;
}else if ($sex== 1 and $age >=56 and $age<=65 and $heartrate <=75 and $heartrate >=72){
  $this->gradeheart = '3' ;
}else if ($sex== 1 and $age >=56 and $age<=65 and $heartrate <=81 and $heartrate >=76){
  $this->gradeheart = '2' ;
}else if ($sex== 1 and $age >=56 and $age<=65 and $heartrate <=94 and $heartrate >=84){
  $this->gradeheart = '1' ;
}else if($sex== 2 and $age >=56 and $age<=65 and $heartrate  <=59 and $heartrate >=54){
    $this->gradeheart = '7' ;
}else if ($sex== 2 and $age >=56 and $age<=65 and $heartrate <=64 and $heartrate >=61 ){
  $this->gradeheart = '6' ;
}else if ($sex== 2 and $age >=56 and $age<=65 and $heartrate <=69 and $heartrate >=67 ){
  $this->gradeheart = '5' ;
}else if($sex== 2 and $age >=56 and $age<=65 and $heartrate <=73 and $heartrate >=71){
  $this->gradeheart = '4' ;
}else if ($sex== 2 and $age >=56 and $age<=65 and $heartrate <=77 and $heartrate >=75){
  $this->gradeheart = '3' ;
}else if ($sex== 2 and $age >=56 and $age<=65 and $heartrate <=81 and $heartrate >=79){
  $this->gradeheart = '2' ;
}else if ($sex== 2 and $age >=56 and $age<=65 and $heartrate <=96 and $heartrate >=85){
  $this->gradeheart = '1' ;

}else if($sex== 1 and $age >=46 and $age<=55 and $heartrate  <=57 and $heartrate >=50){
    $this->gradeheart = '7' ;
}else if ($sex== 1 and $age >=46 and $age<=55 and $heartrate <=63 and $heartrate >=59 ){
  $this->gradeheart = '6' ;
}else if ($sex== 1 and $age >=46 and $age<=55 and $heartrate <=67 and $heartrate >=64 ){
  $this->gradeheart = '5' ;
}else if($sex== 1 and $age >=46 and $age<=55 and $heartrate <=71 and $heartrate >=68){
  $this->gradeheart = '4' ;
}else if ($sex== 1 and $age >=46 and $age<=55 and $heartrate <=76 and $heartrate >=73){
  $this->gradeheart = '3' ;
}else if ($sex== 1 and $age >=46 and $age<=55 and $heartrate <=83 and $heartrate >=79){
  $this->gradeheart = '2' ;
}else if ($sex== 1 and $age >=46 and $age<=55 and $heartrate <=97 and $heartrate >=85){
  $this->gradeheart = '1' ;

}else if($sex== 2 and $age >=46 and $age<=55 and $heartrate  <=60 and $heartrate >=54){
    $this->gradeheart = '7' ;
}else if ($sex== 2 and $age >=46 and $age<=55 and $heartrate <=65 and $heartrate >=61 ){
  $this->gradeheart = '6' ;
}else if ($sex== 2 and$age >=46 and $age<=55 and $heartrate <=69 and $heartrate >=66 ){
  $this->gradeheart = '5' ;
}else if($sex== 2 and $age >=46 and $age<=55 and $heartrate <=73 and $heartrate >=70){
  $this->gradeheart = '4' ;
}else if ($sex== 2 and $age >=46 and $age<=55 and $heartrate <=77 and $heartrate >=74){
  $this->gradeheart = '3' ;
}else if ($sex== 2 and $age >=46 and $age<=55 and $heartrate <=84 and $heartrate >=78){
  $this->gradeheart = '2' ;
}else if ($sex== 2 and $age >=46 and $age<=55 and $heartrate <=96 and $heartrate >=85){
  $this->gradeheart = '1' ;

}else if($sex== 1 and $age >=45 and $age<=36 and $heartrate  <=56 and $heartrate >=50){
    $this->gradeheart = '7' ;
}else if ($sex== 1 and $age >=45 and $age<=36 and $heartrate <=62 and $heartrate >=60 ){
  $this->gradeheart = '6' ;
}else if ($sex== 1 and $age >=45 and $age<=36 and $heartrate <=66 and $heartrate >=64 ){
  $this->gradeheart = '5' ;
}else if($sex== 1 and $age >=45 and $age<=36 and $heartrate <=70 and $heartrate >=68){
  $this->gradeheart = '4' ;
}else if ($sex== 1 and $age >=45 and $age<=36 and $heartrate <=76 and $heartrate >=73){
  $this->gradeheart = '3' ;
}else if ($sex== 1 and $age >=45 and $age<=36 and $heartrate <=82 and $heartrate >=77){
  $this->gradeheart = '2' ;
}else if ($sex== 1 and $age >=45 and $age<=36 and $heartrate <=96 and $heartrate >=86){
  $this->gradeheart = '1' ;

}else if($sex== 2 and $age >=45 and $age<=36 and $heartrate  <=59 and $heartrate >=54){
    $this->gradeheart = '7' ;
}else if ($sex== 2 and $age >=45 and $age<=36 and $heartrate <=64 and $heartrate >=62 ){
  $this->gradeheart = '6' ;
}else if ($sex== 2 and $age >=45 and $age<=36 and $heartrate <=69 and $heartrate >=66 ){
  $this->gradeheart = '5' ;
}else if($sex== 2 and $age >=45 and $age<=36 and $heartrate <=72 and $heartrate >=70){
  $this->gradeheart = '4' ;
}else if ($sex== 2 and $age >=45 and $age<=36 and $heartrate <=78 and $heartrate >=74){
  $this->gradeheart = '3' ;
}else if ($sex== 2 and $age >=45 and $age<=36 and $heartrate <=82 and $heartrate >=79){
  $this->gradeheart = '2' ;
}else if ($sex== 2 and $age >=45 and $age<=36 and $heartrate <=92 and $heartrate >=84){
  $this->gradeheart = '1' ;

}else if($sex== 1 and $age >=35 and $age<=26 and $heartrate  <=54 and $heartrate >=49){
    $this->gradeheart = '7' ;
}else if ($sex== 1 and $age >=35 and $age<=26 and $heartrate <=61 and $heartrate >=57 ){
  $this->gradeheart = '6' ;
}else if ($sex== 1 and $age >=35 and $age<=26 and $heartrate <=65 and $heartrate >=62 ){
  $this->gradeheart = '5' ;
}else if($sex== 1 and $age >=35 and $age<=26 and $heartrate <=70 and $heartrate >=66){
  $this->gradeheart = '4' ;
}else if ($sex== 1 and $age >=35 and $age<=26 and $heartrate <=74 and $heartrate >=72){
  $this->gradeheart = '3' ;
}else if ($sex== 1 and $age >=35 and $age<=26 and $heartrate <=81 and $heartrate >=77){
  $this->gradeheart = '2' ;
}else if ($sex== 1 and $age >=35 and $age<=26 and $heartrate <=94 and $heartrate >=84){
  $this->gradeheart = '1' ;

}else if($sex== 2 and $age >=35 and $age<=26 and $heartrate  <=59 and $heartrate >=54){
    $this->gradeheart = '7' ;
}else if ($sex== 2 and $age >=35 and $age<=26 and $heartrate <=64 and $heartrate >=60 ){
  $this->gradeheart = '6' ;
}else if ($sex== 2 and $age >=35 and $age<=26 and $heartrate <=68 and $heartrate >=66 ){
  $this->gradeheart = '5' ;
}else if($sex== 2 and $age >=35 and $age<=26 and $heartrate <=71 and $heartrate >=69){
  $this->gradeheart = '4' ;
}else if ($sex== 2 and $age >=35 and $age<=26 and $heartrate <=72 and $heartrate >=76){
  $this->gradeheart = '3' ;
}else if ($sex== 2 and $age >=35 and $age<=26 and $heartrate <=82 and $heartrate >=78){
  $this->gradeheart = '2' ;
}else if ($sex== 2 and $age >=35 and $age<=26 and $heartrate <=94 and $heartrate >=84){
  $this->gradeheart = '1' ;

}else if($sex== 1 and $age >=18 and $age<=25 and $heartrate  <=55 and $heartrate >=49){
    $this->gradeheart = '7' ;
}else if ($sex== 1 and $age >=18 and $age<=25 and $heartrate <=61 and $heartrate >=57 ){
  $this->gradeheart = '6' ;
}else if ($sex== 1 and $age >=18 and $age<=25 and $heartrate <=65 and $heartrate >=63 ){
  $this->gradeheart = '5' ;
}else if($sex== 1 and $age >=18 and $age<=25 and $heartrate <=69 and $heartrate >=67){
  $this->gradeheart = '4' ;
}else if ($sex== 1 and $age >=18 and $age<=25 and $heartrate <=73 and $heartrate >=71){
  $this->gradeheart = '3' ;
}else if ($sex== 1 and $age >=18 and $age<=25 and $heartrate <=81 and $heartrate >=76){
  $this->gradeheart = '2' ;
}else if ($sex== 1 and $age >=18 and $age<=25 and $heartrate <=95 and $heartrate >=84){
  $this->gradeheart = '1' ;

}else if($sex== 2 and $age >=18 and $age<=25 and $heartrate  <=60 and $heartrate >=54){
    $this->gradeheart = '7' ;
}else if ($sex== 2 and $age >=18 and $age<=25 and $heartrate <=65 and $heartrate >=61 ){
  $this->gradeheart = '6' ;
}else if ($sex== 2 and $age >=18 and $age<=25 and $heartrate <=69 and $heartrate >=66 ){
  $this->gradeheart = '5' ;
}else if($sex== 2 and $age >=18 and $age<=25 and $heartrate <=70 and $heartrate >=70){
  $this->gradeheart = '4' ;
}else if ($sex== 2 and $age >=18 and $age<=25 and $heartrate <=78 and $heartrate >=74){
  $this->gradeheart = '3' ;
}else if ($sex== 2 and $age >=18 and $age<=25 and $heartrate <=84 and $heartrate >=80){
  $this->gradeheart = '2' ;
}else if ($sex== 2 and $age >=18 and $age<=25 and $heartrate <=100 and $heartrate >=86){
  $this->gradeheart = '1' ;

}else {
    $this->gradeheart = 0;
}
// จบอัตราการเต้นของหัอัตราการเต้นหัวใจขณะพัก heartrate//

// แรงบีบมือต่อน้ำหนักตัว  griperweight//
if($sex== 1 and $age >= 51 and $age <= 60 and  $griperweight >= 0.67){
  $this->gradegrip = '5' ;
}else if ($sex== 1 and $age >= 51 and $age <= 60 and $griperweight <= 0.66 and $griperweight >= 0.62 ){
  $this->gradegrip = '4' ;
}else if ($sex== 1 and $age >= 51 and $age <= 60 and $griperweight <= 0.61 and $griperweight >= 0.52){
  $this->gradegrip = '3' ;
}else if($sex== 1 and $age >= 51 and $age <= 60 and $griperweight <= 0.51 and $griperweight >= 0.47){
  $this->gradegrip = '2' ;
}else if ($sex== 1 and  $age >= 51 and $age <= 60 and $griperweight <= 0.46){
  $this->gradegrip = '1' ;
}else if($sex== 2 and $age >= 51 and $age <= 60 and  $griperweight >= 0.43){
  $this->gradegrip = '5' ;
}else if ($sex== 2 and $age >= 51 and $age <= 60 and $griperweight <= 0.42 and $griperweight >= 0.40 ){
  $this->gradegrip = '4' ;
}else if ($sex== 2 and $age >= 51 and $age <= 60 and $griperweight <= 0.39 and $griperweight >= 0.32){
  $this->gradegrip = '3' ;
}else if($sex== 2 and $age >= 51 and $age <= 60 and $griperweight <= 0.31 and $griperweight >= 0.29){
  $this->gradegrip = '2' ;
}else if ($sex== 2 and  $age >= 51 and $age <= 60 and $griperweight <= 0.28){
  $this->gradegrip = '1' ;
}else if($sex== 1 and $age >= 41 and $age <= 50 and  $griperweight >= 0.70){
  $this->gradegrip = '5' ;
}else if ($sex== 1 and $age >= 41 and $age <= 50 and $griperweight <= 0.69 and $griperweight >= 0.66 ){
  $this->gradegrip = '4' ;
}else if ($sex== 1 and $age >= 41 and $age <= 50 and $griperweight <= 0.65 and $griperweight >= 0.56){
  $this->gradegrip = '3' ;
}else if($sex== 1 and $age >= 41 and $age <= 50 and $griperweight <= 0.55 and $griperweight >= 0.51){
  $this->gradegrip = '2' ;
}else if ($sex== 1 and  $age >= 41 and $age <= 50 and $griperweight <= 0.50){
  $this->gradegrip = '1' ;
}else if($sex== 2 and $age >= 41 and $age <= 50 and  $griperweight >= 0.52){
  $this->gradegrip = '5' ;
}else if ($sex== 2 and $age >= 41 and $age <= 50 and $griperweight <= 0.51 and $griperweight >= 0.47 ){
  $this->gradegrip = '4' ;
}else if ($sex== 2 and $age >= 41 and $age <= 50 and $griperweight <= 0.46 and $griperweight >= 0.35){
  $this->gradegrip = '3' ;
}else if($sex== 2 and $age >= 41 and $age <= 50 and $griperweight <= 0.34 and $griperweight >= 0.30){
  $this->gradegrip = '2' ;
}else if ($sex== 2 and  $age >= 41 and $age <= 50 and $griperweight <= 0.29){
  $this->gradegrip = '1' ;
}else if($sex== 1 and $age >= 31 and $age <= 40 and  $griperweight >= 0.81){
  $this->gradegrip = '5' ;
}else if ($sex== 1 and $age >= 31 and $age <= 40 and $griperweight <= 0.80 and $griperweight >= 0.74 ){
  $this->gradegrip = '4' ;
}else if ($sex== 1 and $age >= 31 and $age <= 40 and $griperweight <= 0.73 and $griperweight >= 0.60){
  $this->gradegrip = '3' ;
}else if($sex== 1 and $age >= 31 and $age <= 40 and $griperweight <= 0.59 and $griperweight >= 0.54){
  $this->gradegrip = '2' ;
}else if ($sex== 1 and  $age >= 31 and $age <= 40 and $griperweight <= 0.53){
  $this->gradegrip = '1' ;
}else if($sex== 2 and $age >= 31 and $age <= 40 and  $griperweight >= 0.55){
  $this->gradegrip = '5' ;
}else if ($sex== 2 and $age >= 31 and $age <= 40 and $griperweight <= 0.55 and $griperweight >= 0.51 ){
  $this->gradegrip = '4' ;
}else if ($sex== 2 and $age >= 31 and $age <= 40 and $griperweight <= 0.50 and $griperweight >= 0.43){
  $this->gradegrip = '3' ;
}else if($sex== 2 and $age >= 31 and $age <= 40 and $griperweight <= 0.42 and $griperweight >= 0.39){
  $this->gradegrip = '2' ;
}else if ($sex== 2 and  $age >= 31 and $age <= 40 and $griperweight <= 0.38){
  $this->gradegrip = '1' ;

}else if($sex== 1 and $age >= 20 and $age <= 30 and  $griperweight >= 0.89){
  $this->gradegrip = '5' ;
}else if ($sex== 1 and $age >= 20 and $age <= 30 and $griperweight <= 0.88 and $griperweight >= 0.83 ){
  $this->gradegrip = '4' ;
}else if ($sex== 1 and $age >= 20 and $age <= 30 and $griperweight <= 0.82 and $griperweight >= 0.67){
  $this->gradegrip = '3' ;
}else if($sex== 1 and $age >= 20 and $age <= 30 and $griperweight <= 0.66 and $griperweight >= 0.60){
  $this->gradegrip = '2' ;
}else if ($sex== 1 and  $age >= 20 and $age <= 30 and $griperweight <= 0.59){
  $this->gradegrip = '1' ;
}else if($sex== 2 and $age >= 20 and $age <= 30 and  $griperweight >= 0.65){
  $this->gradegrip = '5' ;
}else if ($sex== 2 and $age >= 20 and $age <= 30 and $griperweight <= 0.64 and $griperweight >= 0.59 ){
  $this->gradegrip = '4' ;
}else if ($sex== 2 and $age >= 20 and $age <= 30 and $griperweight <= 0.58 and $griperweight >= 0.45){
  $this->gradegrip = '3' ;
}else if($sex== 2 and $age >= 20 and $age <= 30 and $griperweight <= 0.44 and $griperweight >= 0.39){
  $this->gradegrip = '2' ;
}else if ($sex== 2 and  $age >= 20 and $age <= 30 and $griperweight <= 0.38){
  $this->gradegrip = '1' ;

}else if($sex== 1 and $age >= 17 and $age <= 19 and  $griperweight >= 0.90){
  $this->gradegrip = '5' ;
}else if ($sex== 1 and$age >= 17 and $age <= 19 and $griperweight <= 0.89 and $griperweight >= 0.84 ){
  $this->gradegrip = '4' ;
}else if ($sex== 1 and $age >= 17 and $age <= 19 and $griperweight <= 0.83 and $griperweight >= 0.71){
  $this->gradegrip = '3' ;
}else if($sex== 1 and $age >= 17 and $age <= 19 and $griperweight <= 0.70 and $griperweight >= 0.66){
  $this->gradegrip = '2' ;
}else if ($sex== 1 and $age >= 17 and $age <= 19 and $griperweight <= 0.65){
  $this->gradegrip = '1' ;
}else if($sex== 2 and $age >= 17 and $age <= 19 and  $griperweight >= 0.67){
  $this->gradegrip = '5' ;
}else if ($sex== 2 and $age >= 17 and $age <= 19 and $griperweight <= 0.66 and $griperweight >= 0.63 ){
  $this->gradegrip = '4' ;
}else if ($sex== 2 and $age >= 17 and $age <= 19 and $griperweight <= 0.62 and $griperweight >= 0.52){
  $this->gradegrip = '3' ;
}else if($sex== 2 and $age >= 17 and $age <= 19 and $griperweight <= 0.51 and $griperweight >= 0.48){
  $this->gradegrip = '2' ;
}else if ($sex== 2 and  $age >= 17 and $age <= 19 and $griperweight <= 0.47){
  $this->gradegrip = '1' ;



}else {
    $this->gradegrip = 0;
}
// จบแรงบีบมือต่อน้ำหนักตัว griperweight//

// แรงเหยียดขาต่อน้ำหนักตัว  griperweight//
if($sex== 1 and $age >= 51 and $age <= 60 and  $legperweight >= 1.84){
  $this->gradeleg = '5' ;
}else if ($sex== 1 and $age >= 51 and $age <= 60 and $legperweight <= 1.83 and $legperweight >= 1.66 ){
  $this->gradeleg = '4' ;
}else if ($sex== 1 and $age >= 51 and $age <= 60 and $legperweight <= 1.65 and $legperweight >= 1.28){
  $this->gradeleg = '3' ;
}else if($sex== 1 and $age >= 51 and $age <= 60 and $legperweight <= 1.27 and $legperweight >= 1.09){
  $this->gradeleg = '2' ;
}else if ($sex== 1 and  $age >= 51 and $age <= 60 and $legperweight <= 1.08){
  $this->gradleg = '1' ;
}else if($sex== 2 and $age >= 51 and $age <= 60 and  $legperweight >= 1.25){
  $this->gradeleg = '5' ;
}else if ($sex== 2 and $age >= 51 and $age <= 60 and $legperweight <= 1.24 and $legperweight >= 1.03 ){
  $this->gradeleg = '4' ;
}else if ($sex== 2 and $age >= 51 and $age <= 60 and $legperweight <= 1.02 and $legperweight >= 0.57){
  $this->gradeleg = '3' ;
}else if($sex== 2 and $age >= 51 and $age <= 60 and $legperweight <= 0.56 and $legperweight >= 0.35){
  $this->gradeleg = '2' ;
}else if ($sex== 2 and  $age >= 51 and $age <= 60 and $legperweight <= 0.34){
  $this->gradeleg = '1' ;

}else if($sex== 1 and $age >= 41 and $age <= 50 and  $legperweight >= 1.84){
  $this->gradeleg = '5' ;
}else if ($sex== 1 and $age >= 41 and $age <= 50 and $legperweight <= 1.83 and $legperweight >= 1.64 ){
  $this->gradeleg = '4' ;
}else if ($sex== 1 and $age >= 41 and $age <= 50 and $legperweight <= 1.63 and $legperweight >= 1.24){
  $this->gradeleg = '3' ;
}else if($sex== 1 and $age >= 41 and $age <= 50 and $legperweight <= 1.23 and $legperweight >= 1.04){
  $this->gradeleg = '2' ;
}else if ($sex== 1 and  $age >= 41 and $age <= 50 and $legperweight <= 1.03){
  $this->gradleg = '1' ;
}else if($sex== 2 and $age >= 41 and $age <= 50 and  $legperweight >= 1.09){
  $this->gradeleg = '5' ;
}else if ($sex== 2 and $age >= 41 and $age <= 50 and $legperweight <= 1.08 and $legperweight >= 0.95 ){
  $this->gradeleg = '4' ;
}else if ($sex== 2 and $age >= 41 and $age <= 50 and $legperweight <= 0.94 and $legperweight >= 0.65){
  $this->gradeleg = '3' ;
}else if($sex== 2 and $age >= 41 and $age <= 50 and $legperweight <= 0.64 and $legperweight >= 0.51){
  $this->gradeleg = '2' ;
}else if ($sex== 2 and  $age >= 41 and $age <= 50 and $legperweight <= 0.50){
  $this->gradeleg = '1' ;

}else if($sex== 1 and $age >= 31 and $age <= 40 and  $legperweight >= 2.11){
  $this->gradeleg = '5' ;
}else if ($sex== 1 and $age >= 31 and $age <= 40 and $legperweight <= 2.10 and $legperweight >= 1.90 ){
  $this->gradeleg = '4' ;
}else if ($sex== 1 and $age >= 31 and $age <= 40 and $legperweight <= 1.89 and $legperweight >= 1.44){
  $this->gradeleg = '3' ;
}else if($sex== 1 and $age >= 31 and $age <= 40 and $legperweight <= 1.43 and $legperweight >= 1.22){
  $this->gradeleg = '2' ;
}else if ($sex== 1 and  $age >= 31 and $age <= 40 and $legperweight <= 1.21){
  $this->gradleg = '1' ;
}else if($sex== 2 and $age >= 31 and $age <= 40 and  $legperweight >= 1.20){
  $this->gradeleg = '5' ;
}else if ($sex== 2 and $age >= 31 and $age <= 40 and $legperweight <= 1.19 and $legperweight >= 1.03 ){
  $this->gradeleg = '4' ;
}else if ($sex== 2 and $age >= 31 and $age <= 40 and $legperweight <= 1.02 and $legperweight >= 0.68){
  $this->gradeleg = '3' ;
}else if($sex== 2 and $age >= 31 and $age <= 40 and $legperweight <= 0.67 and $legperweight >= 0.52){
  $this->gradeleg = '2' ;
}else if ($sex== 2 and  $age >= 31 and $age <= 40 and $legperweight <= 0.51){
  $this->gradeleg = '1' ;

}else if($sex== 1 and $age >= 20 and $age <= 30 and  $legperweight >= 2.42){
  $this->gradeleg = '5' ;
}else if ($sex== 1 and $age >= 20 and $age <= 30 and $legperweight <= 2.41 and $legperweight >= 2.21 ){
  $this->gradeleg = '4' ;
}else if ($sex== 1 and $age >= 20 and $age <= 30 and $legperweight <= 2.20 and $legperweight >= 1.79){
  $this->gradeleg = '3' ;
}else if($sex== 1 and $age >= 20 and $age <= 30 and $legperweight <= 1.78 and $legperweight >= 1.50){
  $this->gradeleg = '2' ;
}else if ($sex== 1 and  $age >= 20 and $age <= 30 and $legperweight <= 1.49){
  $this->gradleg = '1' ;
}else if($sex== 2 and $age >= 20 and $age <= 30 and  $legperweight >= 1.51){
  $this->gradeleg = '5' ;
}else if ($sex== 2 and $age >= 20 and $age <= 30 and $legperweight <= 1.50 and $legperweight >= 1.28 ){
  $this->gradeleg = '4' ;
}else if ($sex== 2 and $age >= 20 and $age <= 30 and $legperweight <= 1.27 and $legperweight >= 0.81){
  $this->gradeleg = '3' ;
}else if($sex== 2 and $age >= 20 and $age <= 30 and $legperweight <= 0.80 and $legperweight >= 0.58){
  $this->gradeleg = '2' ;
}else if ($sex== 2 and  $age >= 20 and $age <= 30 and $legperweight <= 0.57){
  $this->gradeleg = '1' ;

}else if($sex== 1 and $age >= 17 and $age <= 19 and  $legperweight >= 2.31){
  $this->gradeleg = '5' ;
}else if ($sex== 1 and $age >= 17 and $age <= 19 and $legperweight <= 2.30 and $legperweight >= 2.11 ){
  $this->gradeleg = '4' ;
}else if ($sex== 1 and $age >= 17 and $age <= 19 and $legperweight <= 2.10 and $legperweight >= 1.70){
  $this->gradeleg = '3' ;
}else if($sex== 1 and $age >= 17 and $age <= 19 and $legperweight <= 1.69 and $legperweight >= 1.50){
  $this->gradeleg = '2' ;
}else if ($sex== 1 and  $age >= 17 and $age <= 19 and $legperweight <= 1.49){
  $this->gradleg = '1' ;
}else if($sex== 2 and $age >= 17 and $age <= 19 and  $legperweight >= 1.70){
  $this->gradeleg = '5' ;
}else if ($sex== 2 and $age >= 17 and $age <= 19 and $legperweight <= 1.69 and $legperweight >= 1.40 ){
  $this->gradeleg = '4' ;
}else if ($sex== 2 and $age >= 17 and $age <= 19 and $legperweight <= 1.39 and $legperweight >= 1.10){
  $this->gradeleg = '3' ;
}else if($sex== 2 and $age >= 17 and $age <= 19 and $legperweight <= 1.09 and $legperweight >= 0.90){
  $this->gradeleg = '2' ;
}else if ($sex== 2 and  $age >= 17 and $age <= 19 and $legperweight <= 0.89){
  $this->gradeleg = '1' ;

}else {
    $this->gradeleg = 0;
}
// จบแรงเหยียดต่อน้ำหนักตัว griperweight//

// ลุกนั่ง situp//
if($sex== 1 and $age >=50 and $situp >=36){
  $this->gradesitup = '4' ;
}else if ($sex== 1 and $age >=50 and $situp <= 35 and $situp >=26 ){
  $this->gradesitup = '3' ;
}else if($sex== 1 and $age>=50 and $situp <=25 and $situp>=11){
  $this->gradesitup = '2' ;
}else if ($sex== 1 and $age >=50 and $situp <= 10  ){
  $this->gradesitup = '1' ;
}else  if($sex== 2 and $age >=50 and $situp >=30){
  $this->gradesitup = '4' ;
}else if ($sex== 2 and $age >=50 and $situp <= 29 and $situp >=20 ){
  $this->gradesitup = '3' ;
}else if($sex== 2 and $age >=50 and $situp <=19 and $situp>=11){
  $this->gradesitup = '2' ;
}else if ($sex== 2 and $age >=50 and $situp <= 10  ){
  $this->gradesitup = '1' ;

}else if($sex== 1 and $age >=35 and $age <=49 and $situp >=46){
$this->gradesitup = '4' ;
}else if ($sex== 1 and $age >=35 and $age <=49 and $situp <= 45 and $situp >=31 ){
  $this->gradesitup = '3' ;
}else if($sex== 1 and $age>=35 and $age <=49 and $situp <=30 and $situp>=16){
  $this->gradesitup = '2' ;
}else if ($sex== 1 and $age >=35 and $age <=49 and $situp <= 15  ){
  $this->gradesitup = '1' ;
}else  if($sex== 2 and $age >=35 and $age <=49 and $situp >=39){
  $this->gradesitup = '4' ;
}else if ($sex== 2 and $age >=35 and $age <=49 and $situp <= 38 and $situp >=27 ){
  $this->gradesitup = '3' ;
}else if($sex== 2 and $age >=35 and $age <=49 and $situp <=26 and $situp>=13){
  $this->gradesitup = '2' ;
}else if ($sex== 2 and $age >=35 and $age <=49 and $situp <= 12  ){
  $this->gradesitup = '1' ;

}else if($sex== 1 and $age >=18 and $age <=34 and $situp >=51){
$this->gradesitup = '4' ;
}else if ($sex== 1 and $age >=18 and $age <=34 and $situp <= 50 and $situp >=36 ){
  $this->gradesitup = '3' ;
}else if($sex== 1 and $age>=18 and $age <=34 and $situp <=35 and $situp>=21){
  $this->gradesitup = '2' ;
}else if ($sex== 1 and $age >=18 and $age <=34 and $situp <= 20  ){
  $this->gradesitup = '1' ;
}else  if($sex== 2 and $age >=18 and $age <=34 and $situp >=46){
  $this->gradesitup = '4' ;
}else if ($sex== 2 and $age >=18 and $age <=34 and $situp <= 45 and $situp >=31 ){
  $this->gradesitup = '3' ;
}else if($sex== 2 and $age >=18 and $age <=34 and $situp <=30 and $situp>=16){
  $this->gradesitup = '2' ;
}else if ($sex== 2 and $age >=18 and $age <=34 and $situp <= 15  ){
  $this->gradesitup = '1' ;

}else {
    $this->gradesitup = 0;
}
// จบลุกนั่ง  situp//

// นั่งงอตัวไปข้างหน้า flexibility//
if($sex== 1 and $age >=60 and $flexibility >=14){
  $this->gradeflex = '5' ;
}else if ($sex== 1 and $age >=60 and $flexibility <= 13 and $flexibility >=10 ){
  $this->gradeflex = '4' ;
}else if($sex== 1 and $age>=60 and $flexibility <=9 and $flexibility>=2){
  $this->gradeflex = '3' ;
}else if ($sex== 1 and $age >=0 and $flexibility <= 1 and $flexibility >= (-2) ){
  $this->gradeflex = '2' ;
}else if ($sex== 1 and $age >=60 and $flexibility <= (-3)  ){
  $this->gradeflex = '1' ;
}else if($sex== 2 and $age >=60 and $flexibility >=18){
  $this->gradeflex = '5' ;
}else if ($sex== 2 and $age >=60 and $flexibility <= 17 and $flexibility >=15 ){
  $this->gradeflex = '4' ;
}else if($sex== 2 and $age>=60 and $flexibility <=14 and $flexibility>=8){
  $this->gradeflex = '3' ;
}else if ($sex== 2 and $age >=60 and $flexibility <= 7 and $flexibility >= 5 ){
  $this->gradeflex = '2' ;
}else if ($sex== 2 and $age >=60 and $flexibility <= 4  ){
  $this->gradeflex = '1' ;
}else if($sex== 1 and $age >=50 and $age <=59 and $flexibility >=17){
  $this->gradeflex = '5' ;
}else if ($sex== 1 and$age >=50 and $age <=59 and $flexibility <= 16 and $flexibility >=13 ){
  $this->gradeflex = '4' ;
}else if($sex== 1 and $age >=50 and $age <=59 and $flexibility <=12 and $flexibility>=4){
  $this->gradeflex = '3' ;
}else if ($sex== 1 and $age >=50 and $age <=59 and $flexibility <=3 and $flexibility >= 0 ){
  $this->gradeflex = '2' ;
}else if ($sex== 1 and $age >=50 and $age <=59 and $flexibility <= (-1) ){
  $this->gradeflex = '1' ;
}else if($sex== 2 and $age >=50 and $age <=59 and $flexibility >=18){
  $this->gradeflex = '5' ;
}else if ($sex== 2 and$age >=50 and $age <=59 and $flexibility <= 17 and $flexibility >=15 ){
  $this->gradeflex = '4' ;
}else if($sex== 2 and $age >=50 and $age <=59 and $flexibility <=14 and $flexibility>=8){
  $this->gradeflex = '3' ;
}else if ($sex== 2 and $age >=50 and $age <=59 and $flexibility <=7 and $flexibility >= 5 ){
  $this->gradeflex = '2' ;
}else if ($sex== 2 and $age >=50 and $age <=59 and $flexibility <= 4 ){
  $this->gradeflex = '1' ;

}else if($sex== 1 and $age >=40 and $age <=49 and $flexibility >=17){
  $this->gradeflex = '5' ;
}else if ($sex== 1 and$age >=40 and $age <=49 and $flexibility <= 16 and $flexibility >=13 ){
  $this->gradeflex = '4' ;
}else if($sex== 1 and $age >=40 and $age <=49 and $flexibility <=12 and $flexibility>=5){
  $this->gradeflex = '3' ;
}else if ($sex== 1 and $age >=40 and $age <=49 and $flexibility <=4 and $flexibility >= 1 ){
  $this->gradeflex = '2' ;
}else if ($sex== 1 and $age >=40 and $age <=49 and $flexibility <= 0 ){
  $this->gradeflex = '1' ;
}else if($sex== 2 and $age >=40 and $age <=49 and $flexibility >=20){
  $this->gradeflex = '5' ;
}else if ($sex== 2 and$age >=40 and $age <=49 and $flexibility <= 19 and $flexibility >=16 ){
  $this->gradeflex = '4' ;
}else if($sex== 2 and $age >=40 and $age <=49 and $flexibility <=15 and $flexibility>=8){
  $this->gradeflex = '3' ;
}else if ($sex== 2 and $age >=40 and $age <=49 and $flexibility <=7 and $flexibility >= 4 ){
  $this->gradeflex = '2' ;
}else if ($sex== 2 and $age >=40 and $age <=49 and $flexibility <= 3 ){
  $this->gradeflex = '1' ;

}else if($sex== 1 and $age >=30 and $age <=39 and $flexibility >=19){
  $this->gradeflex = '5' ;
}else if ($sex== 1 and$age >=30 and $age <=39 and $flexibility <= 18 and $flexibility >=15 ){
  $this->gradeflex = '4' ;
}else if($sex== 1 and $age >=30 and $age <=39 and $flexibility <=14 and $flexibility>=6){
  $this->gradeflex = '3' ;
}else if ($sex== 1 and $age >=30 and $age <=39 and $flexibility <=5 and $flexibility >= 2 ){
  $this->gradeflex = '2' ;
}else if ($sex== 1 and $age >=30 and $age <=39 and $flexibility <= 1 ){
  $this->gradeflex = '1' ;
}else if($sex== 2 and $age >=30 and $age <=39 and $flexibility >=21){
  $this->gradeflex = '5' ;
}else if ($sex== 2 and$age >=30 and $age <=39 and $flexibility <= 20 and $flexibility >=17 ){
  $this->gradeflex = '4' ;
}else if($sex== 2 and $age >=30 and $age <=39 and $flexibility <=16 and $flexibility>=8){
  $this->gradeflex = '3' ;
}else if ($sex== 2 and $age >=30 and $age <=39 and $flexibility <=7 and $flexibility >= 4 ){
  $this->gradeflex = '2' ;
}else if ($sex== 2 and $age >=30 and $age <=39 and $flexibility <= 3 ){
  $this->gradeflex = '1' ;

}else if($sex== 1 and $age >=20 and $age <=29 and $flexibility >=20){
  $this->gradeflex = '5' ;
}else if ($sex== 1 and$age >=20 and $age <=29 and $flexibility <= 19 and $flexibility >=17 ){
  $this->gradeflex = '4' ;
}else if($sex== 1 and $age >=20 and $age <=29 and $flexibility <=16 and $flexibility>=9){
  $this->gradeflex = '3' ;
}else if ($sex== 1 and $age >=20 and $age <=29 and $flexibility <=8 and $flexibility >= 6 ){
  $this->gradeflex = '2' ;
}else if ($sex== 1 and $age >=20 and $age <=29 and $flexibility <= 5 ){
  $this->gradeflex = '1' ;
}else if($sex== 2 and $age >=20 and $age <=29 and $flexibility >=20){
  $this->gradeflex = '5' ;
}else if ($sex== 2 and$age >=20 and $age <=29 and $flexibility <= 19 and $flexibility >=17 ){
  $this->gradeflex = '4' ;
}else if($sex== 2 and $age >=20 and $age <=29 and $flexibility <=16 and $flexibility>=10){
  $this->gradeflex = '3' ;
}else if ($sex== 2 and $age >=20 and $age <=29 and $flexibility <=9 and $flexibility >= 7 ){
  $this->gradeflex = '2' ;
}else if ($sex== 2 and $age >=20 and $age <=29 and $flexibility <= 6 ){
  $this->gradeflex = '1' ;

}else if($sex== 1 and $age >=17 and $age <=19 and $flexibility >=21){
  $this->gradeflex = '5' ;
}else if ($sex== 1 and$age >=17 and $age <=19 and $flexibility <= 20 and $flexibility >=17 ){
  $this->gradeflex = '4' ;
}else if($sex== 1 and $age >=17 and $age <=19 and $flexibility <=16 and $flexibility>=8){
  $this->gradeflex = '3' ;
}else if ($sex== 1 and $age >=17 and $age <=19 and $flexibility <=7 and $flexibility >= 4 ){
  $this->gradeflex = '2' ;
}else if ($sex== 1 and $age >=17 and $age <=19 and $flexibility <= 3 ){
  $this->gradeflex = '1' ;
}else if($sex== 2 and $age >=17 and $age <=19 and $flexibility >=19){
  $this->gradeflex = '5' ;
}else if ($sex== 2 and$age >=17 and $age <=19 and $flexibility <= 18 and $flexibility >=16 ){
  $this->gradeflex = '4' ;
}else if($sex== 2 and $age >=17 and $age <=19 and $flexibility <=15 and $flexibility>=9){
  $this->gradeflex = '3' ;
}else if ($sex== 2 and $age >=17 and $age <=19 and $flexibility <=8 and $flexibility >= 6 ){
  $this->gradeflex = '2' ;
}else if ($sex== 2 and $age >=17 and $age <=19 and $flexibility <= 5 ){
  $this->gradeflex = '1' ;


}else {
    $this->gradeflex = 0;
}
// จบลนั่งงอตัวไปข้างหน้า  flexibility//

            $id = $this->id;
              return true;
    }

    public static function getUploadPath(){
            return Yii::getAlias('@webroot').'/'.self::UPLOAD_FOLDER.'/';
        }

        public static function getUploadUrl(){
            return Url::base(true).'/'.self::UPLOAD_FOLDER.'/';
        }

        public function getThumbnails($ref,$fname){
             $uploadFiles   = Uploadsf::find()->where(['ref'=>$ref])->all();
             $preview = [];
            foreach ($uploadFiles as $file) {
                $preview[] = [
                    'url'=>self::getUploadUrl(true).$ref.'/'.$file->real_filename,
                    'src'=>self::getUploadUrl(true).$ref.'/thumbnail/'.$file->real_filename,
                    'options' => ['title' => $fname]
                ];
            }
            return $preview;
        }
    public function getGradewaistlines(){
            return @$this->hasOne(Gradewaistline::className(),['WAISTLINE_ID'=>'gradewaistline']);
        }
    public function getGradewaistlineName(){
            return @$this->gradewaistlines->WAISTLINE_NAME;
        }
}
