<?php

namespace backend\modules\dealerRequest\models;

use Yii;

/**
 * This is the model class for table "dealer_request".
 *
 * @property integer $ID
 * @property string $USERNAME
 * @property string $PASSWORD
 * @property integer $MASTER_ID
 * @property string $CHECKSUM
 * @property integer $REQUEST_ID
 * @property string $NAME
 * @property string $CODE
 * @property string $EMAIL
 * @property string $MSISDN
 * @property integer $ERROR_CODE
 * @property string $ERROR_DESC
 * @property integer $DEALER_ID
 * @property integer $TYPE_ACTION
 * @property string $USER_ACTION
 * @property string $CREATE_AT
 * @property string $USER_ACCOUNT
 * @property string $CP_CODE_ACCOUNT
 */
class DealerRequest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $ORDER;
    public $BY;
    public $TIME;
    public static function tableName()
    {
        return 'dealer_request';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['MASTER_ID', 'REQUEST_ID', 'ERROR_CODE', 'DEALER_ID', 'TYPE_ACTION'], 'integer'],
            [['CREATE_AT','ORDER','BY','TIME'], 'safe'],
            [['USER_ACCOUNT'], 'required'],
            [['USERNAME', 'PASSWORD', 'NAME', 'CODE', 'EMAIL', 'MSISDN', 'USER_ACTION', 'USER_ACCOUNT', 'CP_CODE_ACCOUNT'], 'string', 'max' => 255],
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
            'NAME' => 'Name',
            'CODE' => 'Code',
            'EMAIL' => 'Email',
            'MSISDN' => 'Msisdn',
            'ERROR_CODE' => 'Error  Code',
            'ERROR_DESC' => 'Error  Desc',
            'DEALER_ID' => 'Dealer  ID',
            'TYPE_ACTION' => 'Type  Action',
            'USER_ACTION' => 'User  Action',
            'CREATE_AT' => 'Create  At',
            'USER_ACCOUNT' => 'User  Account',
            'CP_CODE_ACCOUNT' => 'Cp  Code  Account',
        ];
    }
}
