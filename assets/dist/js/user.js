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

    $('#myTable').show()

    $('#myTable').DataTable({
        responsive: true,
        "columnDefs": [
          { "width": "25%", "targets": 1 },
          { "width": "25%", "targets": 2 },
          { "width": "20%", "targets": 5 }
        ]
      });

    $('#myTableInfo').show()

    $("[name='accountstatus']").bootstrapSwitch('state', false);
    $("[name='editaccountstatus']").bootstrapSwitch('state', false);

    $('#closeeditaccount').click(function (e) { 
        $('#overlay').attr("style", "display:");
        $("#editaccountid").val("");
        $("#editaccountname").val("");
        $("#editaccountuser").val("");
        $("#editaccountpassword").val("");
        $('#editaccountrole').val("");
        $("#editaccountrole option:first").get(0).remove();
        $("#editaccountstatus").prop('disabled', false);
    });

    $('#closeinfoaccount').click(function (e) { 
        $('#overlay').attr("style", "display:");
        $('#addgroupname').prop('selectedIndex',0);
        $('#addgrouprole').prop('selectedIndex',0);
        var table = $('#myTableInfo').DataTable();
        table.destroy();
    });

    $('#accountpassword').keyup(function(e) {
        var pswd = $('#accountpassword').val();
        //validate letter
        if ( pswd.match(/[A-z]/) ) {
            $('#letter').removeClass('invalid').addClass('valid');
        } else {
            $('#letter').removeClass('valid').addClass('invalid');
            return false;
        }

        //validate capital letter
        if ( pswd.match(/[A-Z]/) ) {
            $('#capital').removeClass('invalid').addClass('valid');
        } else {
            $('#capital').removeClass('valid').addClass('invalid');
            return false;
        }

        //validate number
        if ( pswd.match(/\d/) ) {
            $('#number').removeClass('invalid').addClass('valid');
        } else {
            $('#number').removeClass('valid').addClass('invalid');
            return false;
        }

        if ( pswd.length < 8 ) {
            $('#length').removeClass('valid').addClass('invalid');
        } else {
            $('#length').removeClass('invalid').addClass('valid');
            return false;
        }
    }).focus(function() {
        $('#pswd_info').show();
    }).blur(function() {
        $('#pswd_info').hide();
    });

    $('#btncreateccount').click(function (e) { 
        $('#preloader').show();
        e.preventDefault();
        var account_name = $("#accountname").val();
        var account_user = $("#accountuser").val();
        var account_password = $("#accountpassword").val();
        var accountpassword_cf = $("#accountpassword_cf").val();
        var account_role = $("#accountrole").val();
        var account_status = $("#accountstatus").bootstrapSwitch('state');
        
        if(account_name == '') {
            requireField('alertaccountname', 'accountname');
            $('#preloader').hide();
            window.scrollTo(0, $("#accountname").offset().top);
            return false;
        } else {
            successField('alertaccountname', 'accountname');
        }

        if(account_user == '') {
            requireField('alertaccountuser', 'accountuser');
            $('#preloader').hide();
            window.scrollTo(0, $("#accountuser").offset().top);
            return false;
        } else {
            successField('alertaccountuser', 'accountuser');
        }

        if(account_password == '') {
            requireField('alertaccountpassword', 'accountpassword');
            $('#preloader').hide();
            window.scrollTo(0, $("#accountpassword").offset().top);
            return false;
        } else {
            successField('alertaccountpassword', 'accountpassword');
        }

        if(account_password.length < 8) {
            requireField('alertaccountpassword2', 'accountpassword');
            $('#preloader').hide();
            window.scrollTo(0, $("#accountpassword").offset().top);
            return false;
        } else {
            successField('alertaccountpassword2', 'accountpassword');
        }

        if(accountpassword_cf == '') {
            requireField('alertaccountpassword_cf', 'accountpassword_cf');
            $('#preloader').hide();
            window.scrollTo(0, $("#accountpassword_cf").offset().top);
            return false;
        } else {
            successField('alertaccountpassword_cf', 'accountpassword_cf');
        }

        if(accountpassword_cf != account_password) {
            requireField('alertaccountpassword_cf2', 'accountpassword_cf');
            $('#preloader').hide();
            window.scrollTo(0, $("#accountpassword_cf").offset().top);
            return false;
        } else {
            successField('alertaccountpassword_cf2', 'accountpassword_cf');
        }

        if(account_role == '') {
            requireField2('alertaccountrole', '[data-select2-id="1"]');
            $('#alertaccountrole').show();
            $('#preloader').hide();
            window.scrollTo(0, $("#accountrole").offset().top);
            return false;
        } else {
            successField2('alertaccountrole', '[data-select2-id="1"]');
            $('#alertaccountrole').hide();
        }

        $.ajax({
            type: "POST",
            url: base_url + "api/createuser",
            data: {account_name:account_name,account_user:account_user,account_password:account_password,account_role:account_role,account_status:account_status},
            dataType: 'json',
            success: function (response) {
                $('#preloader').hide();
                if (response == "success") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: "User account have been created.",
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

    $('#btneditaccount').click(function (e) { 
        $('#preloader').show();
        e.preventDefault();
        var account_id = $("#editaccountid").val();
        var account_name = $("#editaccountname").val();
        var account_user = $("#editaccountuser").val();
        var account_password = $("#editaccountpassword").val();
        var accountpassword_cf = $("#editaccountpassword_cf").val();
        var account_role = $("#editaccountrole").val();
        var account_status = $("#editaccountstatus").bootstrapSwitch('state');
        
        if(account_name == '') {
            requireField('alerteditaccountname', 'editaccountname');
            $('#preloader').hide();
            window.scrollTo(0, $("#editaccountname").offset().top);
            return false;
        } else {
            successField('alerteditaccountname', 'editaccountname');
        }

        if(account_user == '') {
            requireField('alerteditaccountuser', 'editaccountuser');
            $('#preloader').hide();
            window.scrollTo(0, $("#editaccountuser").offset().top);
            return false;
        } else {
            successField('alerteditaccountuser', 'editaccountuser');
        }

        if(account_password != '') {
            if(account_password.length < 8) {
                requireField('alerteditaccountpassword2', 'editaccountpassword');
                $('#preloader').hide();
                window.scrollTo(0, $("#editaccountpassword").offset().top);
                return false;
            } else {
                successField('alerteditaccountpassword2', 'editaccountpassword');
            }
    
            if(accountpassword_cf == '') {
                requireField('alerteditaccountpassword_cf', 'editaccountpassword_cf');
                $('#preloader').hide();
                window.scrollTo(0, $("#editaccountpassword_cf").offset().top);
                return false;
            } else {
                successField('alerteditaccountpassword_cf', 'editaccountpassword_cf');
            }
    
            if(accountpassword_cf != account_password) {
                requireField('alerteditaccountpassword_cf2', 'editaccountpassword_cf');
                $('#preloader').hide();
                window.scrollTo(0, $("#editaccountpassword_cf").offset().top);
                return false;
            } else {
                successField('alerteditaccountpassword_cf2', 'editaccountpassword_cf');
            }
        }

        if(account_role == '') {
            requireField2('alerteditaccountrole', '[data-select2-id="3"]');
            $('#alerteditaccountrole').show();
            $('#preloader').hide();
            window.scrollTo(0, $("#editaccountrole").offset().top);
            return false;
        } else {
            successField2('alerteditaccountrole', '[data-select2-id="3"]');
            $('#alerteditaccountrole').hide();
        }

        $.ajax({
            type: "POST",
            url: base_url + "api/editaccount",
            data: {account_id:account_id,account_name:account_name,account_user:account_user,account_password:account_password,account_role:account_role,account_status:account_status},
            dataType: 'json',
            success: function (response) {
                $('#preloader').hide();
                if (response == "success") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: "Account have been Edited.",
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

    $('#btnjoingroup').click(function (e) { 
        e.preventDefault();
        $('#preloader').show();
        var base_url = $("#baseurl").val();
        var groupid = $('#addgroupname').val();
        var grouprole = $('#addgrouprole').val();
        var accountid = $('#infoaccountid').val();

        if(groupid == '') {
            requireField2('alertaddgroupname', '[data-select2-id="5"]');
            $('#alertaddgroupname').show();
            $('#preloader').hide();
            window.scrollTo(0, $("#groupname").offset().top);
            return false;
        } else {
            successField2('alertaddgroupname', '[data-select2-id="5"]');
            $('#alertaddgroupname').hide();
        }

        if(grouprole == '') {
            requireField2('alertaddgrouprole', '[data-select2-id="7"]');
            $('#alertaddgrouprole').show();
            $('#preloader').hide();
            window.scrollTo(0, $("#addgrouprole").offset().top);
            return false;
        } else {
            successField2('alertaddgrouprole', '[data-select2-id="7"]');
            $('#alertaddgrouprole').hide();
        }

        $.ajax({
            type: "POST",
            url: base_url + "api/addmemberingroup",
            data: {groupid:groupid,grouprole:grouprole,accountid:accountid},
            dataType: "json",
            success: function (response) {
                if (response == "success") {
                    $('#preloader').hide();
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: "User account have been join in group.",
                        showConfirmButton: false,
                        timer: 2500
                    });
                    location.reload();
                }else{
                    $('#preloader').hide();
                    Swal.fire({
                        icon: 'error',
                        title: response,
                        showConfirmButton: false,
                        timer: 2500
                    });
                }
            }
        });
    });
    
})(jQuery);