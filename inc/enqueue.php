<?php


/**
 * Load assets for front-end
 */
add_action( 'wp_enqueue_scripts', 'ICSF_frontend_assets' );
function ICSF_frontend_assets() {

	// TODO: 1. only load this on membership page
	wp_enqueue_style( 'icsf-vendor-css', ICSF_ASSETS . '/css/vendor-min.css', null, ICSF_VERSION, 'all' );
	wp_enqueue_script( 'icsf-vendor-script', ICSF_ASSETS . '/js/vendor-min.js', ['jquery'], ICSF_VERSION, true );
	wp_enqueue_style( 'icsf-frontend-style', ICSF_ASSETS . '/css/front-style.css', null, ICSF_VERSION, 'all' );
	wp_register_script( 'jquery-validator', ICSF_ASSETS . '/js/jquery.validate.min.js', array( 'icsf-vendor-script' ), null, true );
	wp_enqueue_script( 'icsf-frontend-script', ICSF_ASSETS . '/js/front.js', ['jquery', 'jquery-validator'], ICSF_VERSION, true );

	wp_localize_script( 'icsf-frontend-script', 'myObj', array(
		'ajaxUrl' => admin_url( 'admin-ajax.php' ),
		'nonce'   => wp_create_nonce( 'form-nonce' ),
	) );

}

/**
 * Load assets for admin
 */
add_action( 'admin_enqueue_scripts', 'ICSF_admin_assets' );
function ICSF_admin_assets( $hook ) {
 if ( $hook == 'toplevel_page_ic-register-users' || $hook == 'ic-members_page_ic-register-user-status' ) {
  wp_enqueue_style( 'icsf-admin-main', ICSF_ASSETS . '/css/admin-style.css', null, ICSF_VERSION, 'all' );
//   wp_enqueue_script( 'icsf-admin-script', ICSF_ASSETS . '/js/admin.js', ['jquery'], ICSF_VERSION, true );

  wp_enqueue_script( 'icsf-admin-scripts', ICSF_ASSETS . '/js/admin.js', ['jquery'], ICSF_VERSION, true );
  wp_localize_script( 'icsf-admin-scripts', 'myTableObj', array(
   'ajaxUrl' => admin_url( 'admin-ajax.php' ),
   'nonce'   => wp_create_nonce( 'form-nonce' ),
  ) );

  wp_localize_script( 'icsf-admin-scripts', 'myTableObjDelete', array(
    'ajaxUrl' => admin_url( 'admin-ajax.php' ),
    'nonce'   => wp_create_nonce( 'form-nonce' ),
    'confirm' => __('Are you sure, want to delete?', 'icsf'),
   ) );

   wp_localize_script( 'icsf-admin-scripts', 'myTableObjUpdate', array(
    'ajaxUrl' => admin_url( 'admin-ajax.php' ),
    'nonce'   => wp_create_nonce( 'form-nonce' ),
    'confirm' => __('Are you sure?', 'icsf'),
   ) );

   wp_localize_script( 'icsf-admin-scripts', 'myTableStatusDelete', array(
    'ajaxUrl' => admin_url( 'admin-ajax.php' ),
    'nonce'   => wp_create_nonce( 'form-nonce' ),
    'confirm' => __('Are you sure, want to delete?', 'icsf'),
   ) );

   wp_localize_script( 'icsf-admin-scripts', 'confirmEmailSendObj', array(
    'ajaxUrl' => admin_url( 'admin-ajax.php' ),
    'nonce'   => wp_create_nonce( 'form-nonce' ),
    'confirm' => __('Are you sure, want to confirm?', 'icsf'),
   ) );

   wp_localize_script( 'icsf-admin-scripts', 'rejectEmailSendObj', array(
    'ajaxUrl' => admin_url( 'admin-ajax.php' ),
    'nonce'   => wp_create_nonce( 'form-nonce' ),
    'confirm' => __('Are you sure, want to reject?', 'icsf'),
   ) );

 }

}