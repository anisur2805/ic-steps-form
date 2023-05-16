<?php

function icsf_formHandler( $user_id ) {

    if ( isset( $_POST['submit'] ) ) {

        $name                           = sanitize_text_field( $_POST['name'] );
        $email                          = sanitize_text_field( $_POST['email'] );
        $userName                       = sanitize_text_field( $_POST['user-name'] );
        $phone                          = sanitize_text_field( $_POST['phone'] );
        $presentAddr                    = sanitize_text_field( $_POST['present-addr'] );
        $permanentAddr                  = sanitize_text_field( $_POST['permanent-addr'] );
        $nidNo                          = sanitize_text_field( $_POST['nid-no'] );
        $fb_url                         = sanitize_text_field( $_POST['fburl'] );
        $linkedin_url                   = sanitize_text_field( $_POST['linkedinurl'] );
        $dob                            = sanitize_text_field( $_POST['date'] );
        $business_name                  = sanitize_text_field( $_POST['business-name'] );
        $position_name                  = sanitize_text_field( $_POST['position-name'] );
        $business_email                 = sanitize_text_field( $_POST['business-email'] );
        $business_phone                 = sanitize_text_field( $_POST['business-phone'] );
        $url                            = sanitize_text_field( $_POST['url'] );
        $last_educational_qualification = sanitize_text_field( $_POST['last-educational'] );
        $fathers_name                   = sanitize_text_field( $_POST['father-name'] );
        $mothers_name                   = sanitize_text_field( $_POST['mother-name'] );
        $is_married                     = sanitize_text_field( $_POST['isMarried'] );
        $spouse_name                    = sanitize_text_field( $_POST['spouse-name'] );
        $anniversary                    = sanitize_text_field( $_POST['anniversary'] );
        $haveChild                      = sanitize_text_field( $_POST['have-children'] );

        $first_child_name   = sanitize_text_field( $_POST['first-kids-name'] );
        $first_child_dob    = sanitize_text_field( $_POST['first-kids-dob'] );
        $first_child_gender = sanitize_text_field( $_POST['first-kids-gender'] );

        $second_child_name   = sanitize_text_field( $_POST['second-kids-name'] );
        $second_child_dob    = sanitize_text_field( $_POST['second-kids-dob'] );
        $second_child_gender = sanitize_text_field( $_POST['second-kids-gender'] );

        $third_child_name   = sanitize_text_field( $_POST['third-kids-name'] );
        $third_child_dob    = sanitize_text_field( $_POST['third-kids-dob'] );
        $third_child_gender = sanitize_text_field( $_POST['third-kids-gender'] );
        $membership_type = sanitize_text_field( $_POST['membership_type'] );

        $photo = ic_upload_file( 'photo' );
        $nid   = ic_upload_file( 'nid' );
        $trade = ic_upload_file( 'trade' );
        $cv    = ic_upload_file( 'cv' );

        // var_dump($photo);

        // if( ! wp_verify_nonce( $_POST['nonce'], 'form-nonce' ) ) {
        //     wp_send_json_error([
        //         'message' => 'Nonce verification failed'
        //     ]);
        // }

        global $wpdb;
        $table_name = $wpdb->prefix . 'ic_members';
        $id         = $wpdb->insert(
            $table_name,
            [
                'name'                           => $name,
                'user_id'                        => $user_id,
                'status'                        =>  0,
                'user_name'                      => $userName,
                'email'                          => $email,
                'phone'                          => $phone,
                'phone'                          => $phone,
                'present_addr'                   => $presentAddr,
                'permanent_addr'                 => $permanentAddr,
                'nid_no'                         => $nidNo,
                'created_at'                     => current_time( 'mysql' ),
                'fb_url'                         => $fb_url,
                'linkedin_url'                   => $linkedin_url,
                'dob'                            => $dob,
                'business_name'                  => $business_name,
                'position_name'                  => $position_name,
                'business_email'                 => $business_email,
                'business_phone'                 => $business_phone,
                'url'                            => $url,
                'last_educational_qualification' => $last_educational_qualification,
                'fathers_name'                   => $fathers_name,
                'mothers_name'                   => $mothers_name,
                'is_married'                     => $is_married,
                'spouse_name'                    => $spouse_name,
                'anniversary'                    => $anniversary,
                'haveChild'                      => $haveChild,
                'first_child_name'               => $first_child_name,
                'first_child_dob'                => $first_child_dob,
                'first_child_gender'             => $first_child_gender,
                'second_child_name'              => $second_child_name,
                'second_child_dob'               => $second_child_dob,
                'second_child_gender'            => $second_child_gender,
                'third_child_name'               => $third_child_name,
                'third_child_dob'                => $third_child_dob,
                'third_child_gender'             => $third_child_gender,
                'membership_type'                => $membership_type,
                'photo'                          => $photo,
                'nid'                            => $nid,
                'trade_license'                  => $trade,
                'cv'                             => $cv,
            ],
            [
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
            ]
        );
    }

}

