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
            'dob'                 => __( '<strong>DOB</strong>', 'founders-club' ),
            'phone'                 => __( '<strong>Mobile No.</strong>', 'founders-club' ),
            'status'              => __( '<strong>Status</strong>', 'founders-club' ),
            'photo'              => __( '<strong>Photo</strong>', 'founders-club' ),
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

    public function column_name( $item ) {
        return sprintf(
            '<strong>%s</strong>',
            esc_attr( $item['name'] ),
        );
    }

    public function column_view( $item ) {
        return sprintf(
            '<button type="button" class="modal-toggle view-popup" data-id="%s"> View Details</button>',
            esc_attr( $item['user_id'] ),
        );
    }

    public function column_status( $item ) {
        return sprintf(
            "Unpaid",
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
