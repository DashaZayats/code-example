<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<!-- Job Alert) -->
<?php if(!empty($topFreelancers)):?>
<section class="testimonial" id="testimonial">
            <div class="container">
                <div class="row">
                    <div class="main-heading">
                        <h2>Тор лучших <span>Фрилансеров</span></h2></div>
                </div>
                <div class="row">
                    <div id="client-testimonial-slider" class="owl-carousel owl-theme">
                
                               <?php foreach($topFreelancers as $freelancer):?> 
                                <div class="owl-item">
                                    <div class="client-testimonial">
                                        <div class="pic">
                                            <?php if($freelancer['imageFile']!=''):?>
                                                <img src="/img/<?php echo $freelancer['imageFile']?>" id="profile-img" class="img-avater" alt="">
                                            <?php else:?>
                                                <img src="/img/avatar.png" id="profile-img" class="img-avater" alt="">
                                            <?php endif;?>
                                        </div>
                                        <?php
                                        $array = explode(" ", $freelancer['description']);
                                        $wordCount = count($array);
                                        $array = array_slice($array, 0, 10);
                                        $smallDescription = implode(" ", $array);
                                        ?>
                                        <p class="client-description"><?php echo $smallDescription?></p>
                                        <h3 class="client-testimonial-title"><?php echo $freelancer['username']?></h3>
                                        <h3 class="client-testimonial-title"><?php echo $freelancer['email']?></h3>
                                        <ul class="client-testimonial-rating">
                                            <li class="fa fa-star"></li>
                                            <li class="fa fa-star"></li>
                                            <li class="fa fa-star"></li>
                                            <li class="fa fa-star"></li>
                                            <li class="fa fa-star"></li>
                                        </ul>
                                    </div>
                                </div>
                            <?php endforeach;?>
                               <?php foreach($topFreelancers as $freelancer):?> 
                                <div class="owl-item">
                                    <div class="client-testimonial">
                                        <div class="pic">
                                            <?php if($freelancer['imageFile']!=''):?>
                                                <img src="/img/<?php echo $freelancer['imageFile']?>" id="profile-img" class="img-avater" alt="">
                                            <?php else:?>
                                                <img src="/img/avatar.png" id="profile-img" class="img-avater" alt="">
                                            <?php endif;?>
                                        </div>
                                        <p class="client-description"><?php echo $freelancer['description']?></p>
                                        <h3 class="client-testimonial-title"><?php echo $freelancer['username']?></h3>
                                        <h3 class="client-testimonial-title"><?php echo $freelancer['email']?></h3>
                                        <ul class="client-testimonial-rating">
                                            <li class="fa fa-star"></li>
                                            <li class="fa fa-star"></li>
                                            <li class="fa fa-star"></li>
                                            <li class="fa fa-star"></li>
                                            <li class="fa fa-star"></li>
                                        </ul>
                                    </div>
                                </div>
                                                            <?php endforeach;?>
                           
                        
                        
                        
                    </div>
                </div>
            </div>
        </section>
<?php endif;?>