<?php 
namespace backend\wgAdminLte;

use yii\base\Widget;
use yii\helpers\Html;

class HeadFormWidget extends Widget
{
    public $data;
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->render('head-form',['data'=>$this->data]);
    }
}