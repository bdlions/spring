<div class="col-md-10" style="background-color: #F5F5F5">
    <div class="col-md-12" style="border-bottom: 1px solid #cccccc; padding-bottom: 8px;"><!--heading-->
        <div class="panel panel-default">
            <div class="panel-heading">Add Reply</div>
            <div class="panel-body">
                <div class="row form-horizontal form-background top-bottom-padding">  
                    <?php echo form_open("admin/feedback/create_reply/".$feedback_id, array('id' => 'form_create_reply', 'class' => 'form-horizontal')) ?>
                    <div class="row">
                        <div class ="col-md-10 margin-top-bottom">                            
                            <div class ="row">
                                <div class="col-md-12"> <?php echo $message; ?> </div>
                            </div>
                            <div class="form-group">
                                <label for="summary" class="col-md-6 control-label requiredField">
                                   Description
                                </label>
                                <div class ="col-md-6">
                                    <?php echo form_textarea($description + array('class' => 'form-control')); ?>
                                </div> 
                            </div>
                            <div class="form-group">
                                <label for="submit_create_match" class="col-md-6 control-label requiredField">

                                </label>
                                <div class ="col-md-3 pull-right">
                                    <?php echo form_submit($submit_create_reply + array('class' => 'form-control button')); ?>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>