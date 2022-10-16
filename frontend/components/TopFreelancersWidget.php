<?php
namespace frontend\components;

use yii\base\Widget;
use app\models\Projects;
use app\models\Profile;
use Yii;

/**
 * Виджет для вывода дерева разделов каталога товаров
 */
class TopFreelancersWidget extends Widget {

    /**
     * Выборка категорий каталога из базы данных
     */
    public $slug;
    public $currentJobId;
    protected $data;

    public function run() {
        // пробуем извлечь данные из кеша
        $html = Yii::$app->cache->get('top-freelancers');
   //     if ($html === false) {
            // данных нет в кеше, получаем их заново
            $temp = new Profile();

            $this->data = $temp->getTopFreelancers();

            if ( ! empty($this->data)) {
                $html = $this->render('topFreelancers', ['topFreelancers' => $this->data]);
            } else {
                $html = '';
            }
            // сохраняем полученные данные в кеше
            Yii::$app->cache->set('top-freelancers', $html, 60);
   //     }
        return $html;
    }
}