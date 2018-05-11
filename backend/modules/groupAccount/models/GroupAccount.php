<?php

namespace backend\modules\groupAccount\models;

use Yii;

/**
 * This is the model class for table "tbl_group_account".
 *
 * @property integer $GROUP_ID
 * @property string $NAME
 * @property string $MODULE_ID
 * @property string $DESCRIPTION
 * @property string $CREATE_DATE
 * @property string $CREATE_BY
 * @property string $UPDATE_DATE
 * @property string $UPDATE_BY
 * @property integer $STATUS
 */
class GroupAccount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'group_account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NAME', 'CREATE_BY', 'STATUS','MODULE_ID'], 'required','message'=>'{attribute} yêu cầu không được để trống'],
            [['STATUS','CREATE_BY','CREATE_DATE','UPDATE_DATE','UPDATE_BY'], 'integer','message'=>'{attribute} kiểu số'],
            [['NAME'], 'string', 'max' => 127,'message'=>'{attribute} chứa nhiều nhất 127 ký tự'],
            [['NAME'], 'unique','message'=>'{attribute} đã tồn tại'],
            [['DESCRIPTION','MODULE_ID'], 'string', 'max' => 255,'message'=>'{attribute} chứa nhiều nhất 255 ký tự'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'GROUP_ID' => 'Nhóm tài khoản',
            'NAME' => 'Tên nhóm',
            'DESCRIPTION' => 'Miêu tả',
            'CREATE_DATE' => 'Ngày tạo',
            'CREATE_BY' => 'Tạo bởi',
            'UPDATE_DATE' => 'Ngày cập nhật',
            'UPDATE_BY' => 'Cập nhật bởi',
            'STATUS' => 'Trạng thái',
            'MODULE_ID' => 'Module',
        ];
    }

    
}
