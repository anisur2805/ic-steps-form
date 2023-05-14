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
            var spanElement = $(this).prev('span');
            var data = {
                data_id: $(this).data('update-id'),
                action: 'icsf_update_user',
            }
            $.post(myTableObjUpdate.ajaxUrl, data, function (response) {
                spanElement.text( response.data.status )
                spanElement.addClass('success')
                self.addClass('disabled')
                self.prop('disabled',  response.data.disabled );
            }).fail(function (e) {
                console.log(myTableObjUpdate.error, e)
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
        
    } );
 
    
} )( jQuery );