<?php

namespace backend\modules\cdrRequest\models;

use Yii;

/**
 * This is the model class for table "cdr_request".
 *
 * @property integer $ID
 * @property integer $REQUEST_ID
 * @property integer $MASTER_ID
 * @property integer $AGENT_ID
 * @property integer $DEALER_ID
 * @property integer $TRANSACTION_ID
 * @property string $TIMESTAMP
 * @property string $ACTION
 * @property integer $ORGINAL_PRICE
 * @property integer $PRICE
 * @property integer $PROMOTION
 * @property integer $CHARGE_COUNT
 * @property integer $RESULT_CODE
 * @property integer $ERROR_CODE
 * @property string $ERROR_DESC
 * @property integer $STATUS
 * @property string $CREATE_AT
 * @property string $PRODUCT_CODE
 * @property string $CHANNEL
 * @property string $DEALER_CODE
 * @property string $PHONE
 */
class CdrRequest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $ORDER;
    public $BY;
    public $START_DATE;
    public $END_DATE;
    public static function tableName()
    {
        return 'cdr_request';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['REQUEST_ID', 'MASTER_ID', 'AGENT_ID', 'DEALER_ID', 'TRANSACTION_ID', 'ORGINAL_PRICE', 'PRICE', 'PROMOTION', 'CHARGE_COUNT', 'RESULT_CODE', 'ERROR_CODE', 'STATUS'], 'integer'],
            [['CREATE_AT','ORDER','BY','START_DATE','END_DATE'], 'safe'],
            [['TIMESTAMP', 'ACTION', 'PRODUCT_CODE', 'CHANNEL', 'DEALER_CODE', 'PHONE'], 'string', 'max' => 255],
            [['ERROR_DESC'], 'string', 'max' => 511],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'REQUEST_ID' => 'Request  ID',
            'MASTER_ID' => 'Master  ID',
            'AGENT_ID' => 'Agent  ID',
            'DEALER_ID' => 'Dealer  ID',
            'TRANSACTION_ID' => 'Transaction  ID',
            'TIMESTAMP' => 'Timestamp',
            'ACTION' => 'Action',
            'ORGINAL_PRICE' => 'Orginal  Price',
            'PRICE' => 'Price',
            'PROMOTION' => 'Promotion',
            'CHARGE_COUNT' => 'Charge  Count',
            'RESULT_CODE' => 'Result  Code',
            'ERROR_CODE' => 'Error  Code',
            'ERROR_DESC' => 'Error  Desc',
            'STATUS' => 'Status',
            'CREATE_AT' => 'Create  At',
            'PRODUCT_CODE' => 'Product  Code',
            'CHANNEL' => 'Channel',
            'DEALER_CODE' => 'Dealer  Code',
            'PHONE' => 'Phone',
        ];
    }
}
