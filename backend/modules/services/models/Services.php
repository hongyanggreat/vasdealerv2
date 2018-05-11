<?php

namespace backend\modules\services\models;

use Yii;

/**
 * This is the model class for table "services".
 *
 * @property integer $ID
 * @property integer $ID_PACKAGE
 * @property string $SERVICE_CODE
 * @property string $PRODUCT_CODE
 * @property integer $PRICE
 * @property integer $CYCLES
 * @property string $DESCRIPTION
 * @property integer $TYPE
 * @property integer $STATUS
 * @property integer $CONMISSION_TYPE
 * @property string $CREATE_AT
 * @property string $UPDATE_AT
 */
class Services extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $ORDER;
    public $BY;
    public static function tableName()
    {
        return 'services';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_PACKAGE', 'PRICE', 'CYCLES', 'TYPE', 'STATUS', 'CONMISSION_TYPE'], 'integer'],
            [['CREATE_AT','UPDATE_AT'], 'safe'],
            [['SERVICE_CODE', 'PRODUCT_CODE', 'DESCRIPTION'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID'              => 'ID',
            'ID_PACKAGE'      => 'Id  Package',
            'SERVICE_CODE'    => 'Service  Code',
            'PRODUCT_CODE'    => 'Product  Code',
            'PRICE'           => 'Price',
            'CYCLES'          => 'Cycles',
            'DESCRIPTION'     => 'Description',
            'TYPE'            => 'Type',
            'STATUS'          => 'Status',
            'CONMISSION_TYPE' => 'Conmission  Type',
            'CREATE_AT'       => 'Create  At',
            'UPDATE_AT'       => 'Update  At',
        ];
    }
}
