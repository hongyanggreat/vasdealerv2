<?php

namespace backend\modules\groupAccountDetail\models;

use Yii;
use backend\modules\groupAccount\models\GroupAccount;
/**
 * This is the model class for table "tbl_group_acc_detail".
 *
 * @property integer $ID
 * @property integer $ACC_ID
 * @property integer $GROUP_ID
 * @property integer $CREATE_BY
 * @property integer $CREATE_DATE
 * @property integer $UPDATE_BY
 * @property integer $UPDATE_DATE
 * @property string $DESCRIPTION
 * @property integer $STATUS
 */
class GroupAccDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'group_acc_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ACC_ID', 'GROUP_ID', 'CREATE_BY', 'CREATE_DATE', 'STATUS'], 'required','message'=>'{attribute} yêu cầu không được để trống'],
            [['GROUP_ID', 'CREATE_BY', 'CREATE_DATE', 'UPDATE_BY', 'UPDATE_DATE', 'STATUS'], 'integer','message'=>'{attribute} kiểu số'],
            [['ACC_ID'], 'string', 'max' => 255,'message'=>'{attribute} chứa nhiều nhất 255 ký tự'],
            [['DESCRIPTION'], 'string', 'max' => 500,'message'=>'{attribute} chứa nhiều nhất 500 ký tự'],
            [['GROUP_ID'], 'unique','message'=>'{attribute} đã tồn tại'],
            //[['ACC_ID'], 'checkExits'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'ACC_ID' => 'Tài khoản',
            'GROUP_ID' => 'Tên nhóm',
            'CREATE_BY' => 'Tạo bởi',
            'CREATE_DATE' => 'Ngày tạo',
            'UPDATE_BY' => 'Cập nhật bởi',
            'UPDATE_DATE' => 'Ngày cập nhật',
            'DESCRIPTION' => 'Miêu tả',
            'STATUS' => 'Trạng thái',
        ];
    }
    public function checkExits($attribute, $params)
    {
        $models = GroupAccDetail::find()
                        ->andWhere(['ACC_ID'=> $this->ACC_ID])
                        ->andWhere(['GROUP_ID'=> $this->GROUP_ID]);
        if(!empty($this->ID)){
           $models->andWhere(['!=','ID', $this->ID]);
        }
        $count = $models->count();
        if ($count) {
          $this->addError($attribute, 'Đã tồn tại tài khoản kết hợp với nhóm này,vui lòng thêm  tài khoản vào nhóm khác!');
        }
        
    }
    public function getGroup()
    {
        return $this->hasOne(GroupAccount::className(), ['GROUP_ID' => 'GROUP_ID']);
    }
    public function getSelfAccount()
    {
        return  $this->hasMany(GroupAccDetail::className(), ['ACC_ID' => 'ACC_ID']);
    }
}
