<?php
/*
Plugin Name: Edusid Timer
Plugin URI: http://www.desterradum.nl
Description: This is a custom plugin does an ajax call to the server and returns the user id
Version: 1.0
Author: Marco Olariu
Author URI: http://www.desterradum.nl
License: GPL2
*/


require_once( plugin_dir_path( __FILE__ ) . 'Grade_counter.php' );
require_once( plugin_dir_path( __FILE__ ) . 'Query_calls.php' );
require_once( plugin_dir_path( __FILE__ ) . 'Edusid_timer.php' );	






$timer = new Edusid_timer();

// add_action( 'wp_footer', array($timer, 'my_page_alert') );
// add_action( 'wp_ajax_my_ajax_function', array($timer, 'my_ajax_function') );

?>