(function ($) {  
 
    var base_url = $("#baseurl").val();

    $('#zipcode').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    $('#ordertelnumber').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    $('#orderdate').daterangepicker({
        drops: 'up',
        autoUpdateInput: false,
        locale: {
            format: 'YYYY/MM/DD',
            cancelLabel: 'Clear'
        }
    });

    $('#orderdate').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'));
    });

    $('#orderdate').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });

    $('#avorderdate').daterangepicker({
        singleDatePicker: true,
        autoUpdateInput: false,
        timePicker: true,
        timePicker24Hour: true,
        locale: {
            format: 'DD-MM-YYYY HH:mm',
            cancelLabel: 'Clear'
        }
    });

    $('#avorderdate').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD-MM-YYYY HH:mm'));
    });

    $('#avorderdate').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });

    $("#btnsearchorder").click(function (e) { 
        e.preventDefault();
        // $('#preloader').show();
        var ordername = $("#ordername").val();
        var ordertelnumber = $("#ordertelnumber").val();
        var ordertracking = $("#ordertracking").val();
        var productid = $("#productid").val();
        var order_logistic = $("#order_logistic").val();
        var order_payment = $("#order_payment").val();
        var province = $("#province").find(':selected').data('province');
        var district = $("#district").find(':selected').data('district');
        var subdistrict = $("#subdistrict").find(':selected').data('subdistrict');
        var zipcode = $("#zipcode").val();
        var order_status = $("#order_status").val();
        var orderdate = $("#orderdate").val();
        var order_by_account_id = $("#order_by_account_id").val();

        if (typeof province === "undefined") {
            province = "";
        }

        if (typeof subdistrict === "undefined") {
            subdistrict = "";
        }

        if (typeof district === "undefined") {
            district = "";
        }

        $('#myTable').show()
        $('#myTable').DataTable({
            responsive: true,
            columnDefs: [
                { className: 'text-center', targets: [0,1,2,3,4,5,6,7] },
            ],
            dom: 'Bfrtip',
            buttons: [
                {
                    text: 'Export Kerry',
                    className: 'btn btn-secondary btn-xs',
                    action: function ( e, dt, node, config ) {
                        alert( 'Coming Soon!' );
                    }
                },
                {
                    text: 'Export ALPHA',
                    className: 'btn btn-secondary btn-xs',
                    action: function ( e, dt, node, config ) {
                        alert( 'Coming Soon!' );
                    }
                },
                {
                    text: 'Export CJ',
                    className: 'btn btn-secondary btn-xs',
                    action: function ( e, dt, node, config ) {
                        alert( 'Coming Soon!' );
                    }
                }
            ],
            "pageLength": 20,
            "processing": true,
            "serverSide": true,
            "searching": false,
            "ajax": base_url + "api/getSearchOrder?ordername="+ordername+"&ordertelnumber="+ordertelnumber+"&ordertracking="+ordertracking+"&productid="+productid+"&order_logistic="+order_logistic+"&order_payment="+order_payment+"&province="+province+"&district="+district+"&subdistrict="+subdistrict+"&zipcode="+zipcode+"&order_status="+order_status+"&orderdate="+orderdate+"&order_by_account_id="+order_by_account_id,
            "bDestroy": true
        });

    });

    $("#province").change(function (e) { 
        $("#subdistrict").empty();
        $("#subdistrict").append("<option value=''>-- Select Sub Districts --</option>");
        e.preventDefault();
        var province = $("#province").val();
        $.ajax({
            type: "POST",
            url: base_url + "api/getDistricts",
            data: {province:province},
            dataType: "json",
            success: function (response) {
                if (response != null) {
                    var len = response.length;
                    $("#district").empty();
                    $("#district").append("<option value='' data-district=''>-- Select Districts --</option>");
                    for( var i = 0; i<len; i++){
                        var id = response[i].id;
                        var name = response[i].districts_name;
                        $("#district").append("<option value='"+id+"' data-district='"+name+"'>" + name + "</option>");
                    }
                }
                $('#district').prop('disabled', false);
            }
        });
    });

    $("#district").change(function (e) { 
        e.preventDefault();
        var district = $("#district").val();
        $.ajax({
            type: "POST",
            url: base_url + "api/getSubDistricts",
            data: {district:district},
            dataType: "json",
            success: function (response) {
                console.log(response)
                if (response != null) {
                    var len = response.length;
                    $("#subdistrict").empty();
                    $("#subdistrict").append("<option value=''>-- Select Sub Districts --</option>");
                    for( var i = 0; i<len; i++){
                        var id = response[i].id;
                        var name = response[i].subdistricts_name;
                        var zipcode = response[i].zip_code;
                        $("#subdistrict").append("<option value='"+id+"' data-subdistrict='"+name+"' data-zipcode='"+zipcode+"'>" + name + "</option>");
                    }
                }
                $('#subdistrict').prop('disabled', false);
            }
        });
    });

    $("#subdistrict").change(function (e) { 
        e.preventDefault();
        var zipcode = $("#subdistrict").find(':selected').data('zipcode')
        $("#zipcode").val(zipcode);
    });
    
    $("#closeeditorder").click(function (e) { 
        e.preventDefault();
        $('#editform').trigger("reset");
        $('#overlay').attr("style", "display:");
    });

    $("#btneditorder").click(function (e) { 
        e.preventDefault();
        $('#preloader').show();
        var orderid = $("#avorderid").val();
        var ordertransaction = $("#avordertransaction").val();
        var ordercountry = $("#avordercountry").val();
        var orderproductid = $("#avorderproductid").val();
        var ordertracking = $("#avordertracking").val();
        var orderlogisticid = $("#avorderlogisticid").val();
        var orderprice = $("#avorderprice").val();
        var orderdate = $("#avorderdate").val();
        var ordername = $("#avordername").val();
        var ordertelnumber = $("#avordertelnumber").val();
        var orderaddress = $("#avorderaddress").val();
        var orderdistrict = $("#avorderdistrict").val()
        var ordersubdistrict = $("#avordersubdistrict").val()
        var orderzipcode = $("#avorderzipcode").val();
        var orderprovince = $("#avprovince").val()
        var orderpaymentid = $("#avorderpaymentid").val();
        var orderdescription = $("#avorderdescription").val();
        var orderpromotionid = $("#avorderprice").val();
        var order_by_account_id = $("#avorder_by_account_id").val();
        var orderstatus = $("#avorderstatus").val();

        if (order_by_account_id == '') {
            $('#preloader').hide();
            $("#avorder_by_account_id").addClass("is-invalid");
            return false;
        }else{
            $("#avorder_by_account_id").removeClass("is-invalid");
            $("#avorder_by_account_id").addClass("is-valid");
        }

        if (orderstatus == '') {
            $('#preloader').hide();
            $("#avorderstatus").addClass("is-invalid");
            return false;
        }else{
            $("#avorderstatus").removeClass("is-invalid");
            $("#avorderstatus").addClass("is-valid");
        }

        if (orderproductid == '') {
            $('#preloader').hide();
            $("#avorderproductid").addClass("is-invalid");
            return false;
        }else{
            $("#avorderproductid").removeClass("is-invalid");
            $("#avorderproductid").addClass("is-valid");
        }

        if (orderlogisticid == '') {
            $('#preloader').hide();
            $("#avorderlogisticid").addClass("is-invalid");
            return false;
        }else{
            $("#avorderlogisticid").removeClass("is-invalid");
            $("#avorderlogisticid").addClass("is-valid");
        }

        if (orderprice == '') {
            $('#preloader').hide();
            $("#avorderprice").addClass("is-invalid");
            return false;
        }else{
            $("#avorderprice").removeClass("is-invalid");
            $("#avorderprice").addClass("is-valid");
        }

        if (orderdate == '') {
            $('#preloader').hide();
            $("#avorderdate").addClass("is-invalid");
            return false;
        }else{
            $("#avorderdate").removeClass("is-invalid");
            $("#avorderdate").addClass("is-valid");
        }

        if (ordername == '') {
            $('#preloader').hide();
            $("#avordername").addClass("is-invalid");
            return false;
        }else{
            $("#avordername").removeClass("is-invalid");
            $("#avordername").addClass("is-valid");
        }

        if (orderaddress == '') {
            $('#preloader').hide();
            $("#avorderaddress").addClass("is-invalid");
            return false;
        }else{
            $("#avorderaddress").removeClass("is-invalid");
            $("#avorderaddress").addClass("is-valid");
        }

        if (orderdistrict == '') {
            $("#avorderdistrict").addClass("is-invalid");
            return false;
        }else{
            $("#avorderdistrict").removeClass("is-invalid");
            $("#avorderdistrict").addClass("is-valid");
        }

        if (ordersubdistrict == '') {
            $('#preloader').hide();
            $("#avordersubdistrict").addClass("is-invalid");
            return false;
        }else{
            $("#avordersubdistrict").removeClass("is-invalid");
            $("#avordersubdistrict").addClass("is-valid");
        }

        if (orderzipcode == '') {
            $('#preloader').hide();
            $("#avorderzipcode").addClass("is-invalid");
            return false;
        }else{
            $("#avorderzipcode").removeClass("is-invalid");
            $("#avorderzipcode").addClass("is-valid");
        }

        if (orderprovince == '') {
            $('#preloader').hide();
            $("#avprovince").addClass("is-invalid");
            return false;
        }else{
            $("#avprovince").removeClass("is-invalid");
            $("#avprovince").addClass("is-valid");
        }

        if (orderpaymentid == '') {
            $('#preloader').hide();
            $("#avorderpaymentid").addClass("is-invalid");
            return false;
        }else{
            $("#avorderpaymentid").removeClass("is-invalid");
            $("#avorderpaymentid").addClass("is-valid");
        }

        $.ajax({
            type: "POST",
            url: base_url + "api/editOrder",
            dataType: "json",
            data: {orderid:orderid,ordertransaction:ordertransaction,ordercountry:ordercountry,ordertracking:ordertracking,orderproductid:orderproductid,ordername:ordername,orderlogisticid:orderlogisticid,orderprice:orderprice,orderdate:orderdate,orderpaymentid:orderpaymentid,orderaddress:orderaddress,orderdistrict:orderdistrict,ordersubdistrict:ordersubdistrict,orderzipcode:orderzipcode,orderprovince:orderprovince,ordertelnumber:ordertelnumber,orderdescription:orderdescription,orderpromotionid:orderpromotionid,order_by_account_id:order_by_account_id,orderstatus:orderstatus},
            success: function (response) {
                $('#preloader').hide();
                if (response == "success") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: "Order have been Edit.",
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