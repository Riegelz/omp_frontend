(function ($) {  
 
    var base_url = $("#baseurl").val();

    $('#promotionperiod').daterangepicker({
        drops: 'up',
        autoUpdateInput: false,
        locale: {
            format: 'YYYY/MM/DD',
            cancelLabel: 'Clear'
        }
    });

    $('#promotionperiod').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'));
    });

    $('#promotionperiod').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });

    $('#editpromotionperiod').daterangepicker({
        drops: 'up',
        autoUpdateInput: false,
        locale: {
            format: 'YYYY/MM/DD',
            cancelLabel: 'Clear'
        }
    });

    $('#editpromotionperiod').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'));
    });

    $('#editpromotionperiod').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });

    $('#promotionprice').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    $('#promotionamount').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    $('#editpromotionprice').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    $('#editpromotionamount').bind('keyup paste', function(){
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
        $('*' + tag).css({
            "border-color": "#DE0024", 
            "border-width":"2px", 
            "border-style":"solid",
            "background-color":"#ffebef"
        });
    }

    function successField2(text, tag)
    {
        $('*' + tag).css({
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

    $("[name='promotionstatus']").bootstrapSwitch('state', false);
    $("[name='editpromotionstatus']").bootstrapSwitch('state', false);

    $('#closeeditpromotion').click(function (e) { 
        $('#overlay').attr("style", "display:");
        $("#editpromotionname").val("");
        $("#editpromotionamount").val("");
        $("#editpromotionprice").val("");
        $("#editpromotionperiod").val("");
        $("#editpromotiongroup option:first").get(0).remove();
        $("#editpromotionproduct option:first").get(0).remove();
        $('#editpromotionproduct').prop('disabled', false);
    });

    $('#btncreatepromotion').click(function (e) { 
        $('#preloader').show();
        e.preventDefault();
        var promotion_name = $("#promotionname").val();
        var promotion_amount = $("#promotionamount").val();
        var promotion_price = $("#promotionprice").val();
        var promotion_group = $("#promotiongroup").val();
        var promotion_product = $("#promotionproduct").val();
        var promotion_period = $("#promotionperiod").val();
        var promotion_status = $("#promotionstatus").bootstrapSwitch('state');
        
        if(promotion_name == '') {
            requireField('alertpromotionname', 'promotionname');
            $('#preloader').hide();
            window.scrollTo(0, $("#promotionname").offset().top);
            return false;
        } else {
            successField('alertpromotionname', 'promotionname');
        }

        if(promotion_amount == '') {
            requireField('alertpromotionamount', 'promotionamount');
            $('#preloader').hide();
            window.scrollTo(0, $("#promotionamount").offset().top);
            return false;
        } else {
            successField('alertpromotionamount', 'promotionamount');
        }

        if(promotion_price == '') {
            requireField('alertpromotionprice', 'promotionprice');
            $('#preloader').hide();
            window.scrollTo(0, $("#promotionprice").offset().top);
            return false;
        } else {
            successField('alertpromotionprice', 'promotionprice');
        }

        if(promotion_group == '') {
            requireField2('alertpromotiongroup', '[data-select2-id="1"]');
            $('#alertpromotiongroup').show();
            $('#preloader').hide();
            window.scrollTo(0, $("#promotiongroup").offset().top);
            return false;
        } else {
            successField2('alertpromotiongroup', '[data-select2-id="1"]');
            $('#alertpromotiongroup').hide();
        }

        if(promotion_product == '') {
            requireField2('alertpromotionproduct', '[data-select2-id="3"]');
            $('#alertpromotionproduct').show();
            $('#preloader').hide();
            window.scrollTo(0, $("#promotionproduct").offset().top);
            return false;
        } else {
            successField2('alertpromotionproduct', '[data-select2-id="3"]');
            $('#alertpromotionproduct').hide();
        }

        $.ajax({
            type: "POST",
            url: base_url + "api/createpromotion",
            data: {promotion_name:promotion_name,promotion_amount:promotion_amount,promotion_price:promotion_price,promotion_group:promotion_group,promotion_product:promotion_product,promotion_period:promotion_period,promotion_status:promotion_status},
            dataType: 'json',
            success: function (response) {
                $('#preloader').hide();
                if (response == "success") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: "Promotion have been created.",
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

    $('#btneditpromotion').click(function (e) { 
        $('#preloader').show();
        e.preventDefault();
        var promotion_id = $("#editpromotionid").val();
        var promotion_name = $("#editpromotionname").val();
        var promotion_amount = $("#editpromotionamount").val();
        var promotion_price = $("#editpromotionprice").val();
        var promotion_group = $("#editpromotiongroup").val();
        var promotion_product = $("#editpromotionproduct").val();
        var promotion_period = $("#editpromotionperiod").val();
        var promotion_status = $("#editpromotionstatus").bootstrapSwitch('state');
        
        if(promotion_name == '') {
            requireField('alerteditpromotionname', 'editpromotionname');
            $('#preloader').hide();
            window.scrollTo(0, $("#editpromotionname").offset().top);
            return false;
        } else {
            successField('alerteditpromotionname', 'editpromotionname');
        }

        if(promotion_amount == '') {
            requireField('alerteditpromotionamount', 'editpromotionamount');
            $('#preloader').hide();
            window.scrollTo(0, $("#editpromotionamount").offset().top);
            return false;
        } else {
            successField('alerteditpromotionamount', 'editpromotionamount');
        }

        if(promotion_price == '') {
            requireField('alerteditpromotionprice', 'editpromotionprice');
            $('#preloader').hide();
            window.scrollTo(0, $("#editpromotionprice").offset().top);
            return false;
        } else {
            successField('alerteditpromotionprice', 'editpromotionprice');
        }

        if(promotion_group == '') {
            requireField2('alerteditpromotiongroup', '[data-select2-id="5"]');
            $('#alerteditpromotiongroup').show();
            $('#preloader').hide();
            window.scrollTo(0, $("#editpromotiongroup").offset().top);
            return false;
        } else {
            successField2('alerteditpromotiongroup', '[data-select2-id="5"]');
            $('#alerteditpromotiongroup').hide();
        }

        if(promotion_product == '') {
            requireField2('alerteditpromotionproduct', '[data-select2-id="7"]');
            $('#alerteditpromotionproduct').show();
            $('#preloader').hide();
            window.scrollTo(0, $("#editpromotionproduct").offset().top);
            return false;
        } else {
            successField2('alerteditpromotionproduct', '[data-select2-id="7"]');
            $('#alerteditpromotionproduct').hide();
        }

        $.ajax({
            type: "POST",
            url: base_url + "api/editpromotion",
            data: {promotion_id:promotion_id,promotion_name:promotion_name,promotion_amount:promotion_amount,promotion_price:promotion_price,promotion_group:promotion_group,promotion_product:promotion_product,promotion_period:promotion_period,promotion_status:promotion_status},
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

    $('#promotiongroup').change(function(event) {
        $('#preloader').show();
        var gid = $('#promotiongroup').val();
        $.ajax({
          url: base_url + 'api/getProductName',
          type: 'POST',
          dataType: 'json',
          data: {gid: gid},
        })
        .done(function(resp) {
            $('#preloader').hide();
          if (resp != null) {
            var len = resp.length;
            $("#promotionproduct").empty();
            $("#promotionproduct").append("<option value=''>-- Select Product --</option>");
            for( var i = 0; i<len; i++){
                var id = resp[i].id;
                var name = resp[i].productname;
                $("#promotionproduct").append("<option value='"+id+"'>"+name+"</option>");
            }
            $('#promotionproduct').prop('disabled', false);
          }else{
            $("#promotionproduct").empty();
            $("#promotionproduct").append("<option value=''>--- No Product ---</option>");
          }
  
        });
    });

    $('#editpromotiongroup').change(function(event) {
        $('#preloader').show();
        var gid = $('#editpromotiongroup').val();
        $.ajax({
          url: base_url + 'api/getProductName',
          type: 'POST',
          dataType: 'json',
          data: {gid: gid},
        })
        .done(function(resp) {
            $('#preloader').hide();
          if (resp != null) {
            var len = resp.length;
            $("#editpromotionproduct").empty();
            $("#editpromotionproduct").append("<option value=''>-- Select Product --</option>");
            for( var i = 0; i<len; i++){
                var id = resp[i].id;
                var name = resp[i].productname;
                $("#editpromotionproduct").append("<option value='"+id+"'>"+name+"</option>");
            }
            $('#editpromotionproduct').prop('disabled', false);
          }else{
            $("#editpromotionproduct").empty();
            $("#editpromotionproduct").append("<option value=''>--- No Product ---</option>");
          }
  
        });
    });
    
})(jQuery);