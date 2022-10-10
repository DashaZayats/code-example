<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="side-dashboard">
    <div class="dashboard-avatar">
        <div class="dashboard-avatar-thumb">
            <?php if(Yii::$app->user->identity->imageFile!=''):?>
                <img src="/img/<?php echo Yii::$app->user->identity->imageFile?>" class="img-avater" alt="">
            <?php else:?>
                <img src="/img/avatar.png" class="img-avater" alt="">
            <?php endif;?>
        </div>
        <div class="dashboard-avatar-text">
            <h4><?php echo Yii::$app->user->identity->username?></h4>
            <span><?php echo Yii::$app->user->identity->email?></span>
        </div>
    </div>
    <div class="dashboard-menu">
        <ul>
            <li><a href="<?= Url::to(['profile/index']);?>"><i class="ti-dashboard"></i>Панель управления</a></li>
            <li class="block-title">Я фрилансер</li>
            <li><a href="<?= Url::to(['profile/view']); ?>"><i class="ti-wallet"></i>Мой профиль</a></li>
            <?php // <li><a href="#"><i class="ti-user"></i>Портфолио</a></li>?>
            <?php // <li><a href="#"><i class="ti-ticket"></i>Мои отклики к проектам</a></li>?>
            <li><a href="<?= Url::to(['profile/responses']);?>"><i class="ti-hand-point-right"></i>Приглашения на проекты</a></li>
            <li class="block-title">Я заказчик</li>
            <li><a href="<?= Url::to(['profile/projects']);?>"><i class="ti-heart"></i>Мои проекты</a></li>
            <?php // <li><a href="#"><i class="ti-id-badge"></i>Выбранные исполнители</a></li>?>

        </ul>
    </div>
</div>