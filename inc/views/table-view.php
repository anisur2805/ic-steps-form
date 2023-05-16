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