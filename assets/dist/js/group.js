(function ($) {  
 
    var base_url = $("#baseurl").val();

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

    $('#myTableInfo').show()

    $('#myTable').DataTable({
        responsive: true,
        "columnDefs": [
        { "width": "25%", "targets": 1 },
        { "width": "25%", "targets": 2 },
        { "width": "20%", "targets": 5 }
        ]
    });

    $("[name='groupstatus']").bootstrapSwitch('state', false);
    $("[name='editgroupstatus']").bootstrapSwitch('state', false);

    $('#closeeditgroup').click(function (e) { 
        $("#editgroupname").val("");
        $("#editgroupdescription").val("");
        $("#editgroupstatus").val("");
        $('#overlay').attr("style", "display:");
    });

    $('#closeinfoaccount').click(function (e) { 
        $('#overlay').attr("style", "display:");
        $('#addgroupname').prop('selectedIndex',0);
        $('#addgrouprole').prop('selectedIndex',0);
        var table = $('#myTableInfo').DataTable();
        table.destroy();
    });

    $('#btncreategroup').click(function (e) { 
        $('#preloader').show();
        e.preventDefault();
        var group_name = $("#groupname").val();
        var group_description = $("#groupdescription").val();
        var group_status = $("#groupstatus").bootstrapSwitch('state');
        
        if(group_name == '') {
            requireField('alertgroupname', 'groupname');
            $('#preloader').hide();
            window.scrollTo(0, $("#groupname").offset().top);
            return false;
        } else {
            successField('alertgroupname', 'groupname');
        }

        $.ajax({
            type: "POST",
            url: base_url + "api/creategroup",
            data: {group_name:group_name,group_description:group_description,group_status:group_status},
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

    $('#btneditgroup').click(function (e) { 
        $('#preloader').show();
        e.preventDefault();
        var group_id = $("#editgroupid").val();
        var group_name = $("#editgroupname").val();
        var group_description = $("#editgroupdescription").val();
        var group_status = $("#editgroupstatus").bootstrapSwitch('state');
        
        if(group_name == '') {
            requireField('alerteditgroupname', 'editgroupname');
            $('#preloader').hide();
            window.scrollTo(0, $("#editgroupname").offset().top);
            return false;
        } else {
            successField('alerteditgroupname', 'editgroupname');
        }

        $.ajax({
            type: "POST",
            url: base_url + "api/editgroup",
            data: {group_id:group_id,group_name:group_name,group_description:group_description,group_status:group_status},
            dataType: 'json',
            success: function (response) {
                $('#preloader').hide();
                if (response == "success") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: "Group have been Edited.",
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
        var groupid = $('#infofroupid').val();
        var grouprole = $('#addgrouprole').val();
        var accountid = $('#addaccountname').val();

        if(accountid == '') {
            requireField2('alertaddgroupname', '[data-select2-id="1"]');
            $('#alertaddaccountname').show();
            $('#preloader').hide();
            window.scrollTo(0, $("#groupname").offset().top);
            return false;
        } else {
            successField2('alertaddgroupname', '[data-select2-id="1"]');
            $('#alertaddaccountname').hide();
        }

        if(grouprole == '') {
            requireField2('alertaddgrouprole', '[data-select2-id="3"]');
            $('#alertaddgrouprole').show();
            $('#preloader').hide();
            window.scrollTo(0, $("#addgrouprole").offset().top);
            return false;
        } else {
            successField2('alertaddgrouprole', '[data-select2-id="3"]');
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