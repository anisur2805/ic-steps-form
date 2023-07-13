"use strict"

const form = $("#ic-steps-form")

form.validate({
    errorPlacement: function errorPlacement(error, element) {
        element.before(error)
    },
    rules: {
        confirm: {
            equalTo: "#password",
        },
        isMarried: {
            required: true,
        },
    },
    messages: {
        isMarried: {
            required: "Please select marital status",
        },
    },
})

// Set message for conform password
$.extend($.validator.messages, {
    equalTo: "Password do not match",
})

form.steps({
    headerTag: "h6",
    bodyTag: "section",
    transitionEffect: "fade",
    titleTemplate: '<span class="step">#index#</span> #title#',
    onStepChanging: function (event, currentIndex, newIndex) {
        form.validate().settings.ignore = ":disabled,:hidden"
        return form.valid()
    },
    onFinishing: function (event, currentIndex) {
        form.validate().settings.ignore = ":disabled"
        return form.valid()
    },
    onFinished: function (event, currentIndex) {},
})

$(document).ready(function () {
    var lastLi = $(".actions.clearfix ul[role='menu'] li:last")
    lastLi.append('<input type="submit" name="submit" value="Finish">')

    var message = $(".show-reg-msg")
    setTimeout(function () {
        message.remove()
    }, 5000)

    const selectors = [
        ".ic_dob",
        ".anniversary",
        ".first-kids-dob",
        ".second-kids-dob",
        ".third-kids-dob",
    ]
    $(selectors.join(", ")).on("change", function () {
        const dateVal = $(this).val()
        const regex = /^\d{2}-\d{2}-\d{4}$/

        if (!regex.test(dateVal)) {
            const selectedDate = new Date(dateVal)
            const currentDate = new Date()

            if (selectedDate.getFullYear() > currentDate.getFullYear()) {
                alert("Please enter a valid year!")
                $(this).val("")
            }
        }
    })
})

jQuery(document).ready(function ($) {
    const selectors = [
        ".ic_dob",
        ".anniversary",
        ".first-kids-dob",
        ".second-kids-dob",
        ".third-kids-dob",
    ]
    $(selectors.join(", ")).datepicker({
        dateFormat: "dd/mm/yy", // Set the desired date format
        maxDate: 0, // Set the maximum date to the current date

        beforeShow: function (input, inst) {
            inst.dpDiv.addClass("custom-datepicker") // Add a custom class to the datepicker
        },

        onSelect: function (dateText, inst) {
            var selectedDate = $(this).datepicker("getDate")
            var currentDate = new Date()

            if (selectedDate > currentDate) {
                alert("Please select a valid date.")
                $(this).val("")
            }

            var year = selectedDate.getFullYear()
            if (year.toString().length > 4) {
                alert("Please enter a valid year (up to 4 digits).")
                $(this).val("")
            }
        },
        yearRange: "c-100:c+10", // Set the range of years to display in the dropdown menu
        changeYear: true, // Enable year selection
    })

    $(
        ".ic_dob",
        ".anniversary",
        ".first-kids-dob",
        ".second-kids-dob",
        ".third-kids-dob"
    ).on("keyup", function (e) {
        let userDate = e.target.value
        let currentDate = new Date()
        let formatDate = currentDate.toLocaleDateString("en-GB")
        if (userDate > formatDate) {
            alert("Please enter a valid date!")
            $(this).val("")
        }
    })
})

// Click event listener for document
$(document).on("click", function (event) {
    var target = event.target

    var userDropdown = $(".ic-user-dropdown")[0]
    var navbarLoggedOut = $(".ic-navbar-logged-out")

    if (userDropdown) {
        // Check if the target element is not contained within the user dropdown
        if (!userDropdown.contains(target)) {
            navbarLoggedOut.removeClass("active-dropdown")
        }
    }
})

// Click event listener for mobile login dropdown button
$("body").on(
    "click",
    ".ic-mobile-login-dropdown button#dropdownMenuButton1",
    function (event) {
        event.stopPropagation()
        var navbarLoggedOut = $(".ic-navbar-logged-out")

        navbarLoggedOut.addClass("active-dropdown")
    }
)

// Phone number validation
;(function birthDateValidate() {
    var businessPhoneNumberInput = document.querySelector(
        'input[name="business-phone"]'
    )
    var phoneNumberInput = document.querySelector('input[name="phone"]')

    // Define the input event listener function
    const inputEventListener = function () {
        // Remove any non-numeric characters except '+'
        this.value = this.value.replace(/[^0-9+]/g, "")
    }

    // Add input event listener to businessPhoneNumberInput
    if (businessPhoneNumberInput) {
        businessPhoneNumberInput.addEventListener("input", inputEventListener)
    }
    // Add input event listener to phoneNumberInput
    if (phoneNumberInput) {
        phoneNumberInput.addEventListener("input", inputEventListener)
    }
})()

jQuery(document).ready(function () {
    icHandleMarriedStatus();
    icHandleHaveChild();
    icHandleSecondChild();
    icHandleThirdChild();
});

// For Step 1 
function icHandleMarriedStatus() {
    let isMarriedValue = jQuery('#isMarried').val();
  
    if (isMarriedValue === '1') {
      jQuery(".condition-1, .first-child-select-row").show();
    } else {
      jQuery('select[name="have-children"]').val('');
      jQuery('.have_second_child select, .have_third_child select').val('');
      
      jQuery(".condition-1, .condition-2, .condition-3, .condition-4").hide();
      jQuery('.have_second_child, .have_third_child').hide();
    }
  }
  

// Step 2
function icHandleHaveChild() {
    let haveSecondChild = jQuery('select[name="have-children"]').val();
    if( haveSecondChild == 1 ) {
        jQuery(".have_second_child").show();
        jQuery(".condition-2").show();
    } else {
        jQuery(".condition-2, .condition-3, .have_second_child").hide()
        jQuery('.have_second_child select, .have_third_child select').val('');

    }

}

// Step 3
function icHandleSecondChild() {
    let haveSecondChild = jQuery('.have_second_child select').val();

    if ( haveSecondChild === '1') {
        jQuery(".condition-3, .condition-4, .have_third_child").show()
    } else {
        jQuery(".condition-3, .condition-4, .have_third_child").hide();
        jQuery('.have_third_child select').val('');

    }

}

// Step 4
function icHandleThirdChild() {
    let haveThirdChild = jQuery('.have_third_child select').val();
    if ( haveThirdChild === '1') {
        jQuery(".condition-4").show()
    } else {
        jQuery(".condition-4").hide()
    }
}

jQuery('#isMarried').on('change', function (e) {
    e.preventDefault();
    icHandleMarriedStatus();
    icHandleHaveChild();
});

jQuery(document).on('change', 'select[name="have-children"]', function (e) {
    e.preventDefault();
    icHandleHaveChild();
    icHandleSecondChild();
});

jQuery(document).on('change', '.have_second_child select', function (e) {
    e.preventDefault();
    icHandleSecondChild();
    icHandleThirdChild();

});

jQuery(document).on('change', '.have_third_child select', function (e) {
    e.preventDefault();
    icHandleThirdChild();
});