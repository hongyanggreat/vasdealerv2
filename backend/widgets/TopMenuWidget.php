<?php 
namespace backend\widgets;

use yii\base\Widget;
use yii\helpers\Html;

class TopMenuWidget extends Widget
{
    public $message;
    public $data;
    public $view;
    public function init()
    {
        parent::init();
    }

    public function run()
    {
       // $view = "topMenu";
        $view = $this->view;
        return $this->render($view,['data'=>$this->data]);
    }
}