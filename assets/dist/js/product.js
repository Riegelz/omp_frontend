(function ($) {  
 
    var base_url = $("#baseurl").val();

    $("#productprefix").bind('keyup', function (e) {
        if (e.which >= 97 && e.which <= 122) {
            var newKey = e.which - 32;
            // I have tried setting those
            e.keyCode = newKey;
            e.charCode = newKey;
        }
    
        $("#productprefix").val(($("#productprefix").val()).toUpperCase());
    });

    $("#productprefix").keypress(function(event){
        var ew = event.which;
        if(ew == 32)
            return true;
        if(48 <= ew && ew <= 57)
            return true;
        if(65 <= ew && ew <= 90)
            return true;
        if(97 <= ew && ew <= 122)
            return true;
        return false;
    });

    $('#productprice').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    function requireField(text, tag)
    {
        $('#' + text).show();
        $('#' + tag).css({
            "border-color": "#DE0024", 
            "border-width":"2px", 
            "border-style":"solid",
            "background-color":"#ffebef"
        });
    }

    function successField(text, tag)
    {
        $('#' + text).hide();
        $('#' + tag).css({
            "border-color": "#18AF18", 
            "border-width":"2px", 
            "border-style":"solid",
            "background-color":"#e3ffe5"
        });
    }

    function requireField2(text, tag)
    {
        $('.' + text).show();
        $('.' + tag).css({
            "border-color": "#DE0024", 
            "border-width":"2px", 
            "border-style":"solid",
            "background-color":"#ffebef"
        });
    }

    function successField2(text, tag)
    {
        $('.' + text).hide();
        $('.' + tag).css({
            "border-color": "#18AF18", 
            "border-width":"2px", 
            "border-style":"solid",
            "background-color":"#e3ffe5"
        });
    }

    $('#myTable').show()

    $('#myTable').DataTable({
        responsive: true,
        "columnDefs": [
          { "width": "25%", "targets": 1 },
          { "width": "25%", "targets": 2 },
          { "width": "20%", "targets": 5 }
        ]
      });

    $("[name='productstatus']").bootstrapSwitch('state', false);
    $("[name='editproductstatus']").bootstrapSwitch('state', false);

    $('#closeeditproduct').click(function (e) { 
        $('#overlay').attr("style", "display:");
        $("#editproductname").val("");
        $("#editproductprefix").val("");
        $("#editproductgroup option:first").get(0).remove();
        $("#editproductprice").val("");
        $("#editproductdetail").val("");
    });

    $('#btncreateproduct').click(function (e) { 
        $('#preloader').show();
        e.preventDefault();
        var product_name = $("#productname").val();
        var product_prefix = $("#productprefix").val();
        var product_price = $("#productprice").val();
        var product_group = $("#productgroup").val();
        var product_detail = $("#productdetail").val();
        var product_status = $("#productstatus").bootstrapSwitch('state');
        
        if(product_name == '') {
            requireField('alertproductname', 'productname');
            $('#preloader').hide();
            window.scrollTo(0, $("#productname").offset().top);
            return false;
        } else {
            successField('alertproductname', 'productname');
        }

        if(product_price == '') {
            requireField('alertproductprice', 'productprice');
            $('#preloader').hide();
            window.scrollTo(0, $("#productprice").offset().top);
            return false;
        } else {
            successField('alertproductprice', 'productprice');
        }

        if(product_group == '') {
            requireField2('alertproductgroup', 'select2-selection');
            $('#preloader').hide();
            window.scrollTo(0, $("#productgroup").offset().top);
            return false;
        } else {
            successField2('alertproductgroup', 'select2-selection');
        }

        $.ajax({
            type: "POST",
            url: base_url + "api/createproduct",
            data: {product_name:product_name,product_prefix:product_prefix,product_price:product_price,product_group:product_group,product_detail:product_detail,product_status:product_status},
            dataType: 'json',
            success: function (response) {
                $('#preloader').hide();
                if (response == "success") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: "Group have been created.",
                        showConfirmButton: false,
                        timer: 2500
                    });
                    location.reload();
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Fail',
                        text: response,
                        showConfirmButton: false,
                        timer: 2500
                    });
                }
            }
        });
    });

    $('#btneditproduct').click(function (e) { 
        $('#preloader').show();
        e.preventDefault();
        var product_id = $("#editproductid").val();
        var product_name = $("#editproductname").val();
        var product_prefix = $("#editproductprefix").val();
        var product_price = $("#editproductprice").val();
        var product_group = $("#editproductgroup").val();
        var product_detail = $("#editproductdetail").val();
        var product_status = $("#editproductstatus").bootstrapSwitch('state');
        
        if(product_name == '') {
            requireField('alerteditproductname', 'editproductname');
            $('#preloader').hide();
            window.scrollTo(0, $("#editproductname").offset().top);
            return false;
        } else {
            successField('alerteditproductname', 'editproductname');
        }

        if(product_price == '') {
            requireField('alerteditproductprice', 'editproductprice');
            $('#preloader').hide();
            window.scrollTo(0, $("#editproductprice").offset().top);
            return false;
        } else {
            successField('alerteditproductprice', 'editproductprice');
        }

        if(product_group == '') {
            requireField2('alerteditproductgroup', 'select2-selection');
            $('#preloader').hide();
            window.scrollTo(0, $("#editproductgroup").offset().top);
            return false;
        } else {
            successField2('alerteditproductgroup', 'select2-selection');
        }

        $.ajax({
            type: "POST",
            url: base_url + "api/editproduct",
            data: {product_id:product_id,product_name:product_name,product_prefix:product_prefix,product_price:product_price,product_group:product_group,product_detail:product_detail,product_status:product_status},
            dataType: 'json',
            success: function (response) {
                $('#preloader').hide();
                if (response == "success") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: "Product have been Edited.",
                        showConfirmButton: false,
                        timer: 2500
                    });
                    location.reload();
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Fail',
                        text: response,
                        showConfirmButton: false,
                        timer: 2500
                    });
                }
            }
        });
    });
})(jQuery);