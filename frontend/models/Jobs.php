<?php

namespace app\models;

use Yii;
use app\models\Projects;
use yii\data\Pagination;
use yii\db\Expression;

/**
 * This is the model class for table "jobs".
 *
 * @property int $id
 * @property int $parent_id
 * @property string $title
 * @property string $description
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_tags
 * @property int $pos
 * @property int $status
 */
class Jobs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jobs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'pos', 'status'], 'integer'],
            [['title', 'description', 'meta_title', 'meta_description', 'meta_tags'], 'required'],
            [['description', 'meta_description', 'meta_tags'], 'string'],
            [['title'], 'string', 'max' => 250],
            [['meta_title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'title' => 'Title',
            'description' => 'Description',
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
            'meta_tags' => 'Meta Tags',
            'pos' => 'Pos',
            'status' => 'Status',
            'jobs.title' => 'CatTitle',
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
    public function getCatProjects($id) {
        $id = (int)$id;
        // для постаничной навигации получаем только часть товаров
        $query = Projects::find()
                ->select('projects.*,jobs.title as cattitle,jobs.url as category_url')
                ->leftJoin('jobs', 'projects.category_id = jobs.id')
                ->where(['category_id' => $id])
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
    public function getRelatedJobs($id){
        $id = (int)$id;
        // для постаничной навигации получаем только часть товаров
        $projects = Projects::find()
                ->select('projects.*,jobs.title as cattitle,jobs.url as category_url')
                ->leftJoin('jobs', 'projects.category_id = jobs.id')
                ->where(['category_id' => $id])
                ->orderBy(new Expression('rand()'))
                ->limit(5)
                ->asArray()
                ->all();


        return $projects;
    }

    public function getProjects(){
       
        // для постаничной навигации получаем только часть товаров
        $query = Projects::find()
                ->select('projects.*,jobs.title as cattitle,jobs.url as category_url')
                ->leftJoin('jobs', 'projects.category_id = jobs.id')
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
    
    /*
     * Метод возвращает информацию о категории с идентификатором $id
     */
    public function getCategory($id) {
        return self::findOne($id);
    }
    
    /*...*/

    /**
     * Возвращает массив всех категорий каталога в виде дерева
     */
    public static function getAllJobs($parent = 0, $level = 0, $exclude = 0) {
        $children = self::find()
            ->where(['parent_id' => $parent])
            ->asArray()
            ->all();
        $result = [];
        foreach ($children as $category) {
            // при выборе родителя категории нельзя допустить
            // чтобы она размещалась внутри самой себя
            if ($category['id'] == $exclude) {
                continue;
            }
            if ($level) {
                $category['title'] = str_repeat('— ', $level) . $category['title'];
            }
            $result[] = $category;
            $result = array_merge(
                $result,
                self::getAllJobs($category['id'], $level+1, $exclude)
            );
        }
        return $result;
    }

    /**
     * Возвращает массив всех категорий каталога для возможности
     * выбора родителя при добавлении или редактировании товара
     * или категории
     */
    public static function getTree($exclude = 0, $root = false) {
        $data = self::getAllJobs(0, 0, $exclude);
        $tree = [];
        // при выборе родителя категории можно выбрать значение «Без родителя»,
        // т.е. создать категорию верхнего уровня, у которой не будет родителя
        if ($root) {
            $tree[0] = 'Без родителя';
        }
        foreach ($data as $item) {
            $tree[$item['id']] = $item['title'];
        }
        return $tree;
    }
}
