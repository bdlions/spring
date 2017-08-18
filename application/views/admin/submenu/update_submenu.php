<div class="panel panel-default">
    <div class="panel-heading">Update_submenu</div>
    <div class="panel-body">
        <div class="form-background top-bottom-padding">
            <div class="row">
                <div class ="col-md-8 margin-top-bottom">
                    <?php echo form_open("admin/submenu/update_submenu/".$submenu['submenu_id'], array('id' => 'form_update_submenu', 'class' => 'form-horizontal')); ?>
                    <div class ="row">
                        <div class="col-md-12"><?php echo $message; ?> </div>
                    </div>
                    <div class="form-group">
                        <label for="match_date" class="col-md-6 control-label requiredField">
                            Title
                        </label>
                        <div class ="col-md-6">
                            <?php echo form_input($title + array('class' => 'form-control')); ?>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label for="match_date" class="col-md-6 control-label requiredField">
                            Menu
                        </label>
                        <div class ="col-md-6">
                            <?php echo form_dropdown('menu_list', array('0'=>'Select')+$menu_list, $submenu['menu_id'], 'class=form-control id=menu_list'); ?>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label for="page_id" class="col-md-6 control-label requiredField">
                            Page
                        </label>
                        <div class ="col-md-6">
                            <?php echo form_dropdown('page_list', array('0'=>'Select')+$page_list, isset($submenu['page_id'])?$submenu['page_id']:'0', 'class=form-control id=page_list'); ?>
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
                            <?php echo form_submit($submit_update_submenu + array('class' => 'form-control button btn_custom_button')); ?>
                        </div> 
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
            <div class="btn-group" style="padding-left: 10px;">
                <input type="button" style="width:120px;" value="Back" id="back_button" onclick="javascript:history.back();" class="form-control button btn_custom_button">
            </div>
        </div>
    </div>
</div>