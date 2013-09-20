<?php

/**
 * Implements hook_rules_action_info()
 *
 * Declaring meta-data about actions for Rules
 */
function bfi_project_review_rules_action_info() {
	$actions = array(
		'bfi_project_review_action_review_in' => array(
			'label' => t('Register that review submitted by reviewer per round.'),
			'group' => t('BFI Custom'),
			'parameter' => array(
				'project' => array(			// Name of the parameter to be supplied via Rules UI
					'type' => 'node',		// Specifying type of entity to be passed
					'label' => t('Project'),
					//'save' => TRUE,			// Only set this if need to save entity once done w/ it
				),
			),
		),


	);

	return $actions;
}

/*
 * Defining what to actually do
 */
function bfi_project_review_action_review_in($project) {
	// Code below adapted from http://drupal.stackexchange.com/questions/85108/access-field-on-relation-from-rule
	global $user;
	$rids = relation_query('user', $user->uid)
		->related('node', $project->nid)
		->execute();
	$relations = entity_load('relation', array_keys($rids));
	dpm($relations);
	if (count($relations) == 1) {
		$relation_wrapper = entity_metadata_wrapper('relation', reset($relations)); // Wrapping fetch relation with Entity API wrapper (https://drupal.org/node/1021556)
		dpm(t('Round is: '.$project->field_project_round['und'][0]['value']));
		switch ($project->field_project_round['und'][0]['value']) {
			case 1:
				$relation_wrapper->field_project_review_r1_in->set(1);
				break;
			case 2:
				$relation_wrapper->field_project_review_r2_in->set(1);
				break;
			case 3;
				$relation_wrapper->field_project_review_r3_in->set(1);
				break;
		}
		$relation_wrapper->save();
	}
}
