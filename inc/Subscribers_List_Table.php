<?php
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

if ( !class_exists( 'WP_List_Table' ) ) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

class Subscribers_List_Table extends \WP_List_Table {

    public function __construct() {
        parent::__construct( [
            'singular' => 'subscriber',
            'plural'   => 'subscribers',
            'ajax'     => false,
        ] );
        add_action( 'admin_head', [$this, 'add_custom_screen_options'] );

    }

    public function get_columns() {
        $columns = [
            'cb'              => __( '<input type="checkbox" />', 'founders-club' ),
            'name'            => __( '<strong>Name</strong>', 'founders-club' ),
            'email'           => __( '<strong>Email</strong>', 'founders-club' ),
            'created_at'      => __( '<strong>Create Date</strong>', 'founders-club' ),
            'membership_type' => __( '<strong>Member Type</strong>', 'founders-club' ),
            'dob'             => __( '<strong>DOB</strong>', 'founders-club' ),
            // 'phone'               => __( '<strong>Mobile No.</strong>', 'founders-club' ),
            'status'          => __( '<strong>Status</strong>', 'founders-club' ),
            'photo'           => __( '<strong>Photo</strong>', 'founders-club' ),
            'view'            => __( '<strong>Action</strong>', 'founders-club' ),
            // 'delete'                => __( '<strong>column_delete</strong>', 'founders-club' ),
        ];

        return $columns;
    }

    public function add_custom_screen_options() {
        die( 'die here' );
        error_log( 'add_custom_screen_options() method called' );
        $screen = get_current_screen();

        // Add screen options only for your WP List Table admin page
        if ( $screen->id === 'toplevel_page_ic-register-users' ) {
            $option = 'per_page'; // Option key
            $args   = [
                'label'   => 'Items per page', // Label for the screen option
                'default' => 20, // Default value
                'option'  => 'custom_items_per_page', // Custom option name (optional)
            ];
            add_screen_option( $option, $args );

            // Retrieve the selected value from screen options
            $per_page = get_user_meta( get_current_user_id(), $option, true );

            // // Set the number of items per page in your WP List Table
            // $this->set_pagination_args( [
            //     'total_items' => $this->get_total_items(), // Replace with your method to get the total number of items
            //     'per_page'    => $per_page ? $per_page : $args['default'],
            // ] );
        }
    }

    /**
     * Handles data query and filter, sorting, and pagination.
     */
    public function prepare_items() {
        $column   = $this->get_columns();
        $hidden   = [];
        $sortable = $this->get_sortable_columns();
        $primary  = 'name';

        $this->_column_headers = [$column, $hidden, $sortable, $primary];

        $per_page     = 2;
        $current_page = $this->get_pagenum();
        $offset       = ( $current_page - 1 ) * $per_page;

        $search = isset( $_REQUEST['s'] ) ? sanitize_text_field( $_REQUEST['s'] ) : '';

        $args = [
            'number' => $per_page,
            'offset' => $offset,
            's'      => $search,
        ];

        if ( isset( $_REQUEST['orderby'] ) && isset( $_REQUEST['order'] ) ) {
            $args['orderby'] = $_REQUEST['orderby'];
            $args['order']   = $_REQUEST['order'];
        }

        $this->items = ic_retrieve_data( $args );

        $this->set_pagination_args( [
            'total_items' => ic_member_count(),
            'per_page'    => $per_page,
        ] );

        $this->process_bulk_action();
    }

    protected function get_bulk_actions() {
        return [
            'bulk-delete' => 'Delete',
        ];
    }

    protected function process_bulk_action() {
        $action = $this->current_action();

        if ( $action === 'bulk-delete' ) {
            $selected_items = $_REQUEST['bulk-delete'] ?? [];

            if ( is_array( $selected_items ) && !empty( $selected_items ) ) {
                global $wpdb;
                $table_name = $wpdb->prefix . 'ic_members';

                foreach ( $selected_items as $item_id ) {
                    $wpdb->delete(
                        $table_name,
                        [ 'id' => $item_id ],
                        [ '%d' ],
                    );
                    echo $wpdb->last_query;
                }
            }

            echo '<script>window.location.href = "' . admin_url( 'admin.php?page=ic-register-users' ) . '";</script>';
            exit;

        }

    }

