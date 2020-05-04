(function ($) {  
 
    var base_url = $("#baseurl").val();

    $('#adscost').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    $('#logisticcost').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    $('#costdate').daterangepicker({
        singleDatePicker: true,
        autoUpdateInput: false, 
        locale: {
            format: 'DD-MM-YYYY',
            cancelLabel: 'Clear'
        }
    });

    $('#costdate').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD-MM-YYYY'));
    });

    $('#costdate').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });

    $('#costdate_2').daterangepicker({
        singleDatePicker: true,
        autoUpdateInput: false, 
        locale: {
            format: 'DD-MM-YYYY',
            cancelLabel: 'Clear'
        }
    });

    $('#costdate_2').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD-MM-YYYY'));
    });

    $('#costdate_2').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });
    
    $("#btnavsaveorder").click(function (e) { 
        e.preventDefault();
        $('#preloader').show();
        var product_id = $("#productid").val();
        var ads_id = $("#ads").val();
        var ads_cost = $("#adscost").val();
        var datetime = $("#costdate").val();

        if (product_id == '') {
            $('#preloader').hide();
            $("#productid").addClass("is-invalid");
            return false;
        }else{
            $("#productid").removeClass("is-invalid");
            $("#productid").addClass("is-valid");
        }

        if (ads_id == '') {
            $('#preloader').hide();
            $("#ads").addClass("is-invalid");
            return false;
        }else{
            $("#ads").removeClass("is-invalid");
            $("#ads").addClass("is-valid");
        }

        if (ads_cost == '') {
            $('#preloader').hide();
            $("#adscost").addClass("is-invalid");
            return false;
        }else{
            $("#adscost").removeClass("is-invalid");
            $("#adscost").addClass("is-valid");
        }

        if (datetime == '') {
            $('#preloader').hide();
            $("#costdate").addClass("is-invalid");
            return false;
        }else{
            $("#costdate").removeClass("is-invalid");
            $("#costdate").addClass("is-valid");
        }

        $.ajax({
            type: "POST",
            url: base_url + "api/saveAdsCost",
            dataType: "json",
            data: {product_id:product_id,ads_id:ads_id,ads_cost:ads_cost,datetime:datetime},
            success: function (response) {
                $('#preloader').hide();
                if (response == "success") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: "Ads cost have been Save.",
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

    $("#btnsavelogisticscost").click(function (e) { 
        e.preventDefault();
        $('#preloader').show();
        var product_id = $("#productid_2").val();
        var logistic_id = $("#logistic").val();
        var logisticcost_cost = $("#logisticcost").val();
        var datetime = $("#costdate_2").val();

        if (product_id == '') {
            $('#preloader').hide();
            $("#productid_2").addClass("is-invalid");
            return false;
        }else{
            $("#productid_2").removeClass("is-invalid");
            $("#productid_2").addClass("is-valid");
        }

        if (logistic_id == '') {
            $('#preloader').hide();
            $("#logistic").addClass("is-invalid");
            return false;
        }else{
            $("#logistic").removeClass("is-invalid");
            $("#logistic").addClass("is-valid");
        }

        if (logisticcost_cost == '') {
            $('#preloader').hide();
            $("#logisticcost").addClass("is-invalid");
            return false;
        }else{
            $("#logisticcost").removeClass("is-invalid");
            $("#logisticcost").addClass("is-valid");
        }

        if (datetime == '') {
            $('#preloader').hide();
            $("#costdate_2").addClass("is-invalid");
            return false;
        }else{
            $("#costdate").removeClass("is-invalid");
            $("#costdate").addClass("is-valid");
        }

        $.ajax({
            type: "POST",
            url: base_url + "api/saveLogisticCost",
            dataType: "json",
            data: {product_id:product_id,logistic_id:logistic_id,logisticcost_cost:logisticcost_cost,datetime:datetime},
            success: function (response) {
                $('#preloader').hide();
                if (response == "success") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: "Logistic cost have been Save.",
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