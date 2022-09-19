<?php

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\components\ProfileMenuWidget;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\models\JobsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Панель управления';
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
                <div class="dashboard-body">
                    <div class="dashboard-caption">
                        <div class="dashboard-caption-wrap">

                            <!-- Overview -->
                            <div class="row">
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="dashboard-stat widget-1">
                                        <div class="dashboard-stat-content"><h4>35</h4> <span>Активных заявок</span></div>
                                        <div class="dashboard-stat-icon"><i class="ti-location-pin"></i></div>
                                    </div>	
                                </div>

                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="dashboard-stat widget-2">
                                        <div class="dashboard-stat-content"><h4>3</h4> <span>Приглашения к сотрудничеству</span></div>
                                        <div class="dashboard-stat-icon"><i class="ti-layers"></i></div>
                                    </div>	
                                </div>

                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="dashboard-stat widget-3">
                                        <div class="dashboard-stat-content"><h4>350</h4> <span>Просмотров профиля</span></div>
                                        <div class="dashboard-stat-icon"><i class="ti-pie-chart"></i></div>
                                    </div>	
                                </div>

                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="dashboard-stat widget-4">
                                        <div class="dashboard-stat-content"><h4>5</h4> <span>Активных проектов</span></div>
                                        <div class="dashboard-stat-icon"><i class="ti-bookmark"></i></div>
                                    </div>	
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<div class="clearfix"></div>


