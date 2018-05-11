<?php 
namespace backend\widgets;

use yii\base\Widget;
use yii\helpers\Html;

class PaginationWidget extends Widget
{
    public $paginator;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        // return $this->render('pagination',['paginator'=>$this->paginator]);
        return $this->render('pagination',['paginator'=>$this->paginator]);
    }
}