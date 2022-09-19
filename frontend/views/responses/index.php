<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ResponsesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Responses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="responses-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Responses', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'project_id',
            'user_id',
            'response:ntext',
            'price',
            //'status',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Responses $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
