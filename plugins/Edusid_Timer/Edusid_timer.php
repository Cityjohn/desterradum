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


function select_query_subjects($user_id)
{
  global $wpdb;

  $currentuser = get_current_user_id();
  $user_email = $wpdb->query(
    $wpdb->prepare(
        "
            SELECT subject FROM $wpdb->prefix.st_pupil_timeblocks WHERE ID = $user_id;
        "
    )
  );
  echo '<script>console.log("last query: ' . $wpdb->last_query . '")</script>'; 
}

function change_subjects($subjects)
{
   $subjects = array("math", "english", "history", "science", "geography", "art", "music", "sport", "other");
   ?>
   <script>
   var user_id = <?php //echo $user_id; ?>;
   var user_email = 0; <?php //echo $user_email; ?>;
  
   if (user_id == 2) 
   {
     var select_copy = document.getElementById("subject");
     var option = document.createElement("option");
     //for loop with the lengt of the array subjects
     for (var i = 0; i < subjects.length; i++) 
     {
       option.text = subjects[i];
       option.value = subjects[i];
       select_copy.add(option);
     }
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
  // $user_email = connect_to_wp_db();

  // select_query_subjects(2);
  

  if ( is_page( 'timer-pupil' ) ) 
  {
    ?>
      <script src="<?php echo plugin_dir_url( __FILE__ ) . 'Edusid_timer.js'; ?>"></script>
      <script>
        var user_id = <?php echo $user_id; ?>;        
        
        if (user_id == 2) 
        {
          // function change_subjects($subjects);
        var select_copy = document.getElementById("subject");
        var option = document.createElement("option");
        option.text = "math";
        option.value = "math";
        select_copy.add(option);
        }
      </script>
    <?php
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