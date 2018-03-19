'use strict';
$(function() {

    // if(window.location.pathname === '/register' || window.location.pathname === '/login' || window.location.pathname === '/password/reset' ) {
    //     $('#main-navbar').removeClass('fixed-top navbar-transparent');
    // }else {
    //     $('#main-navbar').addClass('fixed-top navbar-transparent');
    // }

    $('#select_category').niceSelect();
    // Load Form base on click
    $('.modal-toggle').click(function (e) {
        var tab = e.target.hash;
        var data = $(this).data('tab');
        if(tab === "#link_login") {
            $('#tab_login').addClass('active');
            $('#tab_register').removeClass('active');
            $('#link_login').addClass('active');
            $('#link_register').removeClass('active');
        }else {
            $('#tab_login').removeClass('active');
            $('#tab_register').addClass('active');
            $('#link_login').removeClass('active');
            $('#link_register').addClass('active');
        }
    });

    // Register function
    $(document).on('submit','#register_form', function(e){
        e.preventDefault();
        var formData = $(this).serialize();
        var name = $('#name-register-error').html("");
        var email = $('#email-register-error').html("");
        var password = $('#password-register-error').html();
        $.ajax({
            url: '/register',
            method: 'POST',
            type: 'JSON',
            data: formData,
            success: function(data){
                console.log(data);
                // if(data.errors) {
                //     (data.errors.name) ? $('#name-register-error').html(data.errors.name[0]) : name;
                //     (data.errors.email) ? $('#email-register-error').html(data.errors.email[0]) : email;
                //     (data.errors.password) ? $('#password-register-error').html(data.errors.password[0]) : password;

                // }
            }
        });
    });

    // Login function 
});