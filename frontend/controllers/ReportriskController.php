<?php

namespace frontend\controllers;
use yii;
use yii\filters\VerbFilter;
use common\components\AccessRule;
use yii\web\Controller;
use components\MyHelper;
use yii\filters\AccessControl;
use common\models\User;
class ReportriskController extends \yii\web\Controller {
    public $enableCsrfValidation = false;
   public function behaviors(){
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access'=>[
                'class'=>AccessControl::className(),
                'only'=> ['index','create','update','view','delete','report1','report12','report13','report14','report15'],
                'ruleConfig'=>[
                    'class'=>AccessRule::className()
                ],
                'rules'=>[
                    [
                        'actions'=>['index','create','view','report1','report12','report13','report14','report15'],
                        'allow'=> true,
                        'roles'=>[
                            User::ROLE_USER,
                            User::ROLE_MODERATOR,
                            User::ROLE_ADMIN

                        ]
                    ],
                    [
                        'actions'=>['update','report1','report12','report13'],
                        'allow'=> true,
                        'roles'=>[
                            User::ROLE_MODERATOR,
                            User::ROLE_ADMIN
                        ]
                    ],
                    [
                        'actions'=>['delete'],
                        'allow'=> true,
                        'roles'=>[User::ROLE_ADMIN]
                    ]
                ]
            ]
        ];
    }
    public function actionIndex() {
        return $this->render('index');
    }

    public function actionReport1() {
        $date1 = "2016-10-01";
        $date2 = date('Y-m-d');
        if (Yii::$app->request->isPost) {
        $date1 = $_POST['date1'];
        $date2 = $_POST['date2'];
        }
        $sql = "SELECT p.clinictype,c.CLINIC_NAME as clinicname ,count(p.risk_id) as total
from priskhead as p
left JOIN clinictype c on c.CLINICTYPE_ID=p.clinictype
WHERE risk_date BETWEEN '$date1'and '$date2'
GROUP BY p.clinictype
ORDER BY total DESC
";
        //$rawData = \yii::$app->db->createCommand($sql)->queryAll();
        //print_r($rawData);

        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([

            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        return $this->render('report1', [
                    'dataProvider' => $dataProvider,
                    'sql' => $sql,
                    'date1' => $date1,
                    'date2' => $date2

        ]);
    }

    public function actionReport3($clinictype,$date1,$date2) {
        $sql = "select p.risk_id as เลขรายงานความเสี่ยง,a.DEP_NAME as แผนกที่รายงาน,p.risk_date as วันที่เกิดความเสี่ยง,
            p.event_name as เหตุการณ์,c.CLINIC_NAME as ประเภทความเสี่ยง,l.LEVEL_NAME as ความรุนแรงของความเสี่ยง,pd.PROHEAD_NAME as โปรแกรมความเสี่ยง,s.STATUS_NAME as สถานะความเสี่ยง,
            r.RESULT_NAME as ผลการดำเนินการ,p.reviwe_date as วันที่ทบทวน,
            p.reviwe_detailed as รายละเอียดการทบทวน
            from priskhead p
						LEFT JOIN adddep a on a.ADDDEP_ID=p.department
            LEFT JOIN clinictype c on c.CLINICTYPE_ID=p.clinictype
						LEFT JOIN `level` l  on l.LEVEL_ID=p.risk_level
            LEFT JOIN result r on r.RESULT_ID=p.result
						LEFT JOIN prohead pd on pd.PROHEAD_ID=p.prohead
            LEFT JOIN `status` s on s.STATUS_ID=p.risk_status
						where p.clinictype=$clinictype and risk_date BETWEEN '$date1'and'$date2'
";
        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([

            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        return $this->render('report3', [
                    'dataProvider' => $dataProvider,
                    'sql' => $sql,
                    'date1' => $date1,
                    'date2' => $date2
        ]);

    }
    public function actionReport4()
             {
        $date1 = "2016-10-01";
        $date2 = date('Y-m-d');
        if (Yii::$app->request->isPost) {
        $date1 = $_POST['date1'];
        $date2 = $_POST['date2'];
}

        $sql = "SELECT p.department,a.DEP_NAME as departmentname,COUNT(p.risk_id)as total
from priskhead as p
left JOIN adddep a on a.ADDDEP_ID=p.department
WHERE risk_date BETWEEN '$date1'and '$date2'
GROUP BY p.department
ORDER BY total DESC";
        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([

            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        return $this->render('report4', [
                    'dataProvider' => $dataProvider,
                    'sql' => $sql,
                    'date1' => $date1,
                    'date2' => $date2
        ]);

    }
    public function actionReport5() {
         $date1 = "2016-10-01";
        $date2 = date('Y-m-d');
        if (Yii::$app->request->isPost) {
        $date1 = $_POST['date1'];
        $date2 = $_POST['date2'];
        }
        $sql = "SELECT p.risk_level,c.LEVEL_NAME as levelname ,count(p.risk_id) as total
from priskhead as p
left JOIN level c on c.LEVEL_ID=p.risk_level
WHERE risk_date BETWEEN '$date1'and '$date2'
GROUP BY p.risk_level
ORDER BY total DESC
";
        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([

            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        return $this->render('report5', [
                    'dataProvider' => $dataProvider,
                    'sql' => $sql,
                    'date1' => $date1,
                    'date2' => $date2
        ]);

    }
    public function actionReport6() {
        $sql = "select count(case when MONTH(risk_date)=10 then risk_id end) as ตค2559,
count(case when MONTH(risk_date)=11 then risk_id end) as พย2559,
count(case when MONTH(risk_date)=12 then risk_id end) as ธค2559,
count(case when MONTH(risk_date)=1 then risk_id end) as มค2560,
count(case when MONTH(risk_date)=2 then risk_id end) as กพ2560,
count(case when MONTH(risk_date)=3 then risk_id end) as มีค2560,
count(case when MONTH(risk_date)=4 then risk_id end) as เมข2560,
count(case when MONTH(risk_date)=5 then risk_id end) as พค2560,
count(case when MONTH(risk_date)=6 then risk_id end) as มิย2560,
count(case when MONTH(risk_date)=7 then risk_id end) as กต2560,
count(case when MONTH(risk_date)=8 then risk_id end) as สค2560,
count(case when MONTH(risk_date)=9 then risk_id end) as กย2560,

COUNT(risk_id)as ความเสี่ยงรวมทัืงหมด
from priskhead
where year(risk_date)BETWEEN '2016-10-01'and'2017-09-30'
ORDER BY MONTH(risk_date)
";
        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([

            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        return $this->render('report6', [
                    'dataProvider' => $dataProvider,
                    'sql' => $sql,
        ]);

    }
    public function actionReport7($department,$date1,$date2) {
        $sql = "select p.risk_id as เลขรายงานความเสี่ยง,a.DEP_NAME as แผนกที่รายงาน,p.risk_date as วันที่เกิดความเสี่ยง,
            p.event_name as เหตุการณ์,c.CLINIC_NAME as ประเภทความเสี่ยง,l.LEVEL_NAME as ความรุนแรงของความเสี่ยง,pd.PROHEAD_NAME as โปรแกรมความเสี่ยง,s.STATUS_NAME as สถานะความเสี่ยง,
            r.RESULT_NAME as ผลการดำเนินการ,p.reviwe_date as วันที่ทบทวน,
            p.reviwe_detailed as รายละเอียดการทบทวน
            from priskhead p
						LEFT JOIN adddep a on a.ADDDEP_ID=p.department
            LEFT JOIN clinictype c on c.CLINICTYPE_ID=p.clinictype
						LEFT JOIN `level` l  on l.LEVEL_ID=p.risk_level
            LEFT JOIN result r on r.RESULT_ID=p.result
						LEFT JOIN prohead pd on pd.PROHEAD_ID=p.prohead
            LEFT JOIN `status` s on s.STATUS_ID=p.risk_status
						where p.department=$department and risk_date BETWEEN '$date1'and'$date2'
";
        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([

            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        return $this->render('report7', [
                    'dataProvider' => $dataProvider,
                    'sql' => $sql,
                    'date1' => $date1,
                    'date2' => $date2
        ]);
}
public function actionReport8() {
        $sql = "SELECT d.DEP_NAME as depart,(SELECT COUNT(p.department)
from priskhead p
WHERE p.department=d.ADDDEP_ID and p.created_at =CURDATE()) as total
from adddep d
ORDER BY total DESC";
       //$rawData = \yii::$app->db->createCommand($sql)->queryAll();
        //print_r($rawData);

        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([

            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        return $this->render('report8', [
                    'dataProvider' => $dataProvider,
                     'rawData'=>$rawData
        ]);
    }
    public function actionReport9() {
        $date1 = "2016-10-01";
        $date2 = date('Y-m-d');
        if (Yii::$app->request->isPost) {
        $date1 = $_POST['date1'];
        $date2 = $_POST['date2'];
}

        $sql = "SELECT d.ADDDEP_ID as department,d.DEP_NAME as depart,(SELECT COUNT(p.department) from priskhead p
                left JOIN adddep a on a.ADDDEP_ID=p.department
                WHERE p.department=d.ADDDEP_ID AND risk_date BETWEEN '$date1'and '$date2') as total from adddep d
ORDER BY total DESC";
       //$rawData = \yii::$app->db->createCommand($sql)->queryAll();
        //print_r($rawData);

        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([

            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        return $this->render('report9', [
                   'dataProvider' => $dataProvider,
                    'sql' => $sql,
                    'rawData'=>$rawData,
                    'date1' => $date1,
                    'date2' => $date2
        ]);
    }
    public function actionReport10() {
        $date1 = "2016-10-01";
        $date2 = date('Y-m-d');
        if (Yii::$app->request->isPost) {
        $date1 = $_POST['date1'];
        $date2 = $_POST['date2'];
}

        $sql = "SELECT CONCAT(year(t.risk_date),' - ',month(t.risk_date)) as mm,
            COUNT(t.risk_id) as cnt
            FROM priskhead t
WHERE t.risk_date BETWEEN '$date1'and'$date2'
            GROUP BY mm;";
       //$rawData = \yii::$app->db->createCommand($sql)->queryAll();
        //print_r($rawData);

        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([

            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        return $this->render('report10', [
                   'dataProvider' => $dataProvider,
                    'sql' => $sql,
                    'rawData'=>$rawData,
                    'date1' => $date1,
                    'date2' => $date2
        ]);
    }
    public function actionReport11($department,$date1,$date2) {
        $date1 = "2016-10-01";
        $date2 = date('Y-m-d');
        if (Yii::$app->request->isPost) {
        $date1 = $_POST['date1'];
        $date2 = $_POST['date2'];
}

        $sql = "select p.risk_id as เลขรายงานความเสี่ยง,a.DEP_NAME as แผนกที่รายงาน,p.risk_date as วันที่เกิดความเสี่ยง,
            p.event_name as เหตุการณ์,c.CLINIC_NAME as ประเภทความเสี่ยง,l.LEVEL_NAME as ความรุนแรงของความเสี่ยง,pd.PROHEAD_NAME as โปรแกรมความเสี่ยง,s.STATUS_NAME as สถานะความเสี่ยง,
            r.RESULT_NAME as ผลการดำเนินการ,p.reviwe_date as วันที่ทบทวน,
            p.reviwe_detailed as รายละเอียดการทบทวน
            from priskhead p
						LEFT JOIN adddep a on a.ADDDEP_ID=p.department
            LEFT JOIN clinictype c on c.CLINICTYPE_ID=p.clinictype
						LEFT JOIN `level` l  on l.LEVEL_ID=p.risk_level
            LEFT JOIN result r on r.RESULT_ID=p.result
						LEFT JOIN prohead pd on pd.PROHEAD_ID=p.prohead
            LEFT JOIN `status` s on s.STATUS_ID=p.risk_status
						where p.department=$department  and risk_date BETWEEN '2017-01-01'and'2017-10-31'";
       //$rawData = \yii::$app->db->createCommand($sql)->queryAll();
        //print_r($rawData);

        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([

            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        return $this->render('report11', [
                   'dataProvider' => $dataProvider,
                    'sql' => $sql,
                    'rawData'=>$rawData,
                    'date1' => $date1,
                    'date2' => $date2
        ]);
    }
   public function actionReport12($risk_level,$date1,$date2) {
        $sql = "select p.risk_id as เลขรายงานความเสี่ยง,a.DEP_NAME as แผนกที่รายงาน,p.risk_date as วันที่เกิดความเสี่ยง,
            p.event_name as เหตุการณ์,c.CLINIC_NAME as ประเภทความเสี่ยง,l.LEVEL_NAME as ความรุนแรงของความเสี่ยง,pd.PROHEAD_NAME as โปรแกรมความเสี่ยง,s.STATUS_NAME as สถานะความเสี่ยง,
            r.RESULT_NAME as ผลการดำเนินการ,p.reviwe_date as วันที่ทบทวน,
            p.reviwe_detailed as รายละเอียดการทบทวน
            from priskhead p
						LEFT JOIN adddep a on a.ADDDEP_ID=p.department
            LEFT JOIN clinictype c on c.CLINICTYPE_ID=p.clinictype
						LEFT JOIN `level` l  on l.LEVEL_ID=p.risk_level
            LEFT JOIN result r on r.RESULT_ID=p.result
						LEFT JOIN prohead pd on pd.PROHEAD_ID=p.prohead
            LEFT JOIN `status` s on s.STATUS_ID=p.risk_status
						where p.risk_level=$risk_level and risk_date BETWEEN '$date1'and'$date2'
";
        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([

            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        return $this->render('report3', [
                    'dataProvider' => $dataProvider,
                    'sql' => $sql,
                    'date1' => $date1,
                    'date2' => $date2
        ]);

    }
    public function actionReport13() {
        $sql = "SELECT  risk_date,event_name,clinictype,prohead,prodetail FROM priskhead ORDER BY risk_date";
       //$rawData = \yii::$app->db->createCommand($sql)->queryAll();
        //print_r($rawData);

        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([

            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        return $this->render('report13', [
                    'dataProvider' => $dataProvider,
                     'rawData'=>$rawData
        ]);
    }
    public function actionReport14() {
        $sql = "SELECT  risk_date,event_name,clinictype,prohead,prodetail FROM priskhead ORDER BY risk_date";
       //$rawData = \yii::$app->db->createCommand($sql)->queryAll();
        //print_r($rawData);

        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([

            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        return $this->render('report14', [
                    'dataProvider' => $dataProvider,
                     'rawData'=>$rawData
        ]);
    }

    public function actionReport15() {
        $date1 = "2016-10-01";
        $date2 = date('Y-m-d');
        if (Yii::$app->request->isPost) {
        $date1 = $_POST['date1'];
        $date2 = $_POST['date2'];
}

        $sql = "SELECT p.headmaster as programno,h.HEADMASTER_NAME as riskprogram ,count(p.risk_id) as total
from priskhead as p
left JOIN headmaster h on h.HEADMASTER_ID=p.headmaster
WHERE risk_date BETWEEN '$date1'and '$date2'
GROUP BY p.headmaster
ORDER BY total DESC";
       //$rawData = \yii::$app->db->createCommand($sql)->queryAll();
        //print_r($rawData);

        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([

            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        return $this->render('report15', [
                   'dataProvider' => $dataProvider,
                    'sql' => $sql,
                    'rawData'=>$rawData,
                    'date1' => $date1,
                    'date2' => $date2
        ]);
    }
    public function actionReport16($programno,$date1,$date2) {
        $sql = "select p.risk_id as เลขรายงานความเสี่ยง,a.DEP_NAME as แผนกที่รายงาน,p.risk_date as วันที่เกิดความเสี่ยง,
            p.event_name as เหตุการณ์,c.CLINIC_NAME as ประเภทความเสี่ยง,l.LEVEL_NAME as ความรุนแรงของความเสี่ยง,h.HEADMASTER_NAME as โปรแกรมความเสี่ยง,pd.PROHEAD_NAME as โปรแกรมย่อยความเสี่ยง,s.STATUS_NAME as สถานะความเสี่ยง,
            r.RESULT_NAME as ผลการดำเนินการ,p.reviwe_date as วันที่ทบทวน,
            p.reviwe_detailed as รายละเอียดการทบทวน
            from priskhead p
						LEFT JOIN adddep a on a.ADDDEP_ID=p.department
            LEFT JOIN clinictype c on c.CLINICTYPE_ID=p.clinictype
						LEFT JOIN `level` l  on l.LEVEL_ID=p.risk_level
            LEFT JOIN result r on r.RESULT_ID=p.result
						LEFT JOIN headmaster h on h.HEADMASTER_ID=p.headmaster
						LEFT JOIN prohead pd on pd.PROHEAD_ID=p.prohead
            LEFT JOIN `status` s on s.STATUS_ID=p.risk_status
						where p.headmaster=$programno and risk_date BETWEEN '$date1'and'$date2'
";
        try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([

            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        return $this->render('report16', [
                    'dataProvider' => $dataProvider,
                    'sql' => $sql,
                    'date1' => $date1,
                    'date2' => $date2
        ]);
}
}
?>
