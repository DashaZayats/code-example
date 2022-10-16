<?php
namespace frontend\components;

use yii\base\Widget;
use app\models\Projects;
use app\models\Jobs;
use Yii;

/**
 * Виджет для вывода дерева разделов каталога товаров
 */
class RelatedJobsWidget extends Widget {

    /**
     * Выборка категорий каталога из базы данных
     */
    public $slug;
    public $currentJobId;
    protected $data;

    public function run() {
        // пробуем извлечь данные из кеша
        $html = Yii::$app->cache->get('related-jobs');
   //     if ($html === false) {
            // данных нет в кеше, получаем их заново
            $temp = new Jobs();
            $category = $temp::find()->where(['url' => $this->slug])->one();

            $projects = $temp->getRelatedJobs($category->id);
            $this->data = $projects;
            if ( ! empty($this->data)) {
                $html = $this->render('relatedJobs', ['relatedJobs' => $this->data, 'currentJobId' => $this->currentJobId]);
            } else {
                $html = '';
            }
            // сохраняем полученные данные в кеше
            Yii::$app->cache->set('related-jobs', $html, 60);
   //     }
        return $html;
    }
}