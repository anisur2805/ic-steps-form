<?php

function ic_members_activate() {
    global $wpdb;

    $charset_collate = $wpdb->get_charset_collate();
    $ic_members_table           = $wpdb->prefix . 'ic_members';

    $table_schema = "CREATE TABLE IF NOT EXISTS $ic_members_table (
        `id` int NOT NULL AUTO_INCREMENT,
        `user_id` int NOT NULL,
        `name` varchar(255) NOT NULL,
        `user_name` varchar(30) NOT NULL,
        `email` varchar(50) NOT NULL,
        `phone` varchar(50) NOT NULL,

        `present_addr` varchar(255) NOT NULL,
        `permanent_addr` varchar(255) NOT NULL,
        `nid_no` varchar(50) NOT NULL,
        `fb_url` varchar(255) NOT NULL,
        `linkedin_url` varchar(255) NOT NULL,
        `dob` varchar(30) NOT NULL,
        `business_name` varchar(255) NOT NULL,
        `position_name` varchar(255) NOT NULL,
        `business_email` varchar(50) NOT NULL,
        `business_phone` varchar(30) NOT NULL,
        `url` varchar(255) NOT NULL,
        `last_educational_qualification` varchar(50) NOT NULL,

        `fathers_name` varchar(50) NOT NULL,
        `mothers_name` varchar(50) NOT NULL,
        `is_married` varchar(30) NOT NULL,
        `spouse_name` varchar(50) DEFAULT NULL,
        `anniversary` varchar(50) DEFAULT NULL,
        `haveChild` varchar(50) DEFAULT NULL,        
        `first_child_name` varchar(50) DEFAULT NULL,
        `first_child_dob` varchar(30) DEFAULT NULL,
        `first_child_gender` varchar(50) DEFAULT NULL,
        `second_child_name` varchar(50) DEFAULT NULL,
        `second_child_dob` varchar(30) DEFAULT NULL,
        `second_child_gender` varchar(50) DEFAULT NULL,
        `third_child_name` varchar(50) DEFAULT NULL,
        `third_child_dob` varchar(30) DEFAULT NULL,
        `third_child_gender` varchar(50) DEFAULT NULL,

        `photo` varchar(255) DEFAULT NULL,
        `nid` varchar(255) DEFAULT NULL,
        `trade_license` varchar(255) DEFAULT NULL,
        `cv` varchar(255) DEFAULT NULL,
        PRIMARY KEY (`id`)
  ) $charset_collate";

    if ( ! function_exists( 'dbDelta' ) ) {
        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    }
    dbDelta( $table_schema );
}
