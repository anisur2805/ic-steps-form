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

        /*
        * Toggle Modal
        * */
        jQuery('body').on('click', '.modal-toggle', function(e) {
            e.preventDefault();
            console.log( 'hello' )
            jQuery('.modal').addClass('show');
        });
        
        jQuery('body').on('click', '.modal-close', function(e) {
            e.preventDefault();
            jQuery('.modal').removeClass('show');
        });
        
    } );
 
    
} )( jQuery );