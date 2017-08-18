<!--commercial content-->
                   
<div class="row">
    <?php //$this->load->view('nonmember/templates/sections/left_panel');?>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <h4><?php //echo $page_info['title']?></h4>
            </div> 
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="large_content">
                    <?php echo $page_info['description']; ?>
                </div>
            </div> 
        </div>
        <?php foreach($page_info['image_list'] as $image){ ?>
        <div class="row form-group">
            <div class="col-md-12">
                <img class="size-full-img img-responsive" alt="img" src="<?php echo base_url().'resources/images/'.$image?>"/>
            </div> 
        </div>
        <?php } ?>
        <?php foreach($page_info['file_list'] as $page_file_info){ ?>
        <div class="row form-group">
            <div class="col-md-12">
                <a target="_blank" href="<?php echo base_url().FILE_UPLOAD_PATH.$page_file_info['name']?>"><?php echo $page_file_info['display_name']; ?></a>
            </div> 
        </div>
        <?php } ?>
    </div>
</div>