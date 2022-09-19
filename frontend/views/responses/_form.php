<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Responses */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="responses-form">

    <?php $form = ActiveForm::begin(['action' => Yii::$app->urlManager->createUrl(['/responses/create'])]);?>

    <?= $form->field($model, 'project_id')->hiddenInput(['value'=>Yii::$app->request->get('id')])->label(false); ?>

    <?= $form->field($model, 'user_id')->hiddenInput(['value'=>Yii::$app->user->identity->id])->label(false); ?>

    <?= $form->field($model, 'response')->textarea(['rows' => 6,'placeholder' => 'Расскажите заказчику о ваших навыках, возможности приступить к работе, способе выполнения задания...'])->label('Ваш отклик'); ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true,'placeholder' => 'Сумма в USD'])->label('Укажите стоимость выполнения работы, $'); ?>

    <?= $form->field($model, 'status')->hiddenInput(['value'=>0])->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton('Отправить заявку', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
