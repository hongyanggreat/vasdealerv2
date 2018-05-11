<?php

namespace backend\modules\dichvu\controllers;

use yii\web\Controller;

/**
 * Default controller for the `dichvu` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex($seviceCode)
    {
    	$this->layout = false;
    	echo $seviceCode;
    	// echo $service;

        // return $this->render('index');
    }
}
