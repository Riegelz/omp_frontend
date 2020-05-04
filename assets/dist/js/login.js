(function ($) {  
    var base_url = window.location.origin + window.location.pathname;

    $("#btn-login").click(function() {
        $('#preloader').show();

        $("#ajaxform").submit(function(e) {
            var postData = $(this).serializeArray();
            var formURL = $(this).attr("action");
            $.ajax({
                url : formURL,
                type: "POST",
                dataType: 'json',
                data : postData,
                success:function(data, textStatus, jqXHR) {
                    $('#preloader').hide();
                    if (data == "success") {
                        window.location.href = base_url;
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Login failed.',
                            text: 'Username or Password not match, Please try again.'
                        })
                    }
                },  
                error: function(jqXHR, textStatus, errorThrown) {
                    $('#preloader').hide();
                    Swal.fire({
                        icon: 'error',
                        title: 'Fail.',
                        text: 'Something went wrong.'
                    })
                }            
            });
            this.reset();
            e.preventDefault();
            e.unbind();
        });
        // $("#ajaxform").submit();
    });
})(jQuery);