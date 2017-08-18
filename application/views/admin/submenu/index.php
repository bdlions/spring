<div class="panel panel-default">
    <div class="panel-heading">Submenu</div>
    <div class="panel-body">
        <div class="row col-md-12">            
            <div class="row form-group" style="padding-left:10px;">
                <div class ="col-md-2 pull-left form-group">
                    <a href="<?php echo base_url().'admin/submenu/create_submenu'?>">
                        <button id="menu_create_id" value="" class="form-control pull-right btn_custom_button">Create SubMenu</button>  
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
                                <th>Title</th>
                                <th>Menu</th>
                                <th>Order</th>
                                <th style="text-align: center">Edit</th>
                                <th style="text-align: center">Delete</th>
                            </tr>
                            <?php foreach($submenu_list as $submenu_info){?> 
                            <tr>
                                <td><?php echo $submenu_info['id']; ?></td>
                                <td><?php echo $submenu_info['title']; ?></td>
                                <td><?php echo $submenu_info['menu_title']; ?></td>
                                <td><?php echo $submenu_info['order']; ?></td>
                                <td>
                                    <a href="<?php echo base_url()."admin/submenu/update_submenu/".$submenu_info['id'];?>">
                                        Edit
                                    </a>
                                </td>
                                <td>
                                    <button onclick="open_modal_delete_submenu_confirm('<?php echo $submenu_info['id']; ?>')" value="" class="form-control btn pull-right">
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
<?php $this->load->view("admin/submenu/modal_delete_submenu_confirm"); ?>