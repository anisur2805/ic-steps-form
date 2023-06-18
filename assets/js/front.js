var form = $("#example-form");
form.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
        confirm: {
            equalTo: "#password"
        },
        isMarried: "required"
    }
});

// Set message for conform password
$.extend($.validator.messages, {
    equalTo: "Enter same password"
});

form.steps({
    headerTag: "h6",
    bodyTag: "section",
    transitionEffect: "fade",
    titleTemplate: '<span class="step">#index#</span> #title#',
    onStepChanging: function (event, currentIndex, newIndex)
    {
        
        if( newIndex == 3 ) {
            var married = $('select[name="isMarried"]');
            var marriedWrapper = $('.is-married-col');
        
            if (married.val() == '0') {
                marriedWrapper.addClass('error');
            }
        
            if (married.val() !== '0') {
                marriedWrapper.removeClass('error');
            }
        }
        
        form.validate().settings.ignore = ":disabled,:hidden";
        return form.valid();
    },
    onFinished: function (event, currentIndex) {
    },
})


$(document).ready(function() {
    var lastLi = $(".actions.clearfix ul[role='menu'] li:last");
    lastLi.append('<input type="submit" name="submit" value="Finish">');

    var message = $('.show-reg-msg');
    setTimeout(function() {
        message.remove();
    }, 5000);



    // $('.ic_dob').on('change', function() {
    //     var dateVal = $(this).val();
    //     var regex =  /^\d{2}-\d{2}-\d{4}$/;
        
    //     if (!regex.test(dateVal)) {
    //         alert('Please enter a valid year!');
    //         $(this).val(''); // Reset the input value
    //     }
    // });

    const selectors = ['.ic_dob', '.anniversary', '.first-kids-dob', '.second-kids-dob', '.third-kids-dob'];
    $(selectors.join(', ')).on('change', function() {
        const dateVal = $(this).val();
        const regex = /^\d{2}-\d{2}-\d{4}$/;

        if (!regex.test(dateVal)) {  
            const selectedDate = new Date(dateVal);
            const currentDate = new Date();

            if (selectedDate.getFullYear() > currentDate.getFullYear()) {
                alert('Please enter a year that is not greater than the current year!');
                $(this).val(''); // Reset the input value
            }
        }
    });



});


$('select[name="isMarried"]').on('change', function(){
    
    var selectedValue = $(this).val();

    if (selectedValue !== '0') {
        $(this).parent('.is-married-col').removeClass('error');
    }

    if (selectedValue === '1') {
        $('.condition-1').show();
    } else {
        $('.condition-1').hide();
        $('.condition-2').hide();
    }

});

$('select[name="have-children"]').on('change', function(){
    var selectedValue = $(this).val();

    if (selectedValue === '1') {
        $('.condition-2').show();
    } else {
        $('.condition-2').hide();
    }

});