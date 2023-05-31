'use strict';

const form = $('#example-form');

form.validate({
    errorPlacement: function errorPlacement(error, element) {
        element.before(error)
    },
    rules: {
        confirm: {
            // equalTo: '#password',
        },
    },
})
 


form.steps({
    headerTag: 'h6',
    bodyTag: 'section',
    transitionEffect: 'fade',
    titleTemplate: '<span class="step">#index#</span> #title#',
    onStepChanging: function (event, currentIndex, newIndex) {
        
        form.validate().settings.ignore = ':disabled,:hidden'
        
        return form.valid()
    },
    onFinished: function (event, currentIndex) {
    },
})

$(document).ready(function () {
    var lastLi = $(".actions.clearfix ul[role='menu'] li:last")
    lastLi.append('<input type="submit" name="submit" value="Finish">')

    var message = $('.show-reg-msg')
    setTimeout(function () {
        message.remove()
    }, 10000)
})

jQuery(document).on('click', 'a[href="#finish"]', function (event) {
    var myForm = $('#example-form')
    // myForm.submit()
    // event.preventDefault()

    var name = $("input[name='name']").val()
    var user_name = $("input[name='user-name']").val()
    var email = $("input[name='email']").val()
    var phone = $("input[name='phone']").val()
    var pass = $("input[name='pass']").val()
    var confirmPass = $("input[name='confirm']").val()

    var present_addr = $("textarea[name='present-addr']").val()
    var permanentAddr = $("textarea[name='permanent-addr']").val()
    var nidNo = $("input[name='nid-no']").val()
    var fb_url = $("input[name='fburl']").val()
    var linkedin_url = $("input[name='linkedinurl']").val()
    var dob = $("input[name='date']").val()
    var business_name = $("input[name='business-name']").val()
    var position_name = $("input[name='position-name']").val()
    var business_email = $("input[name='business-email']").val()
    var business_phone = $("input[name='business-phone']").val()
    var url = $("input[name='url']").val()
    var last_educational_qualification = $(
        "input[name='last-educational']"
    ).val()

    var fathers_name = $("textarea[name='father-name']").val()
    var mothers_name = $("textarea[name='mother-name']").val()
    var isMarried = $("select[name='isMarried']").val()
    var spouse_name = $("input[name='spouse-name']").val()
    var anniversary = $("input[name='anniversary']").val()
    var haveChild = $("select[name='have-children']").val()

    var first_child_name = $("input[name='first-kids-name']").val()
    var first_child_dob = $("input[name='first-kids-dob']").val()
    var first_child_gender = $("input[name='first-kids-gender']").val()

    var second_child_name = $("input[name='second-kids-name']").val()
    var second_child_dob = $("input[name='second-kids-dob']").val()
    var second_child_gender = $("input[name='second-kids-gender']").val()

    var third_child_name = $("input[name='third-kids-name']").val()
    var third_child_dob = $("input[name='third-kids-dob']").val()
    var third_child_gender = $("input[name='third-kids-gender']").val()

    const fileInput = document.querySelector('input[name="photo"]');
const file = fileInput.files[0];

const nid = document.querySelector('input[name="photo"]');
const nidFile = nid.files[0];

const formData = new FormData();
formData.append('photo', file);
formData.append('nidFile', nidFile);

formData.append('fathers_name', fathers_name);
formData.append('mothers_name', mothers_name );

formData.append('action', 'helloWorld');

    // const formData = new FormData()
    const data = myForm.serializeArray();

    var storeData = ['name', 'email', 'phone', 'pass', 'confirm'];
        let datas = {}
        jQuery.each( data, function( index, field ) {
            if( storeData.indexOf( field.name ) !== -1 ) {
                datas[field.name] = field.value
            }
        })
    console.log(JSON.stringify(data))
    // jQuery.ajax({
        
        // url: myObj.ajaxUrl,
        // type: 'POST',
        // dataType: 'json',
        // contentType: false,
        // cache: false,
        // processData: false,
        // data: formData,
        // data: datas,
        var myformsData = {
            data: datas,
            action: "helloWorld",
        }

    $.post( myObj.ajaxUrl, myformsData, function (response) {
            console.log( response )
            // $('.form-handler-message').html(response.data.message)
        }).
        fail(function (err) {
            console.log('err ', err)
            // $('.form-handler-message').html(err)
        })
    })

$('select[name="isMarried"]').on('change', function () {
    var selectedValue = $(this).val()
    if (selectedValue === '1') {
        $('.condition-1').show()
    } else {
        $('.condition-1').hide()
        $('.condition-2').hide()
    }
})

$('select[name="have-children"]').on('change', function () {
    var selectedValue = $(this).val()
    if (selectedValue === '1') {
        $('.condition-2').show()
    } else {
        $('.condition-2').hide()
    }
})


