<?php

namespace backend\modules\subscriptStatus\models;

use Yii;

/**
 * This is the model class for table "subscript_status_request".
 *
 * @property integer $ID
 * @property string $USERNAME
 * @property string $PASSWORD
 * @property string $MASTER_ID
 * @property string $CHECKSUM
 * @property integer $DEALER_ID
 * @property integer $SERVICE_ID
 * @property string $MSISDN
 * @property integer $ERROR_CODE
 * @property string $ERROR_DESC
 * @property integer $STATUS
 * @property string $LAST_SUBSCRIBE
 * @property string $LAST_UNSUBSCRIBE
 * @property string $LAST_RENEW
 * @property string $LAST_RETRY
 * @property string $EXPIRE_TIME
 * @property string $CP_CODE_ACCOUNT
 * @property string $USER_ACCOUNT
 * @property string $DEALER_CODE
 * @property string $CREATE_AT
 */
class SubscriptStatusRequest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $ORDER;
    public $BY;
    public $SERVICE_CODE;
    public static function tableName()
    {
        return 'subscript_status_request';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DEALER_ID','SERVICE_ID','MSISDN'], 'required'],
            [['DEALER_ID', 'SERVICE_ID', 'ERROR_CODE', 'STATUS','MASTER_ID'], 'integer'],
            [['CREATE_AT','ORDER','BY','SERVICE_CODE'], 'safe'],
            [['USERNAME', 'PASSWORD', 'MSISDN', 'LAST_SUBSCRIBE', 'LAST_UNSUBSCRIBE', 'LAST_RENEW', 'LAST_RETRY', 'EXPIRE_TIME', 'CP_CODE_ACCOUNT', 'USER_ACCOUNT', 'DEALER_CODE'], 'string', 'max' => 255],
            [['CHECKSUM', 'ERROR_DESC'], 'string', 'max' => 511],
             [['MSISDN'], 'checkPhone'],
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
            'DEALER_ID' => 'Dealer  ID',
            'SERVICE_ID' => 'Service  ID',
            'SERVICE_CODE' => 'Service  Code',
            'MSISDN' => 'Msisdn',
            'ERROR_CODE' => 'Error  Code',
            'ERROR_DESC' => 'Error  Desc',
            'STATUS' => 'Status',
            'LAST_SUBSCRIBE' => 'Last  Subscribe',
            'LAST_UNSUBSCRIBE' => 'Last  Unsubscribe',
            'LAST_RENEW' => 'Last  Renew',
            'LAST_RETRY' => 'Last  Retry',
            'EXPIRE_TIME' => 'Expire  Time',
            'CP_CODE_ACCOUNT' => 'Cp  Code  Account',
            'USER_ACCOUNT' => 'User  Account',
            'DEALER_CODE' => 'Dealer  Code',
            'CREATE_AT' => 'Create  At',
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
