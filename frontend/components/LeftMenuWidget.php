<?php
namespace frontend\components;

use yii\base\Widget;
use app\models\Jobs;
use Yii;

/**
 * Виджет для вывода дерева разделов каталога товаров
 */
class LeftMenuWidget extends Widget {

    /**
     * Выборка категорий каталога из базы данных
     */
    protected $data;

    public function run() {
        // пробуем извлечь данные из кеша
        $html = Yii::$app->cache->get('left-menu');
        if ($html === false) {
            // данных нет в кеше, получаем их заново
            $this->data = Jobs::find()->indexBy('id')->asArray()->all();
            if ( ! empty($this->data)) {
                $html = $this->render('leftMenu', ['leftMenu' => $this->data]);
            } else {
                $html = '';
            }
            // сохраняем полученные данные в кеше
            Yii::$app->cache->set('left-menu', $html, 60);
        }
        return $html;
    }
}