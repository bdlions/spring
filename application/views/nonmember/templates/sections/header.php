<div class="header-bg">
    <div class="row paddin_over_top_20px">
        <div class="col-md-6 form-group">
            <div class="row">
                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                    <?php
                    foreach ($logo_list as $logo_info) {
                        if ($logo_info['type_id'] == LOGO_TYPE_ID_HEADER) {
                            ?>
                            <a href="<?php echo base_url(); ?>">
                                <img class="img-responsive logo" src="<?php echo base_url() ?>resources/images/<?php echo $logo_info['img'] ?>" alt="Spring Logo"> 
                            </a>        
                            <?php
                        }
                    }
                    ?>
                </div>
                <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                    <h3 class="company-name">Spring Trade Ltd.</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h4 class="tag-line">100% Export Oriented Sweater Manufacturing Industry</h4>
                </div>
            </div>
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
            <!--        <div class="row">
                        <div class="col-md-12">
                            <div class="float_phone"><?php echo $address_info['telephone'] ?></div>
                        </div>
                    </div>-->
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <nav class="navbar navbar-default navbar-custom">
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
                        <li class="<?php echo ($menu_id == MENU_ID_HOME) ? "active" : "" ?>"><a href="<?php echo base_url(); ?>"><span class="glyphicon glyphicon-home"></span></a></li>
                        <?php
                        foreach ($menu_submenu_list as $menu_info) {
                            if (count($menu_info['submenu_list']) == 0) {
                                ?>        
                                <li class="<?php echo ($menu_id == $menu_info['menu_id']) ? "active" : "" ?>"><a href="<?php echo ($menu_info['page_id'] == null) ? base_url() . "#" : base_url() . "user/page/" . $menu_info['page_id'] . "/" . $menu_info['menu_id'] ?>"><?php echo $menu_info['title'] ?></a></li>
                                <?php
                            } else {
                                ?>
                                <li class="<?php echo ($menu_id == $menu_info['menu_id']) ? "active" : "" ?>">
                                    <a href="<?php echo ($menu_info['page_id'] == null) ? base_url() . "#" : base_url() . "user/page/" . $menu_info['page_id'] . "/" . $menu_info['menu_id'] ?>"><?php echo $menu_info['title'] ?><span class="indicator glyphicon glyphicon-chevron-down"></span></a>
                                    <ul class="dropdown-menu-custom">
                                        <?php
                                        foreach ($menu_info['submenu_list'] as $submenu_info) {
                                            ?>
                                            <li><a href="<?php echo ($submenu_info['page_id'] == null) ? base_url() . "#" : base_url() . "user/page/" . $submenu_info['page_id'] . "/" . $menu_info['menu_id'] ?>"><?php echo $submenu_info['title'] ?></a></li>
                                            <?php
                                        }
                                        ?>                
                                    </ul>
                                </li>
                                <?php
                            }
                        }
                        ?>

                        <li class="<?php echo ($menu_id == MENU_ID_CONTACT_US) ? "active" : "" ?>"><a href="<?php echo base_url() . 'user/contact_us' ?>">Contact Us</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>
