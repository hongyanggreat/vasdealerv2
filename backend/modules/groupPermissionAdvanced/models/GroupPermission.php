<?php

namespace backend\modules\groupPermissionAdvanced\models;

use Yii;

/**
 * This is the model class for table "tbl_group_permission".
 *
 * @property integer $ID
 * @property integer $GROUP_ID
 * @property integer $MODULE_ID
 * @property boolean $ALL_RIGHT
 * @property boolean $LIST_RIGHT
 * @property boolean $VIEW_RIGHT
 * @property boolean $ADD_RIGHT
 * @property boolean $EDIT_RIGHT
 * @property boolean $DEL_RIGHT
 * @property boolean $UP_RIGHT
 * @property boolean $DOWN_RIGHT
 * @property string $DESCRIPTION
 * @property integer $CREATE_DATE
 * @property integer $CREATE_BY
 * @property integer $UPDATE_DATE
 * @property integer $UPDATE_BY
 * @property integer $STATUS
 */
class GroupPermission extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'group_permission';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['GROUP_ID', 'MODULE_ID', 'CREATE_DATE', 'CREATE_BY', 'STATUS'], 'required'],
            [['GROUP_ID', 'MODULE_ID', 'CREATE_DATE', 'CREATE_BY', 'UPDATE_DATE', 'UPDATE_BY', 'STATUS'], 'integer'],
            [['ALL_RIGHT', 'LIST_RIGHT','VIEW_RIGHT', 'ADD_RIGHT', 'EDIT_RIGHT', 'DEL_RIGHT', 'UP_RIGHT', 'DOWN_RIGHT'], 'boolean'],
            [['DESCRIPTION'], 'string', 'max' => 511],
            [['GROUP_ID'], 'checkExits'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID'          => 'ID',
            'GROUP_ID'    => 'Tên nhóm',
            'MODULE_ID'   => 'Module',
            'ALL_RIGHT'   => 'All  Right',
            'LIST_RIGHT'  => 'List  Right',
            'VIEW_RIGHT'  => 'View  Right',
            'ADD_RIGHT'   => 'Add  Right',
            'EDIT_RIGHT'  => 'Edit  Right',
            'DEL_RIGHT'   => 'Del  Right',
            'UP_RIGHT'    => 'Up  Right',
            'DOWN_RIGHT'  => 'Down  Right',
            'DESCRIPTION' => 'Miêu tả',
            'CREATE_DATE' => 'Ngày tạo',
            'CREATE_BY'   => 'Tạo bởi',
            'UPDATE_DATE' => 'Ngày cập nhật',
            'UPDATE_BY'   => 'Cập nhật bởi',
            'STATUS'      => 'Trạng thái',
        ];
    }
    public function checkExits($attribute, $params)
    {
        $models = GroupPermission::find()
                        ->andWhere(['GROUP_ID'=> $this->GROUP_ID])
                        ->andWhere(['MODULE_ID'=> $this->MODULE_ID]);
        if(!empty($this->ID)){
           $models->andWhere(['!=','ID', $this->ID]);
        }

        $count = $models->count();
        if ($count) {
          $this->addError($attribute, 'Đã tồn tại,vui lòng kết hợp nhóm tài khoản với module khác!');
        }
        
    }
}
