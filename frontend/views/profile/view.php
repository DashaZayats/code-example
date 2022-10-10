<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\components\ProfileMenuWidget;

$this->title = 'Мой профиль';
$this->params['breadcrumbs'][] = ['label' => 'Панель управления', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
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
                        <h4><i class="ti-wallet"></i>Мой профиль</h4>
                    </div>
                    <!--Browse Job -->							
                    <div class="row">
                        <div class="col-md-12">
                            <?= DetailView::widget([
                                'model' => $model,
                                'attributes' => [
                                    'description:ntext',
                                    'price_per_hour',
                                ],
                            ]) ?>
                            <p>
                                <?= Html::a('Изменить', ['update'], ['class' => 'btn btn-primary']) ?>
                            </p>
                        </div>
                    </div>
                    <!--/.Browse Job-->
                </div>
            </div>
        </div>
    </div>
</section>

<div class="clearfix"></div>
