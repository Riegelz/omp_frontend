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

    $('#myTable').show()

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
})(jQuery);