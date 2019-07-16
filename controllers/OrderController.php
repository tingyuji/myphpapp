<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\OrderModel;

class OrderController extends Controller
{

    public function actionGenerate()
    {
        $model = new OrderModel();
        $orderCode = $model->generateCode();
        return $orderCode;
    }
    
}
