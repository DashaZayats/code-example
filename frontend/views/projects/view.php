<?php
use yii\helpers\Url;
use yii\helpers\Html;
use frontend\components\LeftMenuWidget;
use frontend\components\ProjectStageWidget;
use app\models\Responses;

/* @var $this yii\web\View */
/* @var $model app\models\Projects */


if(!empty($category)){
    $this->title = $model->title;
    $this->params['breadcrumbs'][] = array('label'=> 'Работа', 'url'=>Url::toRoute('/jobs/'));
    $this->params['breadcrumbs'][] = array('label'=> $category->title, 'url'=>Url::toRoute(['jobs/view', 'slug' => $category->url]));
    $this->params['breadcrumbs'][] = array('label'=> $this->title);
}else{

    $this->title = $model->title;
    $this->params['breadcrumbs'][] = ['label' => 'Работа', 'url'=>Url::toRoute('/jobs')];
    $this->params['breadcrumbs'][] = $this->title;
}


$this->registerMetaTag(['name' => 'keywords', 'content' => 'HTML-верстка , Веб-программирование, Интернет-магазины , Сайты «под ключ» , Системы управления (CMS) , Тестирование сайтов , Дизайн сайтов, Администрирование сайтов , Контент-менеджер ,Продвижение сайтов (SEO) ']);
$this->registerMetaTag(['name' => 'description', 'content' => 'Фриланс заказы для web программистов, верстальщиков, дизайнеров, сеошников, тестировщиров, администраторов, контент менеджеров']);

\yii\web\YiiAsset::register($this);
?>
<section class="gray">
    <div class="container">
        <div class="row">
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
                                <h2><?= Html::encode($model->title) ?></h2>
                                <a href="<?= Url::toRoute(['jobs/view', 'slug' => $category->url])?>"><i class="fa fa-tags" aria-hidden="true"></i><?= Html::encode($category->title) ?></a>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <ul style="text-align:right;list-style:none;">
                                <li class="price_block">
                                    <span class="service-response__price_success"><?= Html::encode($model->price) ?> $</span>
                                </li>
                                <li><?= Html::encode($model->responses) ?> заявок</li>
                                <li><span class="date time_ago" data-timestamp="<?php echo strtotime($model->create_date);?>"><?php echo $model->create_date;?></span></li>
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
                        <div style="text-align:right;"><b>Авторизуйтесь, чтобы оставить заявку</b></div>
                    <?php else:?>
                 
                        <?php if(empty($responsesUserCount)):?>
                            <div style="text-align:right;"><a href="javascript:void(0)" data-toggle="modal" data-target="#responses" class="btn btn-primary">Отправить заявку</a></div>
                        <?php else:?>
                        <div style="text-align:right;"><b>Вы уже оставляли заявку. Детали смотрите в кабинете пользователя</b></div>

							
                        <?php endif;?>
                    <?php endif;?>
                </div>
                
                <?= ProjectStageWidget::widget(); ?>
            </div>

            <!-- Sidebar Start-->
            <div class="col-md-3 col-sm-12">
                <?= LeftMenuWidget::widget(); ?>
            </div>
            <!-- End Sidebar -->
        </div>
    </div>
</section>


<?php if (!Yii::$app->user->isGuest) : ?>
    <div class="modal fade in" id="responses" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="false" style="display: none">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <?= $this->render('../responses/_form', [
                       'model' => new Responses,
                   ]) ?>
                </div>
            </div>
        </div>
    </div>
<?php endif;?>