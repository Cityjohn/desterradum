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

// $param = $_POST['param_js'];

function my_ajax_function($param) 
{  

  if ( isset($_POST) ) 
  {
    if ( isset($_POST['param_js']) )
    {
        $param = $_POST['param_js'];
        // error_log( "AJAX JS VAR = " . print_r( $param, true ) );
        echo $param;
    }
  }
  wp_die();
}

add_action( 'wp_footer', 'my_page_alert' );
add_action( 'wp_ajax_my_ajax_function', 'my_ajax_function' );
// add_action( 'wp_ajax_nopriv_my_ajax_function', 'my_ajax_function' );

?>