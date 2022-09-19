<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var \frontend\models\PasswordResetRequestForm $model */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Запрос сброса пароля';
$this->params['breadcrumbs'][] = $this->title;

$this->registerMetaTag(['name' => 'keywords', 'content' => 'HTML-верстка , Веб-программирование, Интернет-магазины , Сайты «под ключ» , Системы управления (CMS) , Тестирование сайтов , Дизайн сайтов, Администрирование сайтов , Контент-менеджер ,Продвижение сайтов (SEO) ']);
$this->registerMetaTag(['name' => 'description', 'content' => 'Фриланс заказы для web программистов, верстальщиков, дизайнеров, сеошников, тестировщиров, администраторов, контент менеджеров']);

?>
<section class="gray">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="login-panel panel panel-default">
                    <div class="panel-body">
                        <img src="/logo.png" class="img-responsive">
                            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
                            <div class="form-group">
                                <p>Пожалуйста, заполните адрес электронной почты.<br> Вам будет отправлена ​​ссылка для сброса пароля.</p>
                            </div>
                             <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                             <div class="form-group">
                                 <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
                             </div>

                         <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>