// add_action( 'wp_ajax_icsf_formHandler', 'icsf_formHandler' );
// add_action( 'wp_ajax_nopriv_icsf_formHandler', 'icsf_formHandler' );

add_action( 'user_register', 'icsf_formHandler' );
add_action( 'init', 'ic_register_user' );
function ic_register_user() {

    if( is_admin() ) {
        return;
    }

    if ( isset( $_POST['submit'] ) ) {

        $nonce = isset( $_POST['ic_register_name'] ) ? $_POST['ic_register_name'] : '';

        if ( !wp_verify_nonce( $nonce, 'ic_register_action' ) ) {
            wp_send_json_error( [
                'error' => 'something went wrong',
            ] );
        }

        $email              = sanitize_email( $_POST['email'] );
        $password           = sanitize_text_field( $_POST['pass'] );
        $name               = sanitize_text_field( $_POST['name'] );
		$username           = sanitize_text_field( $_POST['user-name'] );
		$business_name      = sanitize_text_field( $_POST['business-name'] );
		$phone              = sanitize_text_field( $_POST['phone'] );
        $user_id            = username_exists( $email );

        if ( ! $user_id && false == email_exists( $email ) ) {
            $user_id = wp_create_user( $email, $password, $email );

            // send mail for user
            // $user_message = __( 'Thanks for register, we will back to you ASAP');
            $headers = array( 'Content-Type: text/html; charset=UTF-8' );
            // wp_mail( $email, $user_message, $headers );

            $get_message         = get_option('user_message');
            $get_message_subject = get_option('user_message_subject');

            // $user_message = ( ! isset( $get_message ) ) ? __( 'Awesome, Thank you for connecting with us, shortly we will get back to you.' ) : $get_message;
            $headers      = array( 'Content-Type: text/html; charset=UTF-8' );
            // $user_subject = ( ! isset( $get_message_subject ) ) ? __( 'New User Registration Notification.' ) : $get_message_subject;
            $user_subject = 'We received your request';
            // $user_message = 'Hi ' . $name . ',<br/>
            // Thank you for submitting a membership form to the Founder’s Community Club Ltd. This email confirms that we have received your request. <br/>            
            // A member of our team will get back to you shortly. <br/>            
            // Thank you <br/>
            // Team FCCL';
            // wp_mail( $email, $user_subject, $user_message, $headers );

            $user_message = 'Hi ' . $name . ',\n
            Thank you for submitting a membership form to the Founder’s Community Club Ltd. This email confirms that we have received your request. \n \n \n            
            A member of our team will get back to you shortly. \n \n \n
            Thank you \n
            Team FCCL';

            wp_mail( $email, $user_subject, $user_message, $headers );


            // // send mail for admin
            // $admin_email   = get_option( 'admin_email' );
            // $message       = 'Someone has been registered successfully';
            // $admin_subject = __( 'Thanks for Registering' );

            // wp_mail( $admin_email, $admin_subject, $message, $headers );

            // header( "Location: " . add_query_arg( array(
            //     'registration' => 'success',
            // ), $_SERVER['REQUEST_URI'] ) );

            // exit;


			// Registered time: ;
            $admin_email   = get_option( 'admin_email' );
            $message       = "New user has registered to your website <br/>
			User name: {$username} <br/>
			Company name: $business_name <br/>
			Email: $email <br/>
			Phone no: $phone";
            // $admin_subject = __( 'Thanks for Registering' );
            $admin_subject = 'Registered new user: ['.$email.']';
            wp_mail( $admin_email, $admin_subject, $message, $headers );

            header( "Location: " . add_query_arg( array(
                'registration' => 'success',
            ), $_SERVER['REQUEST_URI'] ) );

            exit;


        } else {
            // add_query_arg( array(
            //     'registration' => 'failed',
            // ), site_url('/membership') );
            // header("Location: " . $_SERVER['REQUEST_URI']);
            // exit;

            header( "Location: " . add_query_arg( array(
                'registration' => 'failed',
            ), $_SERVER['REQUEST_URI'] ) );

            session_start();
            $_SESSION['registration_data'] = $_POST;

            exit;

        }
    }

}

