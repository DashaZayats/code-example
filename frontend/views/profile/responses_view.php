<?php
use yii\helpers\Url;
use yii\helpers\Html;
use frontend\components\ProfileMenuWidget;
use frontend\components\ProjectStageWidget;
use app\models\Responses;
use app\models\Messages;

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Projects */


$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Панель управления', 'url'=>Url::toRoute('/profile')];
$this->params['breadcrumbs'][] = ['label' => 'Приглашения на проекты', 'url'=>Url::toRoute('/profile/responses')];
$this->params['breadcrumbs'][] = $this->title;


\yii\web\YiiAsset::register($this);
?>
<section class="gray">
    <div class="container">
        <div class="row">
            <!-- Sidebar Start-->
            <div class="col-md-3 col-sm-12">
                <?= ProfileMenuWidget::widget(); ?>
            </div>
            <!-- End Sidebar -->
            <div class="col-md-9 col-sm-12">
                <div class="container-detail-box">
                    <?php if($model['status']==0):?>
                    <span class="tg-themetag tg-featuretag tg-green_label">Прием заявок</span>
                    <?php elseif($model['status']==1):?>
                    <span class="tg-themetag tg-featuretag tg-blue_label">Исполнитель определен</span>
                    <?php elseif($model['status']==2):?>
                    <span class="tg-themetag tg-featuretag tg-grey_label">Завершен</span>
                    <?php endif;?>
                    <div class="row">
                        <div class="col-md-8 col-sm-12">
                            <div class="apply-job-header">
                                <h2><?= Html::encode($model->title) ?>
                                    <sup>
                                        <?php if($model->worker_id>0):?>
                                            <span class="bg-trans-success cl-success" style='display:inline-block;float:right;'><i class="fa fa-check" aria-hidden="true"></i> Вас выбрали исполнителем</span>
                                        <?php else:?>
                                            <span class="bg-trans-warning cl-warning" style='display:inline-block;float:right;'><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                                Исполнитель не определен
                                            </span>
                                        <?php endif;?>
                                    </sup>
                                </h2>
                                <a href="<?= Url::toRoute(['jobs/view', 'slug' => $category->url])?>">
                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                    <?= Html::encode($category->title) ?>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <ul class="right_info_project">
                                <li class="price_block">
                                    <span class="service-response__price_success"><?= Html::encode($model->price) ?> $</span>
                                </li>
                                <li><?= Html::encode($model->responses) ?> заявок</li>
                                <li>
                                    <span class="date time_ago" data-timestamp="<?php echo strtotime($model->create_date);?>"><?php echo $model->create_date;?></span>
                                </li>
                                <?php 
                                /*
                                <li><?= Html::encode($model->views) ?> просмотров</li> 
                                 */
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="apply-job-detail">
                        <p><?php echo $model->description?></p>
                    </div>
                    <?php /*
                    <div class="apply-job-detail">
                            <h5>Skills</h5>
                            <ul class="skills">
                                    <li>Css3</li>
                                    <li>Html5</li>
                                    <li>Photoshop</li>
                                    <li>Wordpress</li>
                                    <li>PHP</li>
                                    <li>Java Script</li>
                            </ul>
                    </div>
                    */?>
                    <?php if (Yii::$app->user->isGuest) : ?>
                        <div class="right_block"><b>Авторизуйтесь, чтобы оставить заявку</b></div>
                    <?php else:?>
                 
                        <?php if(empty($responsesUserCount) && $model->created_by_id !=Yii::$app->user->id):?>
                            <div  class="right_block"><a href="javascript:void(0)" data-toggle="modal" data-target="#responses" class="btn btn-primary">Отправить заявку</a></div>
                        <?php else:?>
                            
                            
                        <?php endif;?>
                    <?php endif;?>
                </div>
                <?php if(!empty($responsesList)):?>
                    <div class="container-detail-box">
                        <div class="comments">
                            <h3>Ваша заявка

                            </h3>
                            <ul>
                                <?php foreach($responsesList as $response):?>
                                <?php if($model->worker_id==$response['user_id']):?>
                                    <li class="selected_worker">
                                        <div class="user_response_block">
                                            <div class="col-md-8">
                                                <?php if($response['imageFile']!=''):?>
                                                <div class="avatar"><img src="/img/<?php echo $response['imageFile']?>" alt=""></div>
                                                <?php else:?>
                                                    <div class="avatar"><img src="/img/avatar.png" alt=""></div>
                                                <?php endif;?>
                                                <div class="comment-content">
                                                    <div class="arrow-comment"></div>
                                                    <div class="comment-by col-md-8">
                                                        <?php echo $response['user_name']?><br>
                                                        <?php echo $response['user_email']?>
                                                        
                                                        <!-- user rating block-->
                                                        <div class="rateing">
                                                            <i class="fa fa-star filled"></i>
                                                            <i class="fa fa-star filled"></i>
                                                            <i class="fa fa-star filled"></i>
                                                            <i class="fa fa-star filled"></i>
                                                            <i class="fa fa-star filled"></i>
                                                        </div>
                                                        <!-- -end rating-->
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                            <?php if($model->worker_id==$response['user_id']):?>
                                                <div class="selected_worker_icon">
                                                    <i class="fa fa-check" aria-hidden="true"></i>
                                                </div>
                                            <?php else:?>
                                                <div class="right_block" style="margin-bottom:10px;">
                                                    <?php $form = ActiveForm::begin(['action' => Url::to(['projects/update/', 'id' => $model->id])]);?>
                                                    <?= $form->field($model, 'worker_id')->hiddenInput(['value'=>$response['user_id']])->label(false); ?>
                                                    <?= $form->field($model, 'status')->hiddenInput(['value'=>1])->label(false); ?>  
                                                    <?= Html::submitButton('Выбрать исполнителем', ['class' => 'btn btn-primary  btn-sm']) ?>
                                                    <?php ActiveForm::end(); ?> 
                                                </div>
                                            <?php endif;?>
                                                
                                                <!-- modal window to send messages-->
                                                <div class="right_block">
                                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#messages<?=$response['user_id']?>" class="btn btn-primary btn-sm">Написать сообщение</a>
                                                    <div class="modal fade in" id="messages<?=$response['user_id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="false" style="display: none">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    <?= $this->render('../messages/_form_responses', [
                                                                       'model' => new Messages,'response'=>$response,'to_user_id'=>$model->created_by_id,
                                                                   ]) ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end modal send messages-->

                                            </div>
                                        </div>
                                        <div class="">
                                                <div class="col-md-9">
                                                    <p><?php echo $response['response']?></p>
                                                    <span class="date time_ago" data-timestamp="<?php echo strtotime($response['create_date']);?>"><?php echo $response['create_date'];?></span>
                                                </div>
                                                <div class="reply col-md-3 right_block">
                                                    <div class="price_block">
                                                        <div class="service-response__price service-response__price_primary ng-binding"><?php echo $response['price']?>$</div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php if(!empty($response['messages'])):?>
                                        
                                        <div class="messages-block col-md-12">
                                            <div>
                                                <h4>Сообщения (<?php echo count($response['messages'])?>) <a href="#" style="display:inline-block;float:right;border-bottom: 1px dotted #272f46;font-size:14px;">Раскрыть сообщения</a></h4>
                                            </div>
                                         <?php foreach($response['messages'] as $message):?>   
                                            <div class="one-message-left"><?=$message['message']?></div>
                                            <?php endforeach;?>
                                        </div>
                                        <?php endif;?>
                                    </li>
                                    <?php endif;?>
                                <?php endforeach;?>
                             </ul>
                        </div>
                    </div>
                <?php endif;?>
                <?= ProjectStageWidget::widget(); ?>
            </div>

        </div>
    </div>
</section>



<!-- modal window for add responses -->
<?php if (!Yii::$app->user->isGuest) : ?>
    <div class="modal fade in" id="responses" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="false" style="display: none">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <?= $this->render('../responses/_form', [
                       'model' => new Responses, 'project_id' => $model->id,
                   ]) ?>
                </div>
            </div>
        </div>
    </div>
<?php endif;?>
