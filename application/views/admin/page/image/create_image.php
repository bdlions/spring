<script type="text/javascript">
$(function () {
    $("#btnSubmit").on("click", function(){
        
        $.ajax({
            dataType: 'json',
            type: "POST",
            url: '<?php echo base_url();?>admin/page/create_page_image',
            data: $("#form_create_page").serializeArray(),
            success: function(data) {
                alert(data.message);
                window.location = '<?php echo base_url();?>admin/page/images';
            }
        });
    });
    
    // Change this to the location of your server-side upload handler:
    var url = "<?php echo base_url();?>admin/page/create_page_image",
    uploadButton = $('<input type="submit" value="Save"/>').addClass('btn button-custom pull-right').text('Confirm').
    on('click', function() {
        var $this = $(this),data = $this.data();
        $this.off('click').text('Abort').on('click', function() {
            $this.remove();
            data.abort();
        });
        data.submit().always(function() {
            $this.remove();
        });
    });

    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        formData: $("form_create_page_image").serializeArray(),
        autoUpload: false,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 5000000, // 5 MB
        // Enable image resizing, except for Android and Opera,
        // which actually support image resizing, but fail to
        // send Blob objects via XHR requests:
        disableImageResize: /Android(?!.*Chrome)|Opera/
                .test(window.navigator.userAgent),
        previewMaxWidth: 120,
        maxNumberOfFiles: 1,
        previewMaxHeight: 120,
        previewCrop: true
    }).on('fileuploadadd', function(e, data) {
        $("#files").empty();
        data.context = $('<div/>').appendTo('#files');
        $("div#upload").empty();
        $("div#upload").append('<br>').append(uploadButton.clone(true).data(data));
        $.each(data.files, function(index, file) {
            var node = $('<p/>');
            node.appendTo(data.context);
        });
    }).on('fileuploadprocessalways', function(e, data) {
        var index = data.index,
                file = data.files[index],
                node = $(data.context.children()[index]);
        if (file.preview) {
            node.prepend('<br>').prepend(file.preview);
        }
        if (file.error) {
            $("div#header").append('<br>').append($('<span class="text-danger"/>').text(file.error));
        }
        if (index + 1 === data.files.length) {
            data.context.find('button').text('Upload').prop('disabled', !!data.files.error);
        }
    }).on('fileuploadprogressall', function(e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress .progress-bar').css('width',progress + '%');
    }).on('fileuploaddone', function(e, data) {
        alert(data.result.message);
        window.location = '<?php echo base_url();?>admin/page/images';
    }).on('fileuploadsubmit', function(e, data){
        data.formData = $('form').serializeArray();
    }).on('fileuploadfail', function(e, data) {
        alert(data.message);
        $.each(data.files, function(index, file) {
            var error = $('<span class="text-danger"/>').text('File upload failed.');
            $(data.context.children()[index]).append('<br>').append(error);
        });
    }).prop('disabled', !$.support.fileInput)
            .parent().addClass($.support.fileInput ? undefined : 'disabled');

});
</script>
<div class="panel panel-default">
    <div class="panel-heading">Create Page Image</div>
    <div class="panel-body">
        <div class="form-background top-bottom-padding">
            <div class="row">
                <div class ="col-md-8 margin-top-bottom">
                    <?php echo form_open("admin/page/create_page_image", array('id' => 'form_create_page_image', 'class' => 'form-horizontal', 'onsubmit' => 'return false;')); ?>
                    <div class ="row">
                        <div class="col-md-12"> <?php echo $message; ?> </div>
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
                        <label for="picture" class="col-md-3 control-label requiredField">
                            Add picture
                        </label>
                        <div class ="col-md-9">
                            <div class="col-md-6">
                                <div class="row fileinput-button">
                                    <i class="glyphicon glyphicon-plus"></i>
                                    <span>Upload a photo</span>
                                    <input id="fileupload" type="file" name="userfile">
                                </div>
                                <div id="progress" class="row progress">
                                    <div class="progress-bar progress-bar-success"></div>
                                </div>
                            </div>

                            <div class=" col-md-4">
                                <div class="profile-picture-box" >
                                    <div id="files" class="files">
                                    </div>
                                </div>
                            </div>
                        
                            <div class="col-md-offset-8 col-md-4 disable_padding_right" id="upload">
                                <input id="btnSubmit" type="submit" value="Save" class="btn button-custom pull-right"/>
                            </div>
                        </div>
                    </div>
                    
<!--                    <div class="form-group">
                        <label for="submit_create_page" class="col-md-6 control-label requiredField">

                        </label>
                        <div class ="col-md-3 pull-right">
                            <?php echo form_submit($submit_create_page + array('class' => 'form-control button btn_custom_button')); ?>
                        </div> 
                    </div>-->
                    <?php echo form_close(); ?>
                </div>
            </div>
            <div class="btn-group" style="padding-left: 10px;">
                <input type="button" style="width:120px;" value="Back" id="back_button" onclick="javascript:history.back();" class="form-control button btn_custom_button">
            </div>
        </div>
    </div>
</div>

