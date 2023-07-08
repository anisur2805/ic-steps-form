<form id="art-search-form" method="GET">
    <?php

        $itc_subscriber_table = new Subscribers_List_Table();
        $itc_subscriber_table->prepare_items();
        // Search form
        $itc_subscriber_table->search_box('search', 'search_id');
        $itc_subscriber_table->display();
        echo '<input type="hidden" name="page" value="'. $_REQUEST['page'] .'"/>';

    ?>
</form>

<div class="modal-wrapper-footer"></div>