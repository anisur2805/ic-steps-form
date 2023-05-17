<?php

echo '<div class="view-users"><div class="modal-body">
<div class="modal-content">';

printf( '<div class="ic-action-wrap"><a type="button" href="'.admin_url( 'admin.php?page=ic-register-users&action=edit&id=%d' ).'" class="icsf-edit-user" data-id="%s">Edit User</a><a type="button" href="'.admin_url( 'admin.php?page=ic-register-users').'">Back to List Page</a><a onclick="window.print(); return false;" class="ic-pdf-download-btn" type="button" href="#">Download as PDF</a></div>', esc_attr( $id ), esc_attr( $id ) );

    global $wpdb;
    $table_name = $wpdb->prefix . 'ic_members';
    $query      = "SELECT * FROM {$table_name} WHERE user_id = " . $id;
    $results    = $wpdb->get_results( $query, ARRAY_A );

    foreach ( $results as $result ) {
        echo '<div class="print-section"><h2 class="hide-on-normal">Founders Community Club Ltd.</h2>';
        echo '<div><h3>Name</h3> ' . $result['name'] . '</div>';
        echo '<div><h3>User Name</h3> ' . $result['user_name'] . '</div>';
        echo '<div><h3>Email</h3>' . $result['email'] . '</div>';
        echo '<div><h3>Phone</h3>' . $result['phone'] . '</div>';
        // echo '<div><h3>Status</h3>' . ( $result['status'] == 0 ? 'Unpaid' : 'Paid' ) . '</div>';
        
        echo '<div><h3>Present Address</h3>' . $result['present_addr'] . '</div>';
        echo '<div><h3>Permanent Address</h3>' . $result['permanent_addr'] . '</div>';
        echo '<div><h3>NID</h3>' . $result['nid_no'] . '</div>';
        echo '<div><h3>Facebook Link</h3>' . '<a target="_blank" href="'. esc_url( $result['fb_url'] ) . '">'.$result['fb_url'].'</a></div>';
        if( $result['linkedin_url'] ) {
            echo '<div><h3>Linked In URL</h3>' . '<a href="'.$result['linkedin_url'] . '">'.$result['linkedin_url'].'</a></div>';
        }
        echo '<div><h3>Date of birth</h3>' . $result['dob'] . '</div>'; 
        echo '<div><h3>Business Name</h3>' . $result['business_name'] . '</div>';
        echo '<div><h3>Business Position</h3>' . $result['position_name'] . '</div>';
        echo '<div><h3>Business Email</h3>' . $result['business_email'] . '</div>';
        echo '<div><h3>Business Phone</h3>' . $result['business_phone'] . '</div>';
        if( $result['url'] ) {
            echo '<div><h3>Business URL</h3>' . '<a href="'.$result['url'] . '">'.$result['url'].'</a></div>';
        }
        if( $result['last_educational_qualification'] ) {
            echo '<div><h3>Last Educational Qua.</h3>' . $result['last_educational_qualification'] . '</div>';
        }

        echo '<div><h3>Father\'s Name</h3>' . $result['fathers_name'] . '</div>';
        echo '<div><h3>Mother\'s Name</h3>' . $result['mothers_name'] . '</div>';

        if( $result['is_married'] ) {
            echo '<div><h3>Married?</h3>' . ( $result['is_married'] == '1' ? 'Yes' : 'No') . '</div>';
        }
        if( $result['spouse_name'] ) {
            echo '<div><h3>Spouse Name?</h3>' . $result['spouse_name'] . '</div>';
        }
        if( $result['anniversary'] ) {
            echo '<div><h3>Marriage Anniversary</h3>' . date('d-m-Y', strtotime( $result['anniversary'] ) ) . '</div>';
        }

        if( $result['haveChild'] ) {
            echo '<div><h3>Have children?</h3>' . ( $result['haveChild'] == '1' ? 'Yes' : 'No') . '</div>';
        }
        if( $result['first_child_name'] ) {
            echo '<div><h3>First Kid\'s Name</h3>' . $result['first_child_name'] . '</div>';
        }
        if( $result['first_child_dob'] ) {
            echo '<div><h3>First Kid\'s DOB</h3>' . date('d-m-Y', strtotime( $result['first_child_dob'] ) ) . '</div>';
        }
        if( $result['first_child_gender'] ) {
            echo '<div><h3>First Kid\'s Gender</h3>' . $result['first_child_gender'] . '</div>';
        }
        if( $result['second_child_name'] ) {
            echo '<div><h3>Second Kid\'s Name</h3>' . $result['second_child_name'] . '</div>';
        }
        if( $result['second_child_dob'] ) {
            echo '<div><h3>Second Kid\'s DOB</h3>' . date('d-m-Y', strtotime( $result['second_child_dob'] ) ). '</div>';
        }
        if( $result['second_child_gender'] ) {
            echo '<div><h3>Second Kid\'s Gender</h3>' . $result['second_child_gender'] . '</div>';
        }
        if( $result['third_child_name'] ) {
            echo '<div><h3>Third Kid\'s Name</h3>' . $result['third_child_name'] . '</div>';
        }
        if( $result['third_child_dob'] ) {
            echo '<div><h3>Third Kid\'s DOB</h3>' . date('d-m-Y', strtotime( $result['third_child_dob'] ) ). '</div>';
        }
        if( $result['third_child_gender'] ) {
            echo '<div><h3>Third Kid\'s Gender</h3>' . $result['third_child_gender'] . '</div>';
        }

        if( $result['refer_by'] ) {
            echo '<div><h3>Reference By</h3>' . $result['refer_by'] . '</div>';
        }

        if( $result['membership_type'] ) {
            echo '<div><h3>Membership Type</h3>' . $result['membership_type'] . '</div>';
        }

        if( $result['photo'] ) {
            echo '<div><h3>Photo</h3>' . '<img width="100" src="'. esc_attr( wp_upload_dir()['baseurl'] . $result['photo']) .'" alt="My Image"></div>';
        }
        if( $result['nid'] ) {
            echo '<div class="ic-nid-row"><h3>NID</h3>' . '<img width="100" src="'. esc_attr( wp_upload_dir()['baseurl'] . $result['nid'] ).'" /></div>';
        }
        if( $result['trade_license'] ) {
            echo '<div class="ic-license-row"><h3>Trade License</h3>' . '<img width="100" src="'. esc_attr( wp_upload_dir()['baseurl'] . $result['trade_license'] ).'" /></div>';
        }
        if( $result['cv'] ) {
            echo '<div class="ic-cv-row"><h3>CV</h3>' . '<a href="'. esc_attr( wp_upload_dir()['baseurl'] . $result['cv'] ).'" download>Download CV</a></div>';
        }

        echo '</div>';
    }

echo '</div></div></div>';