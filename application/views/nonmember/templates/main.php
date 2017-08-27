<!DOCTYPE html>
<html lang="en" class="js no-flexbox canvas canvastext webgl no-touch geolocation postmessage websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Dedicated for selling textile product">
        <meta name="author" content="Nazmul Hasan, Alamgir Kabir">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="og:site_name" content="apurbobrand" />
        <meta name="og:title" content="buy and sales" />
        <meta name="og:description" content="soport website" />	
        <meta name="keywords" content=""/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>resources/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>resources/css/styles.css">
        <script type="text/javascript" src="<?php echo base_url() ?>resources/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>resources/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() ?>resources/js/jquery.lavalamp.min.js"></script>
        <title><?php echo SITE_TITLE ?></title>
        <script type="text/javascript">
            $(document).ready(function () {
                $('li.current-menu-item').first().addClass('current');
            });
            $(function () {
                $("ul#menu-main-menu").lavaLamp({
                    speed: 500
                });
            });
            $(document).ready(function () {
                $('.carousel').carousel({interval: 7000});
            });
        </script>
    </head>
    <body class="home">
        <div class="wrapper">
            <div class="container container-bg" >
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <?php $this->load->view('nonmember/templates/sections/header'); ?>
                        <div class="margin-top-20px">
                            <?php echo $contents; ?>
                        </div>
                    </div>
                </div>
            </div>  
            <div class="push"></div>
        </div>
        <?php $this->load->view('nonmember/templates/sections/footer'); ?>
    </body>

</html>