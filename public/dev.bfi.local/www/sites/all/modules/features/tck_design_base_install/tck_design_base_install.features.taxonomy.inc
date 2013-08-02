<?php
/**
 * @file
 * tck_design_base_install.features.taxonomy.inc
 */

/**
 * Implements hook_taxonomy_default_vocabularies().
 */
function tck_design_base_install_taxonomy_default_vocabularies() {
  return array(
    'admin_tags' => array(
      'name' => 'Admin Tags',
      'machine_name' => 'admin_tags',
      'description' => 'Tags used solely for backend admin: NOT FOR PUBLIC DISPLAY',
      'hierarchy' => 0,
      'module' => 'taxonomy',
      'weight' => 0,
      'rdf_mapping' => array(
        'rdftype' => array(
          0 => 'skos:ConceptScheme',
        ),
        'name' => array(
          'predicates' => array(
            0 => 'dc:title',
          ),
        ),
        'description' => array(
          'predicates' => array(
            0 => 'rdfs:comment',
          ),
        ),
      ),
    ),
  );
}
