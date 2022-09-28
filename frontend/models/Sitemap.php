<?php
namespace app\models;
 
use Yii;
use yii\base\Model;
use app\models\Jobs;
use app\models\Projects;
 
class Sitemap extends Model{
 
    public function getUrl(){
 
        $urls = array();

        //Категории
        $url_posts = Jobs::find()
                ->select('url')
                ->all();
        //Формируем двумерный массив. createUrl преобразует ссылки в правильный вид. 
        //Добавляем элемент массива 'daily' для указания периода обновления контента 
        foreach ($url_posts as $url_post){
            $urls[] = array('/jobs' . Yii::$app->urlManager->createUrl([$url_post->url]),'daily');
        }

        //Проекты
        $url_cats = Projects::find()
                ->select('url')
                ->all();
        foreach ($url_cats as $url_cat){
            $urls[] = array('/projects' . Yii::$app->urlManager->createUrl([$url_cat->url]),'daily');
        }


        //Статичные страницы (у каждой свое действие контроллера)
        $arr_stat_page = [
            'about', 'jobs', 'contact',
        ];
        foreach ($arr_stat_page as $url_stat){
            $urls[] = array(Yii::$app->urlManager->createUrl($url_stat),'daily');
        }

        return $urls;
    } 
}