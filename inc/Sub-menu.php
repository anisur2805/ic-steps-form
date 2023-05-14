<?php

add_action('admin_menu', function() {
    add_submenu_page(
        'ic-register-users', 'Settings', 'Settings', 'manage_options', 'ic-register-user-setting', 
       'ic_register_user_settings'
    );
});
function ic_register_user_settings() {
    
    $get_message         = get_option('user_message');
    $get_message_subject = get_option('user_message_subject');

    $get_delete_message         = get_option('user_delete_message');
    $get_delete_message_subject = get_option('user_delete_message_subject');

    echo '<div class="wrap ic-settings-box">'; ?>
    <h2><?php _e('This message will be send through email during user registration.', 'icsf-steps-form') ?></h2>
    <form method="post">
        <label for="ic_user_message_subject">Subject</label>
        <input class="widefat" type="text" name="ic_user_message_subject" value="<?php echo $get_message_subject; ?>" />
        <br/>
        <br/>
        <label for="ic_user_message">Message</label>
        <textarea class="widefat" name="ic_user_message" id="ic_user_message" cols="30" rows="10"><?php echo $get_message; ?></textarea>
        <input type="hidden" name="icsf_action" value="1" />
        <button class="button button-primary button-large" type="submit"><?php _e('Add Register Message', 'icsf-steps-form') ?></button>
        <?php wp_nonce_field('user_message') ?>
    </form>

    <br/>
    <br/>
    <hr/>
    <br/>
    <h2><?php _e('This message will be send through email during user delete.', 'icsf-steps-form') ?></h2>
    <form method="post">
        <label for="ic_user_delete_message_subject">Subject</label>
        <input class="widefat" type="text" name="ic_user_delete_message_subject" value="<?php echo $get_delete_message; ?>" />
        <br/>
        <br/>
        <label for="ic_user_delete_message">Message</label>
        <textarea class="widefat" name="ic_user_delete_message" id="ic_user_delete_message" cols="30" rows="10"><?php echo $get_delete_message_subject; ?></textarea>
        <input type="hidden" name="icsf_delete_action" value="1" />
        <button class="button button-primary button-large" type="submit"><?php _e('Add Delete Message', 'icsf-steps-form') ?></button>
        <?php wp_nonce_field('user_delete_message') ?>
    </form>
    
    <?php
    echo '</div>';

} 


add_action('admin_footer', function(){
    ?>
    <style>
        .ic-settings-box label {
            display: block;
            font-size: 16px;
            margin: 0 0 8px;
        }
        .ic-settings-box textarea {
            padding: 15px;
            display: block;
            resize: none;
            height: 150px;
            margin: 0 0 8px;
            width: 100%;
        }

    </style>
    <?php
});