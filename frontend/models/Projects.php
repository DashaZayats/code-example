<?php

namespace app\models;
use yii\data\Pagination;

use Yii;

/**
 * This is the model class for table "projects".
 *
 * @property int $id
 * @property int $category_id
 * @property string $title
 * @property string $description
 * @property string $create_date
 * @property string $end_date
 * @property float $price
 * @property int $responses
 * @property int $views
 * @property int $created_by_id
 * @property int $worker_id
 * @property int $status
 */
class Projects extends \yii\db\ActiveRecord
{
    
    const STATUS_PRIEM_ZAJVOK = 0;
    const STATUS_VIBOR_ISPOLNITELA = 1;
    const STATUS_VIBOR_VIPOLNENIE = 2;
    const STATUS_CLOSE = 3;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projects';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        if (Yii::$app->user->isGuest) {
            return [
                [['category_id', 'responses', 'views', 'created_by_id', 'worker_id', 'status'], 'integer'],
                [['title', 'description', 'create_date', 'end_date', 'price', 'created_by_id', 'worker_id'], 'required'],
                [['description'], 'string'],
                [['create_date', 'end_date'], 'safe'],
                [['price'], 'number'],
                [['title'], 'string', 'max' => 250],
                // verifyCode needs to be entered correctly
                ['reCaptcha', 'required'],
                ['reCaptcha', \himiklab\yii2\recaptcha\ReCaptchaValidator::className(), 'secret' => '6LdCaSEiAAAAAOBnTYdhuUyKPAxfmP5zBBxWe-Lh']
            ];
        }else{
            return [
                [['category_id', 'responses', 'views', 'created_by_id', 'worker_id', 'status'], 'integer'],
                [['title', 'description', 'create_date', 'end_date', 'price', 'created_by_id', 'worker_id'], 'required'],
                [['description'], 'string'],
                [['create_date', 'end_date'], 'safe'],
                [['price'], 'number'],
                [['title'], 'string', 'max' => 250],
             ];
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'title' => 'Title',
            'description' => 'Description',
            'create_date' => 'Create Date',
            'end_date' => 'End Date',
            'price' => 'Price',
            'responses' => 'Responses',
            'views' => 'Views',
            'created_by_id' => 'Created By ID',
            'worker_id' => 'Worker ID',
            'status' => 'Status',
        ];
    }
    
    /**
     * Метод описывает связь таблицы БД `category` с таблицей `product`
     */
    public function getProducts() {
        return $this->hasMany(Projects::class, ['category_id' => 'id']);
    }
    /**
     * Возвращает массив всех товаров бренда с идентификатором $id
     */
    public function getUserProjects() {
        $id = Yii::$app->user->identity->id;
        // для постаничной навигации получаем только часть товаров
        $query = Projects::find()->select('projects.*,jobs.title as cattitle,jobs.url as category_url')
                ->leftJoin('jobs', 'projects.category_id = jobs.id')
                ->where(['projects.worker_id' => $id]);
        $pages = new Pagination([
            'totalCount' => $query->count(),
            // количество товаров на странице теперь в настройках
            'pageSize' => 5,
            'forcePageParam' => false,
            'pageSizeParam' => false
        ]);
        $projects = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->asArray()
            ->all();
        return [$projects, $pages];
    }
    
    public function getProfileProjects() {
        $id = Yii::$app->user->identity->id;
        // для постаничной навигации получаем только часть товаров
        $query = Projects::find()->select('projects.*,jobs.title as cattitle,'
                                        . 'jobs.url as category_url,'
                                        . 'user.email as worker_email,'
                                        . 'user.imageFile as worker_imageFile')
                ->leftJoin('jobs', 'projects.category_id = jobs.id')
                ->leftJoin('user', 'projects.worker_id = user.id')
                ->where(['projects.created_by_id' => $id])
                ->orderBy(['projects.create_date' => SORT_DESC]);
        $pages = new Pagination([
            'totalCount' => $query->count(),
            // количество товаров на странице теперь в настройках
            'pageSize' => 5,
            'forcePageParam' => false,
            'pageSizeParam' => false
        ]);
        $projects = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->asArray()
            ->all();
        return [$projects, $pages];
    }
  /* ... */

    /**
     * Результаты поиска по каталогу товаров
     */
    public function getSearchResult($search, $page) {

        $search = $this->cleanSearchString($search);

        if (empty($search)) {
            return [null, null];
        }

        $words = explode(' ', $search);

        $query = self::find()->select('projects.*,jobs.title as cattitle,jobs.url as category_url')
            ->leftJoin('jobs', 'projects.category_id = jobs.id');
            $query->where(['like', 'projects.title', $words[0]]);
            $query->orWhere(['like', 'projects.description',$words[0]]);
            $query->orWhere(['like', 'jobs.title',$words[0]]);
            
        // разбиваем поисковый запрос на отдельные слова
       for ($i = 1; $i < count($words); $i++) {
            $query->orWhere(['like', 'projects.title',$words[$i]]);
            $query->orWhere(['like', 'projects.description',$words[$i]]);
            $query->orWhere(['like', 'jobs.title',$words[$i]]);
        }
        
        $query->orderBy(['projects.create_date' => SORT_DESC]);
        // постраничная навигация
        $pages = new Pagination([
            'totalCount' => $query->count(),
            'pageSize' =>5,
            'forcePageParam' => false,
            'pageSizeParam' => false
        ]);
        $products = $query
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->asArray()
            ->all();
    //  $sqlText = $query->createCommand()->getRawSql();
   //   print_r($sqlText);
  
        $data = [$products, $pages];

        return $data;
    }

    /**
     * Вспомогательная функция, очищает строку поискового запроса с сайта
     * от всякого мусора
     */
    protected function cleanSearchString($search) {
        $search = iconv_substr($search, 0, 64);
        // удаляем все, кроме букв и цифр
        $search = preg_replace('#[^0-9a-zA-ZА-Яа-яёЁ]#u', ' ', $search);
        // сжимаем двойные пробелы
        $search = preg_replace('#\s+#u', ' ', $search);
        $search = trim($search);
        return $search;
    }
}
