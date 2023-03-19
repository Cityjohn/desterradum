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


$servername = "edusid.com";
$username = "";
$password = "";
$dbname = "testdb_";

function select_query_subjects()
{
  global $wpdb;
  $wpdb->set_prefix('wp_edusid');

  $currentuser = get_current_user_id();
  // $user_email = 
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


function change_subjects($subjects)
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

function insert_query($start_datetime, $end_datetime, $subject)
{
   global $wpdb;
   $wpdb->set_prefix('wp_edusid');

   $currentuser = get_current_user_id();
   //print to console the subject
    echo '<script>console.log("subject in insert query: ' . $subject . '")</script>';
  //  $user_email = 
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

// check if the page is the timer-pupil page
function my_page_alert() 
{
  $user_id = get_current_user_id();

  if ( is_page( 'timer-pupil' ) ) 
  {
    ?>
      <script src="<?php echo plugin_dir_url( __FILE__ ) . 'Edusid_timer.js'; ?>"></script>
   <?php
   $subs = select_query_subjects();
   change_subjects($subs);
    
  }
}

function my_ajax_function($param) 
{  

  if ( isset($_POST) ) 
  {
    if ( isset($_POST['starttime']) )
    {
        $start_datetime = $_POST['starttime'];
        $end_datetime = $_POST['stoptime'];
        $subject = $_POST['subject'];

        insert_query($start_datetime, $end_datetime, $subject);
               
        
        echo $start_datetime, $end_datetime, $subject;
    }
  }
  wp_die();
}

// add_action( 'wp_footer', 'my_page_alert' );
// add_action( 'wp_ajax_my_ajax_function', 'my_ajax_function' );
// add_action( 'wp_ajax_nopriv_my_ajax_function', 'my_ajax_function' );

?>