/*
|--------------------------------------------------------------------------
| Document ready
|--------------------------------------------------------------------------
*/
$( document ).ready(function() {
    adminLoginFormValidation();
    customerRegisterFormValidation();
    userCreateFormValidation();
    userRoleCreateFormValidation();
    customerCreateFormValidation();
    brandFormValidation();
    productValidation();
    categoryFormValidation();
    changeProductStatusFormValidation();
    additionalMethod();
});


/*
|--------------------------------------------------------------------------
| Admin Login form
|--------------------------------------------------------------------------
*/
function adminLoginFormValidation(){    
    $("#admin-login-form").validate({
        ignore: "input[type=hidden]",
        errorClass: "text-danger custom",
        successClass: "text-success",
        highlight: function (element, errorClass) {
            $(element).removeClass(errorClass)
        },
        unhighlight: function (element, errorClass) {
            $(element).removeClass(errorClass)
        },
        errorPlacement: function (error, element) {
            element.closest( ".input-group" ).append( error);
        },
        submitHandler: function (form) {
            invokeLoader();
            form.submit();
        }
    })
}

/*
|--------------------------------------------------------------------------
| Customer Register form
|--------------------------------------------------------------------------
*/
function customerRegisterFormValidation(){    
    $("#customer-register-form").validate({
        ignore: "input[type=hidden]",
        errorClass: "text-danger custom",
        successClass: "text-success",
        highlight: function (element, errorClass) {
            $(element).removeClass(errorClass)
        },
        unhighlight: function (element, errorClass) {
            $(element).removeClass(errorClass)
        },
        errorPlacement: function (error, element) {
            if (element.attr('type') == "checkbox") {
                element.closest("div").removeClass('icheck-primary').addClass('icheck-danger');
                $(element).focus();
            }else{
                element.closest( ".input-group" ).append( error);
            } 
        },
        rules: {
            password_confirmation : {
                equalTo : "#password"
            }
        },
        submitHandler: function (form) {
            invokeLoader();
            form.submit();
        }
    })
}


/*
|--------------------------------------------------------------------------
| User Create form
|--------------------------------------------------------------------------
*/
function userCreateFormValidation(){    
    $("#user-create-form").validate({
        ignore: "input[type=hidden]",
        errorClass: "text-danger custom",
        successClass: "text-success",
        highlight: function (element, errorClass) {
            $(element).removeClass(errorClass)
        },
        unhighlight: function (element, errorClass) {
            $(element).removeClass(errorClass)
        },
        errorPlacement: function (error, element) {  
            element.closest( "div.form-group" ).append(error);
        },
        rules: {
            password_confirmation : {
                equalTo : "#password"
            }
        },
        submitHandler: function (form) {
            invokeLoader();
            form.submit();
        }
    })
}


/*
|--------------------------------------------------------------------------
| User Role form
|--------------------------------------------------------------------------
*/
function userRoleCreateFormValidation(){    
    $("#user-role-create-form").validate({
        ignore: "input[type=hidden]",
        errorClass: "text-danger custom",
        successClass: "text-success",
        highlight: function (element, errorClass) {
            $(element).removeClass(errorClass)
        },
        unhighlight: function (element, errorClass) {
            $(element).removeClass(errorClass)
        },
        errorPlacement: function (error, element) {
            element.closest( ".form-group" ).append( error);
        },
        submitHandler: function (form) {
            invokeLoader();
            form.submit();
        }
    })
}



/*
|--------------------------------------------------------------------------
| Customer Create form
|--------------------------------------------------------------------------
*/
function customerCreateFormValidation(){    
    $("#customer-create-form").validate({
        ignore: "input[type=hidden]",
        errorClass: "text-danger custom",
        successClass: "text-success",
        highlight: function (element, errorClass) {
            $(element).removeClass(errorClass)
        },
        unhighlight: function (element, errorClass) {
            $(element).removeClass(errorClass)
        },
        errorPlacement: function (error, element) {  
            element.closest( "div.form-group" ).append(error);
        },
        rules: {
            password_confirmation : {
                equalTo : "#password"
            }
        },
        submitHandler: function (form) {
            invokeLoader();
            form.submit();
        }
    })
}



