<?php

namespace backend\modules\dealerRequestStatus\models;

use Yii;

/**
 * This is the model class for table "dealer_status_request".
 *
 * @property integer $ID
 * @property string $USERNAME
 * @property string $PASSWORD
 * @property string $MASTER_ID
 * @property string $CHECKSUM
 * @property integer $DEALER_ID
 * @property integer $ERROR_CODE
 * @property string $ERROR_DESC
 * @property integer $STATUS
 * @property string $CREATE_AT
 */
class DealerStatusRequest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dealer_status_request';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DEALER_ID', 'ERROR_CODE', 'STATUS','MASTER_ID'], 'integer'],
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
            'DEALER_ID' => 'Dealer  ID',
            'ERROR_CODE' => 'Error  Code',
            'ERROR_DESC' => 'Error  Desc',
            'STATUS' => 'Status',
            'CREATE_AT' => 'Create  At',
        ];
    }
}
