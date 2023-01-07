<?php
/*
Plugin Name: Ajax_test
Plugin URI: http://www.desterradum.nl
Description: This is a custom plugin does an ajax call to the server and returns the user id
Version: 1.0
Author: Marco Olariu
Author URI: http://www.desterradum.nl
License: GPL2
*/


function my_page_alert() {
  $user_id = get_current_user_id();
  if ( is_page( 'timer-pupil' ) ) 
  {
    ?>
      <script src="<?php echo plugin_dir_url( __FILE__ ) . 'Ajax_test.js'; ?>"></script>
    <?php
  }
}

function my_ajax_function() 
{  
  $test_message = " guess I'll return a value";
  return $test_message;
  wp_die();
}

add_action( 'wp_footer', 'my_page_alert' );
add_action( 'wp_ajax_my_ajax_function', 'my_ajax_function' );
// add_action( 'wp_ajax_nopriv_my_ajax_function', 'my_ajax_function' );

?>