<?php
/**
 * @file
 * bfi_domains.domains.inc
 */

/**
 * Implements hook_domain_default_domains().
 */
function bfi_domains_domain_default_domains() {
  $domains = array();
  $domains['challenge_dev_bfi_local'] = array(
    'subdomain' => 'challenge.dev.bfi.local',
    'sitename' => 'The Buckminster Fuller Challenge',
    'scheme' => 'http',
    'valid' => 1,
    'weight' => 1,
    'is_default' => 0,
    'machine_name' => 'challenge_dev_bfi_local',
  );
  $domains['dev_bfi_local'] = array(
    'subdomain' => 'dev.bfi.local',
    'sitename' => 'The Buckminster Fuller Institute',
    'scheme' => 'http',
    'valid' => 1,
    'weight' => -1,
    'is_default' => 1,
    'machine_name' => 'dev_bfi_local',
  );
  $domains['ideaindex_dev_bfi_local'] = array(
    'subdomain' => 'ideaindex.dev.bfi.local',
    'sitename' => 'Idea Index',
    'scheme' => 'http',
    'valid' => 1,
    'weight' => 2,
    'is_default' => 0,
    'machine_name' => 'ideaindex_dev_bfi_local',
  );

  return $domains;
}

/**
 * Implements hook_domain_alias_default_aliases().
 */
function bfi_domains_domain_alias_default_aliases() {
  $domain_aliases = array();
  $domain_aliases['challenge_dev_bfi_local'] = array();
  $domain_aliases['dev_bfi_local'] = array();
  $domain_aliases['ideaindex_dev_bfi_local'] = array();

  return $domain_aliases;
}

/**
 * Implements hook_domain_conf_default_variables().
 */
function bfi_domains_domain_conf_default_variables() {
  $domain_variables = array();
  $domain_variables['challenge_dev_bfi_local'] = array();
  $domain_variables['dev_bfi_local'] = array();
  $domain_variables['ideaindex_dev_bfi_local'] = array();

  return $domain_variables;
}

/**
 * Implements hook_domain_theme_default_themes().
 */
function bfi_domains_domain_theme_default_themes() {
  $domain_themes = array();
  $domain_themes['challenge_dev_bfi_local'] = array();
  $domain_themes['dev_bfi_local'] = array();
  $domain_themes['ideaindex_dev_bfi_local'] = array();

  return $domain_themes;
}
