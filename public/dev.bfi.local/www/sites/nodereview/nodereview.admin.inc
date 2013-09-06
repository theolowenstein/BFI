<?php

/**
 * Generates the node review type editing form.
 */
function nodereview_type_form($form, &$form_state, $nodereview_type, $op = 'edit') {

  if ($op == 'clone') {
    $nodereview_type->label .= ' (cloned)';
    $nodereview_type->type = '';
  }

  $form['label'] = array(
    '#title' => t('Label'),
    '#type' => 'textfield',
    '#default_value' => $nodereview_type->label,
    '#description' => t('The human-readable name of this node review type.'),
    '#required' => TRUE,
    '#size' => 30,
  );

  // Machine-readable type name.
  $form['type'] = array(
    '#type' => 'machine_name',
    '#default_value' => isset($nodereview_type->type) ? $nodereview_type->type : '',
    '#maxlength' => 32,
    '#disabled' => $nodereview_type->isLocked() && $op != 'clone',
    '#machine_name' => array(
      'exists' => 'nodereview_types',
      'source' => array('label'),
    ),
    '#description' => t('A unique machine-readable name for this node review type. It must only contain lowercase letters, numbers, and underscores.'),
  );

  $form['description'] = array(
    '#type' => 'textarea',
    '#default_value' => isset($nodereview_type->description) ? $nodereview_type->description : '',
    '#description' => t('Description about the node review type.'),
  );

  $form['actions'] = array('#type' => 'actions');
  $form['actions']['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Save node review type'),
    '#weight' => 40,
  );

  if (!$nodereview_type->isLocked() && $op != 'add' && $op != 'clone') {
    $form['actions']['delete'] = array(
      '#type' => 'submit',
      '#value' => t('Delete node review type'),
      '#weight' => 45,
      '#limit_validation_errors' => array(),
      '#submit' => array('nodereview_type_form_submit_delete')
    );
  }
  return $form;
}

/**
 * Submit handler for creating/editing nodereview_type.
 */
function nodereview_type_form_submit(&$form, &$form_state) {
  $nodereview_type = entity_ui_form_submit_build_entity($form, $form_state);
  // Save and go back.
  nodereview_type_save($nodereview_type);

  // Redirect user back to list of node review types.
  $form_state['redirect'] = 'admin/structure/nodereview-types';
}

function nodereview_type_form_submit_delete(&$form, &$form_state) {
  $form_state['redirect'] = 'admin/structure/nodereview-types/' . $form_state['nodereview_type']->type . '/delete';
}

/**
 * node review type delete form.
 */
function nodereview_type_form_delete_confirm($form, &$form_state, $nodereview_type) {
  $form_state['nodereview_type'] = $nodereview_type;
  // Always provide entity id in the same form key as in the entity edit form.
  $form['nodereview_type_id'] = array('#type' => 'value', '#value' => entity_id('nodereview_type' ,$nodereview_type));
  return confirm_form($form,
    t('Are you sure you want to delete node review type %title?', array('%title' => entity_label('nodereview_type', $nodereview_type))),
    'nodereview/' . entity_id('nodereview_type' ,$nodereview_type),
    t('This action cannot be undone.'),
    t('Delete'),
    t('Cancel')
  );
}

/**
 * node review type delete form submit handler.
 */
function nodereview_type_form_delete_confirm_submit($form, &$form_state) {
  $nodereview_type = $form_state['nodereview_type'];
  nodereview_type_delete($nodereview_type);

  watchdog('nodereview_type', '@type: deleted %title.', array('@type' => $nodereview_type->type, '%title' => $nodereview_type->label));
  drupal_set_message(t('@type %title has been deleted.', array('@type' => $nodereview_type->type, '%title' => $nodereview_type->label)));

  $form_state['redirect'] = 'admin/structure/nodereview-types';
}

/**
 * Page to select node review Type to add new node review.
 */
