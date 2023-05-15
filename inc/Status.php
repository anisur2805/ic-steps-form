<?php

add_action('admin_menu', function() {
    add_submenu_page(
        'ic-register-users', 'User Status', 'User Status', 'manage_options', 'ic-register-user-status', 
       'ic_register_user_status'
    );
});
function ic_register_user_status() {
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    global $wpdb;
    $table_name = $wpdb->prefix .'ic_user_status';
    
    $query = $wpdb->get_row("SELECT * FROM $table_name WHERE id = " . $id );

    echo '<div class="wrap ic-settings-box">'; ?>
    <h2><?php _e('Add User Status.', 'icsf-steps-form') ?></h2>
    <div class="ic-user-status">
        <div class="ic-user-status-form">
            <form method="post">
                <?php 
                 if( $id > 0 ) {
                    ?>
                    <input type="hidden" name="icsf_status_update" value="1" />
                    <label for="ic_user_status">Update status</label>
                    <input class="widefat" type="text" id="ic_user_status_update" name="ic_user_status_update" value="<?php echo isset($query->status) ? $query->status : ''; ?>" />
                    <input type="hidden" id="ic_user_status_update_id" name="ic_user_status_update_id" value="<?php echo $id; ?>" />
                    <button class="button button-primary button-large" type="submit"><?php _e('Update status', 'icsf-steps-form') ?></button>
                    <?php
                     wp_nonce_field('ic_user_status_update');
                } else {
                    ?>
                    <input type="hidden" name="icsf_status" value="1" />
                    <label for="ic_user_status">Add status</label>
                    <input class="widefat" type="text" id="ic_user_status" name="ic_user_status" value="" />
                    <button class="button button-primary button-large" type="submit"><?php _e('Add status', 'icsf-steps-form') ?></button>
                    <?php
                    wp_nonce_field('ic_user_status');
                }
                ?>
            </form>
            </div>

            <?php 

            ?>
            <div class="ic-user-status-lists">
                <table>
                    <thead>
                    <tr>
                        <td>Serial No</td>
                        <td>Status Name</td>
                        <td>Action</td>
                    </tr>
                    </thead>
                    <tbody>
                        <?php 
                            global $wpdb;
                            $table_name = $wpdb->prefix . 'ic_user_status';
                            if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name) {
                                $query = $wpdb->get_results("SELECT * FROM $table_name");
                        
                                if (empty($query)) {
                                    echo '<tr><td colspan="3">No statuses found.</td></tr>';
                                } else {
                                    foreach ($query as $k => $val) {
                                        echo '<tr>';
                                        echo '<td>' . ($k+1) . '</td>';
                                        echo '<td>' . $val->status . '</td>';
                                        echo '<td><a href="'.admin_url( 'admin.php?page=ic-register-user-status&action=edit&id=' . $val->id ).'" class="pointer ic-edit-status" data-edit-id="'.$val->id.'">Edit</a><a class="pointer ic-delete-status" data-delete-id="'.$val->id.'">Delete</a></td>';
                                        echo '</tr>';
                                    }
                                }
                            } else {
                                echo '<tr><td colspan="2">Table does not exist.</td></tr>';
                            }
                        ?>
                    </tbody>

                </table>
            </div>
    </div>
    
    <?php
    echo '</div>';

} 


add_action('admin_footer', function(){
    ?>
    <style>
        .ic-user-status {
            display: flex;
            justify-content: space-between;
            gap: 30px;
        }

        td.status.column-status {
            text-align: center;
        }
        td.status.column-status .icsf-update-user {
            margin-top: 5px;
        }

        .ic-user-status .ic-user-status-form,
        .ic-user-status .ic-user-status-lists{
            flex: 1;
        }

        .ic-user-status-lists table {
            width: 100%;
            background: #fff;
        }
        .ic-user-status-lists table td {
            padding: 6px;
        }
        .ic-user-status-lists table thead td {
            font-weight: 500;
        }

        .ic-user-status-lists table tbody tr:nth-child(odd) {
            background: #f8f8f8;
        }

        a.pointer {
            cursor: pointer;
            margin-right: 10px;
        }

        #ic_user_status,
        #ic_user_status_update {
            margin-bottom: 8px;
            display: block;
        }
    </style>
    <?php
});