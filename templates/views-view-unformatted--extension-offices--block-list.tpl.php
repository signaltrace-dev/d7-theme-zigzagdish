<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<div class="accordion--content">
  <?php if (!empty($title)): ?>
    <h3 class="title accordion--title"><?php print $title; ?></h3>
  <?php endif; ?>
  <div class="accordion--body">
    <?php foreach ($rows as $id => $row): ?>
      <div<?php if ($classes_array[$id]) { print ' class="' . $classes_array[$id] .'"';  } ?>>
        <?php print $row; ?>
      </div>
    <?php endforeach; ?>
  </div>
</div>
