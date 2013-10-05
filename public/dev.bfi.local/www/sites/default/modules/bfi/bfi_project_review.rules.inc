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

function bfi_project_review_tally_criteria(&$field) {
	$rating = 0;
	if (isset($field['und'][0]['user'])) {
		$rating = $field['und'][0]['user'];
	} else if (isset($field['und'][0]['rating'])) {
		$rating = $field['und'][0]['rating'];
	}
	return $rating;
}

function bfi_project_review_set_averages(&$field, $cumulative, $count) {
	$average = round($cumulative/$count)/10;
	$field[LANGUAGE_NONE][0]['user'] = $average;
	$field[LANGUAGE_NONE][0]['average'] = $average;
	return $average;
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
		if ($value->field_project_round_eval['und'][0]['value'] == $round) {
			$eval_ids[] = $value->endpoints['und'][0]['entity_id'];
		}
	}
	$evals = entity_load('entityform', $eval_ids);
	dpm(count($evals).' Evaluations');

	$wrap_ids = array();
	foreach($evals as $key => $value) {					// Getting IDs of criteria evaluation field collections
		if (isset($value->field_project_review_score_wrap['und'][0]['value'])) {
			$wrap_ids[] = $value->field_project_review_score_wrap['und'][0]['value'];
		}
	}
	$wraps = entity_load('field_collection_item', $wrap_ids);
	$wrap_count = count($wraps);
	dpm($wrap_count.' Wraps');

	// Tallying up criteria scores
	$crit_vis = $crit_comp = $crit_antic = $crit_ecol = $crit_feas = $crit_verif = $crit_rep = 0;
	foreach($wraps as $key => $value) {
		$crit_vis += bfi_project_review_tally_criteria($value->field_project_review_score_vis);
		$crit_comp += bfi_project_review_tally_criteria($value->field_project_review_score_comp);
		$crit_antic += bfi_project_review_tally_criteria($value->field_project_review_score_antic);
		$crit_ecol += bfi_project_review_tally_criteria($value->field_project_review_score_ecol);
		$crit_feas += bfi_project_review_tally_criteria($value->field_project_review_score_feas);
		$crit_verif += bfi_project_review_tally_criteria($value->field_project_review_score_verif);
		$crit_rep += bfi_project_review_tally_criteria($value->field_project_review_score_rep);
	}

	if (isset($project->field_project_review_score_rds[LANGUAGE_NONE][$round - 1])) {			// If Average for round ($round - 1)already exists, update it
		$score_coll_id = $project->field_project_review_score_rds[LANGUAGE_NONE][$round - 1]['value'];
		$score_coll = entity_load('field_collection_item', array($score_coll_id)); // Load that field collection item, one coll back for the nested field collection

		dpm($score_coll);

//		$score_coll_wrap->save();		// For some reason, this isn't working. Figure out why.
	} else {		// Else, make new field collection
		$new_score_coll = entity_create('field_collection_item', array('field_name' => 'field_page_collection1')); // Create new field collection item.
		$new_score_coll->setHostEntity('node', $node); // Attach it to the node.
		$new_score_coll->field_page_collection1_text1[LANGUAGE_NONE][0]['value'] = 'some value for text field 1'; // Fill value for field_page_collection1_text1.
		$new_score_coll->field_page_collection1_text2[LANGUAGE_NONE][0]['value'] = 'some value for text field 2'; // Fill value for field_page_collection1_text2.
		$new_score_coll->save(); // Save field-collection item.
	}
	dpm('Vis '.$ave_vis.', Comp '.$ave_comp.', Antic '.$ave_antic.', Ecol '.$ave_ecol.', Feas '.$ave_feas.', Verif '.$ave_verif.', Rep '.$ave_rep);
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




