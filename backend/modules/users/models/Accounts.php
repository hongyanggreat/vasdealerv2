<?php

namespace backend\modules\users\models;

use Yii;
use backend\modules\money\models\Money;
/**
 * This is the model class for table "tbl_accounts".
 *
 * @property integer $ACC_ID
 * @property integer $PARENT_ID
 * @property string $USERNAME
 * @property string $PASSWORD
 * @property string $PASSWORD_RESET_TOKEN
 * @property string $AUTH_KEY
 * @property string $CP_CODE
 * @property string $FULL_NAME
 * @property string $DESCRIPTION
 * @property string $ADDRESS
 * @property string $PHONE
 * @property string $EMAIL
 * @property integer $CREATE_DATE
 * @property string $CREATE_BY
 * @property integer $UPDATE_DATE
 * @property string $UPDATE_BY
 * @property integer $USER_TYPE
 * @property integer $STATUS
 * @property integer $LEVEL
 * @property string $OPTION_DATA
 */
class Accounts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $RE_PASSWORD;
    public static function tableName()
    {
        return 'accounts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PARENT_ID','USERNAME' ,'EMAIL','CP_CODE','USER_TYPE','STATUS','AUTH_KEY','CREATE_DATE','CREATE_BY'], 'required'],
            [['PARENT_ID','CREATE_DATE', 'CREATE_BY', 'STATUS','LEVEL','UPDATE_BY','UPDATE_DATE'], 'integer'],
            [['USERNAME', 'PASSWORD','RE_PASSWORD', 'PASSWORD_RESET_TOKEN', 'AUTH_KEY', 'CP_CODE', 'FULL_NAME', 'PHONE', 'EMAIL'], 'string', 'max' => 127],
            [['PASSWORD'], 'required','on'=>'create'],
            //[['PASSWORD'], 'checkPass'],
            
            //[['USERNAME'], 'match', 'pattern' => '/^[a-zA-Z0-9]+([a-zA-Z0-9](_|-| )[a-zA-Z0-9])*[a-zA-Z0-9]+$/','message'=>'Tài khoản chưa hợp lệ'],
            [['USERNAME'], 'match', 'pattern' => '/^[A-Za-z0-9]+(?:[ _-][A-Za-z0-9]+)*$/','message'=>'Tài khoản chưa hợp lệ'],

            [['EMAIL'], 'match', 'pattern' => '/^([0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9})$/','message'=>'Email không hợp lệ'],

            [['DESCRIPTION', 'ADDRESS'], 'string', 'max' => 511],
            [['OPTION_DATA'], 'string', 'max' => 4000],
            [['USERNAME','CP_CODE','EMAIL'], 'unique'],
            [['PHONE'], 'checkPhone'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ACC_ID'               => 'Acc  ID',
            'PARENT_ID'            => 'Parent  ID',
            'USERNAME'             => 'Tài khoản',
            'PASSWORD'             => 'Password',
            'RE_PASSWORD'          => 'RE_PASSWORD',
            'PASSWORD_RESET_TOKEN' => 'Password  Reset  Token',
            'AUTH_KEY'             => 'Auth  Key',
            'CP_CODE'              => 'Cp  Code',
            'FULL_NAME'            => 'Full  Name',
            'ADDRESS'              => 'Address',
            'PHONE'                => 'Phone',
            'EMAIL'                => 'Email',
            'DESCRIPTION'          => 'Miêu tả',
            'CREATE_DATE'          => 'Ngày tạo',
            'CREATE_BY'            => 'Tạo bởi',
            'UPDATE_DATE'          => 'Ngày cập nhật',
            'UPDATE_BY'            => 'Cập nhật bởi',
            'USER_TYPE'            => 'Loại tài khoản',
            'STATUS'               => 'Trạng thái',
            'LEVEL'                => 'Cấp độ',
            'OPTION_DATA'          => 'Option  Data',
        ];
    }

    public function checkPass($attribute, $params)
    {
        if(isset($_POST['Accounts']['PASSWORD'])){
            $password = $_POST['Accounts']['PASSWORD'];
            if(trim($password) != ''){
                $uppercase = preg_match('@[A-Z]@', $password);
                $lowercase = preg_match('@[a-z]@', $password);
                $number    = preg_match('@[0-9]@', $password);
                $special   = preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $password);

                if(!$uppercase || !$lowercase || !$number || !$special || strlen($password) < 20) {
                    $this->addError($attribute, "Mật khẩu chưa được bảo mật.");
                }
            }
        }
    }
    public function checkPhone($attribute, $params)
    {   
        $result = Yii::$app->phoneNumber->detect_number($this->PHONE);
        if(!$result){
            $this->addError($attribute, "Không phải là số điện thoại");
        }
    }
    public function getParent()
    {
        return $this->hasOne(self::className(), ['ACC_ID' => 'PARENT_ID'])
            ->from(self::tableName() . ' PARENT_ID');
    }
     public function getMoney()
    {
        return $this->hasOne(Money::className(), ['ACC_ID' => 'ACC_ID']);
    }
}
