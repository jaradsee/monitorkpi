<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;
use frontend\assets\MaterialAsset;

/* @var $this \yii\web\View */
/* @var $content string */

//AppAsset::register($this);
MaterialAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
            <?php $this->beginBody() ?>
        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => 'ระบบรายงานความเสี่ยงโรงพยาบาลฟากท่า',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
             $report_mnu_itms[] = ['label' => 'เพิ่มรายงานความเสี่ยง', 'url' => ['priskhead/create']];
             $report_mnu_itms[] = ['label' => 'ค้นหาและแก้ไขรายงานความเสี่ยง', 'url' => ['priskhead/index']];
             $report_mnu_itms[] = ['label' => 'ระบบบริหารจัดการความเสี่ยง', 'url' => ['reportrisk/index']];
             $report_mnu_itms[] = ['label' => 'เกี่ยวกับระบบบริหารจัดการความเสี่ยง', 'url' => ['about/index']];

             $report_mnu2_itms[] = ['label' => 'ค้นหาประชากร', 'url' => ['person/index']];
             $report_mnu2_itms[] = ['label' => 'ค้นหาและแก้ไขผลการทดสอลสมรถถภาพ', 'url' => ['bmitest/index']];
             $report_mnu2_itms[] = ['label' => 'ระบบบริหารจัดการความเสี่ยง', 'url' => ['reportrisk/index']];
             $report_mnu2_itms[] = ['label' => 'เกี่ยวกับระบบบริหารจัดการความเสี่ยง', 'url' => ['about/index']];



            $menuItems = [
                ['label' => 'Home', 'url' => ['/site/index']],
                ['label' => 'รายงานความเสี่ยง',
                    'items' => $report_mnu_itms
                ],
                ['label' => 'ระบบทดสอบสมรรถภาพ',
                  'items' => $report_mnu2_itms
                ],
                ['label' => 'Contact', 'url' => ['/site/contact']],
            ];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
            } else {
                $menuItems[] = [
                    'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
            ?>

            <div class="container">
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
<?= Alert::widget() ?>
<?= $content ?>
            </div>
        </div>

        <footer class="footer" style="margin-top: 20px">
            <div class="container">
                <p class="pull-left">&copy; โรงพยาบาลฟากท่า <?= date('Y') ?></p>
                <p class="pull-right"><?= Yii::powered() ?></p>
            </div>
        </footer>

<?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
