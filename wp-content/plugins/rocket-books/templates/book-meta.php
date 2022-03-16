<ul class="book-meta-fields">
    <!-- Here we will display our custom meta -->

    <?php

$meta_fields = array(
    'rbr_book_pages' => __('Pages', 'rocket-books'),
    'rbr_book_format' => __('Format', 'rocket-books'),
    'rbr_is_featured' => __('is Featured', 'rocket-books'),
);

$meta_icons = array(
    'rbr_book_pages' => "<i class='fa-solid fa-file-invoice'></i>",
    'rbr_book_format' => "<i class='fa-solid fa-book-open'></i>",
    'rbr_is_featured' => "<i class='fa-regular fa-face-grin-stars'></i>",
);

$html = '';

foreach ($meta_fields as $meta_key => $label) {
    // first : meta value
    $value = esc_html(get_post_meta(get_the_ID(), $meta_key, true));

    // if its not empty, then we are going build html
    if (empty($value)) {
        continue;
    }
    $html .= "<li>{$meta_icons[$meta_key]}&nbsp;{$label} : {$value}</li>";
}
echo $html;

?>

</ul>