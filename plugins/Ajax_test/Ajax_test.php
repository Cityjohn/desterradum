<?php
/*
Plugin Name: Ajax_test
Plugin URI: http://www.desterradum.nl
Description: This is a custom plugin does an ajax call to the server and returns the user id
Version: 1.0
Author: Marco Olariu
Author URI: http://www.desterradum.nl
License: GPL2
*/

$servername = "desterradum.nl";
$username = "testdb";
$password = ".passwordistan";
$dbname = "testdb_";
$user_id = get_current_user_id();

// $servername = "edusid.com";
// $username = "";
// $password = "";
// $dbname = "testdb_";

function connectToDatabase($servername, $username, $password, $dbname) 
{
  $conn = new mysqli($servername, $username, $password, $dbname); // create a connection
  
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  else {
    echo "Connected successfully";
  }
  return $conn;
}

//$conn = connectToDatabase($servername, $username, $password, $dbname); // Connect to the database
//$conn->close();

// check if the page is the timer-pupil page
function my_page_alert() {
  $user_id = get_current_user_id();
  if ( is_page( 'timer-pupil' ) ) 
  {
    ?>
      <script src="<?php echo plugin_dir_url( __FILE__ ) . 'Ajax_test.js'; ?>"></script>
      <script>
        var user_id = <?php echo $user_id; ?>;
        alert("user id = " + user_id)

        if (user_id == 2) 
        {
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
    if ( isset($_POST['param_js']) )
    {
        $param = $_POST['param_js'];
        // error_log( "AJAX JS VAR = " . print_r( $param, true ) );        
        echo $param;
    }
  }
  wp_die();
}

add_action( 'wp_footer', 'my_page_alert' );
add_action( 'wp_ajax_my_ajax_function', 'my_ajax_function' );
// add_action( 'wp_ajax_nopriv_my_ajax_function', 'my_ajax_function' );

?>