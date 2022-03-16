<?php
/**
 * The template part for displaying single posts
 */
?>

<article id="post-<?php the_ID();?>" <?php post_class('single-book-container');?>>
    <div class="book-meta-container">
        <div class="book-entry-title">
            <h1> <?php the_title();?> </h1>
        </div>
        <div class="book-entry-img">
            <?php the_post_thumbnail('medium_large');?>
        </div>
<?php include ROCKET_BOOKS_BASE_DIR . "templates/book-meta.php";
?>
    </div>
	<div class="book-entry-content">
		<?php the_content();?>
	</div><!-- .entry-content -->

	<footer class="book-entry-footer">
		<?php
edit_post_link(
    sprintf(
        /* translators: %s: Post title. */
        __('Edit<span class="screen-reader-text"> "%s"</span>', 'rocket-books'),
        get_the_title()
    ),
    '<span class="edit-link">',
    '</span>'
);
?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID();?> -->
