<?php 
namespace backend\wgAdminLte;

use yii\base\Widget;
use yii\helpers\Html;

class MainSidebarWidget extends Widget
{
    public $data;
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->render('main-sidebar',['data'=>$this->data]);
    }
}