; ( function ( $ ) {
    $( document ).ready( function () {
        // Ajax call for display users details based on click `id`
        $('button.modal-toggle.view-popup').on('click', function(e){
            e.preventDefault();

            var data = {
                data_id: $(this).data('id'),
                action: 'display_single_user',
            }
            $.post(myTableObj.ajaxUrl, data, function (response) {
                $('.modal-wrapper-footer').html(response)
                $('.modal-wrapper-footer').show();
            }).fail(function (e) {
                console.log(icHandler.error, e)
            });

        });

        // Ajax call for delete user based on click `id`
        $('body').on('click', 'table.subscribers .icsf-delete-user', function(e){
            e.preventDefault();

            if ( !confirm( myTableObjDelete.confirm ) ) {
				return;
			}

            var self = $(this);
            var data = {
                data_id: $(this).data('delete-id'),
                action: 'icsf_delete_user',
            }
            $.post(myTableObjDelete.ajaxUrl, data, function (response) {
                self.closest("tr")
                    .css("background-color", "red")
                    .hide(400, function () {
                        $(this).remove();
                    });

            }).fail(function (e) {
                console.log(myTableObjDelete.error, e)
            });

        });
        
        // Ajax call for Update user status based on click `id`
        $('body').on('click', 'table.subscribers .icsf-update-user', function(e){
            e.preventDefault();

            if ( !confirm( myTableObjUpdate.confirm ) ) {
				return;
			}
            
            var self = $(this);
            var val = $(this).prev('select').val();
            var spanElement = $(this).prev('span');
            var data = {
                data_id: $(this).data('update-id'),
                action: 'icsf_update_user',
                status: val
            }
            $.post(myTableObjUpdate.ajaxUrl, data, function (response) {

            }).fail(function (e) {
                console.log(myTableObjUpdate.error, e)
            });

        });

        // Ajax call for send confirm email to user based on status on click `id`
        $('body').on('click', 'table.subscribers .icsf-send-confirm-email', function(e){
            e.preventDefault();

            if ( !confirm( confirmEmailSendObj.confirm ) ) {
				return;
			}
            
            var self = $(this);
            var data = {
                data_id:    $(this).data('id'),
                data_email: $(this).data('email'),
                action:     'icsf_confirm_email_send',
            }
            $.post(confirmEmailSendObj.ajaxUrl, data, function (response) {
                console.log( 'response', response )
                $('wrap h1').append(
                    response.data.message_body
                )
                console.log( response.data.message_body )
            }).fail(function (e) {
                console.log(confirmEmailSendObj.error, e)
            });

        });


        // Ajax call for send reject email to user based on status on click `id`
        $('body').on('click', 'table.subscribers .icsf-send-reject-email', function(e){
            e.preventDefault();

            if ( !confirm( rejectEmailSendObj.confirm ) ) {
				return;
			}
            
            var self = $(this);
            var data = {
                data_id:    $(this).data('id'),
                data_email: $(this).data('email'),
                action:     'icsf_reject_email_send',
            }
            $.post(rejectEmailSendObj.ajaxUrl, data, function (response) {
                console.log( 'response', response )

            }).fail(function (e) {
                console.log(rejectEmailSendObj.error, e)
            });

        });

        /*
        * Toggle Modal
        * */
        jQuery('body').on('click', '.modal-toggle', function(e) {
            e.preventDefault();
            jQuery('.modal').addClass('show');
        });
        
        jQuery('body').on('click', '.modal-close', function(e) {
            e.preventDefault();
            jQuery('.modal').removeClass('show');
        });

        // Ajax call for delete user status based on click `id`
        $('body').on('click', '.ic-delete-status', function(e){
            e.preventDefault();

            if ( !confirm( myTableStatusDelete.confirm ) ) {
                return;
            }

            var self = $(this);
            var data = {
                data_id: $(this).data('delete-id'),
                action: 'icsf_delete_user_status',
            }
            $.post(myTableStatusDelete.ajaxUrl, data, function (response) {
                self.closest("tr")
                    .css("background-color", "red")
                    .hide(400, function () {
                        $(this).remove();
                    });

            }).fail(function (e) {
                console.log(myTableStatusDelete.error, e)
            });

        });
        
    } );
 
    
} )( jQuery );