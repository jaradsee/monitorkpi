<?php

use miloschuman\highcharts\Highcharts;

$this->title = "Faktha RM";
?>
<div style='display: none'>
    <?=
    Highcharts::widget([
        'scripts' => [
            'highcharts-more',
            'themes/grid'
        //'modules/exporting',
        ]
    ]);
    ?>
</div>
<?php
$this->registerJsFile('./js/chart_dial.js');
?>
<div class="site-index well well-material">


<div class="row">
    <div class="col-sm-4" style="text-align: center;">
        <?php
        $target = 203;
        $result = 102;
        $persent = 0.00;
        if ($target > 0) {
            $persent = $result / $target * 100;
            $persent= number_format($persent, 2);
        }
        $base = 90;
        $this->registerJs("
                        var obj_div=$('#ch1');
                        gen_dial(obj_div,$base,$persent);
                    ");
        ?>
       <h4>ความเสี่ยงประเภททั่วไป</h4>
        <div id="ch1"></div>
    </div>
     <div class="col-sm-4" style="text-align: center;">
        <?php
        $target = 303;
        $result = 102;
        $persent = 0.00;
        if ($target > 0) {
            $persent = $result / $target * 100;
            $persent= number_format($persent, 2);
        }
        $base = 90;
        $this->registerJs("
                        var obj_div=$('#ch2');
                        gen_dial(obj_div,$base,$persent);
                    ");
        ?>
         <h4>ความเสี่ยงประเภทคลินิค</h4>
        <div id="ch2"></div>

    </div>

     <div class="col-sm-4" style="text-align: center;">
        <?php
        $target = 403;
        $result = 102;
        $persent = 0.00;
        if ($target > 0) {
            $persent = $result / $target * 100;
            $persent= number_format($persent, 2);
        }
        $base = 90;
        $this->registerJs("
                        var obj_div=$('#ch3');
                        gen_dial(obj_div,$base,$persent);
                    ");
        ?>
       <h4>ความเสี่ยงประเภทคลินิคเฉพาะ</h4>
        <div id="ch3"></div>
    </div>
</div>
