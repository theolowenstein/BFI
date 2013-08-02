<?php
/**
 * @file
 * tck_design_base_install.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function tck_design_base_install_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "strongarm" && $api == "strongarm") {
    return array("version" => "1");
  }
}
