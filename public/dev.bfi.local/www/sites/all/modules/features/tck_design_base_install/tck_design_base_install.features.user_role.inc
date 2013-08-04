<?php
/**
 * @file
 * tck_design_base_install.features.user_role.inc
 */

/**
 * Implements hook_user_default_roles().
 */
function tck_design_base_install_user_default_roles() {
  $roles = array();

  // Exported role: admin.
  $roles['admin'] = array(
    'name' => 'admin',
    'weight' => 3,
  );

  // Exported role: superadmin.
  $roles['superadmin'] = array(
    'name' => 'superadmin',
    'weight' => 2,
  );

  return $roles;
}
