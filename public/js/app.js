define(['jquery','niceselect','core/now-ui-kit'], function($){
    'use strict';
    $(function() {
        $(document).ready(function(){
            nowuiKit.initContactUs2Map();
        });

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
            console.log(e);
        });

        // Login function 
    });
});