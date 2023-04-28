<?php

class Edusid_timer
{
  function __construct()
  {
    add_action( 'wp_footer', array($this, 'my_page_alert') );
    add_action( 'wp_ajax_my_ajax_function', array($this, 'my_ajax_function') );
  }

  function enqueue_scripts() 
  {
    wp_enqueue_script( 'my-ajax-script', plugin_dir_url( __FILE__ ) . 'Edusid_timer.js', array('jquery') );    
  }

  //TODO verplaatsen naar queries file
  public function select_query_subjects()
  {
    global $wpdb;
    $wpdb->set_prefix('wp_edusid');

    $currentuser = get_current_user_id();
    $wpdb->query(
      $wpdb->prepare(
          "
          SELECT
          pupil,
          st_pupil_subjects.subject_code as subject_code,
          st_pupil_subjects.subject_name as subject_name
          FROM st_pupil_subjects_meta
          JOIN st_pupil_subjects ON st_pupil_subjects.subject_code = st_pupil_subjects_meta.subject_code
          WHERE st_pupil_subjects_meta.pupil = $currentuser;
          "
      )
    );
    $results = $wpdb->get_results( $wpdb->last_query, ARRAY_A ); 

    return $results;
  }


  public function change_subjects($subjects)
  {
    foreach ($subjects as $sub) 
    {
      ?>
    <script>  
      var subject_option = <?php echo json_encode($sub['subject_name']); ?>;
      var subject_code = <?php echo json_encode($sub['subject_code']); ?>;
      var select_copy = document.getElementById("subject");
      var option = document.createElement("option");
      console.log("subject in change subject: " + subject_option);
      option.text = subject_option;
      option.value = subject_code;
      select_copy.add(option);
    
    </script><?php  
    }
  }

  public function insert_query($start_datetime, $end_datetime, $subject)
  {
    global $wpdb;
    $wpdb->set_prefix('wp_edusid');

    $currentuser = get_current_user_id();
    //print to console the subject
      echo '<script>console.log("subject in insert query: ' . $subject . '")</script>';
    $wpdb->query(
      $wpdb->prepare(
          "
              INSERT INTO $wpdb->prefix.st_pupil_timeblocks (pupil, subject, start_datetime, end_datetime)
              VALUES (%s, %s, %s, %s);
          ",
          $currentuser, $subject, $start_datetime, $end_datetime
      )
    );
    echo '<script>console.log("last query: ' . $wpdb->last_query . '")</script>'; 
  }

  function retrieve_grade_data_pupil()
  {
    global $wpdb;
    $wpdb->set_prefix('wp_edusid');

    $wpdb->query(
      $wpdb->prepare(
          "
          SELECT *
          FROM table_name 
          WHERE pupil = 1;
          "
      )
    );
    $results = $wpdb->get_results( $wpdb->last_query, ARRAY_A ); 
    
    echo '<script>console.log("results: ' . $results . '")</script>';


    // return $results;  
  }



  // check if the page is the timer-pupil page
  public function my_page_alert() 
  {
    $user_id = get_current_user_id();

    echo '<script>console.log("userid: ' . $user_id . '")</script>';

    if ( is_page( 'contact' ) )
    {
      echo '<script>console.log("this is a message")</script>';
    } 
    

    if ( is_page( 'pupil-timer' ) ) 
    {
      
      ?>
        <script src="<?php echo plugin_dir_url( __FILE__ ) . 'Edusid_timer.js'; ?>"></script>
    <?php
    $subs = $this->select_query_subjects();
    //print to console the subject
    echo '<script>console.log("subject in my_page_alert: ' . $subs[0]['subject_name'] . '")</script>';

    $this->change_subjects($subs);
      
    }

  }


  public function my_ajax_function($param) 
  {  

    if ( isset($_POST) ) 
    {
      if ( isset($_POST['starttime']) )
      {
          $start_datetime = $_POST['starttime'];
          $end_datetime = $_POST['stoptime'];
          $subject = $_POST['subject'];

          $this->insert_query($start_datetime, $end_datetime, $subject);             
          
          echo $start_datetime . ' ' . $end_datetime . ' ' . $subject;
      }
    }
    wp_die();
  }

}

?>