(function ($) {  
 
    var base_url = $("#baseurl").val();

    $("#accountuser").bind('keyup', function (e) {
        if (e.which >= 97 && e.which <= 122) {
            var newKey = e.which - 32;
            // I have tried setting those
            e.keyCode = newKey;
            e.charCode = newKey;
        }
    
        $("#accountuser").val(($("#accountuser").val()).toLowerCase());
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

    $('#avordertelnumber').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    $('#avorderzipcode').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    $('#avorderprice').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    function Line1(item) {
        searchProduct(item);
    }

    function Line2(item) {
        searchLogistic(item,0);
        searchPrice(item,1);
        searchDate(item,2);
        searchTime(item,3);
        searchPayment(item,4);
    }

    function Line3(item) {
        searchName(item);
    }

    function Line4(item) {
        searchAddress(item);
    }

    function Line5(item) {
        searchDistrict(item,0);
        searchSubdtrict(item,1);
        searchProvince(item,2);
        searchZipcode(item,3);
    }

    function Line6(item) {
        searchTelnumber(item);
    }

    function Line7(item) {
        searchDescription(item);
    }

    function searchProduct(item) {
        if (!item.length == 0 && item.length !== 'undefined') {
            $("#hiddenorderproductid").val(item);
        }else{
            $("#orderproductid").val("");
        }
    }

    function searchTelnumber(item) {
        if (!item.length == 0 && item.length !== 'undefined') {
            $("#ordertelnumber").val(item);
            $('#ordertelnumber').css({"color": "green"});
        }else{
            $("#ordertelnumber").val("");
        }
    }

    function searchDescription(item) {
        if (!item.length == 0 && item.length !== 'undefined') {
            $("#orderdescription").val(item);
            $('#orderdescription').css({"color": "green"});
        }else{
            $("#orderdescription").val("");
        }
    }

    function searchName(item) {
        if (!item.length == 0 && item.length !== 'undefined') {
            $("#ordername").val(item);
            $('#ordername').css({"color": "green"});
        }else{
            $("#ordername").val("");
        }
    }

    function searchAddress(item) {
        if (!item.length == 0 && item.length !== 'undefined') {
            $("#orderaddress").val(item);
            $('#orderaddress').css({"color": "green"});
        }else{
            $("#orderaddress").val("");
        }
    }

    function searchLogistic(item,position) {
        if (!item.length == 0 && item.length !== 'undefined') {
            var explodeline = item.split(' ');
            $("#hiddenorderlogisticid").val(explodeline[position]);
        }else{
            $("#orderlogisticid").val("");
        }
    }

    function searchDistrict(item,position) {
        if (!item.length == 0 && item.length !== 'undefined') {
            var explodeline = item.split(' ');
            var district = ["อำเภอ","อ.","ข.","เขต"];
            var findDistrict = find(explodeline[position],district);
            $("#orderdistrict").val(findDistrict);
            $('#orderdistrict').css({"color": "green"});
        }else{
            $("#orderdistrict").val("");
        }
    }

    function searchSubdtrict(item,position) {
        if (!item.length == 0 && item.length !== 'undefined') {
            var explodeline = item.split(' ');
            var subdistrict = ["ตำบล","ต.","แขวง"];
            var findSubDistrict = find(explodeline[position],subdistrict);
            $("#ordersubdistrict").val(findSubDistrict);
            $('#ordersubdistrict').css({"color": "green"});
        }else{
            $("#ordersubdistrict").val("");
        }
    }

    function searchProvince(item,position) {
        if (!item.length == 0 && item.length !== 'undefined') {
            var explodeline = item.split(' ');
            var province = ["จังหวัด","จ."];
            var findProvince = find(explodeline[position],province);
            $("#orderprovince").val(findProvince);
            $('#orderprovince').css({"color": "green"});
        }else{
            $("#orderprovince").val("");
        }
    }

    function searchZipcode(item,position) {
        if (!item.length == 0 && item.length !== 'undefined') {
            var explodeline = item.split(' ');
            $("#orderzipcode").val(explodeline[position]);
            $('#orderzipcode').css({"color": "green"});
        }else{
            $("#orderzipcode").val("");
        }
    }

    function searchPrice(item,position) {
        var defaultprice = 0;
        if (!item.length == 0 && item.length !== 'undefined') {
            var explodeline = item.split(' ');
            if (explodeline[position]) {
                $("#hiddenorderprice").val(explodeline[position]);
            }else{
                $("#hiddenorderprice").val(defaultprice);
            }
            
        }else{
            $("#orderprice").val("");
        }
    }

    function searchDate(item,position) {
        var defaultdate = $("#orderdatenow").val();
        if (!item.length == 0 && item.length !== 'undefined') {
            var explodeline = item.split(' ');
            if (explodeline[position]) {
                $("#orderdate").val(explodeline[position]);
                $('#orderdate').css({"color": "green"});
            }else{
                $("#orderdate").val(defaultdate);
                $('#orderdate').css({"color": "green"});
            }
            
        }else{
            $("#orderdate").val("");
        }
    }

    function searchTime(item,position) {
        var defaultTime = $("#ordertimenow").val();
        if (!item.length == 0 && item.length !== 'undefined') {
            var explodeline = item.split(' ');
            if (explodeline[position]) {
                $("#orderdate").val($("#orderdate").val() + ' ' + explodeline[position]);
                $('#orderdate').css({"color": "green"});
            }else{
                $("#orderdate").val($("#orderdate").val() + ' ' + defaultTime);
                $('#orderdate').css({"color": "green"});
            }
            
        }
    }

    function searchPayment(item,position) {
        var defaultpayment = "OTHER";
        if (!item.length == 0 && item.length !== 'undefined') {
            var explodeline = item.split(' ');
            if (explodeline[position]) {
                $("#hiddenorderpaymentid").val(explodeline[position]);
            }else{
                $("#hiddenorderpaymentid").val(defaultpayment);
            }
            
        }else{
            $("#orderpaymentid").val("");
        }
    }

    function find(key, array) {
        for (var i = 0; i < array.length; i++) {
            if (key.indexOf(array[i]) == 0) {
                var strDist = key.replace(array[i],'');;
            }
        }
        return strDist;
    }

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

    $("#hintfile").click(function(event) {
        $('#hint').modal('show');
        $('.modal-body-presend').show();
        $('.modal-dialog').css({'top':'10px'});
        $('#btn-confirm').show();
    });

    $('#importdata').on("keypress keyup keydown change",function (event) { 
        var textarea = event.target.value;
        var splitline = textarea.split('\n');
        (splitline[0])?Line1(splitline[0]):null;
        (splitline[1])?Line2(splitline[1]):null;
        (splitline[2])?Line3(splitline[2]):null;
        (splitline[3])?Line4(splitline[3]):null;
        (splitline[4])?Line5(splitline[4]):null;
        (splitline[5])?Line6(splitline[5]):null;
        (splitline[6])?Line7(splitline[6]):null;

        var valorderproductid = $("#hiddenorderproductid").val();
        var valorderlogisticid = $("#hiddenorderlogisticid").val();
        var valorderpaymentid = $("#hiddenorderpaymentid").val();

        var result           = '';
        var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        var charactersLength = characters.length;
        for ( var i = 0; i < 4; i++ ) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }

        $("#orderproductid > option").each(function() {
            if(this.text == valorderproductid) {
                $("#orderproductid > option").removeAttr("selected");
                $(this).attr("selected","selected");
                $('#orderproductid').css({"color": "green"});
                if ($("#orderproductid").find(':selected').data('prefix') != '') {
                    $("#ordertracking").val($("#orderproductid").find(':selected').data('prefix') + new Date().toString("yyyyMMddHHmmss")); 
                }else{
                    $("#ordertracking").val(result + new Date().toString("yyyyMMddHHmmss"));
                }
                return false;
            }else{
                $("#orderproductid > option").removeAttr("selected");
                $("").attr("selected","selected");
                $('#orderproductid').css({"color": "#858585"});
                $("#ordertracking").val(result + new Date().toString("yyyyMMddHHmmss"));
                return true;
            }
        });


        $("#orderlogisticid > option").each(function() {
            if(this.text == valorderlogisticid) {
                $("#orderlogisticid > option").removeAttr("selected");
                $(this).attr("selected","selected");
                $('#orderlogisticid').css({"color": "green"});
                return false;
            }else{
                $("#orderlogisticid > option").removeAttr("selected");
                $("").attr("selected","selected");
                $('#orderlogisticid').css({"color": "#858585"});
                return true;
            }
        });

        $("#orderpaymentid > option").each(function() {
            if(this.text == valorderpaymentid) {
                $("#orderpaymentid > option").removeAttr("selected");
                $(this).attr("selected","selected");
                $('#orderpaymentid').css({"color": "green"});
                return false;
            }else{
                $("#orderpaymentid > option").removeAttr("selected");
                $("").attr("selected","selected");
                $('#orderpaymentid').css({"color": "#858585"});
                return true;
            }
        });

        var productid = $("#orderproductid").val();
        $.ajax({
            type: "POST",
            url: base_url + "api/getPromotionLists",
            data: {productid:productid},
            dataType: "json",
        })
        .done(function(resp) {
          if (resp != null) {
            var len = resp.length;
            $("#orderprice").empty();
            $("#orderprice").append("<option value='"+$("#hiddenorderprice").val()+"' data-promotionid=''>" + $("#hiddenorderprice").val() + "</option>");
            for( var i = 0; i<len; i++){
                var id = resp[i].id;
                var name = resp[i].promotion_name;
                var price = resp[i].promotion_price;
                $("#orderprice").append("<option value='"+price+"' data-promotionid='"+id+"'>" + name + " ( ราคา : " + price + ") " + "</option>");
            }
            $('#orderprice').css({"color": "green"});
          }else{
            $("#orderprice").empty();
            $("#orderprice").append("<option value='"+$("#hiddenorderprice").val()+"' data-promotionid=''>" + $("#hiddenorderprice").val() + "</option>");
            $('#orderprice').css({"color": "green"});
          }
  
        });

        if ($("#orderproductid").val() != '' && $("#ordername").val() != '' && $("#orderaddress").val() != '' && $("#orderlogisticid").val() != '' && $("#orderdistrict").val() != '' && $("#ordersubdistrict").val() != '' && $("#orderprovince").val() != '' && $("#orderzipcode").val() != '' && $("#orderprice").val() != '') {
            $('#btnsaveorder').prop('disabled', false);
        }
        else if ($("#orderproductid").val() === "" && $("#ordername").val() === "" && $("#orderaddress").val() === "" && $("#orderlogisticid").val() === "" && $("#orderdistrict").val() === "" && $("#ordersubdistrict").val() === "" && $("#orderprovince").val() === "" && $("#orderzipcode").val() === "" && $("#orderprice").val() === '') {
            $('#btnsaveorder').prop('disabled', true);
        }
        else if ($("#importdata").val().length == 0) {
            $('#btnsaveorder').prop('disabled', true);
        }
        else{
            $('#btnsaveorder').prop('disabled', true);
        }

    });
    
    $("#btnsaveorder").click(function (e) { 
        $('#preloader').show();
        e.preventDefault();
        var ordertracking = $("#ordertracking").val();
        var orderproductid = $("#orderproductid").val();
        var ordername = $("#ordername").val();
        var orderlogisticid = $("#orderlogisticid").val();
        var orderprice = $("#orderprice").val();
        var orderdate = $("#orderdate").val();
        var orderpaymentid = $("#orderpaymentid").val();
        var orderaddress = $("#orderaddress").val();
        var orderdistrict = $("#orderdistrict").val();
        var ordersubdistrict = $("#ordersubdistrict").val();
        var orderzipcode = $("#orderzipcode").val();
        var orderprovince = $("#orderprovince").val();
        var ordertelnumber = $("#ordertelnumber").val();
        var orderdescription = $("#orderdescription").val();
        var orderpromotionid = $("#orderprice").find(':selected').data('promotionid');

        if (ordertracking == '' || orderproductid == '' || ordername == '' || orderlogisticid == '' || orderprice == '' || orderdate == '' || orderpaymentid == '' || orderaddress == '' || orderdistrict == '' || ordersubdistrict == '' || orderzipcode == '' || orderprovince == '') {
            Swal.fire({
                icon: 'error',
                title: 'Fail',
                text: "Please fill required form",
                showConfirmButton: false,
                timer: 2500
            });
        }else{
            $.ajax({
                type: "POST",
                url: base_url + "api/saveOrder",
                dataType: "json",
                data: {ordertracking:ordertracking,orderproductid:orderproductid,ordername:ordername,orderlogisticid:orderlogisticid,orderprice:orderprice,orderdate:orderdate,orderpaymentid:orderpaymentid,orderaddress:orderaddress,orderdistrict:orderdistrict,ordersubdistrict:ordersubdistrict,orderzipcode:orderzipcode,orderprovince:orderprovince,ordertelnumber:ordertelnumber,orderdescription:orderdescription,orderpromotionid:orderpromotionid},
                success: function (response) {
                    $('#preloader').hide();
                    if (response == "success") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: "Order have been Save.",
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
        }
    });

    $("#avprovince").change(function (e) { 
        $("#avordersubdistrict").empty();
        $("#avordersubdistrict").append("<option value=''>-- Select Sub Districts --</option>");
        e.preventDefault();
        var province = $("#avprovince").val();
        $.ajax({
            type: "POST",
            url: base_url + "api/getDistricts",
            data: {province:province},
            dataType: "json",
            success: function (response) {
                if (response != null) {
                    var len = response.length;
                    $("#avorderdistrict").empty();
                    $("#avorderdistrict").append("<option value='' data-district=''>-- Select Districts --</option>");
                    for( var i = 0; i<len; i++){
                        var id = response[i].id;
                        var name = response[i].districts_name;
                        $("#avorderdistrict").append("<option value='"+id+"' data-district='"+name+"'>" + name + "</option>");
                    }
                }
                $('#avorderdistrict').prop('disabled', false);
            }
        });
    });

    $("#avorderdistrict").change(function (e) { 
        e.preventDefault();
        var district = $("#avorderdistrict").val();
        $.ajax({
            type: "POST",
            url: base_url + "api/getSubDistricts",
            data: {district:district},
            dataType: "json",
            success: function (response) {
                console.log(response)
                if (response != null) {
                    var len = response.length;
                    $("#avordersubdistrict").empty();
                    $("#avordersubdistrict").append("<option value=''>-- Select Sub Districts --</option>");
                    for( var i = 0; i<len; i++){
                        var id = response[i].id;
                        var name = response[i].subdistricts_name;
                        var zipcode = response[i].zip_code;
                        $("#avordersubdistrict").append("<option value='"+id+"' data-subdistrict='"+name+"' data-zipcode='"+zipcode+"'>" + name + "</option>");
                    }
                }
                $('#avordersubdistrict').prop('disabled', false);
            }
        });
    });

    $("#avordersubdistrict").change(function (e) { 
        e.preventDefault();
        var zipcode = $("#avordersubdistrict").find(':selected').data('zipcode')
        $("#avorderzipcode").val(zipcode);
    });

    $("#avorderproductid").change(function (e) { 
        e.preventDefault();
        var productid = $("#avorderproductid").val();
        $.ajax({
            type: "POST",
            url: base_url + "api/getPromotionLists",
            data: {productid:productid},
            dataType: "json",
            success: function (response) {
                console.log(response)
                if (response != null) {
                    var len = response.length;
                    $("#pname").empty();
                    for( var i = 0; i<len; i++){
                        var id = response[i].id;
                        var name = response[i].promotion_name;
                        var promotionprice = response[i].promotion_price;
                        $("#pname").append("<option value='"+promotionprice+"' data-promotionid='"+id+"'> Promotion name : " + name + "</option>");
                    }
                }else{
                    $("#pname").empty();
                }
            }
        });
    });

    $("#btngentracking").click(function (e) { 
        e.preventDefault();
        var prefix = $("#avorderproductid").find(':selected').data('prefix');
        if (prefix != '') {
            $("#avordertracking").val(prefix + new Date().toString("yyyyMMddHHmmss"))
        }else{
            var result           = '';
            var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            var charactersLength = characters.length;
            for ( var i = 0; i < 4; i++ ) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            $("#avordertracking").val(result + new Date().toString("yyyyMMddHHmmss"));
        }
    });




    $("#btnavsaveorder").click(function (e) { 
        e.preventDefault();
        $('#preloader').show();
        var orderproductid = $("#avorderproductid").val();
        var ordertracking = $("#avordertracking").val();
        var orderlogisticid = $("#avorderlogisticid").val();
        var orderprice = $("#avorderprice").val();
        var orderdate = $("#avorderdate").val();
        var ordername = $("#avordername").val();
        var ordertelnumber = $("#avordertelnumber").val();
        var orderaddress = $("#avorderaddress").val();
        var orderdistrict = $("#avorderdistrict").find(':selected').data('district');
        var ordersubdistrict = $("#avordersubdistrict").find(':selected').data('subdistrict');
        var orderzipcode = $("#avorderzipcode").val();
        var orderprovince = $("#avprovince").find(':selected').data('province');
        var orderpaymentid = $("#avorderpaymentid").val();
        var orderdescription = $("#avorderdescription").val();
        var orderpromotionid = $('#pname [value="' + $("#avorderprice").val() + '"]').data('promotionid');

        if (orderproductid == '') {
            $("#avorderproductid").addClass("is-invalid");
            return false;
        }else{
            $("#avorderproductid").removeClass("is-invalid");
            $("#avorderproductid").addClass("is-valid");
        }

        if (orderlogisticid == '') {
            $("#avorderlogisticid").addClass("is-invalid");
            return false;
        }else{
            $("#avorderlogisticid").removeClass("is-invalid");
            $("#avorderlogisticid").addClass("is-valid");
        }

        if (orderprice == '') {
            $("#avorderprice").addClass("is-invalid");
            return false;
        }else{
            $("#avorderprice").removeClass("is-invalid");
            $("#avorderprice").addClass("is-valid");
        }

        if (orderdate == '') {
            $("#avorderdate").addClass("is-invalid");
            return false;
        }else{
            $("#avorderdate").removeClass("is-invalid");
            $("#avorderdate").addClass("is-valid");
        }

        if (ordername == '') {
            $("#avordername").addClass("is-invalid");
            return false;
        }else{
            $("#avordername").removeClass("is-invalid");
            $("#avordername").addClass("is-valid");
        }

        if (orderaddress == '') {
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
            $("#avordersubdistrict").addClass("is-invalid");
            return false;
        }else{
            $("#avordersubdistrict").removeClass("is-invalid");
            $("#avordersubdistrict").addClass("is-valid");
        }

        if (orderzipcode == '') {
            $("#avorderzipcode").addClass("is-invalid");
            return false;
        }else{
            $("#avorderzipcode").removeClass("is-invalid");
            $("#avorderzipcode").addClass("is-valid");
        }

        if (orderprovince == '') {
            $("#avprovince").addClass("is-invalid");
            return false;
        }else{
            $("#avprovince").removeClass("is-invalid");
            $("#avprovince").addClass("is-valid");
        }

        if (orderpaymentid == '') {
            $("#avorderpaymentid").addClass("is-invalid");
            return false;
        }else{
            $("#avorderpaymentid").removeClass("is-invalid");
            $("#avorderpaymentid").addClass("is-valid");
        }

        $.ajax({
            type: "POST",
            url: base_url + "api/saveOrder",
            dataType: "json",
            data: {ordertracking:ordertracking,orderproductid:orderproductid,ordername:ordername,orderlogisticid:orderlogisticid,orderprice:orderprice,orderdate:orderdate,orderpaymentid:orderpaymentid,orderaddress:orderaddress,orderdistrict:orderdistrict,ordersubdistrict:ordersubdistrict,orderzipcode:orderzipcode,orderprovince:orderprovince,ordertelnumber:ordertelnumber,orderdescription:orderdescription,orderpromotionid:orderpromotionid},
            success: function (response) {
                $('#preloader').hide();
                if (response == "success") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: "Order have been Save.",
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