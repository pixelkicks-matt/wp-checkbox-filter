<?php 
/* 
  Any number of taxonomies can be included in this filter, to add new ones simple copy
  and paste a snippet below and change the relevant details (ensuring the ID and Name 
  remain unique).
*/
?>

<form action="<?php echo admin_url('admin-ajax.php'); ?>" method="POST" id="filter-form">

  <?php // Post Category Filter ?>
  <?php if ($cats = get_terms(['taxonomy' => 'cat'])) { ?>
    <fieldset name="cats" class="taxonomy-list">
      <?php foreach ($cats as $cat) {
          echo '<input type="checkbox" class="" id="cat_'.$cat->term_id.'" name="cat_'.$cat->term_id .'" />';
          echo '<label for="cat_'.$cat->term_id.'">'.$cat->name.'</label>';
      } ?>
    </fieldset>
  <?php } ?>

  <?php // Custom Taxonomy 1 Filter ?>
  <?php if ($pixels = get_terms(['taxonomy' => 'pixel'])) { ?>
    <fieldset name="pixels" class="taxonomy-list">
      <?php foreach ($pixels as $pixel) {
          echo '<input type="checkbox" class="" id="pixel_'.$pixel->term_id.'" name="pixel_'.$pixel->term_id .'" />';
          echo '<label for="pixel_'.$pixel->term_id.'">'.$pixel->name.'</label>';
      } ?>
    </fieldset>
  <?php } ?>

  <?php // Custom Taxonomy 2 Filter ?>
  <?php if ($kicks = get_terms(['taxonomy' => 'kick'])) { ?>
    <fieldset name="kicks" class="taxonomy-list">
      <?php foreach ($kicks as $kick) {
          echo '<input type="checkbox" class="" id="kick_'.$kick->term_id.'" name="kick_'.$kick->term_id .'" />';
          echo '<label for="kick_'.$kick->term_id.'">'.$kick->name.'</label>';
      } ?>
    </fieldset>
  <?php } ?>

  <input type="hidden" name="action" value="form_filter"> <?php // The value here matches Lines 2 & 3 in functions.php) ?>
</form>
