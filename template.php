<?php

/**
 * @file
 * This file is empty by default because the base theme chain (Alpha & Omega) provides
 * all the basic functionality. However, in case you wish to customize the output that Drupal
 * generates through Alpha & Omega this file is a good place to do so.
 * 
 * Alpha comes with a neat solution for keeping this file as clean as possible while the code
 * for your subtheme grows. Please read the README.txt in the /preprocess and /process subfolders
 * for more information on this topic.
 */

function _zigzagdish_menu_build_tree($menu_name, $parameters = array()) {
  $tree = menu_build_tree($menu_name, $parameters);
  if (function_exists('i18n_menu_localize_tree')) {
    $tree = i18n_menu_localize_tree($tree);
  }

  return $tree;
}

function zigzagdish_preprocess_region(&$vars) {
  global $language;

  switch($vars['region']) {
    // menu region
    case 'menu':
      $dropdown_menu = menu_tree_output(_zigzagdish_menu_build_tree('main-menu', array('max_depth'=>2)));
      //set the active trail
      $active_trail = menu_get_active_trail();
      foreach($active_trail as $trail) {
        if (isset($trail['mlid']) && isset($dropdown_menu[$trail['mlid'] ] )) {
          $dropdown_menu[$trail['mlid']]['#attributes']['class'][] = 'active-trail';
        }
      }
      // Set the tab index for those with drop downs so can access the links.
      foreach ($dropdown_menu as $key => $item) {
        if (!empty($dropdown_menu[$key]['#below'])) {
          $dropdown_menu[$key]['#attributes']['tabindex'] = 0;
        }
      }
      $vars['dropdown_menu'] = $dropdown_menu;
    break;
    // default footer content
    case 'footer_first':
      $footer_menu = menu_tree_output(_zigzagdish_menu_build_tree('main-menu', array('max_depth'=>1)));
      //set the active trail
      $active_trail = menu_get_active_trail();
      foreach($active_trail as $trail) {
        if (isset($trail['mlid']) && isset($footer_menu[$trail['mlid'] ] )) {
          $footer_menu[$trail['mlid']]['#attributes']['class'][] = 'active-trail';
        }
      }
      $vars['footer_menu'] = $footer_menu;
    break;
  }
}

// theme the search block form
function zigzagdish_form_alter(&$form, &$form_state, $form_id) {
  if ($form_id == 'search_block_form') {
    $form['search_block_form']['#title'] = t('Search'); // Change the text on the label element
    $form['search_block_form']['#title_display'] = 'invisible'; // Toggle label visibilty
    //$form['search_block_form']['#size'] = 40;  // define size of the textfield
    //$form['search_block_form']['#default_value'] = t('Search'); // Set a default value for the textfield
    $form['actions']['submit']['#value'] = t('Go'); // Change the text on the submit button
    //$form['actions']['submit'] = array('#type' => 'image_button', '#src' => base_path() . path_to_theme() . '/images/search-button.png');

    // HTML5 placeholder attribute instead of using javascript
    $form['search_block_form']['#attributes']['placeholder'] = t('SEARCH Food Talk');
  }

  if($form_id == 'user_register_form'){
    drupal_add_js("fbq('track', 'CompleteRegistration');", array('type' => 'inline', 'scope' => 'footer', 'weight' => 5));
  }
} 
// end search theming

function zigzagdish_theme(&$existing, $type, $theme, $path){
  $hooks['user_login_block'] = array(
    'template' => 'templates/user-login-block',
    'render element' => 'form',
  );

  return $hooks;
}

function zigzagdish_preprocess_user_login_block(&$vars){
  $vars['name'] = render($vars['form']['name']);
  $vars['pass'] = render($vars['form']['pass']);
  $vars['submit'] = render($vars['form']['actions']['submit']);
  $vars['rendered'] = drupal_render_children($vars['form']);
}

function zigzagdish_admin_paths(){
  $paths = array(
    'admin/webforms/reports' => TRUE,
  );

  return $paths;
}

