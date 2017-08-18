<div class="panel panel-default">
    <div class="panel-heading">Enquery</div>
    <div class="panel-body">
        <div class="form-background top-bottom-padding">
            <div class="row">
                <div class ="col-md-8 margin-top-bottom">
                    <div class="row form-group">
                        <label for="name" class="col-md-6 control-label requiredField">
                            Name
                        </label>
                        <div class="col-md-6">
                            <?php echo $feedback_info['name'] ?>
                        </div> 
                    </div>
                    <div class="row form-group">
                        <label for="company" class="col-md-6 control-label requiredField">
                            Company
                        </label>
                        <div class="col-md-6">
                            <?php echo $feedback_info['company'] ?>
                        </div> 
                    </div>
                    <div class="row form-group">
                        <label for="address" class="col-md-6 control-label requiredField">
                            Address
                        </label>
                        <div class="col-md-6">
                            <?php echo $feedback_info['address'] ?>
                        </div> 
                    </div>
                    <div class="row form-group">
                        <label for="phone" class="col-md-6 control-label requiredField">
                            Phone
                        </label>
                        <div class="col-md-6">
                            <?php echo $feedback_info['phone'] ?>
                        </div> 
                    </div>
                    <div class="row form-group">
                        <label for="email" class="col-md-6 control-label requiredField">
                            Email
                        </label>
                        <div class="col-md-6">
                            <?php echo $feedback_info['email'] ?>
                        </div> 
                    </div>
                    <div class="row form-group">
                        <label for="subject" class="col-md-6 control-label requiredField">
                            Subject
                        </label>
                        <div class="col-md-6">
                            <?php echo $feedback_info['subject'] ?>
                        </div> 
                    </div>
                    <div class="row form-group">
                        <label for="enquiry" class="col-md-6 control-label requiredField">
                            Enquiry
                        </label>
                        <div class="col-md-6">
                            <?php echo $feedback_info['enquiry'] ?>
                        </div> 
                    </div>
                </div>
            </div>
            <div class="btn-group" style="padding-left: 10px;">
                <input type="button" style="width:120px;" value="Back" id="back_button" onclick="javascript:history.back();" class="form-control button">
            </div>
        </div>
    </div>
</div>