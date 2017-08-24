<script type="text/javascript">
    $(document).ready(function() {
        $('.carousel').carousel({interval: 7000});
    });
</script>
<div class="row">
    <div class="col-md-12">
<!--        <div class="welcomemsg">
            <span class="black">Welcome to</span> <span class="blueish bold">Real</span> <span class="redish bold">State</span> <span class="blueish">Limited</span>
            <span class="black"><?php echo $home_page_info['gallery_image_text']?></span>
        </div>-->
        <div id="carousel_slider" class="carousel slide slider_border" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php foreach($gallery_images as $key => $gallery_image){?>
                    <li data-target="#carousel_slider" data-slide-to="<?php echo $key; ?>" <?php echo ($key == 0)?"class='active'":"" ?></li>
                <?php } ?>
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner carousel-inner-custom" role="listbox">
                <?php foreach($gallery_images as $key => $gallery_image){?>
                    <div class="<?php echo ($key == 0)?"item active":"item" ?>">
                        <img src="<?php echo base_url().'resources/images/'.$gallery_image['img']?>" >
                        <!--<div class="carousel-caption"></div>-->
                    </div>
                <?php } ?>
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#carousel_slider" role="button" data-slide="prev">
                <span class="tp-leftarrow " aria-hidden="true"></span>
                <span class="sr-only"></span>
            </a>
            <a class="right carousel-control" href="#carousel_slider" role="button" data-slide="next">
                <span class="tp-rightarrow" aria-hidden="true"></span>
                <span class="sr-only"></span>
            </a>
        </div>
    </div>
</div>	
<div class="row">
    <div class="col-md-8">
        <article>
            <h2><?php //echo $home_page_info['title'] ?></h2>
            <p>
                <?php echo $home_page_info['description'] ?>
            </p>

        </article>
    </div>
    <div class="col-md-4">
        <aside class="pull-right">
            <div class="contact">
                <h5>Contact Us</h5>
                <p><?php echo $address_info['telephone'] ?></p>
                <p><a class="cursor_pointer"><?php echo $address_info['email'] ?></a></p>
            </div>				
        </aside>
    </div>
</div>
<div class="row col-md-12">
    <p><?php echo $home_page_info['links_title'] ?></p>
</div>
<div class="row form-group">
    <?php foreach ($link_list as $link_info) { ?>
        <div class="col-md-3">
            <div class="row building_servey">
                <div class="col-md-4">
                    <img class="img-responsive" src="<?php echo base_url().'resources/images/'.$link_info['img']; ?>">
                </div>
                <div class="col-md-8">
                    <a 
                        <?php if(isset($link_info['page_id'])){ ?>
                        href="<?php echo base_url() . 'user/page/' . $link_info['page_id']; ?>" class="cursor_pointer"
                        <?php }else{ ?>
                            href="#"
                        <?php } ?>
                    >
                        <h5><?php echo $link_info['title']; ?></h5>
                        <p><?php echo $link_info['summary']; ?></p>
                    </a>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
