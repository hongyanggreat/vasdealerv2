<?php 
namespace backend\widgets;

use yii\base\Widget;
use yii\helpers\Html;

class ButtonWidget extends Widget
{
    public $message;
    public $data;
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->render('button',['data'=>$this->data]);
    }
}