var form = $("#example-form");
form.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
        confirm: {
            equalTo: "#password"
        }
    }
});

form.steps({
    headerTag: "h6",
    bodyTag: "section",
    transitionEffect: "fade",
    titleTemplate: '<span class="step">#index#</span> #title#',
    onStepChanging: function (event, currentIndex, newIndex)
    {
        form.validate().settings.ignore = ":disabled,:hidden";
        return form.valid();
    },
    onFinished: function (event, currentIndex) {
        // location.reload();

        // console.log( new FormData(form) )
        // var myForms = $("#example-form");

        // var formData = $(this).serializeArray(),
        //    var formData= new FormData(this);

        //    console.log( this )

        // $.each($(this).find('input[type="file"]'), function(i, tag) {
        //     $.each($(tag)[0].files, function(i, file) {
        //         formParams.append(tag.name, file);
        //     });
        //   });
      
        //   $.each(formData, function(i, val) {
        //     formParams.append(val.name, val.value);
        //   });
        // var formData = new FormData(this);
            // console.log( formData )
        // return;
        // myForms.submit(function(e){
        // console.log( '025' )


        // var photo = $('input[name="photo"]').val();
        // var photo2 = $('input[name="photo"]');
            // photo = photo.files;

            // console.log( photo, photo2 )

        // jQuery.ajax({
            // url: myObj.ajaxUrl,
            // type: "POST",
            // dataType: 'json',
            // contentType: false,
            // cache: false,
            // processData:false,
            // data: {
                // data: formData,
                // data:  data ,
                // action: "customHandler",
                // nonce: myObj.nonce,
            // },
            // success: function (response) {
                // console.log( response )

                // $(".form-handler-message").html(response.data.message)
                // location.reload()
            // },
            // error: function (err) {
                // console.log("err ", err)
                // $(".form-handler-message").html(err)
            // },
        // });
        

        //     e.preventDefault();
        //     console.log( '2' )

        //     var formData = $(this).serialize();
        //     console.log( formData )
        // });
    },
})


$(document).ready(function() {
    var lastLi = $(".actions.clearfix ul[role='menu'] li:last");
    lastLi.append('<input type="submit" name="submit" value="Finish">');

    var message = $('.show-reg-msg');
    setTimeout(function() {
        message.remove();
    }, 10000);

});

  

$(document).ready(function () {
    let steps = 0;
    $('.actions ul[role="menu"]').addClass('position-relative');
    // $('ul[role="tablist"] li[role="tab"]').on('click',function(){
    //     var firstExampleLink = $(this).find("a#example-form-h-0:first");
    //     var secondExampleLink = $(this).find("a#example-form-h-1:first");
    //     var thirdExampleLink = $(this).find("a#example-form-h-2:first");
    //     var fourthExampleLink = $(this).find("a#example-form-h-3:first");
    //     if(firstExampleLink){
    //         console.log( 'firstExampleLink' )
    //         $('.submit-button-li').addClass('d-none')
    //         $('.submit-button-li').removeClass('d-block');
    //     }
    //     if(secondExampleLink){
    //         console.log( 'secondExampleLink' )
    //         $('.submit-button-li').addClass('d-none')
    //         $('.submit-button-li').removeClass('d-block');
    //     }
    //     if(thirdExampleLink){
    //         console.log( 'thirdExampleLink' )
    //         $('.submit-button-li').addClass('d-none')
    //         $('.submit-button-li').removeClass('d-block');
    //     }
    //     if(fourthExampleLink){
    //         console.log( 'fourthExampleLink' )
    //         $('.submit-button-li').removeClass('d-none')
    //         $('.submit-button-li').addClass('d-block');
    //     }
    // })


    // last 1
  /*
    $('#example-form-t-0').click(function (event) {
        $('.submit-button-li').hide();  
        console.log($('.submit-button-li')  )
    });
    $('#example-form-t-1').click(function () {
        $('.submit-button-li').hide();  
    });
    $('#example-form-t-2').click(function () {
        $('.submit-button-li').hide();  
    });

    $('#example-form-t-3').click(function () {
        $('.submit-button-li').show();  
    });
    */

// last 2
/*
    $('.actions a[role="menuitem"]').on('click', function() {
        let $previous = $(this).attr('href'); 

        if($previous == '#previous'){
            steps -= 1;
            
        } else {
            steps += 1;
        }
        console.log( steps )
        if( steps == 3){
            $('.submit-button-li').show();  
        }else {
            $('.submit-button-li').hide();  
        }

        let $a = $('.actions a[href="#finish"]');
        var $button = $('<button>').html($a.html()).attr('type', 'submit').attr('name', 'submit').html('Register');
        $a.replaceWith($button);
        // add submit-button-li to parent li
        $button.parent().addClass('submit-button-li');

    }) */
});


