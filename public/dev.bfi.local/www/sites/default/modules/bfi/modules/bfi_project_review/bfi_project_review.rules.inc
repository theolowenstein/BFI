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
	// Code below copied from http://drupal.stackexchange.com/questions/85108/access-field-on-relation-from-rule
	global $user;
	$rids = relation_query('user', $user->uid)
		->related('node', $project->nid)
		->execute();
	$relations = entity_load('relation', array_keys($rids));
	dpm($relations);
	if (count($relations) == 1) {
		$relation = reset($relations);
		dpm(t('Round is: '.$project->field_project_round['und'][0]['value']));
		switch ($project->field_project_round['und'][0]['value']) {			// put in Entity API stuff here to be able to save the new value!
			case 1:
				$relation->field_project_review_r1_in['und'][0] = array ('value' => 1,);
				break;
			case 2:
				$relation->field_project_review_r2_in['und'][0] = array ('value' => 1,);
				break;
			case 3;
				$relation->field_project_review_r3_in['und'][0] = array ('value' => 1,);
				break;
		}
	}
}
