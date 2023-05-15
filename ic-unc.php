<?php
    if( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) exit();
    global $wpdb;
    $ic_members_table = $wpdb->prefix . 'ic_members';
    $wpdb->query( "DROP TABLE IF EXISTS {$ic_members_table}" );
?>