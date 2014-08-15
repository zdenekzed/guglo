<?php

/**
The function is called before the output of the form of new node creation
variable $node contains information about the node that is being repinned
the variable contains additional data except standard data
$rnode->did - nid of the original node that is being repinned
$node->gid - nid of the node that is being repinned
Use the following function to specify the composition of variable $node 
drupal_set_message('<pre>'. check_plain(print_r($node, 1)) .'</pre>');
*/
function hook_pinboard_helper_repin(&$node) {
  $node->name = 'Admin';
  drupal_set_message('<pre>'. check_plain(print_r($node, 1)) .'</pre>');
}


/**
The function is called after performing all procedures in function pinboard_helper_node_presave
variable $node contains an information about a node
the variable contains additional data except standard data
$node->bid - id of a board
Use the following function to specify the composition of variable $node 
drupal_set_message('<pre>'. check_plain(print_r($node, 1)) .'</pre>');
*/
function hook_pinboard_helper_node_presave(&$node) {
  drupal_set_message('<pre>'. check_plain(print_r($node, 1)) .'</pre>');
}


/**
The function is called before performing all procedures in function pinboard_helper_save_pinboard
variable $node contains an information about a node
Use the following function to specify the composition of variable $node 
drupal_set_message('<pre>'. check_plain(print_r($node, 1)) .'</pre>');
*/
function hook_pinboard_helper_save_in(&$node) {
  drupal_set_message('<pre>'. check_plain(print_r($node, 1)) .'</pre>');
}


/**
The function is called after performing all procedures in function pinboard_helper_save_pinboard
variable $node contains an information about a node
Use the following function to specify the composition of variable $node
drupal_set_message('<pre>'. check_plain(print_r($node, 1)) .'</pre>');
*/
function hook_pinboard_helper_save_out(&$node) {
  drupal_set_message('<pre>'. check_plain(print_r($node, 1)) .'</pre>');
}

