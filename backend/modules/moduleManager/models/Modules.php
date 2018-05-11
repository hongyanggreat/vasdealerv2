<?php

namespace backend\modules\moduleManager\models;
use Yii;
use backend\modules\userPermission\models\UserPermission;

/**
 * This is the model class for table "tbl_modules".
 *
 * @property integer $MODULE_ID
 * @property string $RESOURCE
 * @property string $NAME
 * @property string $DESCRIPTION
 * @property integer $CREATE_DATE
 * @property integer $CREATE_BY
 * @property integer $UPDATE_DATE
 * @property integer $UPDATE_BY
 * @property integer $TYPE
 * @property integer $STATUS
 */
class Modules extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $TEXT_LIMIT;
    public static function tableName()
    {
        return 'modules';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['RESOURCE','NAME','CREATE_DATE', 'CREATE_BY', 'TYPE', 'STATUS'], 'required'],
            [['CREATE_DATE', 'CREATE_BY', 'UPDATE_DATE', 'UPDATE_BY', 'TYPE', 'STATUS','TEXT_LIMIT'], 'integer'],
            [['RESOURCE'], 'string', 'max' => 1023],
            [['RESOURCE'], 'unique'],
            [['NAME', 'DESCRIPTION'], 'string', 'max' => 511],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'MODULE_ID'   => 'Module',
            'RESOURCE'    => 'Module',
            'NAME'        => 'Tên module',
            'DESCRIPTION' => 'Miêu tả',
            'CREATE_DATE' => 'Ngày tạo',
            'CREATE_BY'   => 'Tạo bởi',
            'UPDATE_DATE' => 'Ngày cập nhật',
            'UPDATE_BY'   => 'Cập nhật bởi',
            'TYPE'        => 'Type',
            'STATUS'      => 'Trạng thái',
            'TEXT_LIMIT'   => 'TEXT_LIMIT',
        ];
    }

   /* public function getUserPermission()
    {
        return $this->hasMany(UserPermission::className(), ['MODULE_ID' => 'MODULE_ID']);
    }*/
}
