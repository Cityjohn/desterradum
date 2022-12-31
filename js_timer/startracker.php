<?php
/*
Plugin Name: Startracker
Plugin URI: http://www.desterradum.nl
Description: This is a custom plugin that passes the current user's ID to JavaScript.
Version: 1.0
Author: Marco Olariu
Author URI: http://www.desterradum.nl
License: GPL2
*/

function passuserid() {
  // Get the current user ID
  $user_id = get_current_user_id();

  // Print the user ID as a JavaScript variable
  echo '<script>var current_user_id = ' . $user_id . ';</script>';
}
add_action( 'wp_head', 'passuserid' );

// Close the PHP tag
?>