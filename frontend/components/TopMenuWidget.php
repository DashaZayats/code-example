<?php
namespace frontend\components;

use yii\base\Widget;
use app\models\Jobs;
use Yii;

class TopMenuWidget extends Widget
{
    protected $data;
    public function run()
    {
        // пробуем извлечь данные из кеша
        $html = Yii::$app->cache->get('top-menu');
        if ($html === false) {
            // данных нет в кеше, получаем их заново
            $this->data = Jobs::find()->indexBy('id')->asArray()->all();
            if ( ! empty($this->data)) {
                $html = $this->render('topMenu', ['menu' => $this->data]);
            } else {
                $html = '';
            }
            // сохраняем полученные данные в кеше
            Yii::$app->cache->set('top-menu', $html, 60);
        }
        return $html;
    }
}