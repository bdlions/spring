<?php $this->load->view("admin/image/logo/modal_delete_confirm_logo");?>
<style type="text/css">

    .item{

        text-align: center;
        height: 100% !important;
    }
    .carousel{
        margin-top: 20px;
    }
    .slider-size {
        //min-height: 200px;
        background-size: 100% 100%;
        background-repeat: no-repeat;

    }
    .carousel {
        width:100%; 
        margin:0 auto; /* center your carousel if other than 100% */ 
    }
    #imgbuttonb{ height: 32px; width: 32px; position: absolute; right: 64px; top: 30px;}
    #imgbuttonf{ height: 32px; width: 32px; position: absolute; right: 32px; top: 30px;}
</style>

<script type="text/javascript">
$(document).ready(function() {
    var logo_list = <?php echo json_encode($logo_list); ?>;
    if(logo_list.length > 0)
    {
        $('#input_photography_id').val(logo_list[0]['id']);
    }  
    $("div.item").each(function() {
        $(this).find('div').height($(window).height() - $("body nav").height() - 200);
    });
    $("#myCarousel").carousel({
        interval: false,
        pause: false
    });
    $('#myCarousel').bind('slid.bs.carousel', function (e) {
        var current_img_id = $('.item.active').find('div').prop('id');
        $('#input_photography_id').val(current_img_id);
    });
});
</script>

<div class="panel panel-default">
    <div class="panel-heading">Logos</div>
    <div class="panel-body">
        <div class ="row col-md-2 pull-left" style="margin-bottom: 10px">
            <a href="<?php echo base_url(); ?>admin/image/create_logo">
                <button id="button_add_image" value="" class="form-control btn button pull-right">Add Logo</button>  
            </a>
        </div>
        <div class="row col-md-12">
            <div class="row col-md-10">
                <div id="myCarousel" class="carousel slide" data-interval="3000" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php if (!empty($logo_list)): ?>
                                <?php $i = 1; ?>
                            <?php foreach ($logo_list as $logo_info): ?>
                                <div class="item <?php echo ($i == 1) ? 'active' : ''; ?>">
                                    <div  id="<?php echo $logo_info['id']; ?>" class="slider-size" style="background-image: url('<?php echo base_url() . 'resources/images/' . $logo_info['img']; ?>');" >

                                    </div>
                                </div>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div> 
                    <a href="#myCarousel" data-slide="next">
                        <img id="imgbuttonf" src="<?php echo base_url(); ?>resources/images/front_arrow.png"/>
                    </a>
                    <a  href="#myCarousel" data-slide="prev">
                        <img id="imgbuttonb" src="<?php echo base_url(); ?>resources/images/back_arrow.png"/>
                    </a>
                </div>
            </div>
            
            <div class="col-md-2" style="padding-left: 25px;">
                <?php if(!empty($logo_list)): ?>
                    <a onclick="open_modal_photo_delete_confirm()">Delete</a>
                <?php endif; ?>
            </div>
            
        </div>
    </div>
</div>