function nodereview_admin_add_page() {
  $items = array();
  foreach (nodereview_types() as $nodereview_type_key => $nodereview_type) {
    $items[] = l(entity_label('nodereview_type', $nodereview_type), 'nodereview/add/' . $nodereview_type_key);
  }
  return array('list' => array('#theme' => 'item_list', '#items' => $items, '#title' => t('Select type of node review to create.')));
}

/**
 * Add new node review page callback.
 */
function nodereview_add($type) {
  $nodereview_type = nodereview_types($type);

  $nodereview = entity_create('nodereview', array('type' => $type));
  drupal_set_title(t('Create @name', array('@name' => entity_label('nodereview_type', $nodereview_type))));

  $output = drupal_get_form('nodereview_form', $nodereview);

  return $output;
}

/**
 * node review Form.
 */
function nodereview_form($form, &$form_state, $nodereview) {
  $form_state['nodereview'] = $nodereview;

  $form['title'] = array(
    '#type' => 'textfield',
    '#required' => TRUE,
    '#title' => t('Name'),
    '#default_value' => $nodereview->title,
  );

  $form['description'] = array(
    '#type' => 'textarea',
    '#title' => t('Description'),
    '#default_value' => $nodereview->description,
  );

  $form['uid'] = array(
    '#type' => 'value',
    '#value' => $nodereview->uid,
  );

  field_attach_form('nodereview', $nodereview, $form, $form_state);

  $submit = array();
  if (!empty($form['#submit'])) {
    $submit += $form['#submit'];
  }

  $form['actions'] = array(
    '#weight' => 100,
  );

  $form['actions']['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Save Node Review'),
    '#submit' => $submit + array('nodereview_form_submit'),
  );

  // Show Delete button if we edit nodereview.
  $nodereview_id = entity_id('nodereview' ,$nodereview);
  if (!empty($nodereview_id) && nodereview_access('edit', $nodereview)) {
    $form['actions']['delete'] = array(
      '#type' => 'submit',
      '#value' => t('Delete'),
      '#submit' => array('nodereview_form_submit_delete'),
    );
  }

  $form['#validate'][] = 'nodereview_form_validate';

  return $form;
}

function nodereview_form_validate($form, &$form_state) {

}

/**
 * nodereview submit handler.
 */
function nodereview_form_submit($form, &$form_state) {
  $nodereview = $form_state['nodereview'];
  entity_form_submit_build_entity('nodereview', $nodereview, $form, $form_state);
  nodereview_save($nodereview);
  $nodereview_uri = entity_uri('nodereview', $nodereview);
  $form_state['redirect'] = $nodereview_uri['path'];
  drupal_set_message(t('Node Review %title saved.', array('%title' => entity_label('nodereview', $nodereview))));
}

function nodereview_form_submit_delete($form, &$form_state) {
  $nodereview = $form_state['nodereview'];
  $nodereview_uri = entity_uri('nodereview', $nodereview);
  $form_state['redirect'] = $nodereview_uri['path'] . '/delete';
}

/**
 * Delete confirmation form.
 */
function nodereview_delete_form($form, &$form_state, $nodereview) {
  $form_state['nodereview'] = $nodereview;
  // Always provide entity id in the same form key as in the entity edit form.
  $form['nodereview_type_id'] = array('#type' => 'value', '#value' => entity_id('nodereview' ,$nodereview));
  $nodereview_uri = entity_uri('nodereview', $nodereview);
  return confirm_form($form,
    t('Are you sure you want to delete node review %title?', array('%title' => entity_label('nodereview', $nodereview))),
    $nodereview_uri['path'],
    t('This action cannot be undone.'),
    t('Delete'),
    t('Cancel')
  );
}

/**
 * Delete form submit handler.
 */
function nodereview_delete_form_submit($form, &$form_state) {
  $nodereview = $form_state['nodereview'];
  nodereview_delete($nodereview);

  drupal_set_message(t('Node Review %title deleted.', array('%title' => entity_label('nodereview', $nodereview))));

  $form_state['redirect'] = 'nodereview';
}
