<?php
function my_plugin_enqueue_scripts() 
{
    wp_enqueue_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js', array(), '3.6.0', true );
}

function Contact_Page_Alert()
{
    if ( is_page( 'about' ) )
    {
        echo '<script>console.log("about pagina is bereikt")</script>';
    }
    else if ( is_page( 'pupil-dashboard' ) ) 
    {
        echo '<script>console.log("dashboard pagina is bereikt")</script>';
        ?>
           <script src="<?php echo plugin_dir_url( __FILE__ ) . 'Pupil_chart_render.js'; ?>"></script>
        <?php
    }
    else if ( is_page( 'teacher-dashboard' ) ) 
    {
        echo '<script>console.log("dashboard pagina is bereikt")</script>';
        ?>
           <script src="<?php echo plugin_dir_url( __FILE__ ) . 'Teacher_chart_render.js'; ?>"></script>
        <?php
    }
    else if ( is_page( 'pupil-timer' ) ) 
    {
        echo '<script>console.log("pupil-timer pagina is bereikt")</script>';
        ?>
            <script src="<?php echo plugin_dir_url( __FILE__ ) . 'Edusid_timer.js'; ?>"></script>
        <?php           
    }
}

add_action( 'wp_enqueue_scripts', 'my_plugin_enqueue_scripts' );
add_action( 'wp_footer', 'Contact_Page_Alert' );

?>