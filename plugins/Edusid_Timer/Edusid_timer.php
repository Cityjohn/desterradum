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

$servername = "edusid.com";
$username = "";
$password = "";
$dbname = "testdb_";

function connect_to_wp_db()
{
  global $wpdb;

  $wpdb->set_prefix('wp_edusid');
  $user_email = $wpdb->get_var("SELECT user_email FROM $wpdb->prefix.edu_users WHERE id = 2");  
  echo '<script>console.log("email var type: ' . gettype($user_email) . '")</script>';
  echo '<script>console.log("email var type: ' . $user_email . '")</script>';

  return 0;
}

function select_query()
{
  global $wpdb;

  $currentuser = get_current_user_id();
  $user_email = $wpdb->query(
    $wpdb->prepare(
        "
            SELECT pupil FROM $wpdb->prefix.st_pupil_timeblocks WHERE ID = 1;
        "
    )
  );

  echo '<script>console.log("last query: ' . $wpdb->last_query . '")</script>'; 
}


function select_query_subjects()//$user_id)
{
  global $wpdb;
  $wpdb->set_prefix('wp_edusid');

  $currentuser = get_current_user_id();
  $user_email = $wpdb->query(
    $wpdb->prepare(
        "
        SELECT
        pupil,
        st_pupil_subjects.subject_code as subject_code,
        st_pupil_subjects.subject_name as subject_name
        FROM st_pupil_subjects_meta
        JOIN st_pupil_subjects ON st_pupil_subjects.subject_code = st_pupil_subjects_meta.subject_code
        WHERE st_pupil_subjects_meta.pupil = 1
        "
    )
  );

  $results = $wpdb->get_results( $wpdb->last_query, ARRAY_A ); 
  foreach ($results as $row) 
  {
    echo '<script>console.log("subject: ' . $row['subject_name'] . '")</script>';
  }
  return $results;
}


function change_subjects($subjects)
{
  // foreach ($subjects as $row) 
  // {
  //   echo '<script>console.log("subject in change subs: ' . $row['subject_name'] . '")</script>';
  // }
  foreach ($subjects as $sub) 
  {
    ?>
   <script>  
    var subject_option = <?php echo json_encode($sub['subject_name']); ?>;
    var select_copy = document.getElementById("subject");
    var option = document.createElement("option");
    console.log("subject in change subject: " + subject_option);
    option.text = subject_option;
    option.value = subject_option;
    select_copy.add(option);
  
   </script><?php  
  }
}


function change_subjects2($subjects)
{
   ?>
   <script>  
    var subjects = <?php echo json_encode($subjects); ?>;
    var select_copy = document.getElementById("subject");
         
     for (var i = 0; i < subjects.length; i++) 
     {
       var option = document.createElement("option");
       option.text = subjects[i];
       option.value = subjects[i];
       select_copy.add(option);
     }
   
   </script><?php  
}

function insert_query($start_datetime, $end_datetime, $subject)
{
   global $wpdb;
   $wpdb->set_prefix('wp_edusid');

   $currentuser = get_current_user_id();
   $user_email = $wpdb->query(
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

   change_subjects($subs);//array("beeb", "boob", "art", "music", "sport", "other"));
    
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

add_action( 'wp_footer', 'my_page_alert' );
add_action( 'wp_ajax_my_ajax_function', 'my_ajax_function' );
// add_action( 'wp_ajax_nopriv_my_ajax_function', 'my_ajax_function' );

?>