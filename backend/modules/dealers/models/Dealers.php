<?php

namespace backend\modules\dealers\models;

use Yii;

/**
 * This is the model class for table "dealers".
 *
 * @property integer $ID
 * @property integer $DEALER_ID
 * @property string $NAME
 * @property string $CODE
 * @property string $EMAIL
 * @property string $MSISDN
 * @property integer $ACCOUNT_ID
 * @property string $USER_ACCOUNT
 * @property integer $STATUS
 * @property string $CREATE_AT
 * @property string $EFFECTIVE_TIME_START
 * @property string $CP_CODE_ACCOUNT 
 * @property string $EFFECTIVE_TIME_END
 */
class Dealers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $ORDER;
    public $BY;
    public static function tableName()
    {
        return 'dealers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NAME','CODE'], 'required'],
            [['NAME','CODE'], 'unique'],
            [['DEALER_ID', 'ACCOUNT_ID', 'STATUS'], 'integer'],
            [['CREATE_AT', 'EFFECTIVE_TIME_START', 'EFFECTIVE_TIME_END','ORDER','BY'], 'safe'],
            [['NAME', 'CODE', 'EMAIL', 'MSISDN', 'USER_ACCOUNT','CP_CODE_ACCOUNT'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'DEALER_ID' => 'Dearler  ID',
            'NAME' => 'Name',
            'CODE' => 'Code',
            'EMAIL' => 'Email',
            'MSISDN' => 'Msisdn',
            'ACCOUNT_ID' => 'Account  ID',
            'USER_ACCOUNT' => 'User  Account',
            'STATUS' => 'Status',
            'CREATE_AT' => 'Create  At',
            'EFFECTIVE_TIME_START' => 'Effective  Time  Start',
            'EFFECTIVE_TIME_END' => 'Effective  Time  End',
            'ORDER' => 'Order',
            'BY' => 'By',
            'CP_CODE_ACCOUNT' => 'Cp Code Account', 
        ];
    }
}
