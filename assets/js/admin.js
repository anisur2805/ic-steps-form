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

        // Ajax call for display more action dropdown #1
        $('body').on('click', 'table.subscribers .view-more-btn', function(e){
            $(this).closest('tr').addClass("show-more-action");
        });
        // Ajax call for hide more action dropdown #2
        $(document).on('click', function(event) {
            var target = $(event.target);
            if (target.hasClass('view-more-btn')) {
              target.closest('tr').addClass('show-more-action');
            } else if (!target.closest('.ic-action-button-wrapper').length) {
              $('.show-more-action').removeClass('show-more-action');
            }
        });

        // in admin panel check password and confirm password are same
        $(document).ready(function() {
            $('#confirm').on('keyup', function() {
                var password = $('#password').val();
                var confirmPassword = $(this).val();
                if (password !== confirmPassword) {
                    $('#password-error').text("Passwords do not match.").show();
                    document.querySelector('button[name="update-user"]').disabled = true;
                } else {
                    $('#password-error').hide();
                    document.querySelector('button[name="update-user"]').disabled = false;
                }
            });
        });
        
        // print the view page
        function printSection() {
            // Hide all elements except the desired section for printing
            const sectionsToHide = document.querySelectorAll('body > *:not(.print-section)');
            sectionsToHide.forEach((section) => {
              section.style.display = 'none';
            });
          
            // Apply print styles
            const style = document.createElement('style');
            style.innerHTML = '@media print { body { margin: 0; } }';
            document.head.appendChild(style);
          
            // Print the desired section
            window.print();
          
            // Remove the print styles
            style.parentNode.removeChild(style);
          
            // Restore the visibility of the hidden sections
            sectionsToHide.forEach((section) => {
              section.style.display = '';
            });
          }          
          

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

        // Ajax call for delete user based on click action delete button
        $('body').on('click', 'table.subscribers .row-actions .delete a', function(e){
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