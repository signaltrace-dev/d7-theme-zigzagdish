<?php

function zigzagdish_alpha_preprocess_html(&$vars) {
  //krumo($vars);

  // add Font Awesome - http://fortawesome.github.io/Font-Awesome/
  // drupal_add_css('//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css', array('type' => 'external'));

  // add the Google Fonts we need
  drupal_add_css('//fonts.googleapis.com/css?family=Open+Sans:400,700|Open+Sans+Condensed:300,700|Lobster+Two:400,700,400italic,700italic|Roboto+Slab:400,700|Port+Lligat+Slab', array('type' => 'external'));

  // Add information about the number of sidebars.
  if (!empty($vars['page']['content']['content']['sidebar_first']) && !empty($vars['page']['content']['content']['sidebar_second'])) {
    $vars['attributes_array']['class'][] = 'two-sidebars';
  }
  elseif (!empty($vars['page']['content']['content']['sidebar_first'])) {
    $vars['attributes_array']['class'][] = 'one-sidebar sidebar-first';
  }
  elseif (!empty($vars['page']['content']['content']['sidebar_second'])) {
    $vars['attributes_array']['class'][] = 'one-sidebar sidebar-second';
  }
  else {
    $vars['attributes_array']['class'][] = 'no-sidebars';
  }
  // end sidebar class stuff

}
