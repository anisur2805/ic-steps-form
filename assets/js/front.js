'use strict';

const form = $('#ic-steps-form');

form.validate({
    errorPlacement: function errorPlacement(error, element) {
        element.before(error)
    },
    rules: {
        confirm: {
            equalTo: "#password"
        },
        isMarried:{
            required: true,
        },
    },
    messages: {
        isMarried:{
            required: "Please select marital status",
        }
    },
});

// Set message for conform password
$.extend($.validator.messages, {
    equalTo: "Password do not match"
});

form.steps({
    headerTag: 'h6',
    bodyTag: 'section',
    transitionEffect: 'fade',
    titleTemplate: '<span class="step">#index#</span> #title#',
    onStepChanging: function (event, currentIndex, newIndex) {       
        form.validate().settings.ignore = ":disabled,:hidden";
        return form.valid();
    },
    onFinishing: function( event, currentIndex ) {
        form.validate().settings.ignore = ":disabled";
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


// Phone number validation
(function birthDateValidate() {
    var businessPhoneNumberInput = document.querySelector('input[name="business-phone"]');
    var phoneNumberInput         = document.querySelector('input[name="phone"]');   

    // Define the input event listener function
    const inputEventListener = function() {
    // Remove any non-numeric characters except '+'
    this.value = this.value.replace(/[^0-9+]/g, '');
    };

    // Add input event listener to businessPhoneNumberInput
    businessPhoneNumberInput.addEventListener('input', inputEventListener);

    // Add input event listener to phoneNumberInput
    phoneNumberInput.addEventListener('input', inputEventListener);
})();


$(document).on('change', 'select[name="isMarried"]', function() {
    var selectedValue = $(this).val();
    if (selectedValue === '1') {
      $('.condition-1').show();
    } else {
      $('.condition-1').hide();
      $('.condition-2').hide();
    }
  });
  

$('select[name="have-children"]').on('change', function () {
    var selectedValue = $(this).val()
    if (selectedValue === '1') {
        $('.condition-2').show()
        $('.have_second_child').show()
    } else {
        $('.condition-2').hide()
        $('.have_second_child').hide()
        $('.conditional_child').hide()
        $('.condition-3').hide()
        $('.condition-4').hide()
    }
});

$('.have_second_child i').on('click', function () {
    // var selectedValue = $(this).val()
    $('.condition-3').show()
    $('.have_third_child').show()
});

$('.have_third_child i').on('click', function () {
    // var selectedValue = $(this).val()
    $('.condition-4').show()
    // $('.have_second_child').show()
});