/*
|--------------------------------------------------------------------------
| Brand form
|--------------------------------------------------------------------------
*/
function brandFormValidation(){    
    $("#brand-form").validate({
        ignore: "input[type=hidden]",
        errorClass: "text-danger custom",
        successClass: "text-success",
        highlight: function (element, errorClass) {
            $(element).removeClass(errorClass)
        },
        unhighlight: function (element, errorClass) {
            $(element).removeClass(errorClass)
        },
        errorPlacement: function (error, element) {
            element.closest( ".form-group" ).append( error);
        },
        submitHandler: function (form) {
            invokeLoader();
            form.submit();
        }
    })
}



/*
|--------------------------------------------------------------------------
| Category form
|--------------------------------------------------------------------------
*/
function categoryFormValidation(){    
    $("#category-form").validate({
        ignore: "input[type=hidden]",
        errorClass: "text-danger custom",
        successClass: "text-success",
        highlight: function (element, errorClass) {
            $(element).removeClass(errorClass)
        },
        unhighlight: function (element, errorClass) {
            $(element).removeClass(errorClass)
        },
        errorPlacement: function (error, element) {
            element.closest( ".form-group" ).append( error);
        },
        submitHandler: function (form) {
            invokeLoader();
            form.submit();
        }
    })
}



/*
|--------------------------------------------------------------------------
| product form
|--------------------------------------------------------------------------
*/
function productValidation(){    
    $("#product-form").validate({
        ignore: [],
        errorClass: "text-danger custom",
        successClass: "text-success",
        highlight: function (element, errorClass) {
            $(element).removeClass(errorClass)
        },
        unhighlight: function (element, errorClass) {
            $(element).removeClass(errorClass)
        },
        errorPlacement: function (error, element) {
            // error.insertAfter(element)
            element.closest( ".form-group" ).append( error);
        },
        invalidHandler: function(e, validator){
            if(validator.errorList.length)
            $('.error-icon').remove();
            $('#vert-tabs-tab a[href="#' + jQuery(validator.errorList[0].element).closest(".tab-pane").attr('id') + '"]').tab('show');
            jQuery.each(validator.errorList, function(index, item) {
                // do something with `item` (or `this` is also `item` if you like)
                var tab = $('#vert-tabs-tab a[href="#' + jQuery(validator.errorList[index].element).closest(".tab-pane").attr('id') + '"]');
                jQuery.each(tab, function(ind, itm) {
                    var error_id = $(itm).attr('id');
                    if($('#error-icon-'+error_id).length == 0){
                        $(itm).append(' <span id="error-icon-'+error_id+'" class="error-icon float-right"><i class="fas fa-exclamation-triangle" style="color: #b90707;"></i></span>');
                    }
                });
            });
        },
        submitHandler: function (form) {
            invokeLoader();
            form.submit();
        }
    })
}