// jQuery(document).on("click", 'a[href="#finish"]', function (event) {
//     // $('input[name="submit"]').submit();
//     $('#example-form').submit();
// });

// jQuery(document).on("submit", '#example-form', function (event) {
//     // $('input[name="submit"]').submit();
//     // $('#example-form').submit();
//     console.log( event )
// });


// jQuery(document).on(
//     "click", 'a[href="#finish"]', function (event) {
//         var myForm = $("#example-form")
//         myForm.submit();
//         event.preventDefault();
        
//         // console.log( new Form( myForm) )

//         var name = $("input[name='name']").val()
//         var user_name = $("input[name='user-name']").val()
//         var email = $("input[name='email']").val()
//         var phone = $("input[name='phone']").val()
//         var pass = $("input[name='pass']").val()
//         var confirmPass = $("input[name='confirm-pass']").val()

//         var present_addr = $("textarea[name='present-addr']").val()
//         var permanentAddr = $("textarea[name='permanent-addr']").val()
//         var nidNo = $("input[name='nid-no']").val()
//         var fb_url = $("input[name='fburl']").val()
//         var linkedin_url = $("input[name='linkedinurl']").val()
//         var dob = $("input[name='date']").val()
//         var business_name = $("input[name='business-name']").val()
//         var position_name = $("input[name='position-name']").val()
//         var business_email = $("input[name='business-email']").val()
//         var business_phone = $("input[name='business-phone']").val()
//         var url = $("input[name='url']").val()
//         var last_educational_qualification = $("input[name='last-educational']").val()

//         var fathers_name = $("textarea[name='father-name']").val()
//         var mothers_name = $("textarea[name='mother-name']").val()
//         var isMarried = $("select[name='isMarried']").val()
//         var spouse_name = $("input[name='spouse-name']").val()
//         var anniversary = $("input[name='anniversary']").val()
//         var haveChild = $("select[name='have-children']").val()

//         var first_child_name = $("input[name='first-kids-name']").val()
//         var first_child_dob = $("input[name='first-kids-dob']").val()
//         var first_child_gender = $("input[name='first-kids-gender']").val()

//         var second_child_name = $("input[name='second-kids-name']").val()
//         var second_child_dob = $("input[name='second-kids-dob']").val()
//         var second_child_gender = $("input[name='second-kids-gender']").val()
        
//         var third_child_name = $("input[name='third-kids-name']").val()
//         var third_child_dob = $("input[name='third-kids-dob']").val()
//         var third_child_gender = $("input[name='third-kids-gender']").val()

//         // var company_name = $("input[name='company-name']").val()
//         // var workAddr = $("input[name='work-address']").val()
//         // var homeAddr = $("input[name='home-address']").val()
//         // var url = $("input[name='url']").val()
//         // var businessType = $("input[name='business-type']").val()
//         // var education = $("input[name='education']").val()
//         // var fax = $("input[name='fax']").val()

//         const fileInput = document.querySelector('input[name="photo"]');
//         const file = fileInput.files[0];

//         console.log( 'file ', file )
//         const formData = new FormData();
//         formData.append('photo', file);
        
//         // var photoName = $("input[name='photo']");
//         //     photo = photoName[0].files[0];

