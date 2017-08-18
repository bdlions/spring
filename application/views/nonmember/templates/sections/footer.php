<div class="footer_bg">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-1 col-md-10">
                <div class="contacts">
                    <div class="row col-md-12" >
                        <?php foreach($logo_list as $logo_info){
                            if($logo_info['type_id'] == LOGO_TYPE_ID_FOOTER){
                        ?>
                        <ul class="center">
                            <li><img style="max-height:60px!important; max-width:250px!important;" class="img-responsive" src="<?php echo base_url() ?>resources/images/<?php echo $logo_info['img'] ?>"></li>
                         </ul>
                        <?php 
                           } 
                        } 
                        ?>
<!--                        <div class="col-md-3">
                            <ul class="address">
                                <li class="head"><?php echo $address_info['title']?></li>
                                <li><?php echo $address_info['street']?></li>
                                <li><?php echo $address_info['city']?>, <?php echo $address_info['post_code']?></li>
                                <li>Tel: <?php echo $address_info['telephone']?></li>
                            </ul>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="slogan_bg">
        <div class="container">
            <div class="row" >
                <div class="col-md-offset-1 col-md-10">
                    <div class="slogan">
                        <p><?php echo $home_page_info['footer_message']?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright_bg">
        <div class="container">
            <div class="row" >
                <div class="col-md-offset-1 col-md-10">
                    <div class="row copyright">
                        <div class="col-md-10">
                            <p><?php echo $home_page_info['copy_right']?></p>
                        </div>
                        <div class="col-md-2 pull-right">
                            <p><a href="#">Designed by bdlions</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>