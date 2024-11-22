$(document).ready(function() {

    // Form  validation
    $.validate({
        modules: 'file,sanitize',
        validateOnBlur : false,
        form: '.login_form',
        inputParentClassOnError: 'has-danger',        
        errorMessageClass: 'alert-danger',
        onError : function($form) {
          return false;
        },
        onSuccess: function($form) {
            $('.submit_button').attr('disabled','disabled');
            login();
           
            return false;
        }
    });  
   
    // submit form
    function login() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });        

         var values = $('.login_form').serializeArray();
         $.ajax({
                url: "api/spa/login",
                type: "post",
                data: values ,
                success: function (response) {
                    window.location.href= 'dashboard';
                },
                error: function(response) {

                    printErrorMsg(response.responseJSON.errors);

                }


        });
    }

    function printErrorMsg (msg) {
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display','block');
        $.each( msg, function( key, value ) {
            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            $('.submit_button').removeAttr('disabled');
        });
    }


});
