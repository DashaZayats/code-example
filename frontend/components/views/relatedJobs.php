<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<!-- Job Alert -->
<?php if(isset($relatedJobs[1])):?>
<section class="padd-top-20" style="margin-top:30px;padding:20px;">
    <div class="">
            <div class="row mrg-0">
                <div class="col-md-12 col-sm-12">
                    <h3><a href="<?= Url::toRoute(['jobs/view', 'slug' => $relatedJobs[0]['category_url']])?>">Другие заказы в категории «<?php echo $relatedJobs[0]['cattitle']?>»</a></h3>
                </div>
            </div>
            <!--Browse Job In Grid-->
            <div class="row mrg-0">
            <?php foreach($relatedJobs as $project):?>
                <?php if($project['id'] != $currentJobId):?>
                <div class="col-md-12 col-sm-12">
                    <div class="newjob-list-layout">
                            <div class="cll-wrap">
                                <div class="cll-caption">
                                    <h4><a href="<?= Url::to(['projects/view', 'url' => $project['url']]); ?>"><?php echo $project['title']?></a></h4>
                                    <?php
                                    $array = explode(" ", $project['description']);
                                    $wordCount = count($array);
                                    $array = array_slice($array, 0, 25);
                                    $newtext = implode(" ", $array);
                                    ?>
                                    <p><a style="color:#667488" href="<?= Url::to(['projects/view', 'url' => $project['url']]); ?>"><?php echo $newtext?><?php if($wordCount>25): echo '...'; endif;?></a></p>
                                    <ul>
                                        <li><i class="fa fa-tags" aria-hidden="true"></i><a href="<?= Url::toRoute(['jobs/view', 'slug' => $project['category_url']])?>"><?php echo $project['cattitle']?></a></li>
                                        <!--<li><a href="#">#Html</a></li>-->
                                    </ul>
                                </div>
                            </div>

                            <div class="cll-right">
                                <ul style="list-style: none;text-align: right;">
                                    <li class="price_block">
                                        <span class="service-response__price_success"><?= Html::encode($project['price']) ?> $</span>
                                    </li>
                                    <li><?php echo $project['responses']?> Заявки</li>
                                    <li><span class="date time_ago" data-timestamp="<?php echo strtotime($project['create_date']);?>"><?php echo $project['create_date'];?></span></li>
                                </ul>
                            </div>
                        <?php if($project['status']==0):?>
                        <span class="tg-themetag tg-featuretag tg-green_label">Прием заявок</span>
                        <?php elseif($project['status']==1):?>
                        <span class="tg-themetag tg-featuretag tg-blue_label">Исполнитель определен</span>
                        <?php elseif($project['status']==2):?>
                        <span class="tg-themetag tg-featuretag tg-grey_label">Завершен</span>
                        <?php endif;?>
                    </div>
                </div>
                <?php endif;?>
            <?php endforeach;?>


            </div>
            <!--/.Browse Job In Grid-->

    </div>
    </section>
<?php endif;?>