function ic_upload_file( $image = '' ) {
    if ( isset( $_FILES[$image] ) && $_FILES[$image]['error'] == UPLOAD_ERR_OK ) {
        $image_name    = $_FILES[$image]['name'];
        $temp          = explode( '.', $image_name );
        $new_file_name = generateUuidV4() . '.' . end( $temp );
        $upload_dir    = wp_upload_dir();
        move_uploaded_file( $_FILES[$image]['tmp_name'], $upload_dir['path'] . '/' . $new_file_name );
        return $upload_dir['subdir'] . '/' . $new_file_name;
    }
}

function generateUuidV4() {
    $data    = openssl_random_pseudo_bytes( 16 );
    $data[6] = chr( ord( $data[6] ) & 0x0f | 0x40 ); // set version to 4
    $data[8] = chr( ord( $data[8] ) & 0x3f | 0x80 ); // set variant

    return vsprintf( '%s%s-%s-%s-%s-%s%s%s', str_split( bin2hex( $data ), 4 ) );
}

// add_action('wp_ajax_customHandler', 'customHandler');
// add_action('wp_ajax_nopriv_customHandler', 'customHandler');
// function customHandler(){
//     echo '<pre>';
//           print_r( $_POST );
//     echo '</pre>';
//     wp_send_json_success(['data'=> 'hello']);
// }


/**
 * Ajax call for query and display user details in modal
 */
add_action('wp_ajax_display_single_user', 'display_single_user');
add_action('wp_ajax_nopriv_display_single_user', 'display_single_user');
function display_single_user() {
    $data_id = sanitize_key( $_POST['data_id'] ); ?>
    
    <div class="modal show">
        <div class="modal-overlay modal-toggle"></div>
        <div class="modal-wrapper modal-transition">
        <div class="modal-header">
            <button class="modal-close modal-toggle"><span class="dashicons dashicons-no-alt"></span></button>
            <h2 class="modal-heading">Details of User</h2>
        </div>

        <div class="modal-body">
            <div class="modal-content">                
                <?php
                    global $wpdb;
                    $table_name = $wpdb->prefix . 'ic_members';
                    $query      = "SELECT * FROM {$table_name} WHERE user_id = " . $data_id;
                    $results    = $wpdb->get_results( $query, ARRAY_A );
                    
                    foreach ( $results as $result ) {
                        echo '<div>';
                        echo '<div><h3>Name</h3> ' . $result['name'] . '</div>';
                        echo '<div><h3>Email</h3>' . $result['email'] . '</div>';
                        echo '<div><h3>Date of birth</h3>' . $result['dob'] . '</div>'; 
                        echo '<div><h3>Phone</h3>' . $result['phone'] . '</div>';
                        echo '<div><h3>Status</h3>' . ( $result['status'] == 0 ? 'Unpaid' : 'Paid' ) . '</div>';
                        
                        echo '<div><h3>Business Name</h3>' . $result['business_name'] . '</div>';
                        echo '<div><h3>Business Position</h3>' . $result['position_name'] . '</div>';
                        echo '<div><h3>Business Email</h3>' . $result['business_email'] . '</div>';
                        echo '<div><h3>Business Phone</h3>' . $result['business_phone'] . '</div>';
                        echo '<div><h3>Business URL</h3>' . '<a href="'.$result['url'] . '">'.$result['linkedin_url'].'</a></div>';

                        echo '<div><h3>Present Address</h3>' . $result['present_addr'] . '</div>';
                        echo '<div><h3>Last Educational Qua.</h3>' . $result['last_educational_qualification'] . '</div>';
                        echo '<div><h3>Permanent Address</h3>' . $result['permanent_addr'] . '</div>';

                        echo '<div><h3>Father\'s Name</h3>' . $result['fathers_name'] . '</div>';
                        echo '<div><h3>Mother\'s Name</h3>' . $result['mothers_name'] . '</div>';
                        echo '<div><h3>Married?</h3>' . ( $result['is_married'] == '1' ? 'Yes' : 'No') . '</div>';

                        if( $result['is_married'] == '1' ) {
                            echo '<div><h3>Spouse Name?</h3>' . $result['spouse_name'] . '</div>';
                            echo '<div><h3>Marriage Anniversary</h3>' . $result['anniversary'] . '</div>';
                            echo '<div><h3>Have children?</h3>' . $result['haveChild'] . '</div>';

                            echo '<div><h3>First Kid\'s Name</h3>' . $result['first_child_name'] . '</div>';
                            echo '<div><h3>First Kid\'s DOB</h3>' . $result['first_child_dob'] . '</div>';
                            echo '<div><h3>First Kid\'s Gender</h3>' . $result['first_child_gender'] . '</div>';

                            echo '<div><h3>Second Kid\'s Name</h3>' . $result['second_child_name'] . '</div>';
                            echo '<div><h3>Second Kid\'s DOB</h3>' . $result['second_child_dob'] . '</div>';
                            echo '<div><h3>Second Kid\'s Gender</h3>' . $result['second_child_gender'] . '</div>';

                            echo '<div><h3>Third Kid\'s Name</h3>' . $result['third_child_name'] . '</div>';
                            echo '<div><h3>Third Kid\'s DOB</h3>' . $result['third_child_dob'] . '</div>';
                            echo '<div><h3>Third Kid\'s Gender</h3>' . $result['third_child_gender'] . '</div>';
                        }

                        echo '<div><h3>NID</h3>' . $result['nid_no'] . '</div>';
                        echo '<div><h3>Facebook Link</h3>' . '<a target="_blank" href="'. esc_url( $result['fb_url'] ) . '">'.$result['fb_url'].'</a></div>';
                        echo '<div><h3>Linked In Link</h3>' . '<a target="_blank" href="'. esc_url( $result['linkedin_url'] ) . '">'.$result['linkedin_url'].'</a></div>';

                        echo '<div><h3>Photo</h3>' . '<img width="100" src="'. esc_attr( wp_upload_dir()['baseurl'] . $result['photo']) .'" alt="My Image"></div>';
                        echo '<div><h3>NID</h3>' . '<img width="100" src="'. esc_attr( wp_upload_dir()['baseurl'] . $result['nid'] ).'" /></div>';
                        echo '<div><h3>Trade License</h3>' . '<img width="100" src="'. esc_attr( wp_upload_dir()['baseurl'] . $result['trade_license'] ).'" /></div>';
                        echo '<div><h3>CV</h3>' . '<a href="'. esc_attr( wp_upload_dir()['baseurl'] . $result['cv'] ).'" download>Download CV</a></div>';

                        echo '</div>';
                    }
                ?> 
            </div>
        </div>
        </div>
    </div>

    <?php
    wp_die();
}

