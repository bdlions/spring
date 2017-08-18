<div class="panel panel-default">
    <div class="panel-heading">Replies</div>
    <div class="panel-body">
        <div class="row col-md-12">            
            <div class="row">
                <div class="table-responsive table-left-padding">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Description</th>
                            </tr>
                            <?php foreach($reply_list as $reply_info){?> 
                            <tr>
                                <td><?php echo $reply_info['reply_id']; ?></td>
                                <td><?php echo $reply_info['description']; ?></td>                                
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