<div class="panel panel-default">
    <div class="panel-heading">Create Menu</div>
    <div class="panel-body">
        <div class="form-background top-bottom-padding">
            <div class="row">
                <div class ="col-md-8 margin-top-bottom">
                    <?php echo form_open("admin/menu/create_menu", array('id' => 'form_create_menu', 'class' => 'form-horizontal')); ?>
                    <div class ="row">
                        <div class="col-md-12"> <?php echo $message; ?> </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-md-6 control-label requiredField">
                            Title
                        </label>
                        <div class ="col-md-6">
                            <?php echo form_input($title + array('class' => 'form-control')); ?>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label for="page_id" class="col-md-6 control-label requiredField">
                            Page
                        </label>
                        <div class ="col-md-6">
                            <?php echo form_dropdown('page_list', array('0'=>'Select')+$page_list, '0', 'class=form-control id=page_list'); ?>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label for="match_time" class="col-md-6 control-label requiredField">
                            Order
                        </label>
                        <div class ="col-md-6">
                            <?php echo form_input($order + array('class' => 'form-control')); ?>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label for="submit_create_match" class="col-md-6 control-label requiredField">

                        </label>
                        <div class ="col-md-3 pull-right">
                            <?php echo form_submit($submit_create_menu + array('class' => 'form-control button')); ?>
                        </div> 
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
            <div class="btn-group" style="padding-left: 10px;">
                <input type="button" style="width:120px;" value="Back" id="back_button" onclick="javascript:history.back();" class="form-control button">
            </div>
        </div>
    </div>
</div>