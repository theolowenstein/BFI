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
	foreach ($wraps as $key => $eval) {
		foreach ($eval as $field => $value) {
			if(substr($field, 0, 26) == 'field_project_review_score') {
				$bitlet = substr($field, 27);
				if (isset($scores_cum[$bitlet])) $scores_cum[$bitlet] += bfi_project_review_tally_criteria($value);
				else $scores_cum[$bitlet] = 0;
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
	foreach ($score_coll_wrapper as $field => $value) {
		if (substr($field, 0, 24) == 'field_project_review_ave') {
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
				bfi_project_review_average_criteria_scores($project, $curr_round);
				break;
			case 2:
				$user_rel_wrapper->field_project_review_r2_in->set(1);
				$user_rel_wrapper->save();
				bfi_project_review_average_criteria_scores($project, $curr_round);
				break;
			case 3;
				$user_rel_wrapper->field_project_review_r3_in->set(1);
				$user_rel_wrapper->save();
				bfi_project_review_average_criteria_scores($project, $curr_round);
				break;
		}
		
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
			if (substr($key, 0, 6) == 'field_') {
				$field_coll_node->$key = $value;
			}
		}
		$field_coll_node->save();
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




