<?php

namespace frontend\controllers;

use Yii;
use yii\base\Model;
use common\models\User;
use app\models\Projects;
use app\models\ProjectsSearch;
use app\models\SignupForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Jobs;
use app\models\Responses;

/**
 * ProjectsController implements the CRUD actions for Projects model.
 */
class ProjectsController extends Controller
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
     * Lists all Projects models.
     *
     * @return string
     */
    public function actionIndex()
    {

        return $this->redirect(['/jobs']); // or where you want to redirect?
   //     $searchModel = new ProjectsSearch();
   //     $dataProvider = $searchModel->search($this->request->queryParams);

   //     return $this->render('index', [
  //          'searchModel' => $searchModel,
   //         'dataProvider' => $dataProvider,
   //     ]);
    }

    /**
     * Displays a single Projects model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($url)
    {

        $temp = new Projects();
        $model = $temp::find()->where(['url' => $url])->one();


        if(!empty($model)){
            $id = $model->id;
            $category = Jobs::findOne($model->category_id);

            if(Yii::$app->user->isGuest){
                $responsesUserCount = 0;
            }else{
                $responsesUserCount = Responses::find()->where(['user_id' => Yii::$app->user->identity->id ,'project_id'=>$id])->one();
            }
            $responsesList = Responses::find()->select('responses.*,user.email as user_email, user.username as user_name')->leftJoin('user', 'responses.user_id = user.id')->where(['responses.project_id'=>$id])->asArray()->all();
            return $this->render(
                'view',
                compact('model', 'category','responsesUserCount', 'responsesList')
            );
        }else{
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Creates a new Projects model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Projects();

        if ($this->request->isPost) {
            $data = $this->request->post();
            $model->url = $this->translitstr($data['Projects']['title'], 'urltranslit');

            if ($model->load($this->request->post()) && $model->save(false)) {
                
                if(Yii::$app->user->isGuest){

                    $usermodel = new User();
                    $usermodel->email = $data['SignupForm']['email'];
                    $usermodel->password_hash = Yii::$app->security->generatePasswordHash($data['SignupForm']['password']);

                    $usermodel->generateAuthKey();
                    $usermodel->generateEmailVerificationToken();
                //    print_r($usermodel);exit;
                    $usermodel->save(false);
                   // $identity=new UserIdentity($usermodel->email,$data['Projects']['password']);
                    Yii::$app->user->login($usermodel->findByUsername($usermodel->email), 3600 * 24 * 30);
              
                }
                
                
                $model->url = $this->translitstr($data['Projects']['title'], 'urltranslit').'-'.$model->id;
                $model->created_by_id = Yii::$app->user->getId();
                $model->save(false);

                return $this->redirect(['view', 'url' => $model->url]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    public function translitstr($text, $tip) {
        $translit = array('а' => 'a',   'б' => 'b',   'в' => 'v', 'г' => 'g',   'д' => 'd',   'е' => 'e', 'ё' => 'yo',   'ж' => 'zh',  'з' => 'z', 'и' => 'i',   'й' => 'j',   'к' => 'k', 'л' => 'l',   'м' => 'm',   'н' => 'n', 'о' => 'o',   'п' => 'p',   'р' => 'r', 'с' => 's',   'т' => 't',   'у' => 'u', 'ф' => 'f',   'х' => 'x',   'ц' => 'c', 'ч' => 'ch',  'ш' => 'sh',  'щ' => 'shh', 'ь' => '\'',  'ы' => 'y',   'ъ' => '\'\'', 'э' => 'e\'', 'ю' => 'yu',  'я' => 'ya', 'А' => 'A',   'Б' => 'B',   'В' => 'V', 'Г' => 'G',   'Д' => 'D',   'Е' => 'E', 'Ё' => 'YO',   'Ж' => 'Zh',  'З' => 'Z', 'И' => 'I',   'Й' => 'J',   'К' => 'K', 'Л' => 'L',   'М' => 'M',   'Н' => 'N', 'О' => 'O',   'П' => 'P',   'Р' => 'R', 'С' => 'S',   'Т' => 'T',   'У' => 'U', 'Ф' => 'F',   'Х' => 'X',   'Ц' => 'C', 'Ч' => 'CH',  'Ш' => 'SH',  'Щ' => 'SHH', 'Ь' => '\'',  'Ы' => 'Y\'',   'Ъ' => '\'\'', 'Э' => 'E\'', 'Ю' => 'YU',  'Я' => 'YA',);
        if($tip == 'translit')    { $text = strtr($text, $translit); }
        if($tip == 'untranslit')  { $text = strtr($text, array_flip($translit)); }
        if($tip == 'urltranslit') {
        $text = strtr($text, $translit);
        $text = preg_replace('/[^\w\s]/u', '', $text);          //удаляем все знаки препинания
        $text = preg_replace('/(\s)+/', '-', $text);            //заменяем переводы строк и множественные пробелы на -
        $text = mb_strtolower($text, 'UTF-8'); }                //в нижний регистр
        return $text;
        }
    /**
     * Updates an existing Projects model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['profile/project', 'id' => $model->id]);
        }

        return $this->render('../profile/projects_view', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Projects model.
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
     * Finds the Projects model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Projects the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Projects::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    

    
}
