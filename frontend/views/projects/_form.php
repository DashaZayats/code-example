<?php

use yii\helpers\Html;
use mihaildev\ckeditor\CKEditor;
use yii\widgets\ActiveForm;
use app\models\Jobs;
use \frontend\models\SignupForm;

/* @var $this yii\web\View */
/* @var $model app\models\Projects */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="projects-form">

    <?php $form = ActiveForm::begin(); ?>

    

    <?= $form->field($model, 'title')->textInput(['maxlength' => true,'placeholder' => 'Что нужно сделать'])->label('Название проекта'); ?>


    <?= $form->field($model, 'description')->widget(CKEditor::className(),[
        'editorOptions' => [
            'preset' => 'basic', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false, //по умолчанию false
        ],
    ])->textarea(['rows' => 6,'placeholder' => 'Подробно опишите вашу задачу'])->label('Описание (Подробно опишите вашу задачу)'); ?>
  
    
    <?= $form->field($model, 'price')->textInput(['maxlength' => true,'placeholder' => 'Сумма в USD'])->label('Бюджет, $'); ?>
    
    <?= $form->field($model, 'category_id')->dropDownList(Jobs::getTree())->label('Категория'); ?>

    <?= $form->field($model, 'create_date')->hiddenInput(['value'=>date('Y-m-d H:i:s')])->label(false); ?>

    <?= $form->field($model, 'end_date')->hiddenInput(['value'=>date('Y-m-d H:i:s')])->label(false); ?>

    <?= $form->field($model, 'responses')->hiddenInput(['value'=>0])->label(false); ?>

    <?= $form->field($model, 'views')->hiddenInput(['value'=>0])->label(false); ?>

    <?= $form->field($model, 'worker_id')->hiddenInput(['value'=>0])->label(false); ?>

    <?= $form->field($model, 'status')->hiddenInput(['value'=>0])->label(false); ?>
    <?php if (Yii::$app->user->isGuest) : ?>
        <?php $usermodel = new SignupForm;?>
        <?= $form->field($usermodel, 'email')->textInput(['maxlength' => true,'placeholder' => 'Email для регистрации в сервисе'])->label('Ваш Email'); ?>
        <?= $form->field($usermodel, 'password')->passwordInput(); ?>
        <?= $form->field($model, 'reCaptcha')->widget(\himiklab\yii2\recaptcha\ReCaptcha::className()) ?>
    <?php else:?>
        <?= $form->field($model, 'created_by_id')->hiddenInput(['value'=>Yii::$app->user->identity->id])->label(false); ?>
    <?php endif;?>
    

    <div class="form-group">
        <?= Html::submitButton('Разместить заказ', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


