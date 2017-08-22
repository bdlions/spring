<!--commercial content-->

<div class="row">
    <?php //$this->load->view('nonmember/templates/sections/left_panel');?>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <h4><?php //echo $page_info['title']      ?></h4>
            </div> 
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="large_content">
                    <?php echo $page_info['description']; ?>
                </div>
            </div> 
        </div>
        <div class="row form-group">
            <?php foreach ($page_info['image_list'] as $image) { ?>
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 form-group">
                    <img id="" class="size-full-img img-responsive" alt="img" src="<?php echo base_url() . 'resources/images/' . $image ?>" alt="Page Image"/>

                </div> 
            <?php } ?>
        </div>
        <?php foreach ($page_info['file_list'] as $page_file_info) { ?>
            <div class="row form-group">
                <div class="col-md-12">
                    <a target="_blank" href="<?php echo base_url() . FILE_UPLOAD_PATH . $page_file_info['name'] ?>"><?php echo $page_file_info['display_name']; ?></a>
                </div> 
            </div>
        <?php } ?>
    </div>
</div>
<style>

</style>
</head>
<body>
<!--

    <img id="myImg" src="<?php echo base_url() . 'resources/images/' . $image ?>" alt="Page Image" width="300" height="200">

     The Modal 
    <div id="myModal" class="modal">
        <span class="close full-opacity">&times;</span>
        <img class="modal-content" id="img01">
        <div id="caption"></div>
    </div>

    <script>
        // Get the modal
        var modal = document.getElementById('myModal');

        // Get the image and insert it inside the modal - use its "alt" text as a caption
        var img = document.getElementById('myImg');
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
        img.onclick = function () {
            modal.style.display = "block";
            modalImg.src = this.src;
//            captionText.innerHTML = this.alt;
        }

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function () {
            modal.style.display = "none";
        }
    </script>
-->
    
    


