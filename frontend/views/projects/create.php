<?php

use yii\helpers\Html;
use frontend\components\LeftMenuWidget;

/* @var $this yii\web\View */
/* @var $model app\models\Projects */

$this->title = 'Создание проекта';
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="gray">
    <div class="container">
            <div class="row">
            <div class="col-md-9 col-sm-12">
                <div class="container-detail-box">
                    <h1><?= Html::encode($this->title) ?></h1>
                    <?= $this->render('_form', [
                       'model' => $model,
                   ]) ?>
               </div>
            </div>

            <!-- Sidebar Start-->
            <div class="col-md-3 col-sm-12">
                    <?= LeftMenuWidget::widget(); ?>
                    <!-- Job Detail -->
            </div>
            <!-- End Sidebar -->
            </div>
    </div>
</section>

