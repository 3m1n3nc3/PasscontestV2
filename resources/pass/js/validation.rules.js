$( "#paform").validate({
    rules: {
        accept: {
            required: true
        } 
    },
    errorPlacement: function(error, element) {
        error.appendTo('#accept-terms-error');
    },
    messages: {
        accept: "Please accept the terms and conditions to continue!"
    }
});

$( "#login_form").validate({ 
    errorClass: 'my-0 py-0 text-danger',
    rules: { 
        username : {
            required: true,
            minlength: 4//,
            // remote: {
            //     url: site_url+'ajax/connect/login',
            //     type: 'post',
            //     data: {
            //         password: function() {
            //             return $('input[name="password"]').val();
            //         }
            //     }
            // }
        },
        password : {
            required: true,
            minlength: 6
        }
    },
    errorPlacement: function(error, element) { 
        var el = element.attr('name');
        if (el == 'username') { 
            error.insertBefore('#username-block'); 
        }
        else if (el == 'password') { 
            error.insertBefore('#password-block');
        }
    },
    messages: {
        username: {
            required: '<small>Please enter username!</small>',
            minlength: '<small>Username should be longer than 3 characters!</small>',
        },
        password: {
            required: '<small>Please enter password!</small>',
            minlength: '<small>Password should be longer than 5 characters!</small>',
        } 
    }
});

$( "#signup_form").validate({ 
    errorClass: 'my-0 py-0 text-danger',
    rules: { 
        username : {
            required: true,
            minlength: 4,
            remote: {
                url: site_url+'ajax/connect/user_availability',
                type: 'post' 
            }
        },
        password : {
            required: true,
            minlength: 6
        },
        email : {
            required: true,
            email: true,
            remote: {
                url: site_url+'ajax/connect/user_availability',
                type: 'post' 
            }
        }
    },
    errorPlacement: function(error, element) { 
        var el = element.attr('name');
        if (el == 'username') { 
            error.insertBefore('#username-block'); 
        }
        else if (el == 'password') { 
            error.insertBefore('#password-block');
        }
        else if (el == 'email') { 
            error.insertBefore('#email-block');
        }
    },
    messages: {
        username: {
            required: '<small>Please enter username!</small>',
            minlength: '<small>Username should be longer than 3 characters!</small>',
        },
        password: {
            required: '<small>Please enter password!</small>',
            minlength: '<small>Password should be longer than 5 characters!</small>',
        } ,
        email: {
            required: '<small>Please enter email address!</small>',
            email: '<small>Invalid Email address!</small>',
        } 
    }
});
