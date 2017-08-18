<div class="panel panel-default">
    <div class="panel-heading">Menu</div>
    <div class="panel-body">
        <div class="row col-md-12">            
            <div class="row form-group" style="padding-left:10px;">
                <div class ="col-md-2 pull-left form-group">
                    <a href="<?php echo base_url().'admin/menu/create_menu'?>">
                        <button id="menu_create_id" value="" class="form-control pull-right btn_custom_button">Create Menu</button>  
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="table-responsive table-left-padding">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Order</th>
                                <th style="text-align: center">Edit</th>
                                <th style="text-align: center">Delete</th>
                            </tr>
                            <?php foreach($menu_list as $menu_info){?> 
                            <tr>
                                <td><?php echo $menu_info['menu_id']; ?></td>
                                <td><?php echo $menu_info['title']; ?></td>
                                <td><?php echo $menu_info['order']; ?></td>
                                <td>
                                    <a href="<?php echo base_url()."admin/menu/update_menu/".$menu_info['menu_id'];?>">
                                        Edit
                                    </a>
                                </td>
                                <td>
                                    <button onclick="open_modal_menu_delete_confirm('<?php echo $menu_info['menu_id']; ?>')" value="" class="form-control btn pull-right">
                                        Delete
                                    </button>
                                </td>
                             </tr>
                            <?php }?>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="btn-group" style="padding-right: 10px;">
                <input type="button" style="width:120px;" value="Back" id="back_button" onclick="javascript:history.back();" class="form-control btn_custom_button">
            </div>
        </div>
    </div>
</div>
<?php $this->load->view("admin/menu/modal_delete_menu_confirm");