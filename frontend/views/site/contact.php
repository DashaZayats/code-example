<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var \frontend\models\ContactForm $model */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Контакты';
$this->params['breadcrumbs'][] = $this->title;

$this->registerMetaTag(['itemprop' => 'keywords', 'name' => 'keywords', 'content' => 'HTML-верстка , Веб-программирование, Интернет-магазины , Сайты «под ключ» , Системы управления (CMS) , Тестирование сайтов , Дизайн сайтов, Администрирование сайтов , Контент-менеджер ,Продвижение сайтов (SEO) ']);
$this->registerMetaTag(['itemprop' => 'description', 'name' => 'description', 'content' => 'Фриланс заказы для web программистов, верстальщиков, дизайнеров, сеошников, тестировщиров, администраторов, контент менеджеров']);

?>
<section class="gray">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="login-panel panel panel-default">
                    <div class="panel-body">
                        <div class="site-contact">


                                    <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                                        <div class="form-group">
                                            <p>
                                                Если у вас есть вопросы, пожалуйста, заполните следующую форму, чтобы связаться с нами. Спасибо.
                                            </p>
                                        </div>
                                        <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

                                        <?= $form->field($model, 'email') ?>

                                        <?= $form->field($model, 'subject') ?>

                                        <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

                                        <?= $form->field($model, 'reCaptcha')->widget(\himiklab\yii2\recaptcha\ReCaptcha::className()) ?>

                                        <div class="form-group">
                                            <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                                        </div>

                                    <?php ActiveForm::end(); ?>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
