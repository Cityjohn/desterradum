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



class main
{
    public $edusid_timer;

    public function __construct()
    {
        $this->edusid_timer = new Edusid_timer();
    }       
    public function my_page_alert()
    {
        $this->edusid_timer->my_page_alert();
    }
    public function my_ajax_function()
    {        
        $this->edusid_timer->my_ajax_function();
    }
    public function just_say_hello()
    {        
        $this->edusid_timer->just_say_hello();
    }
}

$main = new main();

add_action( 'wp_footer', array($main, 'my_page_alert') );
add_action( 'wp_ajax_my_ajax_function', array($main, 'my_ajax_function') );





?>