/**
 * Ajax call for delete user in list table based on `ID`
 */
add_action('wp_ajax_icsf_delete_user', 'icsf_delete_user');
add_action('wp_ajax_nopriv_icsf_delete_user', 'icsf_delete_user');
function icsf_delete_user() {
    $data_id = sanitize_key( $_POST['data_id'] ); ?>
            
    <?php
        global $wpdb;
        $table_name = $wpdb->prefix . 'ic_members';

        $wpdb->delete($wpdb->users, array('ID' => $data_id));
        $wpdb->delete( $table_name, array('user_id' => $data_id));

        $headers = array( 'Content-Type: text/html; charset=UTF-8' );
        $query = $wpdb->prepare("SELECT * FROM {$wpdb->prefix}ic_members WHERE user_id = %d", $data_id);
        $results = $wpdb->get_results($query);
        $email = $results['email'];

        $get_delete_message         = get_option('user_delete_message');
        $get_delete_message_subject = get_option('user_delete_message_subject');

        $user_message = __('We are sorry to');
        $headers      = array( 'Content-Type: text/html; charset=UTF-8' );
        $user_subject = __( 'User account delete notification.' );
        wp_mail( $email, $user_subject, $user_message, $headers );
        
    ?>

    <?php
    wp_die();
}

/**
 * Ajax call for delete user status in list table based on `ID`
 */
add_action('wp_ajax_icsf_delete_user_status', 'icsf_delete_user_status');
add_action('wp_ajax_nopriv_icsf_delete_user_status', 'icsf_delete_user_status');
function icsf_delete_user_status() {
    $data_id = sanitize_key( $_POST['data_id'] ); ?>
            
    <?php
        global $wpdb;
        $table_name = $wpdb->prefix . 'ic_user_status';
        $wpdb->delete( $table_name, array('id' => $data_id));
        
    ?>

    <?php
    wp_die();
}

