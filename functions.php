<?php
function pixel_kicks_checkbox_filter()
{
    // Taxonomy 1
    if ($pixels = get_terms(['taxonomy' => 'pixels'])):
        $pixel_terms = [];

        foreach ($pixels as $pixel) {
            if (
                isset($_POST['pixel_' . $pixel->term_id]) &&
                $_POST['pixel_' . $pixel->term_id] == 'on'
            ) {
                $pixel_terms[] = $pixel->slug;
            }
        }
    endif;

    // Taxonomy 2
    if ($kicks = get_terms(['taxonomy' => 'kicks'])):
        $kicks_terms = [];

        foreach ($kicks as $kick) {
            if (
                isset($_POST['kick_' . $kick->term_id]) &&
                $_POST['kick_' . $kick->term_id] == 'on'
            ) {
                $kicks_terms[] = $kick->slug;
            }
        }
    endif;

    $tax_query = ['relation' => 'AND'];

    if (!empty($pixel_terms)) {
        $tax_query[] = [
            'taxonomy' => 'pixel',
            'field' => 'slug',
            'terms' => $pixel_terms,
        ];
    }
    if (!empty($kicks_terms)) {
        $tax_query[] = [
            'taxonomy' => 'kicks',
            'field' => 'slug',
            'terms' => $kicks_terms,
        ];
    }

    $args = [
        'post_type' => 'post',
        'orderby' => 'date',
        'order' => 'desc',
        'posts_per_page' => 999,
        'post_status' => 'publish',
        'tax_query' => $tax_query,
    ];

    $query = new WP_Query($args);

    if ($query->have_posts()):
        while ($query->have_posts()):
            $query->the_post(); ?>

    <h1><?php the_title(); ?></h1>

  <?php
        endwhile;
        wp_reset_postdata();
    else:
        echo 'No posts found';
    endif;
    die();
}

add_action('wp_ajax_filter_pixel_filter', 'pixel_kicks_checkbox_filter');
add_action('wp_ajax_nopriv_filter_pixel_filter', 'pixel_kicks_checkbox_filter');
