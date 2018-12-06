<?php

namespace frontend\controllers;

use frontend\models\LineBot;
use frontend\models\Priskhead;
use yii\helpers\Url;

class LineBotController extends \yii\web\Controller
{

    public function actionCurl()
    {
        /*
         * ส่งจาก Forum
         */
        $last_priskhead = LineBot::findOne(['type' => 'event_name']);
        $priskhead = Priskhead::find()->orderBy(['id' => SORT_DESC])->one();
        if(!$last_priskhead){
            $last_priskhead = new LineBot();
            $last_priskhead->type = 'event_name';
            $last_priskhead->last_id = $priskhead->risk_id;
            $last_priskhead->save();
            $message = $priskhead->subject.' '.Url::to('http://113.53.236.21/faktharm'.$priskhead->risk_id);
            $res = $this->notify_message($message);

        }else{
            if($last_priskhead->last_id != $thread->risk_id){
                $message = $priskhead->subject.' '.Url::to('http://113.53.236.21/faktharm'.$priskhead->risk_id);
                $res = $this->notify_message($message);
                $last_priskhead->last_id = $thread->risk_id;
                $last_priskhead->save();
            }
        }


    }

    public function notify_message($message)
    {
        $line_api = 'https://notify-api.line.me/api/notify';
        $line_token = 'RVGm1zwgzEDMFz9y0O0mzv1QPcBxrObfLYuVJq4gVB4';

        $queryData = array('message' => $message);
        $queryData = http_build_query($queryData,'','&');
        $headerOptions = array(
            'http'=>array(
                'method'=>'POST',
                'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"
                    ."Authorization: Bearer ".$line_token."\r\n"
                    ."Content-Length: ".strlen($queryData)."\r\n",
                'content' => $queryData
            )
        );
        $context = stream_context_create($headerOptions);
        $result = file_get_contents($line_api, FALSE, $context);
        $res = json_decode($result);
        return $res;
    }

}