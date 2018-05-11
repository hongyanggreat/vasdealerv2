<?php

namespace backend\modules\serviceRequest\models;

use Yii;

/**
 * This is the model class for table "service_request".
 *
 * @property integer $ID
 * @property string $USERNAME
 * @property string $PASSWORD
 * @property string $MASTER_ID
 * @property string $CHECKSUM
 * @property integer $ERROR_CODE
 * @property string $ERROR_DESC
 * @property integer $QUANTITY
 * @property string $ITEMS
 * @property integer $ITEM_ID
 * @property string $CREATE_AT
 */
class ServiceRequest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service_request';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ERROR_CODE', 'QUANTITY', 'ITEM_ID','MASTER_ID'], 'integer'],
            [['ITEMS'], 'string'],
            [['CREATE_AT'], 'safe'],
            [['USERNAME', 'PASSWORD'], 'string', 'max' => 255],
            [['CHECKSUM', 'ERROR_DESC'], 'string', 'max' => 511],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'USERNAME' => 'Username',
            'PASSWORD' => 'Password',
            'MASTER_ID' => 'Master  ID',
            'CHECKSUM' => 'Checksum',
            'ERROR_CODE' => 'Error  Code',
            'ERROR_DESC' => 'Error  Desc',
            'QUANTITY' => 'Quantity',
            'ITEMS' => 'Items',
            'ITEM_ID' => 'Item  ID',
            'CREATE_AT' => 'Create  At',
        ];
    }
}
