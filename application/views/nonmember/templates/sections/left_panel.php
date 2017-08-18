<div class="col-md-3">
    <aside>
        <div class="lhmenu three columns alpha">
            <h5>Menu</h5>
            <ul class="clearfix">
                <?php foreach($submenu_list as $submenu_info){?>
                    <li class="page_item page-item-6 current_page_item">
                        <a href="<?php echo base_url().'user/page/'.$submenu_info['submenu_id']?>"><?php echo $submenu_info['title']?></a>
                    </li>
                <?php } ?>
            </ul>
        </div>				
    </aside>
</div>