<?php


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