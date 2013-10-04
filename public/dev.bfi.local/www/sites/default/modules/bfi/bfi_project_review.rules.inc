<?php

/**
 * Implements hook_rules_action_info()
 *
 * Declaring meta-data about actions for Rules
 */
function bfi_project_review_rules_action_info() {
	$actions = array(
		'bfi_project_review_action_review_in' => array(
			'label' => t('register Project Review submission, per reviewer, per round'),
			'group' => t('BFI Custom'),
			'parameter' => array(
				'project' => array(			// Name of the parameter to be supplied via Rules UI
					'type' => 'node',		// Specifying type of entity to be passed
					'label' => t('Project'),
					//'save' => TRUE,			// Only set this if need to save entity once done w/ it
				),
			),
		),

		'bfi_project_review_action_fetch_project' => array(
			'label' => t('fetch current project via relation from entityform'),
			'group' => t('BFI Custom'),
			'parameter' => array(
				'review_current' => array(			// Name of the parameter to be supplied via Rules UI
					'type' => 'entityform',		// Specifying type of entity to be passed
					'label' => t('Current Review'),
					//'save' => TRUE,			// Only set this if need to save entity once done w/ it
				),
			),
			'provides' => array(
				'project_current' => array(			// Name of the parameter to be supplied via Rules UI
					'type' => 'node',		// Specifying type of entity to be passed
					'label' => t('Current Project'),
				),
			),
		),

		'bfi_project_review_action_dpm_project' => array(
			'label' => t('DPM all project stuff'),
			'group' => t('BFI Custom'),
			/*
			'parameter' => array(
				'project' => array(			// Name of the parameter to be supplied via Rules UI
					'type' => 'node',		// Specifying type of entity to be passed
					'label' => t('Project'),
					//'save' => TRUE,			// Only set this if need to save entity once done w/ it
				),
			),*/
		),

	);

	return $actions;
}

/*
 * Setting Review Round submissions register per user, per round. The vars then determine if the review note form is visible later.
 */
function bfi_project_review_action_review_in($project) {
	// Code below adapted from http://drupal.stackexchange.com/questions/85108/access-field-on-relation-from-rule
	global $user;
	$user_rids = relation_query('user', $user->uid)
		->related('node', $project->nid)
		->execute();
	$user_rels = entity_load('relation', array_keys($user_rids));
	if (count($user_rels) == 1) {
		$user_rel_wrapper = entity_metadata_wrapper('relation', reset($user_rels)); // Wrapping fetch relation with Entity API wrapper (https://drupal.org/node/1021556)
		$curr_round = $project->field_project_round['und'][0]['value'];
		switch ($curr_round) {
			case 1:
				$user_rel_wrapper->field_project_review_r1_in->set(1);
				$user_rel_wrapper->save();
				break;
			case 2:
				$user_rel_wrapper->field_project_review_r2_in->set(1);
				$user_rel_wrapper->save();
				break;
			case 3;
				$user_rel_wrapper->field_project_review_r3_in->set(1);
				$user_rel_wrapper->save();
				break;
		}
		
	}

}

function bfi_project_review_action_fetch_project($review_current) {
	$project_current = relation_get_related_entity('entityform', $review_current->entityform_id);
	return array(
		'project_current' => $project_current,
	);
}

function bfi_project_review_action_dpm_project() {
	$node = menu_get_object();
	if ($node->type == 'project') {
		dpm($node);
	}

}




