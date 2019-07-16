<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;


class IndexController extends Controller
{

    public function actionIndex()
    {
        $date = date('Y-m-d H:i:s');
        return $date;
    }
    
}
