<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<!-- Job Alert -->


<a href="<?= Url::to(['projects/create']); ?>" class="rainbow-button" alt="Разместить заказ"></a><br>
<!-- /Job Alert -->

<div class="show-hide-sidebar">
    <div class="sidebar-widgets">
        <div class="ur-detail-wrap">
            <div class="ur-detail-wrap-header">
                <h4><a href="<?= Url::to(['/jobs/index']); ?>">Все заказы</a></h4>
            </div>
            <div class="ur-detail-wrap-body">
                <ul class="advance-list">
                    <?php foreach ($leftMenu as $item): ?>
                        <li>
                            <a href="<?= Url::to(['jobs/view', 'slug' => $item['url']]); ?>">
                                <?= Html::encode($item['title']); ?>
                            </a>
                            <!--<span class="pull-right">102</span>-->
                        </li>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>
    </div>
</div>