<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Profile */
/* @var $form yii\widgets\ActiveForm */
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $(document).on('change','#profile-imagefile',function(e){
        var formData = new FormData($('#imageForm')[0]);
        $.ajax({
             type: 'POST',
             url: '/index.php?r=site%2Fupload',
             contentType: false,
             processData: false,
             data: formData,

             success: function(res){
                    console.log(res);
                 //   $('#profile-imagefile').val('');
                },
                error: function(){
                    alert('Error!');
                }
            });
    });
});
</script>
<div class="profile-form">
<form id="imageForm" action="/index.php?r=profile%2Fupdate&amp;id=2" method="post" enctype="multipart/form-data">

<div class="form-group field-profile-imagefile">
<label class="control-label" for="profile-imagefile">Photo</label>
<input type="hidden" name="Profile[imageFile]" value="">
<input type="file" id="profile-imagefile" name="Profile[imageFile]" value="">

<div class="help-block"></div>
</div>
</form>
<?php $form = ActiveForm::begin() ?>


    <?= $form->field($model, 'user_id')->hiddenInput(['value'=>Yii::$app->user->identity->id])->label(false); ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6])->label('Обо мне'); ?>



    <?= $form->field($model, 'type')->dropDownList([ 'freelancer' => 'Фрилансер', 'employer' => 'Заказчик', ], ['prompt' => ''])->label('Тип'); ?>

    <?= $form->field($model, 'price_per_hour')->textInput(['maxlength' => true])->label('Стоимость работы в час'); ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
