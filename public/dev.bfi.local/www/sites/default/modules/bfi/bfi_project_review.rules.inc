<?php

/**
 * Implements hook_rules_action_info()
 *
 * Declaring meta-data about actions for Rules
 */
function bfi_project_review_rules_action_info() {
	$actions = array(
		'bfi_project_review_action_review_in' => array(
			'label' => t('Register Project Review submission, per reviewer, per round'),
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
			'label' => t('Fetch current project via relation from entityform'),
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

		'bfi_project_review_action_ensure_unique_project' => array(
			'label' => t("Ensure that submitted project is unique by current year's emails"),
			'group' => t('BFI Custom'),
			'parameter' => array(
				'app' => array(			// Name of the parameter to be supplied via Rules UI
					'type' => 'entityform',		// Specifying type of entity to be passed
					'label' => t('Project Application'),
					//'save' => TRUE,			// Only set this if need to save entity once done w/ it
				),
			),
			'provides' => array(
				'nonu_projects' => array(			// Name of the parameter to be supplied via Rules UI
					'type' => 'integer',		// Specifying type of entity to be passed
					'label' => t('Non-unique Projects'),
				),
			),
		),

		'bfi_project_review_action_copy_field_coll_to_node' => array(
			'label' => t('Copy Field Collection from Entityform to Node'),
			'group' => t('BFI Custom'),
			'parameter' => array(
				'source' => array(			// Name of the parameter to be supplied via Rules UI
					'type' => 'entityform',		// Specifying type of entity to be passed
					'label' => t('Origin Entityform'),
					//'save' => TRUE,			// Only set this if need to save entity once done w/ it
				),
				'node' => array(			// Name of the parameter to be supplied via Rules UI
					'type' => 'node',		// Specifying type of entity to be passed
					'label' => t('Recipient Node'),
					//'save' => TRUE,			// Only set this if need to save entity once done w/ it
				),
				'field' => array(			// Name of the parameter to be supplied via Rules UI
					'type' => 'field_collection_item',		// Specifying type of entity to be passed
					'label' => t('Desired Collection'),
					//'save' => TRUE,			// Only set this if need to save entity once done w/ it
				),
			),
		),

		'bfi_project_review_action_assign_reviewer_if_not' => array(
			'label' => t('Assign project to review if not already assigned'),
			'group' => t('BFI Custom'),
			'parameter' => array(
				'reviewer' => array(			// Name of the parameter to be supplied via Rules UI
					'type' => 'user',		// Specifying type of entity to be passed
					'label' => t('Reviewer'),
					//'save' => TRUE,			// Only set this if need to save entity once done w/ it
				),
			),
		),

		'bfi_project_review_action_take_out_reviewer' => array(
			'label' => t('Take out reviewer if assigned to project'),
			'group' => t('BFI Custom'),
			'parameter' => array(
				'reviewer' => array(			// Name of the parameter to be supplied via Rules UI
					'type' => 'user',		// Specifying type of entity to be passed
					'label' => t('Reviewer'),
					//'save' => TRUE,			// Only set this if need to save entity once done w/ it
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

function bfi_project_review_tally_criteria(&$field) {
	$rating = 0;
	if (isset($field[LANGUAGE_NONE][0]['user'])) {
		$rating = $field[LANGUAGE_NONE][0]['user'];
	} else if (isset($field[LANGUAGE_NONE][0]['rating'])) {
		$rating = $field[LANGUAGE_NONE][0]['rating'];
	}
	return $rating;
}

function bfi_project_review_set_averages(&$field, $cumulative, $count) {
	$average = $cumulative/(10*$count);
	$field->set($average);	
}

function bfi_project_review_average_criteria_scores(&$project, $round) {
	$rel_ids = relation_query('node', $project->nid)
		->execute();
	foreach($rel_ids as $key => $value) {				// Finding only evaluation relations
		if ($value->relation_type != 'bfc_evaluation') unset($rel_ids[$key]);
	}
	$rels = entity_load('relation', array_keys($rel_ids));
	$eval_ids = array();
	foreach($rels as $key => $value) {					// Finding the evals for just this round
		if ($value->field_project_round_eval[LANGUAGE_NONE][0]['value'] == $round) {
			$eval_ids[] = $value->endpoints[LANGUAGE_NONE][0]['entity_id'];
		}
	}
	$evals = entity_load('entityform', $eval_ids);

	$wrap_ids = array();
	foreach($evals as $key => $value) {					// Getting IDs of criteria evaluation field collections
		if (isset($value->field_project_review_score_wrap[LANGUAGE_NONE][0]['value'])) {
			$wrap_ids[] = $value->field_project_review_score_wrap[LANGUAGE_NONE][0]['value'];
		}
	}
	$wraps = entity_load('field_collection_item', $wrap_ids);
	$wrap_count = count($wraps);

	// Tallying up criteria scores
	$scores_cum = array();
	foreach ($wraps as $key => $eval) {					// Loop through evaluations
		foreach ($eval as $field => $value) {			// Loop through fields
			if(substr($field, 0, 26) == 'field_project_review_score') {			// Save score values to cumulative array
				$bitlet = substr($field, 27);
				if (isset($scores_cum[$bitlet])) {
					$scores_cum[$bitlet] += bfi_project_review_tally_criteria($value);
				} else {
					$scores_cum[$bitlet] = bfi_project_review_tally_criteria($value);
				}
			}
		}
	}

	// If Average for round ($round - 1) already exists, update it
	if (isset($project->field_project_review_score_rds[LANGUAGE_NONE][$round - 1])) {		// Borrowing from http://www.rajanmayekar.com/blog/programmatically-creating-deleting-modifying-field-collection-item-node and https://drupal.org/node/1106182
		$score_coll_id = $project->field_project_review_score_rds[LANGUAGE_NONE][$round - 1]['value'];
		$score_coll = entity_load('field_collection_item', array($score_coll_id));
	} else {		// Else, make new field collection
		$score_coll = entity_create('field_collection_item', array('field_name' => 'field_project_review_score_rds')); // Create new field collection item.
		$score_coll->setHostEntity('node', $project); // Attach it to the node.
		$score_coll->save();			// This isn't working for some reason - figure out why!
	}
	$score_coll_wrapper = entity_metadata_wrapper('field_collection_item', reset($score_coll));
	$score_coll_wrapper->field_project_round_eval->set($round);
	foreach ($score_coll_wrapper as $field => $value) {		// Loop through fields
		if (substr($field, 0, 24) == 'field_project_review_ave') {			// Save average values
			bfi_project_review_set_averages($value, $scores_cum[substr($field, 25)], $wrap_count);
		}
	}
	$score_coll_wrapper->save();		// Relation add has issues with this for some reason - figure it out!
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
		$curr_round = $project->field_project_round[LANGUAGE_NONE][0]['value'];
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
		bfi_project_review_average_criteria_scores($project, $curr_round);
	}
}

function bfi_project_review_action_copy_field_coll_to_node($source, $node, $field) {
	$field_to_get_name = $field->field_name;
	if (isset($source->$field_to_get_name)) {
		$field_to_get = $source->$field_to_get_name;
		$field_to_get_id = $field_to_get[LANGUAGE_NONE][0]['value'];
		$field_coll_form = entity_load('field_collection_item', array($field_to_get_id));

		$field_coll_node = entity_create('field_collection_item', array('field_name' => $field_to_get_name));
		$field_coll_node->setHostEntity('node', $node);

		foreach ($field_coll_form[$field_to_get_id] as $key => $value) {
			if (substr($key, 0, 6) == 'field_') {			// Check to see if field is custom field, to be copied over
				$field_coll_node->$key = $value;
			}
		}
		$field_coll_node->save();
	}
}

function bfi_project_review_action_ensure_unique_project($app) {
	$return = 0;
	$app_qs = entity_load('field_collection_item', array($app
		->field_application_questions[LANGUAGE_NONE][0]['value']));		// Load app and get email
	foreach ($app_qs as $value) {
		$app_email = $value->field_project_app_contact_email[LANGUAGE_NONE][0]['email'];
	}
	$project_query = new EntityFieldQuery();		// Generate list of projects in current year
	$project_query
		->entityCondition('entity_type', 'node')
		->fieldCondition('field_year', 'value', date('Y').'-01-01 00:00:00');
	$projects = $project_query->execute();
	foreach ($projects as $list) {
		foreach ($list as $project) {			// Loop through each submitted project
			$curr_project = node_load($project->nid);
			$field_coll = entity_load('field_collection_item', array($curr_project
				->field_application_questions[LANGUAGE_NONE][0]['value']));
			foreach ($field_coll as $value) {		// Check for email addresses
				if ($value->field_project_app_contact_email[LANGUAGE_NONE][0]['email'] == $app_email) {
					$return++;
				}
			}
		}
	}
	return array(
		'nonu_projects' => $return,
	);
}

function bfi_project_review_action_fetch_project($review_current) {
	$project_current = relation_get_related_entity('entityform', $review_current->entityform_id);
	return array(
		'project_current' => $project_current,
	);
}

function bfi_project_review_action_assign_reviewer_if_not($reviewer) {
	$project = menu_get_object();
	$rids = relation_query('user', $reviewer->uid)
		->related('node', $project->nid)
		->execute();
	$rels = entity_load('relation', array_keys($rids));
	if (!count($rels)) {				// Only do below if no review rels exist yet
		$endpoints = array(				// Adding review relation
			array('entity_type' => 'user', 'entity_id' => $reviewer->uid),
			array('entity_type' => 'node', 'entity_id' => $project->nid),
		);
		$rid = relation_insert('bfc_reviewer_assignment', $endpoints);
		drupal_set_message('<i>'.$reviewer->name.'</i> has been assigned to <i>'.$project->title.'</i>.');
	} else drupal_set_message('Sorry, <i>'.$reviewer->name.'</i> has already been assigned to <i>'.$project->title.'</i>.', 'error');
}

function bfi_project_review_action_take_out_reviewer($reviewer) {
	$project = menu_get_object();
	$rids = relation_query('user', $reviewer->uid)
		->related('node', $project->nid)
		->execute();
	$rels = entity_load('relation', array_keys($rids));
	if (count($rids)) {				// Only do below if review rel(s) exist already
		$rel_wrapper = entity_metadata_wrapper('relation', reset($rels));
		relation_delete($rel_wrapper->rid->value());
		$review_query = new EntityFieldQuery();
		$review_query
			->entityCondition('entity_type', 'relation')
			->propertyCondition('relation_type', 'bfc_evaluation');
		$reviews_all = $review_query->execute();
		foreach ($reviews_all['relation'] as $key => $value) {
			$review_rel = entity_load('relation', array($value->rid));
			foreach($review_rel as $key2 => $review) {
				if (($reviewer->uid == $review->uid) && ($project->nid == $review->endpoints[LANGUAGE_NONE][1]['entity_id'])) {
					relation_delete($review->rid);
				}
			}
		}
		drupal_set_message('<i>'.$reviewer->name.'</i> has been removed from <i>'.$project->title.'</i>.');
	} else drupal_set_message('Sorry, <i>'.$reviewer->name.'</i> is not assigned to <i>'.$project->title.'</i> yet.', 'error');

}

function bfi_project_review_action_dpm_project() {
	$node = menu_get_object();
	if ($node->type == 'project') {
		dpm($node);
		$app = entity_load('field_collection_item', array($node->field_application_questions[LANGUAGE_NONE][0]['value']));
		foreach ($app as $value) {
			$email = $value->field_project_app_contact_email[LANGUAGE_NONE][0]['email'];
		}
		dpm($email);
		$user_query = new EntityFieldQuery();
		$user_query
			->entityCondition('entity_type', 'user')
			->propertyCondition('mail', $email);
		$users = $user_query->execute();
		if (isset($users['user'])) {			// If user w/ email exists, assign to user
			dpm($users['user']);
		} else {								// Else make new user
			dpm('making new user');
		}
	}
}




