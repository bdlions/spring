<!--commercial content-->
                   
<div class="row">
    <?php $this->load->view('nonmember/templates/sections/left_panel');?>
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-12">
                <h4><?php echo $page_info['title']?></h4>
            </div> 
        </div>
        <?php if(!empty($page_info['img'])){ ?>
        <div class="row form-group">
            <div class="col-md-12">
                <img class="size-full-img img-responsive" alt="commercial-img" src="<?php echo base_url().'resources/images/'.$page_info['img']?>"/>
            </div> 
        </div>
        <?php } ?>
        <div class="row">
            <div class="col-md-12">
                <div class="large_content">
                    <?php echo $page_info['description']; ?>
                </div>
            </div> 
        </div>
    </div>
</div>