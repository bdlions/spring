<div class="panel panel-default">
    <div class="panel-heading">Menu</div>
    <div class="panel-body">
        <div class="row col-md-12">            
            <div class="row">
                <div class="table-responsive table-left-padding">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Enquire</th>
                                <th>Show Replies</th>
                                <th>Reply</th>
                                <th style="text-align: center">Delete</th>
                            </tr>
                            <?php foreach($feedback_list as $feedback_info){?> 
                            <tr>
                                <td><?php echo $feedback_info['name']; ?></td>
                                <td><?php echo $feedback_info['email']; ?></td>
                                <td><?php echo $feedback_info['phone']; ?></td>
                                <td><?php echo $feedback_info['enquiry']; ?></td>
                                <td>
                                    <a href="<?php echo base_url().'admin/feedback/show_replies/'.$feedback_info['feedback_id']?>">
                                        Show
                                    </a>
                                </td>
                                <td>
                                    <a href="<?php echo base_url().'admin/feedback/create_reply/'.$feedback_info['feedback_id']?>">
                                        Reply
                                    </a>
                                </td>
                                <td>
                                    <button onclick="open_modal_feedback_delete_confirm('<?php echo $feedback_info['feedback_id']; ?>')" value="" class="form-control btn pull-right">
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
<?php $this->load->view("admin/feedback/modal_delete_feedback_confirm");