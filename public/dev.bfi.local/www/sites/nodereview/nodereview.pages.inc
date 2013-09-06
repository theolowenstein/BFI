<?php

/**
 * Node Review view callback.
 */
function nodereview_view($nodereview) {
  drupal_set_title(entity_label('nodereview', $nodereview));
  return entity_view('nodereview', array(entity_id('nodereview', $nodereview) => $nodereview), 'full');
}
