<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user;


    public $email;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required','message'=>'{attribute} không được để trống'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['username', 'validateAdmin'],
            ['password', 'validatePassword'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'username'               => 'Tài khoản',
            'password'               => 'Mật khẩu',
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateAdmin($attribute, $params)
    {
        $module    = Yii::$app->controller->module->id;
        if (!$this->hasErrors()) {
            $user = $this->getUser();
           /* if ($user->USER_TYPE != null && $module !="app-frontend") {
                $this->addError($attribute, 'Bạn không được cấp quyền truy cập.');
            }*/
        }
    }
     public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Tên đăng nhập hoặc mật khẩu không chính xác.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
