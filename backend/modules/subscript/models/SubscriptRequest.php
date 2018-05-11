<?php

namespace backend\modules\subscript\models;

use Yii;

/**
 * This is the model class for table "subscript_request".
 *
 * @property integer $ID
 * @property string $USERNAME
 * @property string $PASSWORD
 * @property string $MASTER_ID
 * @property string $CHECKSUM
 * @property string $REQUEST_ID
 * @property integer $DEALER_ID
 * @property integer $SERVICE_ID
 * @property string $MSISDN
 * @property string $DEALER_CODE
 * @property string $USER_ACCOUNT
 * @property string $CP_CODE_ACCOUNT
 * @property integer $ERROR_CODE
 * @property string $ERROR_DESC
 * @property integer $HAVE_COMMISSION
 * @property string $TRANSACTION_ID
 * @property string $TIME_START
 * @property string $TIME_END
 * @property integer $STATUS
 * @property string $CREATE_AT
 */
class SubscriptRequest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
     public $ORDER;
    public $BY;
    public static function tableName()
    {
        return 'subscript_request';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['REQUEST_ID', 'DEALER_ID', 'SERVICE_ID', 'ERROR_CODE', 'HAVE_COMMISSION', 'TRANSACTION_ID', 'STATUS','MASTER_ID'], 'integer'],
            [['CP_CODE_ACCOUNT'], 'required'],
            [['TIME_START', 'TIME_END', 'CREATE_AT','ORDER','BY'], 'safe'],
            [['USERNAME', 'PASSWORD', 'MSISDN', 'DEALER_CODE', 'USER_ACCOUNT', 'CP_CODE_ACCOUNT'], 'string', 'max' => 255],
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
            'REQUEST_ID' => 'Request  ID',
            'DEALER_ID' => 'Dealer  ID',
            'SERVICE_ID' => 'Service  ID',
            'MSISDN' => 'Msisdn',
            'DEALER_CODE' => 'Dealer  Code',
            'USER_ACCOUNT' => 'User  Account',
            'CP_CODE_ACCOUNT' => 'Cp  Code  Account',
            'ERROR_CODE' => 'Error  Code',
            'ERROR_DESC' => 'Error  Desc',
            'HAVE_COMMISSION' => 'Have  Commission',
            'TRANSACTION_ID' => 'Transaction  ID',
            'TIME_START' => 'Time  Start',
            'TIME_END' => 'Time  End',
            'STATUS' => 'Status',
            'CREATE_AT' => 'Create  At',
        ];
    }
}
