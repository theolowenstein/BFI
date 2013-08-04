<?php
/**
 * @file
 * bfi_site_basics.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function bfi_site_basics_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "strongarm" && $api == "strongarm") {
    return array("version" => "1");
  }
}
