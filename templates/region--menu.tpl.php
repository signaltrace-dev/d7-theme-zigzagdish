<div<?php print $attributes; ?>>
  <div<?php print $content_attributes; ?>>
    <nav class="navigation clearfix">
      <?php print render($dropdown_menu); ?>
    </nav>
    <nav class="mobile-main-nav clearfix">
      <?php print theme('links__system_main_menu', array('links' => $main_menu, 'attributes' => array('id' => 'main-menu', 'class' => array('links', 'clearfix', 'main-menu')), 'heading' => array('text' => t('Main menu'),'level' => 'h2','class' => array('element-invisible')))); ?>
    </nav>    
    <?php print $content; ?>
  </div>
</div>
