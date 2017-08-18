<div class="panel panel-default">
    <div class="panel-heading">Page</div>
    <div class="panel-body">
        <div class="row col-md-12">            
            <div class="row form-group" style="padding-left:10px;">
                <div class ="col-md-2 pull-left form-group">
                    <a href="<?php echo base_url() . 'admin/page/create_page_image' ?>">
                        <button id="page_create_id" value="" class="form-control pull-right btn_custom_button">Add Page Image</button>  
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive table-left-padding table_padding">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Page Title</th>
                                    <th>Image</th>
                                    <th style="text-align: center">Delete</th>
                                </tr>
                                <?php foreach($page_image_list as $page_image_info){?> 
                            <tr>
                                <td><?php echo $page_image_info['id']; ?></td>
                                <td><?php echo $page_image_info['title']; ?></td>
                                <td>
                                    <img style="width: 120px; height: 120px;" src="<?php echo base_url() . IMAGE_UPLOAD_PATH . $page_image_info['img']; ?>" class="img-responsive"/>
                                </td>
                                <td>
                                    <button onclick="open_modal_delete_page_confirm('<?php echo $page_image_info['id']; ?>')" value="" class="form-control btn pull-right">
                                        Delete
                                    </button>
                                </td>
                             </tr>
                            <?php }?>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="btn-group" style="padding-right: 10px;">
                <input type="button" style="width:120px;" value="Back" id="back_button" onclick="javascript:history.back();" class="form-control btn_custom_button">
            </div>
        </div>
    </div>
</div>


<?php $this->load->view("admin/page/image/modal_delete_page_image_confirm"); ?>