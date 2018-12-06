
<?php
use yii\helpers\Html;
use miloschuman\highcharts\Highcharts;

$this->title = "Fakth Hospital RM";
?>



<div style='display: none'>
    <?=
    Highcharts::widget([
        'scripts' => [
            'highcharts-more',
            'themes/grid',
            'modules/solid-gauge'
        //'modules/exporting',
        ]
    ]);
    ?>
</div>

<?php
//$webroot = Yii::$app->request->BaseUrl;
$this->registerJsFile('@web/js/chart-donut.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<div class="panel panel-default"> 
    
    <div class="panel-body">
    <!--row1 -->
        <div class="row">
 <div class="row">
                
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
				<img src="icon/xxx044-512.png" alt="Smiley face" height="65" width="65">					
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><h2><?php
                $data1 = "SELECT COUNT(risk_id)as total  FROM priskhead";
                $chart1 = Yii::$app->db->createCommand($data1)->queryAll();
                $data1=[];
                for ($i = 0; $i < count($chart1); $i++) {
                    $data1[] = $chart1[$i]['total'];
                }
                $js_cc1 = implode(",", $data1);
                echo $js_cc1;
                ?></h2></div>
                                    <div><h4>จำนวนความเสี่ยงทั้งหมด<br>(ครั้ง)</h4></div>
                                </div>
                            </div>
                        </div>
                        <a href="index.php?r=reportrisk%2Freport13">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
				
				<div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    
								<!--
                                    <i class="fa fa-comments fa-5x"></i>
									-->
				<img src="icon/arc-flash-table-assessment.png" alt="Smiley face" height="65" width="80">
                                </div>
                                <div class="col-xs-9 text-right">
                                    <h2><div class="huge"><?php
                $data2 = "SELECT COUNT(risk_id)as total  FROM priskhead where risk_status='1'";
                $chart1 = Yii::$app->db->createCommand($data2)->queryAll();
                $data2=[];
                for ($i = 0; $i < count($chart1); $i++) {
                    $data2[] = $chart1[$i]['total'];
                }
                $js_cc2 = implode(",", $data2);
                echo $js_cc2;
                ?></div></h2>
                                    <div><h4>จำนวนความเสี่ยงที่ได้รับการแก้ไข<br>(ครั้ง)</h4></div>
                                </div>
                            </div>
                        </div>
                        <a href="index.php?r=reportrisk%2Freport14">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
				
				
				<div class="col-lg-3 col-md-6">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    
								<!--
                                    <i class="fa fa-comments fa-5x"></i>
									-->
				<img src="icon/insurance-512.png" alt="Smiley face" height="65" width="65">
                                </div>
                                <div class="col-xs-9 text-right">
                                    <h2><div class="huge"><?php
                $data2 = "SELECT COUNT(risk_id)as total  FROM priskhead where clinictype='1'";
                $chart1 = Yii::$app->db->createCommand($data2)->queryAll();
                $data2=[];
                for ($i = 0; $i < count($chart1); $i++) {
                    $data2[] = $chart1[$i]['total'];
                }
                $js_cc2 = implode(",", $data2);
                echo $js_cc2;
                ?></div></h2>
                                    <div><h4>จำนวนความเสี่ยงประเภททั่วไป<br>(ครั้ง)</h4></div>
                                </div>
                            </div>
                        </div>
                        <a href="index.php?r=reportrisk%2Freport1">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
				
				<div class="col-lg-3 col-md-6">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    
								<!--
                                    <i class="fa fa-comments fa-5x"></i>
									-->
				<img src="icon/original.png" alt="Smiley face" height="65" width="65">
                                </div>
                                <div class="col-xs-9 text-right">
                                    <h2><div class="huge"><?php
                $data2 = "SELECT COUNT(risk_id)as total  FROM priskhead where clinictype in ('3','2')";
                $chart1 = Yii::$app->db->createCommand($data2)->queryAll();
                $data2=[];
                for ($i = 0; $i < count($chart1); $i++) {
                    $data2[] = $chart1[$i]['total'];
                }
                $js_cc2 = implode(",", $data2);
                echo $js_cc2;
                ?></div></h2>
                                    <div><h4>จำนวนความเสี่ยงประเภทคลีนิค<br>(ครั้ง)</h4></div>
                                </div>
                            </div>
                        </div>
                        <a href="index.php?r=reportrisk%2Freport1">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
<div class="col-md-4" style="text-align: center;">
                <?php
                $data1 = "SELECT (SELECT COUNT(risk_id)*100  FROM priskhead WHERE clinictype='1') / (SELECT COUNT(*) from priskhead)as percent FROM priskhead";
                $chart1 = Yii::$app->db->createCommand($data1)->queryAll();
                $data1=[];
                for ($i = 0; $i < count($chart1); $i++) {
                    $data1[] = $chart1[$i]['percent'];
                }
                $js_cc1 = implode(",", $data1);

$this->registerJs("
                                var obj_div=$('#chart1');
                                gen_donut(obj_div,'ความเสี่ยงประเภททั่วไป',$js_cc1);
                             ");
                ?>
                <div id="chart1" style="width: 300px; height: 200px; float: left"></div>
            </div>
<div class="col-md-4" style="text-align: right;">
                <?php
                $data2 = "SELECT (SELECT COUNT(risk_id)*100  FROM priskhead WHERE clinictype='2') / (SELECT COUNT(*) from priskhead)as percent FROM priskhead";
                $chart2 = Yii::$app->db->createCommand($data2)->queryAll();
                $data2=[];
                for ($i = 0; $i < count($chart2); $i++) {
                    $data2[] = $chart2[$i]['percent'];
                }
                $js_cc1 = implode(",", $data2);

$this->registerJs("
                                var obj_div=$('#chart2');
                                gen_donut(obj_div,'ความเสี่ยงประเภทคลินิค',$js_cc1);
                             ");
                ?>
    
    <div id="chart2" style="width: 300px; height: 200px; float: center"></div>
            </div>
            <div class="col-md-4" style="text-align: right;">
                <?php
                $data3 = "SELECT (SELECT COUNT(risk_id)*100  FROM priskhead WHERE clinictype='3') / (SELECT COUNT(*) from priskhead)as percent FROM priskhead";
                $chart3 = Yii::$app->db->createCommand($data3)->queryAll();
                $data3=[];
                for ($i = 0; $i < count($chart3); $i++) {
                    $data3[] = $chart3[$i]['percent'];
                }
                $js_cc1 = implode(",", $data3);

$this->registerJs("
                                var obj_div=$('#chart3');
                                gen_donut(obj_div,'ความเสี่ยงประเภทคลินิคเฉพาะโรค',$js_cc1);
                             ");
                ?>
   <div id="chart3" style="width: 300px; height: 200px; float: right"></div>
            </div>
</div>
<div class="panel-body">    
<div id="container"></div>
 <div class="row">
<?php
$sql = "SELECT d.DEP_NAME,(SELECT COUNT(p.department) from priskhead p WHERE p.department=d.ADDDEP_ID) as total from adddep d";
$rawData = Yii::$app->db->createCommand($sql)->queryAll();

$main_data=[];
foreach ($rawData as $data) {   
    $main_data[] = [ 'name' => $data['DEP_NAME'], 'y' => $data['total']*1, 'drilldown' => $data['DEP_NAME']];    
}
$main = json_encode($main_data);

$sql = "SELECT h.hoscode,h.hosname
,(select COUNT(DISTINCT p.HOSPCODE,p.PID) from person p 
where p.HOSPCODE = h.hoscode and p.TYPEAREA=1) as type1
,(select COUNT(DISTINCT p.HOSPCODE,p.PID) from person p 
where p.HOSPCODE = h.hoscode and p.TYPEAREA=2) as type2
,(select COUNT(DISTINCT p.HOSPCODE,p.PID) from person p 
where p.HOSPCODE = h.hoscode and p.TYPEAREA=3) as type3
,(select COUNT(DISTINCT p.HOSPCODE,p.PID) from person p 
where p.HOSPCODE = h.hoscode and p.TYPEAREA=4) as type4
 from chospital_amp h";

$rawData = Yii::$app->db->createCommand($sql)->queryAll();

$sub_data=[];
foreach ($rawData as $data) {
   
    $sub_data[] = [
    'id' => $data['hoscode'],
    'name' => $data['hosname'],
    'data' => [['type1',$data['type1']*1],['type2', $data['type2']*1],['type3',$data['type3']*1],['type4',$data['type4']*1]]
];
    
}

$sub = json_encode($sub_data);

$this->registerJs("$(function () {

    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'แผนภูมิแท่งเปรียบเทียบแผนกที่รายงานความเสี่ยง'
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: '<b>จำนวนความเสี่ยง</b>'
            },
        },

        legend: {
            enabled: true
        },

        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true
                }
            }
        },

        series: [
        {
            name: 'แผนกที่รายงาน',
            colorByPoint: true,
            data:$main
            
        }
        ],
        drilldown: {
            series:$sub
            
        }
    });
});", yii\web\View::POS_END);
?>


<div id="chart" style="padding-bottom: 10px"></div>