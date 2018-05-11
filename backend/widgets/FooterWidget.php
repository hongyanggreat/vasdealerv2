<?php 
namespace backend\widgets;

use yii\base\Widget;
use yii\helpers\Html;

class FooterWidget extends Widget
{
    public $message;
    public $data;
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->render('footer',['data'=>$this->data]);
    }
}