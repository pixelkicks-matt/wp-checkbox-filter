<form action="<?php echo site_url(); ?>/wp-admin/admin-ajax.php" method="POST" id="checkbox_filter">

  <?php if ($pixels = get_terms(['taxonomy' => 'pixels'])) { ?>
    <div class="taxonomy-list">
      <?php foreach ($pixels as $pixel) {
          echo '<input type="checkbox" class="" id="pixel_' .
              $pixel->term_id .
              '" name="pixel_' .
              $pixel->term_id .
              '" />';
          echo '<label for="pixel_' .
              $pixel->term_id .
              '">' .
              $pixel->name .
              '</label>';
      } ?>
    </div>
  <?php } ?>

  <?php if ($pixels = get_terms(['taxonomy' => 'kicks'])) { ?>
    <div class="taxonomy-list">
      <?php foreach ($kicks as $kick) {
          echo '<input type="checkbox" class="" id="kick_' .
              $kick->term_id .
              '" name="kick_' .
              $kick->term_id .
              '" />';
          echo '<label for="kick_' .
              $kick->term_id .
              '">' .
              $kick->name .
              '</label>';
      } ?>
    </div>
  <?php } ?>

   <input type="hidden" name="action" value="pixel_filter">
</form>