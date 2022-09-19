<?php
namespace frontend\components;
 
use frontend\models\Sef;
use yii\web\UrlRuleInterface;
use yii\base\Object;
 
class SefRule extends Object implements UrlRuleInterface{
 
    public $connectionID = 'db';
    public $name;
 
    public function init(){
        if ($this->name === null) {
            $this->name = __CLASS__;
        }
    }
 
    //Формирует ссылки в заданном виде (часть формируется в коде, остальное берется из БД)
    public function createUrl($manager, $route, $params){
        //debug($route);
        //Определяем контроллеры, у которых к страницам нужно добавлять .html
        $controller = explode('/',$route)[0]; //Получаем контроллер        
        if ($route == 'post/view' || $controller == 'site') $html = '.html';
        else $html = '';
 
        //Если передаются параметры (напрмиер ?id=3&page=2) сохраняем в $link по-очереди
        $link ='';
        $page ='';
        if(count($params)){
            $link = "?";
            $page = false;
            foreach ($params as $key => $value){
                if($key == 'page'){
                    $page = $value;
                    continue;
                }
                $link .= "$key=$value&";
            }
            $link = substr($link, 0, -1); //удаляем последний символ (&)
        }
        //Из БД получаем строку со ссылкой на которую нужно будет поменять
         $sef = Sef::find()->where(['link' => $route.$link])->one();
 
        if ($sef){
            //Если есть - добавляем пагинацию в конец (?page=2)
            if ($page) return $sef->link_sef."$html?page=$page";
            else return $sef->link_sef.$html;
        }
        return false;
    }
 
    //Разбирает входящий URL запрос, преобразует ссылки произвольного вида (из БД поле link_sef) в нужный для Yii2
    public function parseRequest($manager, $request){        
 
        //Получаем URL
        $pathInfo = $request->getPathInfo();    
 
        //Получаем 1 часть, до слэша, если есть
        $alias = explode('/',$pathInfo)[0];
        //Если на конце .html, то убираем для поиска в БД
        $alias_small = str_replace(".html","",$alias);
 
        //не выводить .html для указанных URL (первая часть алиаса)
        $not_html = [
            'category','tag','posts','notes'
        ];
 
        /*
         * Проверяем наличие URL (до слэша) в $not_html
         * Если есть, то в URL не должно быть окончание .html
         * $exception = true разрешает поиск URL в БД
         */
        $exception = false;
        if(array_search($alias_small, $not_html) !== FALSE){            
            if (preg_match("/^(.*)\.html$/",$pathInfo)) return false;
            $exception = true;
        }     
 
        //Будем искать в БД если ссылка содержит .html или есть в $not_html
        if(preg_match('/^(.*)\.html$/', $pathInfo, $matches) || $exception){    
 
            $pathInfo = isset($matches[1]) ? $matches[1] : $pathInfo;
 
            //получаем из БД данные по строке содержащей заданный алиас
            $sef  = Sef::find()->where(['link_sef' => $pathInfo])->one();
 
            if($sef){
                //Разбивает строку типа post/view?id=5 на массив по разделителю
                $link_data = explode('?',$sef->link);
                //берем только первую часть без параметров (контроллер/действие)
                $route = $link_data[0]; 
                $params = array();
                //если есть параметры - вставляем их 
                if(isset($link_data[1])){
                    $temp = explode('&',$link_data[1]);
                    foreach($temp as $t){
                        $t = explode('=', $t);
                        $params[$t[0]] = $t[1];
                    }
                }
                //$route - контроллер/действие
                //$params - параметры
                return [$route, $params];
            }
        }
        return false;
    }
}