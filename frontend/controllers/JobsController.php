<?php

namespace frontend\controllers;

use yii;
use app\models\Jobs;
use app\models\Projects;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\HttpException;

/**
 * JobsController implements the CRUD actions for Jobs model.
 */
class JobsController extends Controller
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
                           'search' => ['GET'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Jobs models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $id = 0;
        return $this->actionView($id);
    }

    /**
     * Displays a single Jobs model.
     * @param $slug url
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($slug)
    {
        $temp = new Jobs();
        
        if(!empty($slug)){
            $category = $temp::find()->where(['url' => $slug])->one();
        }else{
            $category = array();
        }
     
        // товары категории
        if(!empty($category) && !empty($slug)){
            
            list($projects, $pages) = $temp->getCatProjects($category->id);
            // данные о категории
            $model = $this->findModel($category->id);

        }else{
            
            list($projects, $pages) = $temp->getProjects();
            // данные о категории
            $model = array();
        }


        return $this->render(
            'index',
            compact('model', 'projects', 'pages','category')
        );

    }



    /**
     * Deletes an existing Jobs model.
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
     * Finds the Jobs model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Jobs the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Jobs::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    
    /**
     * Результаты поиска по каталогу товаров
     */
    public function actionSearch($query = '', $page = 1) {
        $request = Yii::$app->request;
        $query = $request->get('query'); 
        $page = $request->get('page');

        // получаем результаты поиска с постраничной навигацией
        list($projects, $pages) = (new Projects())->getSearchResult($query, $page);

        // устанавливаем мета-теги для страницы
       // $this->setMetaTags('Поиск по каталогу');
           // данные о бренде
            $model = array();
            $category = array();
        return $this->render(
            'index',
            compact('model', 'projects', 'pages','category','query')
        );
    }
    
}