//         // console.log( 'photoName', photoName )
//         // console.log( 'photo', photo )

//         // var nid = $("input[name='nid']").val()
//         // var trade = $("input[name='trade']").val()
//         // var cv = $("input[name='cv']").val()

//         // var date = $("input[name='date']").val()

//         // var formData = new FormData();
//         // formData.append("name", name);
//         // formData.append("user_name", user_name);
//         // formData.append("email", email);
//         // formData.append("phone", phone);
//         // formData.append("pass", pass);
//         // formData.append("confirmPass", confirmPass);
//         // formData.append("presentAddr", present_addr);
//         // formData.append("permanentAddr", permanentAddr);
//         // formData.append("nidNo", nidNo);
//         // formData.append("fb_url", fb_url);
//         // formData.append("linkedin_url", linkedin_url);
//         // formData.append("business_name", business_name);
//         // formData.append("position_name", position_name);
//         // formData.append("business_email", business_email);
//         // formData.append("business_phone", business_phone);
//         // formData.append("url", url);
//         // formData.append("last_educational_qualification", last_educational_qualification);
//         // formData.append("fathers_name", fathers_name);
//         // formData.append("mothers_name", mothers_name);
//         // formData.append("isMarried", isMarried);
//         // formData.append("spouse_name", spouse_name);
//         // formData.append("anniversary", anniversary);
//         // formData.append("haveChild", haveChild);
//         // formData.append("first_child_name", first_child_name);
//         // formData.append("first_child_dob", first_child_dob);
//         // formData.append("first_child_gender", first_child_gender);
//         // formData.append("second_child_name", second_child_name);
//         // formData.append("second_child_dob", second_child_dob);
//         // formData.append("second_child_gender", second_child_gender);
//         // formData.append("third_child_name", third_child_name);
//         // formData.append("third_child_dob", third_child_dob);
//         // formData.append("third_child_gender", third_child_gender);

//         var data = {
//             name: name,
//             user_name: user_name,
//             email: email,
//             phone: phone,
//             pass: pass,
//             confirmPass: confirmPass,

//             presentAddr: present_addr,
//             permanentAddr: permanentAddr,
//             nidNo: nidNo,
//             fb_url: fb_url,
//             linkedin_url: linkedin_url,
//             dob :dob,
//             business_name:business_name,
//             position_name:position_name,
//             business_email:business_email,
//             business_phone:business_phone,

//             url :url,
//             last_educational_qualification :last_educational_qualification,
//             fathers_name :fathers_name,
//             mothers_name :mothers_name,
//             isMarried :isMarried,
//             spouse_name :spouse_name,
//             anniversary :anniversary,
//             haveChild :haveChild,

//             first_child_name :first_child_name,
//             first_child_dob :first_child_dob,
//             first_child_gender :first_child_gender,
//             second_child_name :second_child_name,
//             second_child_dob :second_child_dob,
//             second_child_gender :second_child_gender,

//             third_child_name :third_child_name,
//             third_child_dob :third_child_dob,
//             third_child_gender :third_child_gender,

//             // photo: photo,
//             // nid: nid,
//             // trade: trade,
//             // cv: cv,
//         }

//         console.log( JSON.stringify( formData ) )
//         jQuery.ajax({
//             url: myObj.ajaxUrl,
//             type: "POST",
//             dataType: 'json',
//             contentType: false,
//             cache: false,
//             processData:false,
//             data: {
//                 data: JSON.stringify( formData ) ,
//                 // data:  data ,
//                 action: "formHandler",
//                 nonce: myObj.nonce,
//             },
//             success: function (response) {
//                 console.log( response )

//                 $(".form-handler-message").html(response.data.message)
//                 // location.reload()
//             },
//             error: function (err) {
//                 console.log("err ", err)
//                 $(".form-handler-message").html(err)
//             },
//         })
//     }
// )


$('select[name="isMarried"]').on('change', function(){
    
    var selectedValue = $(this).val();

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