<?php

// if this file is call directly, abor.

if (!defined('ABSPATH')) {
    die();
}

?>

<div class="book-content" style="background-color: lightskyblue;">
<?php echo get_the_content(); ?>
</div>