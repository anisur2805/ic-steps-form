<?php
function ic_admin_menu() {
    add_menu_page(
        __( 'IC Register Members', ),
        __( 'IC Members', ),
        'manage_options',
        'ic-register-users',
        'ic_register_users',
        'dashicons-admin-users',
        30
    );
}
add_action( 'admin_menu', 'ic_admin_menu' );

function ic_register_users() { ?>
    <div class="wrap">
        <h1><?php echo get_admin_page_title(); ?></h1>

        <?php 

        $action = isset($_GET['action']) ? $_GET['action'] : 'table';
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

        switch ($action) {
            case 'view':
                $template = __DIR__ . '/views/user-view.php';
                break;

            case 'edit':
                $template = __DIR__ . '/views/user-edit.php';
                break;

            default:
                $template = __DIR__ . '/views/table-view.php';
                break;
        }

        if (file_exists($template)) {
            include $template;
        }
        
        ?>
    </div>

<?php }