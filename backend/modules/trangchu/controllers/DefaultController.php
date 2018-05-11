<?php

namespace backend\modules\trangchu\controllers;
use Yii;
use yii\web\Controller;

use backend\modules\subject\models\Subjects;

/**
 * Default controller for the `trangchu` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    const LIMIT = 10;
     public function actions()
    {
        
        $this->layout = "@app/views/layouts/adminLte";
        
    }
    public function actionIndex()
    {

        
    }
}