/*
|--------------------------------------------------------------------------
| product status form
|--------------------------------------------------------------------------
*/
function changeProductStatusFormValidation(){    
    $("#change-product-status-form").validate({
        ignore: "input[type=hidden]",
        errorClass: "text-danger custom",
        successClass: "text-success",
        highlight: function (element, errorClass) {
            $(element).removeClass(errorClass)
        },
        unhighlight: function (element, errorClass) {
            $(element).removeClass(errorClass)
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        submitHandler: function (form) {
            invokeLoader();
            form.submit();
        }
    })
}



$("#agreeTerms").change(function() {
    var div = $(this).closest("div");
    if($(this).prop('checked')) {
        if($(div).hasClass('icheck-danger')){
            $(div).removeClass('icheck-danger').addClass('icheck-primary');
        }
    } 
});



/*
|--------------------------------------------------------------------------
| Regular expression
|--------------------------------------------------------------------------
*/  
function additionalMethod(){  
    
    jQuery.validator.addMethod("pass", function(value, element) {
        return this.optional( element ) || /^(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z\d@$!^%*#?&]{5,}$/.test( value );
    }, 'Password should be minimum 5 characters, at least one uppercase letter and one lowercase letter.');

    jQuery.validator.addMethod("phone", function(value, element) {
        return this.optional( element ) || /^[0-9]{10}$/.test( value );
    }, 'Please enter a valid phone number.');

    jQuery.validator.addMethod("select2", function(value, element) { 
        if ($(".select2 option:selected").val() == "default") return false;
        else return true;
    }, 'This field is required.');

    jQuery.validator.addMethod("laxEmail", function(value, element) {
        // allow any non-whitespace characters as the host part
        return this.optional( element ) || /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@(?:\S{1,63})$/.test( value );
    }, 'Please enter a valid email address.');

    jQuery.validator.addMethod("vadlid-age", function(value, element) {
        return this.optional( element ) || checkAge(value);
    }, 'Must be above 18 years of age');

    jQuery.validator.addMethod("slug", function(value, element) {
        // allow any non-whitespace characters as the host part
        return this.optional( element ) || /^[a-z0-9/-]+$/.test( value );
    }, 'Please enter a valid slug! remove special characters and spaces');



    /*
    |--------------------------------------------------------------------------
    | Ajax method
    |--------------------------------------------------------------------------
    */ 
    jQuery.validator.addMethod("vadlid-phone", function(value, element) {
        return this.optional( element ) || checkPhoneNumber(value);
    }, 'Phone Number Is Already Exists');

    jQuery.validator.addMethod("vadlid-referrer", function(value, element) {
        return this.optional( element ) || sendAjaxRequest(value);
    }, 'Referrer is not exists');
}



/*
|--------------------------------------------------------------------------
| Check Age Above 18
|--------------------------------------------------------------------------
*/ 

function checkAge(date){

    const splitArray= date.split("-");
    var day         = splitArray[2];
    var month       = splitArray[1];
    var year        = splitArray[0];
    var age         = 18;
    var mydate      = new Date();
    mydate.setFullYear(year, month-1, day);

    var currdate = new Date();
    var setDate = new Date();         
    setDate.setFullYear(mydate.getFullYear() + age, month-1, day);

    if ((currdate - setDate) > 0){
        return true;
    }else{
        return false;
    }
}




/*
|--------------------------------------------------------------------------
| Ajax Check Phone Number 
|--------------------------------------------------------------------------
*/ 

function checkPhoneNumber(phone){

    var base_url = window.location.origin;

    if(phone!=thisPhone){
    $.ajax({  
            type: "GET",
            url: base_url+'/check-referrer-ajax',
            headers: {
                'X-CSRF-TOKEN': $('meta[name=token]').attr('content')
            },
            data: {
                '_token': token,
                'phone':phone,
            },
            cache:false,     
            success:function(response){
                if(response.success===true){
                    validated = false;
                }else{
                    validated = true;
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                Swal.fire(
                    'Oops... Something went to wrong. Please try again!',
                    '',
                'error'
                )
            }
    });
    }
    else{
        validated = true;
    }

    return validated;
   
}

var validated = true;

/*
|--------------------------------------------------------------------------
|function send Ajax Request
|--------------------------------------------------------------------------
*/
function sendAjaxRequest(phone) {

    if(phone.length == 10){

        var base_url = window.location.origin;
        $.ajax({
            type: "GET",
            url: base_url + '/check-phone-number-ajax',
            headers: {
                'X-CSRF-TOKEN': $('meta[name=token]').attr('content')
            },
            data: {
                '_token': token,
                'phone' : phone,
            },
            cache: false,
            success: function (response) {
                if (response.success === true) {
                    validated = true;
                }
                else {
                    validated = false;
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                //Swal.fire("Oops!", "Oops... Something went to wrong. Please try again!", "error");
            }
        });

    }else{
        validated = false;
    }

    return validated;
  }



 /*
 |--------------------------------------------------------------------------
 | Invoke Loader
 |--------------------------------------------------------------------------
 */ 
 function invokeLoader(){
    if($('.loader-wrapper').length=='0'){
    var svg = '<div class="loader-wrapper" ><?xml version="1.0" encoding="utf-8"?><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: none; display: block; shape-rendering: auto;" width="100px" height="100px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid"><g transform="translate(50 50)"><g><animateTransform attributeName="transform" type="rotate" values="0;45" keyTimes="0;1" dur="0.2s" repeatCount="indefinite"></animateTransform><path d="M29.491524206117255 -5.5 L37.491524206117255 -5.5 L37.491524206117255 5.5 L29.491524206117255 5.5 A30 30 0 0 1 24.742744050198738 16.964569457146712 L24.742744050198738 16.964569457146712 L30.399598299691117 22.621423706639092 L22.621423706639096 30.399598299691114 L16.964569457146716 24.742744050198734 A30 30 0 0 1 5.5 29.491524206117255 L5.5 29.491524206117255 L5.5 37.491524206117255 L-5.499999999999997 37.491524206117255 L-5.499999999999997 29.491524206117255 A30 30 0 0 1 -16.964569457146705 24.742744050198738 L-16.964569457146705 24.742744050198738 L-22.621423706639085 30.399598299691117 L-30.399598299691117 22.621423706639092 L-24.742744050198738 16.964569457146712 A30 30 0 0 1 -29.491524206117255 5.500000000000009 L-29.491524206117255 5.500000000000009 L-37.491524206117255 5.50000000000001 L-37.491524206117255 -5.500000000000001 L-29.491524206117255 -5.500000000000002 A30 30 0 0 1 -24.742744050198738 -16.964569457146705 L-24.742744050198738 -16.964569457146705 L-30.399598299691117 -22.621423706639085 L-22.621423706639092 -30.399598299691117 L-16.964569457146712 -24.742744050198738 A30 30 0 0 1 -5.500000000000011 -29.491524206117255 L-5.500000000000011 -29.491524206117255 L-5.500000000000012 -37.491524206117255 L5.499999999999998 -37.491524206117255 L5.5 -29.491524206117255 A30 30 0 0 1 16.964569457146702 -24.74274405019874 L16.964569457146702 -24.74274405019874 L22.62142370663908 -30.39959829969112 L30.399598299691117 -22.6214237066391 L24.742744050198738 -16.964569457146716 A30 30 0 0 1 29.491524206117255 -5.500000000000013 M0 -20A20 20 0 1 0 0 20 A20 20 0 1 0 0 -20" fill="#bababa"></path></g></g></svg></div>';
    $(svg).appendTo('body');
    }
    // document.addEventListener('contextmenu', event => event.preventDefault());
    // document.onkeydown = function (e) {return false;}
}

 /*
 |--------------------------------------------------------------------------
 | Invoke Loader
 |--------------------------------------------------------------------------
 */ 
 function invokeDatatabeLoader(){
    if($('.loader-wrapper').length=='0'){
    var svg = '<div class="loader-wrapper data-table-loader"><?xml version="1.0" encoding="utf-8"?><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: none; display: block; shape-rendering: auto;" width="100px" height="100px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid"><g transform="translate(50 50)"><g><animateTransform attributeName="transform" type="rotate" values="0;45" keyTimes="0;1" dur="0.2s" repeatCount="indefinite"></animateTransform><path d="M29.491524206117255 -5.5 L37.491524206117255 -5.5 L37.491524206117255 5.5 L29.491524206117255 5.5 A30 30 0 0 1 24.742744050198738 16.964569457146712 L24.742744050198738 16.964569457146712 L30.399598299691117 22.621423706639092 L22.621423706639096 30.399598299691114 L16.964569457146716 24.742744050198734 A30 30 0 0 1 5.5 29.491524206117255 L5.5 29.491524206117255 L5.5 37.491524206117255 L-5.499999999999997 37.491524206117255 L-5.499999999999997 29.491524206117255 A30 30 0 0 1 -16.964569457146705 24.742744050198738 L-16.964569457146705 24.742744050198738 L-22.621423706639085 30.399598299691117 L-30.399598299691117 22.621423706639092 L-24.742744050198738 16.964569457146712 A30 30 0 0 1 -29.491524206117255 5.500000000000009 L-29.491524206117255 5.500000000000009 L-37.491524206117255 5.50000000000001 L-37.491524206117255 -5.500000000000001 L-29.491524206117255 -5.500000000000002 A30 30 0 0 1 -24.742744050198738 -16.964569457146705 L-24.742744050198738 -16.964569457146705 L-30.399598299691117 -22.621423706639085 L-22.621423706639092 -30.399598299691117 L-16.964569457146712 -24.742744050198738 A30 30 0 0 1 -5.500000000000011 -29.491524206117255 L-5.500000000000011 -29.491524206117255 L-5.500000000000012 -37.491524206117255 L5.499999999999998 -37.491524206117255 L5.5 -29.491524206117255 A30 30 0 0 1 16.964569457146702 -24.74274405019874 L16.964569457146702 -24.74274405019874 L22.62142370663908 -30.39959829969112 L30.399598299691117 -22.6214237066391 L24.742744050198738 -16.964569457146716 A30 30 0 0 1 29.491524206117255 -5.500000000000013 M0 -20A20 20 0 1 0 0 20 A20 20 0 1 0 0 -20" fill="#bababa"></path></g></g></svg></div>';
    $(svg).appendTo('body');
    }
    // document.addEventListener('contextmenu', event => event.preventDefault());
}

 /*
 |--------------------------------------------------------------------------
 | Remove Loader
 |--------------------------------------------------------------------------
 */ 
function removeLoader(){
    $('.loader-wrapper').remove();
    document.onkeydown = function (e) {return true;}
}