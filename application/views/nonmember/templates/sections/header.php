<div class="row paddin_over_top_20px">
    <div class="col-md-6 form-group">
        <?php
        foreach ($logo_list as $logo_info) {
            if ($logo_info['type_id'] == LOGO_TYPE_ID_HEADER) {
                ?>
                <a href="<?php echo base_url(); ?>">
                    <img style="max-height:90px!important; max-width:380px!important;" class="img-responsive" src="<?php echo base_url() ?>resources/images/<?php echo $logo_info['img'] ?>" alt="Cadogan Mcqueen Logo"> 
                </a>        
                <?php
            }
        }
        ?>
    </div>
    <div class="col-md-6">
        <!--                            <div class="row">
                    <div class="col-md-12">
                        <ul class="list-unstyled list-inline custom">
                            <li> <a href="" target="_blank"><img class="img-responsive img-circle" src="resources/images/pinterest.png"></a></li>
                            <li><a href="" target="_blank"><img class="img-responsive img-circle" src="resources/images/facebook.png" ></a> </li>
                            <li><a href="" target="_blank"><img class="img-responsive img-circle" src="resources/images/twitter.png" ></a> </li>
                            <li><a href="" target="_blank"><img class="img-responsive img-circle" src="resources/images/linkedin.png" ></a> </li>
                        </ul>
                    </div>
                </div>-->
        <div class="row">
            <div class="col-md-12">
                <div class="float_phone"><?php echo $address_info['telephone'] ?></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <nav class="navbar navbar-default">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header navbar-header-custom">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-menu" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse main-menu-collapse" id="main-menu">
                <ul class="nav navbar-nav nav-custom">
                    <li class="active"><a href=""><span class="glyphicon glyphicon-home"></span></a></li>
                    <li id="product-service" class="">
                        <a href="">Products & Services <span class="indicator glyphicon glyphicon-chevron-down"></span></a>
                        <ul class="dropdown-menu-custom">
                            <li><a href="">Spinning</a></li>
                            <li><a href="">Knitting</a></li>
                            <li><a href="">Dyeing and Washing</a></li>
                            <li><a href="">Printing</a></li>
                            <li><a href="">Apparels</a></li>
                            <li><a href="">Packaging</a></li>
                            <li><a href="">Distribution</a></li>
                            <li><a href="">Ceramics</a></li>
                            <li><a href="">ICT & Telecommunications</a></li>
                        </ul>
                    </li>
                    <li><a href="">Concerns</a></li>
                    <li><a href="">Sustainability</a></li>
                    <li><a href="">Development Partners</a></li>
                    <li class="">
                        <a href="">Career  <span class="indicator glyphicon glyphicon-chevron-down"></span></a>
                        <ul class="dropdown-menu-custom">
                            <li><a href="">Career at DBL</a></li>
                            <li><a href="">Current Vacancies</a></li>
                        </ul>
                    </li>
                    <li class="">
                        <a href="">About Us  <span class="indicator glyphicon glyphicon-chevron-down"></span></a>
                        <ul class="dropdown-menu-custom">
                            <li><a href="">About DBL Group</a></li>
                            <li><a href="">Core Values</a></li>
                            <li><a href="">Major Buyers</a></li>
                            <li><a href="">Board of Directors</a></li>
                            <li><a href="">Export Destinations</a></li>
                            <li><a href="">Awards and Achievements</a></li>
                            <li><a href="">Newsletter</a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo base_url().'user/contact_us'?>">Contact Us</a></li>
                </ul>
            </div>
        </nav>
    </div>
</div>
