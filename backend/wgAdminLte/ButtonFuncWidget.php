<?php 
namespace backend\wgAdminLte;

use yii\base\Widget;
use yii\helpers\Html;

class ButtonFuncWidget extends Widget
{
    public $dataProvider;
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->render('button-func',['dataProvider'=>$this->dataProvider]);
    }
}