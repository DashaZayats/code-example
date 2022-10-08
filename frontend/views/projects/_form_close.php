<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Projects */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="projects-form">
    <?php $form = ActiveForm::begin(['action' => Url::to(['projects/update/', 'id' => $project_id])]);?>
    <p>Вы действительно хотите завершить проект?</p>
    <p><b><?php echo $project_title?></b></p>
    <?= $form->field($model, 'end_date')->hiddenInput(['value'=>date('Y-m-d H:i:s')])->label(false); ?>
    <?= $form->field($model, 'status')->hiddenInput(['value'=>2])->label(false); ?>
    
    <p>Оцените исполнителя</p>
    <div class="star-rating2">
      <div class="star-rating__wrap2">
        <input class="star-rating__input" id="star-rating-5" type="radio" name="rating" value="5">
        <label class="star-rating__ico fa fa-star-o fa-lg" filled for="star-rating-5" title="5 out of 5 stars"></label>
        <input class="star-rating__input" id="star-rating-4" type="radio" name="rating" value="4">
        <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-4" title="4 out of 5 stars"></label>
        <input class="star-rating__input" id="star-rating-3" type="radio" name="rating" value="3">
        <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-3" title="3 out of 5 stars"></label>
        <input class="star-rating__input" id="star-rating-2" type="radio" name="rating" value="2">
        <label class="star-rating__ico fa fa-star fa-lg" for="star-rating-2" title="2 out of 5 stars"></label>
        <input class="star-rating__input" id="star-rating-1" type="radio" name="rating" value="1">
        <label class="star-rating__ico fa fa-star fa-lg" for="star-rating-1" title="1 out of 5 stars"></label>
      </div>
    </div>
<style>
    .star-rating2 label {
  color: #d4d5dc;
}
.star-rating2{
	font-size: 0;
}
.star-rating__wrap2{
	display: inline-block;
	font-size: 1rem;
}
.star-rating__wrap2:after{
	content: "";
	display: table;
	clear: both;
}
.star-rating__ico{
	float: right;
	padding-left: 2px;
	cursor: pointer;
	color: #FFB300;
}
.star-rating__ico:last-child{
	padding-left: 0;
}
.star-rating__input{
	display: none;
}
.star-rating__ico:hover:before,
.star-rating__ico:hover ~ .star-rating__ico:before,
.star-rating__input:checked ~ .star-rating__ico:before
{
	
        color:#ff9b20;
}
    </style>
    

    <div class="form-group">
        <?= Html::submitButton('Завершить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


