<?php

/**
 * Plugin Name: IC Steps Form
 * Description: Simple multi-steps form
 * Plugin URI:  #
 * Version:     1.1
 * Author:      Itclan BD
 * Author URI:  https://itclanbd.com/
 * Text Domain: icsf-steps-form
 * License:     GPL v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

if ( !defined( 'ABSPATH' ) ) {
 exit;
}
// if( ! is_admin() ) {
//     session_start();
// }

if ( !defined( 'ICSF_VERSION' ) ) {
 define( 'ICSF_VERSION', '1.1' );
}

/**
 * Define Constant
 */
define( 'ICSF_FILE', __FILE__ );
define( 'ICSF_DIR_URL', plugin_dir_url( ICSF_FILE ) );
define( 'ICSF_ASSETS', ICSF_DIR_URL . 'assets' );
define( 'ICSF_DIR', __DIR__ );

require ICSF_DIR . '/inc/functions.php';
require ICSF_DIR . '/inc/create-db.php';
require ICSF_DIR . '/inc/Menu.php';
require ICSF_DIR . '/inc/Sub-menu.php';
require ICSF_DIR . '/inc/Status.php';
require ICSF_DIR . '/inc/Subscribers_List_Table.php';
require ICSF_DIR . '/inc/enqueue.php';
require ICSF_DIR . '/inc/role.php';

/**
 * Create shortcode 'ic_steps_form'
 * for load Steps form
 */
add_shortcode( 'ic_steps_form', 'icsf_shortcode' );
function icsf_shortcode( $atts, $content = null ) {
    
    ob_start();
    if ( isset( $_SESSION['registration_data'] ) ) {
        $registration_data = $_SESSION['registration_data'];
    } else {
        $registration_data = array();
    }
   
	include ICSF_DIR . "/inc/shortcode.php";
	return ob_get_clean();
}

register_activation_hook( __FILE__, 'ic_members_activate' );
