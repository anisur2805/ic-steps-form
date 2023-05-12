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
                'user_name'                      => $userName,
                'email'                          => $email,
                'phone'                          => $phone,
                'phone'                          => $phone,
                'present_addr'                   => $presentAddr,
                'permanent_addr'                 => $permanentAddr,
                'nid_no'                         => $nidNo,
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
            ]
        );
    }

}

// add_action( 'wp_ajax_icsf_formHandler', 'icsf_formHandler' );
// add_action( 'wp_ajax_nopriv_icsf_formHandler', 'icsf_formHandler' );

add_action( 'user_register', 'icsf_formHandler' );
add_action( 'init', 'ic_register_user' );
function ic_register_user() {

    if ( isset( $_POST['submit'] ) ) {

        $nonce = isset( $_POST['ic_register_name'] ) ? $_POST['ic_register_name'] : '';

        if ( !wp_verify_nonce( $nonce, 'ic_register_action' ) ) {
            die( 'die here' );
            wp_send_json_error( [
                'error' => 'something went wrong',
            ] );
        }

        $email    = sanitize_email( $_POST['email'] );
        $password = sanitize_text_field( $_POST['pass'] );

        $user_id = username_exists( $email );

        if ( ! $user_id && false == email_exists( $email ) ) {
            $user_id = wp_create_user( $email, $password, $email );

            // send mail for user
            // $user_message = __( 'Thanks for register, we will back to you ASAP');
            $headers = array( 'Content-Type: text/html; charset=UTF-8' );
            // wp_mail( $email, $user_message, $headers );

            $user_message = __( 'Awesome, we will get back to you ASAP' );
            $headers      = array( 'Content-Type: text/html; charset=UTF-8' );
            $user_subject = __( 'Thanks for Registering' );
            wp_mail( $email, $user_subject, $user_message, $headers );

            // send mail for admin
            $admin_email   = get_option( 'admin_email' );
            $message       = 'Someone has been registered successfully';
            $admin_subject = __( 'Thanks for Registering' );

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

// reuseable checking function 
function fieldCheck( $key ) {
    if ( isset( $_SESSION['registration_data'][ $key ])) {
        $key = sanitize_text_field($_SESSION['registration_data'][ $key ]);
    } else {
        $key = '';
    }

    return $key;
}


if ( isset( $_GET['registration'] ) && $_GET['registration'] == 'success' ) {
    if ( isset( $_SESSION['registration_data'] ) ) {
        $_SESSION['registration_data'] = [];
    }
}