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
             url: '/upload',
             contentType: false,
             processData: false,
             data: formData,

             success: function(res){
                    console.log(res);
                    $('#profile-imagefile').val('');
                    $("#profile-img").attr('src','/img/'+res);
                },
                error: function(){
                    alert('Error!');
                }
            });
    });
});
</script>
<div class="profile-form">
    <div class="dashboard-avatar">
        <div class="dashboard-avatar-thumb">
            <?php if($model['imageFile']!=''):?>
            <img src="/img/<?php echo $model['imageFile']?>" id="profile-img" class="img-avater" alt="">
            <?php else:?>
            <img src="/img/avatar.png" id="profile-img" class="img-avater" alt="">
            <?php endif;?>
        </div>
        <form id="imageForm" action="/update" method="post" enctype="multipart/form-data">
            <div class="form-group field-profile-imagefile">
                <label class="control-label" for="profile-imagefile">Фото</label>
                <input type="hidden" name="Profile[imageFile]" value="">
                <input type="file" id="profile-imagefile" name="Profile[imageFile]" value="">

                <div class="help-block"></div>
            </div>
        </form>
    </div>
<?php $form = ActiveForm::begin() ?>
    <?= $form->field($model, 'username')->textInput(['maxlength' => true])->label('Имя (псевдоним)'); ?>
    <?= $form->field($model, 'description')->textarea(['rows' => 6])->label('Обо мне'); ?>
    <?= $form->field($model, 'price_per_hour')->textInput(['maxlength' => true])->label('Стоимость работы в час, $'); ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
