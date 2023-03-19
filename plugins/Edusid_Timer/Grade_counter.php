<?php
/*
Plugin Name: Edusid Timer
Plugin URI: http://www.edusid.nl
Description: This is a custom plugin does an ajax call to the server and returns the user id
Version: 1.0
Author: Sebastian Smit
Author URI: http://www.edusid.nl
License: GPL2
*/


class grade_determination
{
  public $grade;
  public $adder;
  public $last_stored_grade;
  public $subject;

  function get_grade(){         return $this->grade;  }
  function get_adder(){         return $this->adder;  }
  function get_wpdb(){          return $this->wpdb;   }  
  function set_grade($grade){   $this->grade = $grade;}
  function set_adder($adder){   $this->adder = $adder;} 
  
  
}




?>