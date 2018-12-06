<?php

namespace frontend\controllers;
use yii;
use yii\filters\VerbFilter;
use common\components\AccessRule;
use yii\web\Controller;
use components\MyHelper;
use yii\filters\AccessControl;
use common\models\User;
class AboutController extends \yii\web\Controller {
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

    
}
?>
