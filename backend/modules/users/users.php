<?php

namespace backend\modules\users;

use Yii;
/**
 * users module definition class
 */
class users extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'backend\modules\users\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        Yii::$app->errorHandler->errorAction = 'users/default/fault';
    }
}
