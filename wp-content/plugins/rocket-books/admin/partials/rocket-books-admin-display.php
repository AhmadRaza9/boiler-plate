<?php

?>


<div class="wrap">
    <h1><?php echo get_admin_page_title(); ?></h1>
    <form action="options.php" method="POST">
<?php
// Security
settings_fields('rbr-settings-page-options-group');

// display section
do_settings_sections('rbr-settings-page');

?>
        <?php submit_button('Submit');?>
    </form>
</div>