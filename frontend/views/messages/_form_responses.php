<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Messages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="messages-form">

    <?php $form = ActiveForm::begin(['action' => Yii::$app->urlManager->createUrl(['/messages/createresponses'])]);?>

    <?= $form->field($model, 'project_id')->hiddenInput(['value'=>Yii::$app->request->get('id')])->label(false); ?>
    <?= $form->field($model, 'response_id')->hiddenInput(['value'=>$response['id']])->label(false); ?>

    <?= $form->field($model, 'from_user_id')->hiddenInput(['value'=>Yii::$app->user->identity->id])->label(false); ?>

    <?= $form->field($model, 'to_user_id')->hiddenInput(['value'=>$to_user_id])->label(false); ?>

    <?= $form->field($model, 'message')->textarea(['rows' => 6,'placeholder' => 'Ваше сообщение'])->label('Сообщение'); ?>

    <?= $form->field($model, 'status')->hiddenInput(['value'=>0])->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton('Отправить сообщение', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
