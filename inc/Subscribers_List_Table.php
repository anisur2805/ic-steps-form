<?php
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

if ( !class_exists( 'WP_List_Table' ) ) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

class Subscribers_List_Table extends \WP_List_Table {
    private $_items;

    public function __construct( $data ) {
        parent::__construct( [
            'singular' => 'subscriber',
            'plural'   => 'subscribers',
            'ajax'     => false,
        ] );
        $this->_items = $data;
    }

    public function get_columns() {
        $columns = array(
            'cb'                  => __( '<input type="checkbox" />', 'founders-club' ),
            'name'                => __( '<strong>Name</strong>', 'founders-club' ),
            'email'               => __( '<strong>Email</strong>', 'founders-club' ),
            'created_at'          => __( '<strong>Create Date</strong>', 'founders-club' ),
            'membership_type'     => __( '<strong>Member Type</strong>', 'founders-club' ),
            'dob'                 => __( '<strong>DOB</strong>', 'founders-club' ),
            // 'phone'               => __( '<strong>Mobile No.</strong>', 'founders-club' ),
            'status'              => __( '<strong>Status</strong>', 'founders-club' ),
            'photo'               => __( '<strong>Photo</strong>', 'founders-club' ),
            'view'                => __( '<strong>Action</strong>', 'founders-club' ),
        );

        return $columns;
    }

    /**
     * Handles data query and filter, sorting, and pagination.
     */
    public function prepare_items() {

        $per_page     = 30;
        $total_items  = count( $this->_items );
        $current_page = $this->get_pagenum();
        $this->set_pagination_args( [
            'total_items' => $total_items,
            'per_page'    => $per_page,
        ] );

        $data                  = array_slice( $this->_items, ( $current_page - 1 ) * $per_page, $per_page );
        $this->items           = $data;
        $this->_column_headers = [$this->get_columns(), [], []];

    }

    public function get_sortable_columns() {
        $sortable_columns = [
            'name'       => ['name', true],
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
                "SELECT * FROM {$wpdb->prefix}ic_ic_members
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

        return (int) $wpdb->get_var( "SELECT count(id) FROM {$wpdb->prefix}ic_ic_members " );
    }

    public function column_cb( $item ) {
        return "<input type='checkbox' value='{$item["id"]}'/>";
    }

    public function column_created_at( $item ) {
        $created_at = $item['created_at'];
        $formatted_date = date( 'Y-m-d', strtotime( $created_at ) );

        return $formatted_date;
    }

    public function column_name( $item ) {
        return sprintf(
            '<strong>%s</strong>',
            esc_attr( $item['name'] ),
        );
    }

    public function column_membership_type( $item ) {
        $type = ucwords( str_replace('-', ' ', $item['membership_type'] ) );
        return sprintf( '<span>%s</span>', $type );
    }

    public function column_view( $item ) {
        // <button type="button" class="modal-toggle view-popup" data-id="%s"> View Details</button>
        return sprintf(
            '<button type="button" class="icsf-send-email" data-id="%s">Send Email</button>
            <button type="button" class="icsf-edit-user" data-id="%s">Edit User</button>
            <button type="button" class="icsf-delete-user" data-delete-id="%s">Delete User</button>',
            esc_attr( $item['user_id'] ),
            esc_attr( $item['user_id'] ),
            esc_attr( $item['user_id'] )
            ,
        );
    }

    public function column_status( $item ) {
        $status = $item['status'] == 0 ? 'Unpaid' : 'Paid';
        $status_class = $item['status'] == 1 ? 'success' : '';
        $disabled = $item['status'] == 1 ? 'disabled' : '';
        global $wpdb;
        $table_name = $wpdb->prefix . 'ic_user_status';
        $query = $wpdb->get_results( "SELECT * FROM $table_name", ARRAY_A );
    
        // $select = '<select class="status-dropdown">';
        // foreach( $query as $res ) {
        //     $select .= '<option value="' . $res['id'] . '">' . $res['status'] . '</option>';
        // }
        // $select .= '</select>';
        // <span class="%s">%s</span> 

        // echo '<pre>';
        //       print_r( $item );
        // echo '</pre>';

        $select = '<select class="status-dropdown">';
        foreach ($query as $res) {
            $selected = ( $res['id'] == $item['status'] ) ? 'selected' : '';
            $select .= '<option value="' . $res['id'] . '" '.$selected.'>' . $res['status'] . '</option>';
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
    
    public function column_photo( $item ) {
        return sprintf(
            "<img width='40' height='40' src='%s'/>",
            site_url( 'wp-content/uploads' ) . $item['photo'],
        );
    }

    public function no_items() {
        _e( 'No subscribers available.', $this->plugin_text_domain );
    }

    public function get_hidden_columns() {
        return array();
    }

    public function column_default( $item, $column_name ) {
        return $item[$column_name];
    }
}
