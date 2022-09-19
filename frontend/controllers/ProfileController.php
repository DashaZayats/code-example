<?php

namespace frontend\controllers;

use yii;
use app\models\Profile;
use app\models\ProfileSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Projects;
use app\models\Responses;
use app\models\Jobs;
use app\models\Messages;

/**
 * ProfileController implements the CRUD actions for Profile model.
 */
class ProfileController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Profile models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $temp = new Projects();
        list($projects, $pages) = $temp->getUserProjects();
                
        return $this->render(
            'index',
            compact('projects', 'pages')
        );
    }
   /**
     * Lists all Profile models.
     *
     * @return string
     */
    public function actionProjects()
    {
        $temp = new Projects();
        list($projects, $pages) = $temp->getProfileProjects();
                
      return $this->render(
            'projects',
            compact('projects', 'pages')
        );
    }
    
    
    
   /**
     * Lists all Profile models.
     *
     * @return string
     */
    public function actionResponses()
    {
        $temp = new Projects();
        list($projects, $pages) = $temp->getUserProjects();
                
      return $this->render(
            'responses',
            compact('projects', 'pages')
        );
    }
    
    
    /**
     * Displays a single Projects model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionProject($id)
    {


        $model = Projects::findOne(['id' => $id]);
        if(!empty($model)){
            $category = Jobs::findOne($model->category_id);
        }
       
        if(Yii::$app->user->isGuest){
            $responsesUserCount = 0;
        }else{
            $responsesUserCount = Responses::find()->where(['user_id' => Yii::$app->user->identity->id ,'project_id'=>$id])->one();
        }
        $responsesList = Responses::find()->select('responses.*,user.email as user_email, user.username as user_name')->leftJoin('user', 'responses.user_id = user.id')->where(['responses.project_id'=>$id])->asArray()->all();
        
        foreach($responsesList as $key=>$response){
            $responsesList[$key]['messages'] = Messages::find()->select('*')->where(['response_id'=>$response['id']])->orderBy(['create_date' => SORT_DESC])->asArray()->all();
        }
        
        
        return $this->render(
            'projects_view',
            compact('model', 'category','responsesUserCount', 'responsesList')
        );
    }
    
    /**
     * Displays a single Profile model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Profile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Profile();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Profile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
     
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Profile model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Profile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Profile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Profile::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
