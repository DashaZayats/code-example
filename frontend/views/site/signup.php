<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Регистрация в сервисе';
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
                 
                                <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                                <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
                                <?= $form->field($model, 'password')->passwordInput() ?>
                                <div class="form-group">
                                    <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                                </div>
                                <?php ActiveForm::end(); ?>
                 
                        <?php /*
                        <ul class="social-login">
                            <li class="facebook-login"><a href="#"><i class="fa fa-facebook"></i>Facebook</a></li>
                            <span>OR</span>
                            <li class="google-plus-login"><a href="#"><i class="fa fa-google-plus"></i>Facebook</a></li>
                        </ul> */?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
