<script type="text/javascript" src="<?php echo base_url(); ?>resources/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
window.onload = function()
{
    CKEDITOR.replace('description', {
        language: 'en',
        toolbar: [
            { name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source', '-', 'Preview', '-', 'Templates' ] },
            { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
            { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
            { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
            '/',
            { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },

            { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
            '/',
            { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl' ] },
            { name: 'forms', items: ['ImageButton'] },
        ],
            toolbarGroups: [
                    { name: 'document',	   groups: [ 'mode', 'document' ] },			// Displays document group with its two subgroups.
                    { name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },			// Group's name will be used to create voice label.
            { name: 'links' },
            { name: 'colors' },
                    '/',																// Line break - next group will be placed in new line.
                    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
            { name: 'styles' },
            '/',
            { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
            { name: 'forms' },
            ]
        });
}
</script>
<script>
$(function () {
    $("#submit_update_home_page_info").on("click", function(){
        
        $("#description_editortext").val(jQuery('<div />').text( CKEDITOR.instances.description.getData()).html());
        if (CKEDITOR.instances.description.getData() === "")
        {
            alert("Description is required.");
            return;
        } 
        $.ajax({
            dataType: 'json',
            type: "POST",
            url: '<?php echo base_url()."admin/home/index/".$home_page_info['home_page_info_id'];?>',
            data: $("#form_update_home_page_info").serializeArray(),
            success: function(data) {
                alert(data.message);
                window.location = '<?php echo base_url();?>admin/home';
            }
        });
    });
});
</script>
<h3>Update Home Page Info</h3>
<div class ="form-horizontal form-background top-bottom-padding">
    <?php echo form_open("admin/home/index/".$home_page_info['home_page_info_id'], array('id' => 'form_update_home_page_info', 'class' => 'form-horizontal', 'onsubmit' => 'return false;')); ?>
    <div class="row">
        <div class ="col-md-8 margin-top-bottom">
            <div class ="row">
                <div class="col-md-4"></div>
                <div class="col-md-8"><?php echo $message; ?></div>
            </div>
            <div class="form-group">
                <label for="gallery_image_text" class="col-md-4 control-label requiredField">
                    Gallery Image Text *
                </label>
                <div class ="col-md-8">
                    <?php echo form_input($gallery_image_text+array('class'=>'form-control')); ?>
                </div> 
            </div>
            <div class="form-group">
                <label for="title" class="col-md-4 control-label requiredField">
                    Title *
                </label>
                <div class ="col-md-8">
                    <?php echo form_input($title+array('class'=>'form-control')); ?>
                </div> 
            </div>
            <div class="form-group">
                <label for="description" class="col-md-4 control-label requiredField">
                    Description *
                </label>
                <div class ="col-md-8">
                    <?php echo form_textarea($description+array('class'=>'form-control')); ?>
                    <input type="hidden" name="description_editortext" id="description_editortext">
                </div> 
            </div>
            <div class="form-group">
                <label for="links_title" class="col-md-4 control-label requiredField">
                    Links Title *
                </label>
                <div class ="col-md-8">
                    <?php echo form_input($links_title+array('class'=>'form-control')); ?>
                </div> 
            </div>
            <div class="form-group">
                <label for="footer_message" class="col-md-4 control-label requiredField">
                    Footer Message *
                </label>
                <div class ="col-md-8">
                    <?php echo form_input($footer_message+array('class'=>'form-control')); ?>
                </div> 
            </div>
            <div class="form-group">
                <label for="copy_right" class="col-md-4 control-label requiredField">
                    Copyright *
                </label>
                <div class ="col-md-8">
                    <?php echo form_input($copy_right+array('class'=>'form-control')); ?>
                </div> 
            </div>
            <div class="form-group">
                <label for="submit_update_home_page_info" class="col-md-6 control-label requiredField">

                </label>
                <div class ="col-md-3 col-md-offset-3">
                    <?php echo form_input($submit_update_home_page_info+array('class'=>'form-control btn-success')); ?>
                </div> 
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>