    protected function column_delete( $item ) {
        $actions = [
            'delete' => sprintf(
                '<a href="?page=%s&action=%s&item=%s">Delete</a>',
                esc_attr( $_REQUEST['page'] ),
                'delete',
                absint( $item['id'] )
            ),
        ];

        return $this->row_actions( $actions );
    }

    // protected function bulk_actions() {
    //     $actions = array(
    //         'delete' => 'Delete',
    //     );

    //     return $actions;
    // }

    /**
     * Delete a single row.
     *
     * @param int $item_id The ID of the row to delete.
     */
    protected function delete_item( $item_id ) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'ic_members';

        // Perform the delete operation for the single item
        $wpdb->delete(
            $table_name,
            [ 'id' => $item_id ],
            [ '%d' ],
        );
    }

    // ...

    /**
     * Generate the bulk actions dropdown.
     *
     * @return string The HTML for the bulk actions dropdown.
     */
    // protected function bulk_actions() {
    //     $actions = array(
    //         'delete' => 'Delete',
    //     );

    //     return $actions;
    // }

    /**
     * Get the table views.
     *
     * @return string The views HTML.
     */
    protected function get_views() {
        // Build your views HTML here
        $views = [
            'all'       => sprintf( '<a href="%s" class="current">All</a>', 'admin.php?page=ic-register-users' ),
            'pending'   => '<a href="#">Pending</a>',
            'published' => '<a href="#">Published</a>',
        ];

        $current_view = isset( $_REQUEST['view'] ) ? sanitize_key( $_REQUEST['view'] ) : 'all';

        $html = '<ul class="subsubsub">';
        foreach ( $views as $view => $label ) {
            $class = ( $current_view === $view ) ? 'current' : '';
            $html .= "<li><a href='#' class='$class'>$label</a> |</li>";
        }
        $html .= '</ul>';

        return $html;
    }

    public function get_sortable_columns() {
        $sortable_columns = [
            'name'       => ['name', true],
            'email'      => ['email', true],
            'dob'        => ['dob', true],
            'created_at' => ['created_at', true],
        ];

        return $sortable_columns;
    }

    public function itc_get_subscribers( $args = [] ) {
        global $wpdb;

        $defaults = [
            "offset"  => 0,
            "number"  => 20,
            "orderby" => "id",
            "order"   => "ASC",
        ];

        $args = wp_parse_args( $args, $defaults );

        $items = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT * FROM {$wpdb->prefix}ic_members
            ORDER BY {$args["orderby"]} {$args["order"]}
            LIMIT %d OFFSET %d",
                $args["number"], $args["offset"] )
        );
        $items = $wpdb->query(
            "SELECT display_name FROM {$wpdb->prefix}users where ID =" . $items
        );
    }

    public function itc_subscribers_count() {
        global $wpdb;

        return (int) $wpdb->get_var( "SELECT count(id) FROM {$wpdb->prefix}ic_members " );
    }

    protected function column_cb( $item ) {
        return '<input type="checkbox" name="bulk-delete[]" value="' . $item['id'] . '" />';
    }

    public function column_created_at( $item ) {
        $created_at     = $item['created_at'];
        $formatted_date = date( 'd-m-Y', strtotime( $created_at ) );

        return $formatted_date;
    }

    public function column_name( $item ) {
        $action         = [];
        $action['edit'] = sprintf(
            '<a href="' . admin_url( 'admin.php?page=ic-register-users&action=edit&id=%d' ) . '" >%s</a>', esc_attr( $item['user_id'] ), __( 'Edit' )
        );
        $action['delete'] = sprintf(
            '<a data-delete-id="%1$s" href="#">%2$s</a>', esc_attr( $item['user_id'] ), __( 'Delete' )
        );
        return sprintf(
            '<strong>%s</strong>%s',
            esc_attr( $item['name'] ),
            $this->row_actions( $action ),
        );
    }

    // public function column_membership_type( $item ) {
    //     $type = ucwords( str_replace('-', ' ', $item['membership_type'] ) );
    //     return sprintf( '<span>%s</span>', $type );
    // }

    public function column_membership_type( $item ) {
        if ( isset( $item['membership_type'] ) && !is_null( $item['membership_type'] ) ) {
            if ( $item['membership_type'] === '0' ) {
                $type = 'Not Selected';
            } else {
                $type = ucwords( str_replace( '-', ' ', $item['membership_type'] ) );
            }
            return sprintf( '<span>%s</span>', $type );
        } else {
            return '';
        }
    }

    public function column_view( $item ) {
        // echo '<pre>';
        //       print_r( $item );
        // echo '</pre>';
        // <button type="button" class="modal-toggle view-popup" data-id="%s"> View Details</button>
        return sprintf(
            '<button type="button" class="view-more-btn">...</button><div class="ic-action-button-wrapper"><button type="button" class="icsf-send-confirm-email" data-id="%s" data-email="%s">Confirm Email</button>
            <button type="button" class="icsf-send-reject-email" data-id="%s" data-email="%s">Reject Email</button>
            <a type="button" href="' . admin_url( 'admin.php?page=ic-register-users&action=edit&id=%d' ) . '" class="icsf-edit-user btn" data-id="%s">Edit User</a>
            <a type="button" href="' . admin_url( 'admin.php?page=ic-register-users&action=view&id=%d' ) . '" class="icsf-edit-user btn" data-id="%s">View User</a>
            <button type="button" class="icsf-delete-user" data-delete-id="%s">Delete User</button>
            <a href="%s" type="button" class="icsf-cv-download btn" download>CV Download</a></div>',
            esc_attr( $item['user_id'] ),
            esc_attr( $item['email'] ),
            esc_attr( $item['user_id'] ),
            esc_attr( $item['email'] ),
            esc_attr( $item['user_id'] ),
            esc_attr( $item['user_id'] ),
            esc_attr( $item['user_id'] ),
            esc_attr( $item['user_id'] ),
            esc_attr( $item['user_id'] ),
            esc_attr( esc_attr( wp_upload_dir()['baseurl'] . $item['cv'] ) ),
        );
    }

    public function column_status( $item ) {
        $status       = $item['status'] == 0 ? 'Unpaid' : 'Paid';
        $status_class = $item['status'] == 1 ? 'success' : '';
        $disabled     = $item['status'] == 1 ? 'disabled' : '';
        global $wpdb;
        $table_name = $wpdb->prefix . 'ic_user_status';

        if ( !$wpdb->get_var( "SHOW TABLES LIKE '$table_name'" ) == $table_name ) {
            return;
        }

        $query = $wpdb->get_results( "SELECT * FROM $table_name", ARRAY_A );

        $select = '<select class="status-dropdown">';
        foreach ( $query as $res ) {
            $selected = ( $res['id'] == $item['status'] ) ? 'selected' : '';
            $select .= '<option value="' . $res['id'] . '" ' . $selected . '>' . $res['status'] . '</option>';
        }
        $select .= '</select>';

        return sprintf(
            '%s
            <button %s type="button" class="icsf-update-user" data-update-id="%s"> Update Status</button>',
            $select,
            $disabled,
            esc_attr( $item['user_id'] )
        );
    }

/*
<a title="Click to Download" href="/images/myw3schoolsimage.jpg" download>
<img src="/images/myw3schoolsimage.jpg" alt="W3Schools" width="104" height="142"> Click to Download
</a> */

    public function column_photo( $item ) {
        return sprintf(
            '<a title="Click to Download" href="%s" class="btn" download><img width="40" height="40" src="%s" /> Click to Download</a>',
            site_url( 'wp-content/uploads' ) . $item['photo'],
            site_url( 'wp-content/uploads' ) . $item['photo'],
        );
    }

    public function no_items() {
        _e( 'No subscribers available.', $this->plugin_text_domain );
    }

    public function get_hidden_columns() {
        return [];
    }

    public function column_default( $item, $column_name ) {
        return $item[$column_name];
    }
}
