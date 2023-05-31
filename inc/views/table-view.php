<form id="art-search-form" method="POST">
    <?php

        $itc_subscriber_table = new Subscribers_List_Table();
        $itc_subscriber_table->prepare_items();
        // Search form
        $itc_subscriber_table->search_box('search', 'search_id');
        $itc_subscriber_table->display();

    ?>
</form>

<div class="modal-wrapper-footer"></div>