<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Product extends \yii\db\ActiveRecord
{
    public $id;
    public $name;
    public $type;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [[ 'name', 'type'], 'required']
        ];
    } 
    
    public static function tableName()
    {
        return 'products';
    }
   
}
