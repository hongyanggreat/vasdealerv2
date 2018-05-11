<?php 
namespace backend\widgets;

use yii\base\Widget;
use yii\helpers\Html;

class ButtonControlWidget extends Widget
{
    public $message;
    public $dataProvider;
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->render('buttonControl',['dataProvider'=>$this->dataProvider]);
    }
}