<?php

namespace backend\modules\users\models;

use Yii;

/**
 * This is the model class for table "useronline".
 *
 * @property integer $ID
 * @property integer $TIME_SS
 * @property string $IP
 * @property string $USER
 * @property string $LOCAL
 */
class Useronline extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'useronline';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['TIME_SS','STATUS'], 'integer'],
            [['IP', 'USER', 'LOCAL'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID'      => 'ID',
            'TIME_SS' => 'Time  Ss',
            'IP'      => 'Ip',
            'USER'    => 'User',
            'LOCAL'   => 'Local',
            'STATUS'  => 'Local',
        ];
    }
}
