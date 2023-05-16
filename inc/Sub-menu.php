<?php

add_action('admin_menu', function() {
    add_submenu_page(
        'ic-register-users', 'Settings', 'Settings', 'manage_options', 'ic-register-user-setting', 
       'ic_register_user_settings'
    );
});
function ic_register_user_settings() {
    
    $get_message                 = get_option('user_message');
    $get_message_subject         = get_option('user_message_subject');

    $get_admin_message_subject   = get_option('ic_admin_message_subject');
    $get_admin_message           = get_option('ic_admin_message');

    $get_delete_message          = get_option('user_delete_message');
    $get_delete_message_subject  = get_option('user_delete_message_subject');

    $get_confirm_message         = get_option('get_confirm_message');
    $get_confirm_message_subject = get_option('get_confirm_message_subject');

    $ic_user_reject_message      = get_option('ic_user_reject_message');
    $get_reject_message_subject  = get_option('ic_user_reject_message_subject');

    echo '<div class="wrap ic-settings-box">'; ?>
    <h2><?php _e('This mail is for user ( registration )', 'icsf-steps-form') ?></h2>
    <form method="post">
        <label for="ic_user_message_subject">Subject</label>
        <input class="widefat" type="text" name="ic_user_message_subject" id="ic_user_message_subject" value="<?php echo $get_message_subject; ?>" />
        <br/>
        <br/>
        <label for="ic_user_message">Message</label>
        <textarea class="widefat" name="ic_user_message" id="ic_user_message" cols="30" rows="10"><?php echo $get_message; ?></textarea>
        <input type="hidden" name="icsf_action" value="1" />
        <button class="button button-primary button-large" type="submit"><?php _e('Add Register Mail', 'icsf-steps-form') ?></button>
        <?php wp_nonce_field('user_message') ?>
    </form>

    <br/>
    <br/>
    <hr/>
    <br/>
    <h2><?php _e('This mail is for admin ( registration )', 'icsf-steps-form') ?></h2>
    <form method="post">
        <label for="ic_admin_message_subject">Subject</label>
        <input class="widefat" type="text" name="ic_admin_message_subject" id="ic_admin_message_subject" value="<?php echo $get_admin_message_subject; ?>" />
        <br/>
        <br/>
        <label for="ic_admin_message">Message</label>
        <textarea class="widefat" name="ic_admin_message" id="ic_admin_message" cols="30" rows="10"><?php echo $get_admin_message; ?></textarea>
        <input type="hidden" name="icsf_admin_action" value="1" />
        <button class="button button-primary button-large" type="submit"><?php _e('Add Admin Mail', 'icsf-steps-form') ?></button>
        <?php wp_nonce_field('admin_message') ?>
    </form>

    <br/>
    <br/>
    <hr/>
    <br/>
    <h2><?php _e('This mail is for User Confirmation.', 'icsf-steps-form') ?></h2>
    <form method="post">
        <label for="get_confirm_message_subject">Subject</label>
        <input class="widefat" type="text" name="get_confirm_message_subject" id="get_confirm_message_subject" value="<?php echo $get_confirm_message_subject; ?>" />
        <br/>
        <br/>
        <label for="get_confirm_message">Message</label>
        <textarea class="widefat" name="get_confirm_message" id="get_confirm_message" cols="30" rows="10"><?php echo $get_confirm_message; ?></textarea>
        <input type="hidden" name="icsf_confirm_action" value="1" />
        <button class="button button-primary button-large" type="submit"><?php _e('Add Confirm Mail', 'icsf-steps-form') ?></button>
        <?php wp_nonce_field('user_confirm_message') ?>
    </form>

    
    <br/>
    <br/>
    <hr/>
    <br/>
    <h2><?php _e('This mail is for User Reject.', 'icsf-steps-form') ?></h2>
    <form method="post">
        <label for="ic_user_reject_message_subject">Subject</label>
        <input class="widefat" type="text" name="ic_user_reject_message_subject" id="ic_user_reject_message_subject" value="<?php echo $get_reject_message_subject; ?>" />
        <br/>
        <br/>
        <label for="ic_user_reject_message">Message</label>
        <textarea class="widefat" name="ic_user_reject_message" id="ic_user_reject_message" cols="30" rows="10"><?php echo $ic_user_reject_message; ?></textarea>
        <input type="hidden" name="icsf_reject_action" value="1" />
        <button class="button button-primary button-large" type="submit"><?php _e('Add Reject Mail', 'icsf-steps-form') ?></button>
        <?php wp_nonce_field('user_reject_message') ?>
    </form>

    <br/>
    <br/>
    <hr/>
    <br/>

    <h2><?php _e('This mail is for User Delete', 'icsf-steps-form') ?></h2>
    <form method="post">
        <label for="ic_user_delete_message_subject">Subject</label>
        <input class="widefat" type="text" name="ic_user_delete_message_subject" id="ic_user_delete_message_subject" value="<?php echo $get_delete_message; ?>" />
        <br/>
        <br/>
        <label for="ic_user_delete_message">Message</label>
        <textarea class="widefat" name="ic_user_delete_message" id="ic_user_delete_message" cols="30" rows="10"><?php echo $get_delete_message_subject; ?></textarea>
        <input type="hidden" name="icsf_delete_action" value="1" />
        <button class="button button-primary button-large" type="submit"><?php _e('Add Delete Mail', 'icsf-steps-form') ?></button>
        <?php wp_nonce_field('user_delete_message') ?>
    </form>
    <?php
    echo '</div>';

    $get_message         = get_option('user_message');
    $get_message_subject = get_option('user_message_subject');
    $get_admin_message_subject   = get_option('ic_admin_message_subject');
    $get_admin_message           = get_option('ic_admin_message');
    $get_confirm_message         = get_option('get_confirm_message');
    $get_confirm_message_subject = get_option('get_confirm_message_subject');

    $ic_user_reject_message      = get_option('ic_user_reject_message');
    $get_reject_message_subject  = get_option('ic_user_reject_message_subject');


    // $email = 'anisur@tem.com';
    // $url = 'https://facebook.com';
    // $get_admin_message_subject   = get_option('ic_admin_message_subject');
    // $admin_updated_message = str_replace("[Email]", $email, $get_admin_message_subject);
    // $admin_url = str_replace("[url]", $url, $get_admin_message);

    // var_dump( [
    //     $admin_url,
    //  $admin_updated_message] );



    // $name = 'Anisur Rahman';
    // $get_message = get_option('user_message');

    // $updated_message = str_replace("[full_name]", $name, $get_message);
    // echo $updated_message;
    // var_dump([ $get_admin_message_subject, $get_admin_message ]) . "\n";
    // var_dump([ $get_message, $get_message_subject  ]) . '<br/>';
    // var_dump([ $get_confirm_message, $get_confirm_message_subject  ]) . '<br/>';
    // var_dump([ $ic_user_reject_message, $get_reject_message_subject  ]) . '<br/>';


    // $url = 'https:website.com';
    // $username = 'anisur';
    // $business_name = 'website_anisur';
    // $phone = '0174';
    // $email = 'test@gmail.com';

    // $admin_updated_message = str_replace("[Email]", $email, $get_admin_message_subject);
    // // $business_url      = str_replace("[url]", $url, $get_admin_message);
    // $admin_email    = get_option( 'admin_email' );

    // $replace_shortcode = [
    //     "[url]"           => $url,
    //     "[username]"      => $username,
    //     "[company_name]"  => $business_name,
    //     "[Phone]"         => $phone,
    //     "[Email]"         => $email,
    //     "[Time]"          => date("Y/m/d"),
    // ];
    // $get_admin_message = strtr( $get_admin_message, $replace_shortcode );
            
    // echo '<pre>';
    //      var_dump([
    //         $admin_updated_message,
    //         $get_admin_message
    //      ]);
    // echo '</pre>';

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
            height: 150px;
            margin: 0 0 8px;
            width: 100%;
        }

    </style>
    <?php
});