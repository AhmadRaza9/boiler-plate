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
        <ul class="book-meta-fields">
            <!-- Here we will display our custom meta -->

            <li>Pages: <?php echo esc_html(get_post_meta(get_the_ID(), 'rbr_book_pages', true)); ?></li>
            <!-- <li>IS Featured Book: <#?php echo esc_html(get_post_meta(get_the_ID(), 'rbr-is-featured', true)); ?></li> -->
            <li>Book Format: <?php echo esc_html(get_post_meta(get_the_ID(), 'rbr_book_format', true)); ?></li>

        </ul>
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
