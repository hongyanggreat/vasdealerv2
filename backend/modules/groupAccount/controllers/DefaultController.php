<?php

namespace backend\modules\groupAccount\controllers;

use Yii;
use backend\modules\groupAccount\models\GroupAccount;
use backend\modules\groupAccount\models\GroupAccountSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use backend\modules\moduleManager\models\Modules;

/**
 * DefaultController implements the CRUD actions for GroupAccount model.
 */
class DefaultController extends Controller
{
    /**
     * @inheritdoc
     */
     public function behaviors()
    {
        $actions = Yii::$app->acl->getRole();

        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => $actions,
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }
     public function actions()
    {

		$this->layout = "@app/views/layouts/layoutTable";
        
    }
    /**
     * Lists all GroupAccount models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GroupAccountSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GroupAccount model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new GroupAccount model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $dataModule = ArrayHelper::map(Modules::find()->select(['MODULE_ID','NAME'])->asArray()->where('STATUS=:status',['status'=>1])->all(),'MODULE_ID','NAME'); 
        $model = new GroupAccount();

        if ($model->load(Yii::$app->request->post())) {

            $idUser             = Yii::$app->user->id;
            $model->CREATE_BY   = $idUser;
            $time               = time();
            $model->CREATE_DATE = $time ;

            $strModuleId   = '';
            $moduleIdArr  = $model->MODULE_ID;
            if(isset($moduleIdArr) && $moduleIdArr){
                $strModuleId   = implode('-', $moduleIdArr);
            }
            $model->MODULE_ID = $strModuleId;

            if($model->save()){
                return $this->redirect(['view', 'id' => $model->GROUP_ID]);
            }else{
               
                return $this->render('create', [
                   'model'      => $model,
                   'dataModule' => $dataModule,
                ]);
            }
        } else {
            return $this->render('create', [
                'model'      => $model,
                'dataModule' => $dataModule,
            ]);
        }
    }

    /**
     * Updates an existing GroupAccount model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
         $dataModule = ArrayHelper::map(Modules::find()->select(['MODULE_ID','NAME'])->asArray()->where('STATUS=:status',['status'=>1])->all(),'MODULE_ID','NAME'); 
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $idUser             = Yii::$app->user->id;
            $model->UPDATE_BY   = $idUser;
            $time               = time();
            $model->UPDATE_DATE = $time ;

            $strModuleId   = '';
            $moduleIdArr  = $model->MODULE_ID;
            if(isset($moduleIdArr) && $moduleIdArr){
                $strModuleId   = implode('-', $moduleIdArr);
            }
            $model->MODULE_ID = $strModuleId;

            if($model->save()){
                return $this->redirect(['view', 'id' => $model->GROUP_ID]);
            }else{
               
                return $this->render('create', [
                   'model'      => $model,
                   'dataModule' => $dataModule,
                ]);
            }
        } else {
            return $this->render('update', [
                'model'      => $model,
                'dataModule' => $dataModule,
            ]);
        }
    }

    /**
     * Deletes an existing GroupAccount model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        //$this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the GroupAccount model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GroupAccount the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GroupAccount::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
