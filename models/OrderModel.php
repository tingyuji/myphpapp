<?php

namespace app\models;

use Yii;
use yii\base\Model;

class OrderModel extends Model
{
    public $id;
    public $name;
    public $price;
    public $num;

    private static $orders = [
        '100' => [
            'id' => '2019041100001',
            'name' => '苹果手机',
            'price' => '10000',
            'num' => '1'
        ],
        '101' => [
            'id' => '2019041100002',
            'name' => '华为手机',
            'price' => '5000',
            'num' => '1'
        ],
    ];


    /**
     * {@inheritdoc}
     */
    public function generateCode()
    {
        $num =  rand(0, 100);
        $orderCode=date('Ymd').str_pad($num,5,'0',STR_PAD_LEFT);
        return $orderCode;
    }


}
