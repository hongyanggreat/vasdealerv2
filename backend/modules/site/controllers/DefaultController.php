<?php

namespace backend\modules\site\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Default controller for the `site` module
 */
class DefaultController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error','forget'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {

         //$this->layout = "@app/views/layouts/main";
         //$this->layout = "@app/views/layouts/layoutHtml";
         $this->layout = "@app/views/layouts/layoutLogin";
         //$this->layout = "@app/views/layouts/adminLayoutFormLogin";

        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        // Yii::$app->user->logout();
        // die;
        //echo Yii::$app->getRequest()->hostInfo;
        // echo 'DNH';
        if (Yii::$app->user->isGuest) {
            return $this->redirect('site/login');
        }else{
            return $this->redirect("users");
        }

    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        Yii::$app->session->destroy();
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $baseUrl = Yii::$app->params['baseUrl'];
            return $this->redirect($baseUrl.'quan-tri');
            // return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionForget(){
        $model = new LoginForm();
        return $this->render('forget', [
            'model' => $model,
        ]);
        //echo 'Đang Cập nhật';
        //print_r($_POST);
        //print_r($_GET);
    }
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    
}