// Add new status column in database
add_action( 'plugins_loaded', 'ic_members_add_status_column' );
function ic_members_add_status_column() {
    global $wpdb;

    $current_version = ICSF_VERSION;
    $next_version = '1.5';
    $ic_members_table = $wpdb->prefix . 'ic_members';

    $installed_version = get_option('ic_members_version');

    if ($installed_version != $next_version) {
        $wpdb->query("ALTER TABLE $ic_members_table ADD COLUMN status varchar(5) DEFAULT NULL");
        $wpdb->query("ALTER TABLE $ic_members_table ADD COLUMN created_at DATETIME NOT NULL");
        $wpdb->query("ALTER TABLE $ic_members_table ADD COLUMN membership_type varchar(50) DEFAULT NULL");

        update_option('ic_members_version', $next_version);
    }
}

/**
 * Ajax call for update user status in list table based on `ID`
 */
add_action('wp_ajax_icsf_update_user', 'icsf_update_user');
add_action('wp_ajax_nopriv_icsf_update_user', 'icsf_update_user');
function icsf_update_user() {

    // echo '<pre>';
    //       print_r( $_POST );
    // echo '</pre>';
    $data_id = sanitize_key( $_POST['data_id'] );
    $status = sanitize_key( $_POST['status'] );
    
    global $wpdb;
    $table_name = $wpdb->prefix . 'ic_members';
    $table_status = $wpdb->prefix . 'ic_user_status';

    // Update from ic_members table
    $wpdb->update(
        $table_name,
        array('status' => $status),
        array('user_id' => $data_id)
    );

    // $wpdb->update(
    //     $table_status,
    //     array('status' => 1),
    //     array('user_id' => $data_id)
    // );
        
    wp_send_json_success([
        'status' => __('Paid', 'icsf-steps-form'),
        'user_id' => $data_id,
        'disabled' => true,
        'status' => $status
    ]);
}

// reuseable checking function 
function fieldCheck( $key ) {
    if ( isset( $_SESSION['registration_data'][ $key ])) {
        $key = sanitize_text_field($_SESSION['registration_data'][ $key ]);
    } else {
        $key = '';
    }

    return $key;
}

// reset session if the registration process is sucess
if ( isset( $_GET['registration'] ) && $_GET['registration'] == 'success' ) {
    if ( isset( $_SESSION['registration_data'] ) ) {
        $_SESSION['registration_data'] = [];
    }
}

// handle the form submit for user registration
add_action( 'admin_init', 'icsf_user_message' );
function icsf_user_message() {

    if (isset($_POST['icsf_action']) && $_POST['icsf_action'] == 1) {

        if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'user_message' ) ) {
            wp_die('Invalid nonce. Form submission not allowed.');
        }

        $message_subject = sanitize_text_field( $_POST['ic_user_message_subject'] );
        $message = sanitize_textarea_field( $_POST['ic_user_message'] );

        update_option( 'user_message', $message );
        update_option( 'user_message_subject', $message_subject );
        
    }
}

// handle the form submit for admin during registration
add_action( 'admin_init', 'icsf_admin_action' );
function icsf_admin_action() {

    if (isset($_POST['icsf_admin_action']) && $_POST['icsf_admin_action'] == 1) {

        if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'admin_message' ) ) {
            wp_die('Invalid nonce. Form submission not allowed.');
        }

        $subject = sanitize_text_field( $_POST['ic_admin_message_subject'] );
        $message = sanitize_textarea_field( $_POST['ic_admin_message'] );

        update_option( 'ic_admin_message', $message );
        update_option( 'ic_admin_message_subject', $subject );
        
    }
}

// handle the form submit for User Confirmation
add_action( 'admin_init', 'icsf_confirm_action' );
function icsf_confirm_action() {

    if (isset($_POST['icsf_confirm_action']) && $_POST['icsf_confirm_action'] == 1) {

        if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'user_confirm_message' ) ) {
            wp_die('Invalid nonce. Form submission not allowed.');
        }

        $subject = sanitize_text_field( $_POST['get_confirm_message_subject'] );
        $message = sanitize_textarea_field( $_POST['get_confirm_message'] );

        update_option( 'get_confirm_message', $message );
        update_option( 'get_confirm_message_subject', $subject );
        
    }
}

// handle the form submit for User Confirmation
add_action( 'admin_init', 'icsf_reject_action' );
function icsf_reject_action() {

    if (isset($_POST['icsf_reject_action']) && $_POST['icsf_reject_action'] == 1) {

        if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'user_reject_message' ) ) {
            wp_die('Invalid nonce. Form submission not allowed.');
        }

        $subject = sanitize_text_field( $_POST['ic_user_reject_message_subject'] );
        $message = sanitize_textarea_field( $_POST['ic_user_reject_message'] );

        update_option( 'ic_user_reject_message', $message );
        update_option( 'ic_user_reject_message_subject', $subject );
        
    }
}

