<?php

namespace backend\modules\subscript\models;

use Yii;

/**
 * This is the model class for table "subscript_request".
 *

 * @property integer $REQUEST_ID
 * @property integer $DEALER_ID
 * @property integer $SERVICE_ID
 * @property string $MSISDN
 
 */
class Subscript extends \yii\db\ActiveRecord
{
    public $SERVICE_CODE;
    public static function tableName()
    {
        return 'subscript_request';
    }
    public function rules()
    {
        return [
            [['MSISDN','DEALER_ID','REQUEST_ID','SERVICE_ID'], 'required'],
            [['REQUEST_ID', 'DEALER_ID', 'SERVICE_ID'], 'integer'],
            [['MSISDN', ], 'string', 'max' => 15],
            [['SERVICE_CODE'], 'safe'],
            [['MSISDN'], 'checkPhone'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'REQUEST_ID' => 'Request  ID',
            'DEALER_ID'  => 'Dearler  ID',
            'SERVICE_ID' => 'Service  ID',
            'MSISDN'     => 'Msisdn',
            'SERVICE_CODE' => 'SERVICE_CODE',
        ];
    }

    public function checkPhone($attribute, $params)
    {   
        $result = Yii::$app->phoneNumber->detect_phone_vina($this->MSISDN);
        if(!$result){
            $this->addError($attribute, "Không phải là số điện thoại vinaphone");
        }
    }
}
