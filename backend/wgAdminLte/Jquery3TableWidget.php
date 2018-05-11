<?php 
namespace backend\wgAdminLte;

use yii\base\Widget;
use yii\helpers\Html;

class Jquery3TableWidget extends Widget
{
    public $data;
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->render('jquery3-table',['data'=>$this->data]);
    }
}