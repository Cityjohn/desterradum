<?php

class Calls_To_Query
{
  public $wpdb;
  public $current_user;
  public $subject;

  public function __construct()
  {
    global $wpdb;
    $this->wpdb = $wpdb;
    $this->wpdb->set_prefix('wp_edusid');
    $this->current_user = get_current_user_id();    
  }

  //query the subjects related to the current user and return the subjects as an array
  function select_query_subjects($currentuser)
  {
    if ($currentuser == null)
    {
      $currentuser = get_current_user_id(); // throw error, no user logged in
    }
    $user_email = $this->wpdb->query(
      $this->wpdb->prepare(
          "
          SELECT
          pupil,
          st_pupil_subjects.subject_code as subject_code,
          st_pupil_subjects.subject_name as subject_name
          FROM st_pupil_subjects_meta
          JOIN st_pupil_subjects ON st_pupil_subjects.subject_code = st_pupil_subjects_meta.subject_code
          WHERE st_pupil_subjects_meta.pupil = $this->currentuser;
          "
      )
    );
    $results = $this->wpdb->get_results( $this->wpdb->last_query, ARRAY_A ); 

    return $results;
  }

//insert the timeblock in the database with the corresponding credo-code
function insert_query($start_datetime, $end_datetime, $subject)
{
    //print to console the subject
   echo '<script>console.log("subject in insert query: ' . $subject . '")</script>';
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



}


?>