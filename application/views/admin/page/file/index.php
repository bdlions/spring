<div class="panel panel-default">
    <div class="panel-heading">Page</div>
    <div class="panel-body">
        <div class="row col-md-12">            
            <div class="row form-group" style="padding-left:10px;">
                <div class ="col-md-2 pull-left form-group">
                    <a href="<?php echo base_url() . 'admin/page/create_page_file' ?>">
                        <button id="page_create_id" value="" class="form-control pull-right btn_custom_button">Add Page File</button>  
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
                                    <th>Display Name</th>
                                    <th>File</th>
                                    <th style="text-align: center">Delete</th>
                                </tr>
                                <?php foreach($page_file_list as $page_file_info){?> 
                            <tr>
                                <td><?php echo $page_file_info['id']; ?></td>
                                <td><?php echo $page_file_info['title']; ?></td>
                                <td><?php echo $page_file_info['display_name']; ?></td>
                                <td>
                                    <a target="_blank" href="<?php echo base_url().FILE_UPLOAD_PATH.$page_file_info['name']?>"><?php echo $page_file_info['name']; ?></a>
                                </td>
                                <td>
                                    <button onclick="open_modal_delete_page_confirm('<?php echo $page_file_info['id']; ?>')" value="" class="form-control btn pull-right">
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


<?php $this->load->view("admin/page/file/modal_delete_page_file_confirm"); ?>