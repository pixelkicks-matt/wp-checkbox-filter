<?php
    add_action('wp_ajax_form_filter', 'pixel_kicks_checkbox_filter');
    add_action('wp_ajax_nopriv_form_filter', 'pixel_kicks_checkbox_filter');

function pixel_kicks_checkbox_filter(){
    /*
    The below sets up three different taxonomies to be filtered. If you need to add more,
    simply copy and paste a snippet and change the relevant details.
    */

    // Post Category Taxonomy
    if( $cats = get_terms( array( 'taxonomy' => 'cat' ) ) ) :
        $cat_terms = array();
  
    foreach( $cats as $cat ) {
        if( isset( $_POST['cat_' . $cat->term_id ] ) && $_POST['cat_' . $cat->term_id] == 'on' )
            $cat_terms[] = $cat->slug;
        }
    endif;
  
    // Custom Taxonomy 1
    if( $pixels = get_terms( array( 'taxonomy' => 'pixel' ) ) ) :
        $pixel_terms = array();
    
        foreach( $pixels as $pixel ) {
        if( isset( $_POST['pixel_' . $pixel->term_id ] ) && $_POST['pixel_' . $pixel->term_id] == 'on' )
            $pixel_terms[] = $pixel->slug;
        }
    endif;

    // Custom Taxonomy 2
    if( $kicks = get_terms( array( 'taxonomy' => 'kick' ) ) ) :
        $kick_terms = array();

        foreach( $kicks as $kick ) {
        if( isset( $_POST['kick_' . $kick->term_id ] ) && $_POST['kick_' . $kick->term_id] == 'on' )
            $kick_terms[] = $kick->slug;
        }
    endif;

    /*
    The below tells the loop what to actually include when certain options are selected. Since we're
    using checkboxes, we need the relation to be AND - this will enable options from each taxonomy to
    be included in the filter. 

    The very first snippet is optional and is used to specify a query that will be used when all checkboxes
    have been de-selected. By default it will show all posts from your post-type - but can be setup to only
    show ones from a specific category, or exclude a category for instance. 
    */

    $tax_query = array( 'relation' => 'AND' );

    /* THIS IS OPTIONAL
    if( empty($brand_terms && empty($models_terms) && empty($storage_terms) )) {
        $tax_query[] = array(
            'taxonomy' => 'cat',
            'field'    => 'id',
            'terms'    => array(1),
            'operator' => 'NOT IN',
        );
    }
    */

    if ( ! empty( $cat_terms ) ) {
        $tax_query[] = array(
        'taxonomy' => 'product_cat',
        'field'    => 'slug',
        'terms'    => $cat_terms,
        );
    }
    if ( ! empty( $pixel_terms ) ) {
        $tax_query[] = array(
            'taxonomy' => 'pixel',
            'field'    => 'slug',
            'terms'    => $pixel_terms,
        );
    }
    if ( ! empty( $kick_terms ) ) {
        $tax_query[] = array(
            'taxonomy' => 'kick',
            'field'    => 'slug',
            'terms'    => $kick_terms,
        );
    }
  
    /*
        This is the standard loop. The only important bit here is the 'tax_query'. This will be
        populated based on which checkboxes are selected (as specified in the code above).
    */
    $args = array(
        'post_type' => 'post',
        'orderby' => 'date',
        'order' => 'desc',
        'posts_per_page' => 999,
        'post_status' => 'publish',
        'tax_query'      => $tax_query,
    );
    $query = new WP_Query( $args );
?>

<?php if( $query->have_posts() ) : ?>
    <?php while( $query->have_posts() ): $query->the_post(); ?>

        <?php 
        /*
        Here is where your HTML for your post goes. Generally, this will be copy
        and pasted from your main archive code.
        */
        ?>
        <h1><?php the_title(); ?></h1>

    <?php endwhile; wp_reset_postdata(); ?>

    <?php // Include a .no-results class on your archive page (outside of the post wrapper) ?>
    <script>
        $(".no-results").removeClass("visible");
    </script>
    <?php else: ?>
    <script>
        $(".no-results").addClass("visible");
    </script>

<?php endif; die(); }
