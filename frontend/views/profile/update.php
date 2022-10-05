<?php

use yii\helpers\Html;
use frontend\components\ProfileMenuWidget;

/* @var $this yii\web\View */
/* @var $model app\models\Profile */

$this->title = 'Редактирование профиля';
$this->params['breadcrumbs'][] = ['label' => 'Панель управления', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Мой профиль', 'url' => ['view']];
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="gray">
    <div class="container">
        <div class="row">

            <!-- Sidebar Wrap -->
            <div class="col-lg-3 col-md-4">
                <?= ProfileMenuWidget::widget(); ?>
            </div>

            <!-- Content Wrap -->
            <div class="col-lg-9 col-md-8">
                <div class="container-detail-box">
                    <div class="dashboard-caption-header">
                        <h4><i class="ti-wallet"></i><?= Html::encode($this->title) ?></h4>
                    </div>
                    <!--Browse Job -->							
                    <div class="row">
                        <div class="col-md-12">
                            <?= $this->render('_form', [
                                'model' => $model,
                            ]) ?>
                        </div>
                    </div>
                    <!--/.Browse Job-->
                </div>
            </div>
        </div>
    </div>
</section>

<div class="clearfix"></div>
