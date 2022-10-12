<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Rating;


/* @var $this yii\web\View */
/* @var $model app\models\Projects */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="projects-form">
    <?php $form = ActiveForm::begin(['action' => Url::to(['projects/updateresponses/', 'id' => $project_id])]);?>
    <h3 class="text-center">Вы действительно хотите отказаться от проекта?</h3>
    <p><b>
        <i class="fa fa-quote-left" aria-hidden="true"></i>
            <?php echo $project_title?>
        <i class="fa fa-quote-right" aria-hidden="true"></i>
        </b></p>

    <?= $form->field($model, 'worker_id')->hiddenInput(['value'=>0])->label(false); ?>
    
    <?php if($user_id>0 && isset($user_id)):?>
        <?php $rating = new Rating;?>
        <h3 class="text-center">Оцените работодателя</h3>
        <?= $form->field($rating, 'user_id')->hiddenInput(['value'=>$user_id])->label(false); ?>
        <?= $form->field($rating, 'from_user_id')->hiddenInput(['value'=>$from_user_id])->label(false); ?>
        <div class="col-md-12">
            <?php if($worker_imageFile!=''):?>
                <div class="avatar"><img src="/img/<?php echo $worker_imageFile?>" alt=""></div>
            <?php else:?>
                <div class="avatar"><img src="/img/avatar.png" alt=""></div>
            <?php endif;?>
            <div class="comment-content">
                <div class="comment-by col-md-8">
                    <?php echo $worker_username?><br>
                    <?php echo $worker_email?><br>
                    <!-- user rating block-->
                    <div class="rateing">
                        <div class="star-rating2">
                          <div class="star-rating__wrap2">
                            <input class="star-rating__input" id="star-rating-5" type="radio" name="Rating[rating]" value="5">
                            <label class="star-rating__ico fa fa-star fa-lg" for="star-rating-5" title="5 out of 5 stars"></label>

                            <input class="star-rating__input" id="star-rating-4" type="radio" name="Rating[rating]" value="4">
                            <label class="star-rating__ico fa fa-star fa-lg" for="star-rating-4" title="4 out of 5 stars"></label>

                            <input class="star-rating__input" id="star-rating-3" type="radio" name="Rating[rating]" value="3">
                            <label class="star-rating__ico fa fa-star fa-lg" for="star-rating-3" title="3 out of 5 stars"></label>

                            <input class="star-rating__input" id="star-rating-2" type="radio" name="Rating[rating]" value="2">
                            <label class="star-rating__ico fa fa-star fa-lg" for="star-rating-2" title="2 out of 5 stars"></label>

                            <input class="star-rating__input" id="star-rating-1" type="radio" name="Rating[rating]" value="1">
                            <label class="star-rating__ico fa fa-star fa-lg" for="star-rating-1" title="1 out of 5 stars"></label>
                          </div>
                        </div>
                    </div>
                    <!-- -end rating-->
                </div>

            </div>
        </div>
    <?php endif;?>

    

    <div class="form-group" style="text-align: right;">
        <?= Html::submitButton('Отказаться', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


