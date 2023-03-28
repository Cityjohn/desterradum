<?php
/*
Plugin Name: Edusid Timer
Plugin URI: http://www.edusid.com
Description: This is a custom plugin does an ajax call to the server and returns the user id
Version: 1.0
Author: Sebastian Smit
Author URI: http://www.edusid.com
License: none
*/


require_once( plugin_dir_path( __FILE__ ) . 'Grade_counter.php' );
require_once( plugin_dir_path( __FILE__ ) . 'Query_calls.php' );
require_once( plugin_dir_path( __FILE__ ) . 'Edusid_timer.php' );	


$timer = new Edusid_timer();

?>