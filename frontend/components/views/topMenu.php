<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<?php if(!empty($menu)):?>
<ul class="dropdown-menu megamenu-content animated" role="menu">
    <li>
        <div class="row">
            <div class="col-menu col-md-4">
                <div class="content">
                    <ul class="menu-col">
                       <?php for ($i = 1; $i <= 5; $i++):?>
                        <li>
                            <a href="<?= Url::to(['jobs/view', 'slug' => $menu[$i]['url']]); ?>">
                                <?= Html::encode($menu[$i]['title']); ?>
                            </a>
                        </li>
                        <?php endfor;?>
                    </ul>
                </div>
            </div><!-- end col-3 -->
            <div class="col-menu col-md-4">
                <div class="content">
                    <ul class="menu-col">
                        <?php for ($i = 6; $i <= 10; $i++):?>
                        <li>
                            <a href="<?= Url::to(['jobs/view', 'slug' => $menu[$i]['url']]); ?>">
                                <?= Html::encode($menu[$i]['title']); ?>
                            </a>
                        </li>
                        <?php endfor;?>
                    </ul>
                </div>
            </div><!-- end col-3 -->  
            <div class="col-menu col-md-4">
                <div class="content">
                    <h6 class="title see-all-menu-link"><a class="btn btn-primary" href="<?= Url::to(['jobs/index']); ?>">Смотреть все</a></h6>
                </div>
            </div><!-- end col-3 -->  
        </div><!-- end row -->
    </li>
</ul>
<?php endif;?>