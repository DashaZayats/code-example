<?php

namespace frontend\controllers;


use yii;
use app\models\Parser;
use app\models\ParserProduct;
use app\models\ParserProductSpecial;
use app\models\ParserProductToCategory;
use app\models\ParserProductToLayout;
use app\models\ParserProductToStore;
use app\models\ParserManufacturer;
use app\models\ParserProductAttribute;
use app\models\ParserProductDescription;
use app\models\ParserProductOption;
use app\models\ParserProductImage;
use app\models\ParserProductOptionValue;
use app\models\ParserOptionValueDescription;
use app\models\ParserOptionValue;
use app\models\ParserAttributeDescription;

use app\models\ParserMoto;
use app\models\ParserMotoProduct;
use app\models\ParserProductFilter;
use app\models\ParserCategoryFilter;
use app\models\ParserFilter;
use app\models\ParserFilterDescription;
use app\models\ParserFilterGroup;
use app\models\ParserFilterGroupDescription;

use app\models\ParserSeoUrl;

use frontend\models\UploadForm;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\HttpException;
use yii\helpers\Url;
use yii\httpclient\Client;

require_once('phpQuery.php');
/**
 * Site controller
 */
class AvitoController extends Controller
{

    public function actionIndex()
    {
$ourData = file_get_contents("cars.json");
$cars = json_decode($ourData);

        foreach($cars as $car){
        //    var_dump($car);
            echo $car->id;
            echo "</br>";
            
            echo $car->name;
            echo "</br>";
            
            $cyrillicname = 'cyrillic-name';
            echo $car->$cyrillicname;
            echo "</br>";
            echo $car->popular;
            echo "</br>";
            echo $car->country;
            echo "</br>";
            if($car->models){
                foreach($car->models as $model){
                    echo $model->name;
                    echo "</br>";
                    
                    $cyrillicname = 'cyrillic-name';
                    echo $model->$cyrillicname;
                    echo "</br>";
                }
            }
                        echo "</br>";            echo "</br>";            echo "</br>";
        }
    }
}
