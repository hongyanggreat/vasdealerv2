<?php 
namespace backend\wgAdminLte;

use yii\base\Widget;
use yii\helpers\Html;

class Jquery3FormWidget extends Widget
{
    public $data;
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->render('jquery3-form',['data'=>$this->data]);
    }
}