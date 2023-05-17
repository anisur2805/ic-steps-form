<?php

// Add user new role
function add_ic_member_role() {
    add_role( 'ic_member', 'IC Member' );
}
add_action( 'init', 'add_ic_member_role' );

function add_ic_member_capability() {
    $role = get_role( 'ic_member' );
    if ( $role ) {
        $role->add_cap( 'access_ic_member_page' );
    }
}
add_action( 'init', 'add_ic_member_capability' );