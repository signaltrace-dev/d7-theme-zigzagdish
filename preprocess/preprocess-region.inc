<?php

function zigzagdish_alpha_preprocess_region(&$vars) {
  //krumo($vars);

  global $language;
  
  switch($vars['region']) {
    // menu region
    case 'menu':
      $footer_menu_cache = cache_get("footer_menu_data:". $language->language) ;
		  if ($footer_menu_cache) {
		    $footer_menu = $footer_menu_cache->data;
		  }
		  else {
		    $footer_menu = menu_tree_output(_zigzagdish_menu_build_tree('main-menu', array('max_depth'=>2)));
		    cache_set("footer_menu_data:" .$language->language, $footer_menu);
		  }
		  //set the active trail
		  $active_trail = menu_get_active_trail();
		  foreach($active_trail as $trail) {
		    if (isset($trail['mlid']) && isset($footer_menu[$trail['mlid'] ] )) {
		      $footer_menu[$trail['mlid']]['#attributes']['class'][] = 'active-trail';
		    }
		  }
		  $vars['dropdown_menu'] = $footer_menu;
    break;
    // default footer content
    case 'footer_first':
      $footer_menu_cache = cache_get("footer_menu_data:". $language->language) ;
		  if ($footer_menu_cache) {
		    $footer_menu = $footer_menu_cache->data;
		  }
		  else {
		    $footer_menu = menu_tree_output(_genix_menu_build_tree('main-menu', array('max_depth'=>2)));
		    cache_set("footer_menu_data", $footer_menu);
		  }
			
      $footer_menu_utility_cache = cache_get("footer_menu_utility_data:". $language->language) ;
		  if ($footer_menu_utility_cache) {
		    $footer_utility_menu = $footer_menu_utility_cache->data;
		  }
		  else {
				$footer_utility_menu = menu_tree_output(_zigzagdish_menu_build_tree('menu-utility', array('max_depth'=>2)));
				cache_set("footer_menu_utility_data", $footer_utility_menu);
		  }			
			
		  //set the active trail
		  $active_trail = menu_get_active_trail();
		  foreach($active_trail as $trail) {
		    if (isset($trail['mlid']) && isset($footer_menu[$trail['mlid'] ] )) {
		      $footer_menu[$trail['mlid']]['#attributes']['class'][] = 'active-trail';
		    }
		  }
		  $vars['footer_menu'] = $footer_menu;
		  //krumo($vars['footer_menu']);
    break;
  }
}
