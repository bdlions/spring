<div class="panel panel-default">
    <div class="panel-heading">Admin Login</div>
    <div class="panel-body">
        <div class="form-background top-bottom-padding">
            <div class="row">
                <div class ="col-md-8 margin-top-bottom">
                    <?php echo form_open("admin/auth/login", array('id' => 'form_admin_login', 'class' => 'form-horizontal')); ?>
                    <div class ="row">
                        <div class="col-md-12"> <?php echo $message; ?> </div>
                    </div>
                    <div class="form-group">
                        <label for="match_date" class="col-md-6 control-label requiredField">
                            Email
                        </label>
                        <div class ="col-md-6">
                            <?php echo form_input($identity + array('class' => 'form-control')); ?>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label for="match_time" class="col-md-6 control-label requiredField">
                            Password
                        </label>
                        <div class ="col-md-6">
                            <?php echo form_input($password + array('class' => 'form-control')); ?>
                        </div> 
                    </div>
                    <div class="form-group">
                        <label for="submit_create_match" class="col-md-6 control-label requiredField">

                        </label>
                        <div class ="col-md-3 pull-right">
                            <?php echo form_submit($submit_login + array('class' => 'form-control button')); ?>
                        </div> 
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

