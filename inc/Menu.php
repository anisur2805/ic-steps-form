<?php
function ic_admin_menu() {
    add_menu_page(
        __( 'IC Register Members', ),
        __( 'IC Members', ),
        'manage_options',
        'ic-register-users',
        'ic_register_users',
        'dashicons-admin-users',
    );
}
add_action( 'admin_menu', 'ic_admin_menu' );

function ic_register_users() { ?>
    <div class="wrap">
        <h1><?php echo get_admin_page_title(); ?></h1>

        <form id="art-search-form" method="POST">
            <?php

                global $wpdb;
                $query   =  "SELECT * from {$wpdb->prefix}" . 'ic_members';
                $results = $wpdb->get_results( $query, ARRAY_A );
                $itc_subscriber_table = new Subscribers_List_Table( $results );
                $itc_subscriber_table->prepare_items();
                $itc_subscriber_table->display();

            ?>
        </form>
        
        <div class="modal-wrapper-footer"></div>
    </div>

<?php }