// handle the form submit for user delete message
add_action( 'admin_init', 'icsf_user_delete_message' );
function icsf_user_delete_message() {

    if (isset($_POST['icsf_delete_action']) && $_POST['icsf_delete_action'] == 1) {

        if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'user_delete_message' ) ) {
            wp_die('Invalid nonce. Form submission not allowed.');
        }

        $message_subject = sanitize_text_field( $_POST['ic_user_delete_message_subject'] );
        $message = sanitize_textarea_field( $_POST['ic_user_delete_message'] );

        update_option( 'user_delete_message', $message );
        update_option( 'user_delete_message_subject', $message_subject );
        
    }
}

// handle the form submit for user status
add_action( 'admin_init', 'icsf_user_status' );
function icsf_user_status() {

    if (isset($_POST['icsf_status']) && $_POST['icsf_status'] == 1) {

        if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'ic_user_status' ) ) {
            wp_die('Invalid nonce. Form submission not allowed.');
        }

        $status = sanitize_text_field( $_POST['ic_user_status'] );
        global $wpdb;
        $status_table = $wpdb->prefix . 'ic_user_status';
        $wpdb->query(
            $wpdb->prepare(
               "INSERT INTO $status_table
               ( status )
               VALUES ( %s )",
               $status,
            )
         );
        
    }
}

// Update user status
add_action( 'admin_init', 'icsf_user_status_update' );
function icsf_user_status_update() {

    if (isset($_POST['icsf_status_update']) && $_POST['icsf_status_update'] == 1) {

        if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'ic_user_status_update' ) ) {
            wp_die('Invalid nonce. Form submission not allowed.');
        }

        $status = sanitize_text_field( $_POST['ic_user_status_update'] );
        $id     = sanitize_text_field( $_POST['ic_user_status_update_id'] );
        global $wpdb;
        $status_table = $wpdb->prefix . 'ic_user_status';

         $wpdb->update(
            $status_table,
            array(
                'status' => $status,
            ),
            array( 'id' => $id ),
            array(
                '%s',
            ),
            array( '%d' )
        );
    }

}

/**
 * Ajax call for send user confirm email
 */
add_action('wp_ajax_icsf_confirm_email_send', 'icsf_confirm_email_send');
add_action('wp_ajax_nopriv_icsf_confirm_email_send', 'icsf_confirm_email_send');
function icsf_confirm_email_send() {

    $data_id    = sanitize_key( $_POST['data_id'] );
    $user_email = sanitize_key( $_POST['data_email'] );
    
    global $wpdb;
    $table_name     = $wpdb->prefix . 'ic_members';
    $table_status   = $wpdb->prefix . 'ic_user_status';
    $user_subject   = '';
    $headers        = array( 'Content-Type: text/html; charset=UTF-8' );
    $name           = '';
    $user_message = <<<EOD
We received your request

Hi $name,

Thank you for submitting a membership form to the Founder’s Community Club Ltd. This email confirms that we have received your request.

A member of our team will get back to you shortly.

Thank you,
Team FCCL
EOD;

    wp_mail( $user_email, $user_subject, $user_message, $headers );
        
    wp_send_json_success([
        'is_emailed'   => true,
        'message_body' => $user_message
    ]);
}



/**
 * Ajax call for send user reject email
 */
add_action('wp_ajax_icsf_reject_email_send', 'icsf_reject_email_send');
add_action('wp_ajax_nopriv_icsf_reject_email_send', 'icsf_reject_email_send');
function icsf_reject_email_send() {

    $data_id    = sanitize_key( $_POST['data_id'] );
    $user_email = sanitize_key( $_POST['data_email'] );
    
    global $wpdb;
    $table_name     = $wpdb->prefix . 'ic_members';
    $table_status   = $wpdb->prefix . 'ic_user_status';
    $user_subject   = '';
    $headers        = array( 'Content-Type: text/html; charset=UTF-8' );
    $name           = '';
    $user_message = <<<EOD
We received your request

Hi $name,

Thank you for submitting a membership form to the Founder’s Community Club Ltd. This email confirms that we have received your request.

A member of our team will get back to you shortly.

Thank you,
Team FCCL
EOD;

    wp_mail( $user_email, $user_subject, $user_message, $headers );
        
    wp_send_json_success([
        'is_emailed'   => true,
        'message_body' => $user_message
    ]);
}