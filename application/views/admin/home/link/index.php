<?php $this->load->view("admin/home/link/modal_delete_link_confirm");?>
<div class="panel panel-default">
    <div class="panel-heading">Link</div>
    <div class="panel-body">
        <div class="row col-md-12">            
            <div class="row form-group" style="padding-left:10px;">
                <div class ="col-md-2 pull-left form-group">
                    <a href="<?php echo base_url().'admin/home/create_link'?>">
                        <button id="" value="" class="form-control pull-right btn_custom_button">Create Link</button>  
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
                                <th>Summary</th>
                                <th>Link</th>
                                <th>Order</th>
                                
                                <th style="text-align: center">Edit</th>
                                <th style="text-align: center">Delete</th>
                            </tr>
                            <?php foreach($link_list as $link_info){?> 
                            <tr>
                                <td><?php echo $link_info['id']; ?></td>
                                <td><?php echo $link_info['title']; ?></td>
                                <td><?php echo $link_info['summary']; ?></td>
                                <td><?php echo $link_info['link']; ?></td>
                                <td><?php echo $link_info['order']; ?></td>
                                <td>
                                    <a href="<?php echo base_url()."admin/home/update_link/".$link_info['id'];?>">
                                        Edit
                                    </a>
                                </td>
                                <td>
                                    <button onclick="open_modal_link_delete_confirm('<?php echo $link_info['id']; ?>')" value="" class="form-control btn pull-right">
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
