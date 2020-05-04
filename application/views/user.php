<!DOCTYPE html>
<html lang="en">
<head>
    <meta content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?=$title;?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/material-design-lite/1.1.0/material.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.material.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url();?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <script src="<?=base_url();?>assets/dist/js/jquery-3.4.1.min.js"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    
<div id="preloader">
	<div id="statuspreloader" >&nbsp;</div>
</div>

<div class="wrapper">
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0 text-dark"><i class="fas fa-users"></i> User Account</h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><i class="fas fa-home"></i><a href="home"> Home</a></li>
                    <li class="breadcrumb-item active"><a href="<?php echo $breadcrumb;?>"><?php echo $breadcrumb;?></a></li>
                </ol>
                </div>
            </div>
            </div>
        </div>

        <div class="col-12">  
            <a class="btn-sm btn-success" href="#" data-toggle="modal" data-target="#modal-lg">
                <em class="fas fa-plus"></em> Create User
            </a>
        </div>
        <div class="col-12"> 
            <br>
        </div>

        <section class="content">
            <div class="row">
                <div class="col-12">  
                    <div class="card">  
                        <div class="card-body">
                            <div class="table-responsive">
                                <input type="hidden" class="form-control" id="infoaccountid" placeholder="">
                                <table class="mdl-data-table" id="myTable" style="display:none; width: 100%;">
                                    <thead>
                                    <tr>
                                        <th style="text-align: left;">Account Name</th>
                                        <th style="text-align: left;">Username</th>
                                        <th style="text-align: center;">Status</th>
                                        <th style="text-align: center;">Role</th>
                                        <th style="text-align: center;">Create Date</th>
                                        <th style="text-align: center;">Tools</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($userlists as $num => $row){?>
                                        <tr>
                                            <td style="text-align: left;"><?php echo $row->account_name;?></td>
                                            <td style="text-align: left;"><?php echo $row->username;?></td>

                                            <?php switch($row->status) {
                                                case 1:
                                                    $project_status = "Enable";
                                                    $color = "success";
                                                    break;
                                                case 0:
                                                    $project_status = "Disable";
                                                    $color = "danger";
                                                    break;
                                            }?>
                                            <td style="text-align: center;"><span id="status" class="badge badge-<?php echo $color; ?>"><?php echo $project_status;?></span></td> 

                                            <?php switch($row->account_role) {
                                                case 0:
                                                    $account_role = "User";
                                                    $color = "secondary";
                                                    break;
                                                case 1:
                                                    $account_role = "Administrator";
                                                    $color = "info";
                                                    break;
                                            }?>
                                            <td style="text-align: center;"><span id="role" class="badge badge-<?php echo $color; ?>"><?php echo $account_role;?></span></td> 

                                            <td style="text-align: center;"><?php echo $row->create_date;?></td>
                                            <td style="text-align: center;">
                                                <a id="info-button<?php echo $i?>" class="btn btn-warning btn-circle infobutton" href="#<?php echo $row->id?>" data-toggle="modal" data-target="#modal-overlay-info"> <span class="fas fa-info-circle" style="color:#fff;"></span> </a>
                                                <script>
                                                    $('#info-button<?php echo $i?>').click(function (e) { 
                                                        var base_url = $("#baseurl").val();
                                                        var accountid = $("#info-button<?php echo $i?>").attr("href").match(/#([0-9999]+)/)[1];
                                                        $('#infoaccountid').val(accountid);
                                                        $('#myTableInfo').DataTable({
                                                            responsive: true,
                                                            columnDefs: [
                                                                { className: 'text-center', targets: [0,1,2,3,4] },
                                                            ],
                                                            "bPaginate": false,
                                                            "bFilter": false,
                                                            "bInfo": false,
                                                            "ajax": base_url + "api/getGroupByaid?accountid=" + accountid,
                                                        });
                                                        $('#overlay-info').attr("style", "display: none !important");
                                                    });
                                                </script>

                                                <a id="editbutton<?php echo $i?>" class="btn btn-info btn-circle editbutton"  href="#<?php echo $row->id?>" data-toggle="modal" data-target="#modal-overlay"> <span class="fas fa-cog"></span> </a> 
                                                <script>
                                                    $('#editbutton<?php echo $i?>').click(function (e) { 
                                                        $("#editaccountpassword").val("");
                                                        var base_url = $("#baseurl").val();
                                                        var accountid = $("#editbutton<?php echo $i?>").attr("href").match(/#([0-9999]+)/)[1];
                                                        var role = '';
                                                        $.ajax({
                                                            type: "POST",
                                                            url: base_url + "api/getaccountid",
                                                            data: {accountid:accountid},
                                                            dataType: "json",
                                                            success: function (response) {
                                                                if (response.status == "success") {
                                                                    $('#overlay').attr("style", "display: none !important");
                                                                    $("#editaccountid").val(response.data.account_id);
                                                                    $("#editaccountname").val(response.data.account_name);
                                                                    $("#editaccountuser").val(response.data.username);
                                                                    if (response.data.account_role == '0') {
                                                                        role = 'User';
                                                                    }else{
                                                                        role = 'Administrator';
                                                                    }
                                                                    $('#editaccountrole').prepend($('<option>', {
                                                                        value: response.data.account_role,
                                                                        text: role + " ( Default Role )",
                                                                        selected: 'selected'
                                                                    }));
                                                                    if (response.data.status == "1") {
                                                                        var status = true;
                                                                    }else{
                                                                        var status = false;
                                                                    }
                                                                    $("#editaccountstatus").bootstrapSwitch('state', status);

                                                                }
                                                            }
                                                        });
                                                    });
                                                </script>
                                                <a id="delete-button<?php echo $i?>" class="btn btn-danger btn-circle" > <span class="fas fa-trash-alt" style="color:#fff;"></span> </a>
                                                <script>
                                                $("#delete-button<?php echo $i?>").click(function(){
                                                    var base_url = $("#baseurl").val();
                                                    Swal.fire({
                                                    title: 'Do you want to delete?',
                                                    text: "Please check detail before click 'Delete' a account!",
                                                    icon: 'warning',
                                                    showCancelButton: true,
                                                    confirmButtonColor: '#d33',
                                                    cancelButtonColor: '#3085d6',
                                                    confirmButtonText: 'Delete'
                                                    }).then((result) => {
                                                        if (result.value) {
                                                            $('#preloader').show();
                                                            $.ajax({
                                                            url: base_url + "api/delaccount",
                                                            type: 'post',
                                                            dataType: 'json',
                                                            data: {id:<?php echo $row->id?>},
                                                                success: function (response) {
                                                                    if (response == "success") {
                                                                        $('#preloader').hide();
                                                                        Swal.fire({
                                                                            icon: 'success',
                                                                            title: 'Deleted.',
                                                                            text: "Promotion has been Delete",
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
                                                            })
                                                        }
                                                    })
                                                });
                                                </script>
                                            </td>
                                        </tr>
                                        <?php $i++; } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div> 
                    </div> 
                </div>
            </div>
        </section>  
    </div>
</div>
<!-- ./wrapper -->

<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Create User Account</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" id="createform" autocomplete="off" action="#">
                <div class="card-body">

                    <div class="form-group">
                        <label for="accountname">Account Name *</label>
                        <input type="text" class="form-control" id="accountname" placeholder="">
                        <div id="alertaccountname" class="alertaccountname" style="display:none; color: red; margin-top: 5px;"> Account name cannot be null</div>    
                    </div>

                    <div class="form-group">
                        <label for="accountuser">Username *</label>
                        <input type="text" class="form-control" id="accountuser" autocomplete=off placeholder="">
                        <div id="alertaccountuser" class="alertaccountuser" style="display:none; color: red; margin-top: 5px;"> Account user cannot be null</div>  
                    </div>

                    <div class="form-group">
                        <label for="accountpassword">Password *</label>
                        <input type="password" class="form-control" id="accountpassword" autocomplete="off" placeholder="Password should have 8-12 character">
                        <div id="alertaccountpassword" class="alertaccountpassword" style="display:none; color: red; margin-top: 5px;"> Password cannot be null</div>   
                        <div id="alertaccountpassword2" class="alertaccountpassword2" style="display:none; color: red; margin-top: 5px;"> Password should have 8-12 character</div>    
                    </div>

                    <div id="pswd_info">
                        <h4>Password must meet the following requirements:</h4>
                        <ul>
                            <li id="letter" class="invalid">At least <strong>one letter</strong></li>
                            <li id="capital" class="invalid">At least <strong>one capital letter</strong></li>
                            <li id="number" class="invalid">At least <strong>one number</strong></li>
                            <li id="length" class="invalid">Be at least <strong>8 characters</strong></li>
                        </ul>
                    </div>

                    <div class="form-group">
                        <label for="accountpassword_cf">Comfirm Password *</label>
                        <input type="password" class="form-control" id="accountpassword_cf" autocomplete="off" placeholder="Confirm password">
                        <div id="alertaccountpassword_cf" class="alertaccountpassword_cf" style="display:none; color: red; margin-top: 5px;"> Confirm password cannot be null</div>    
                        <div id="alertaccountpassword_cf2" class="alertaccountpassword_cf2" style="display:none; color: red; margin-top: 5px;"> Confirm password not match</div>  
                    </div>

                    <div class="form-group">
                        <label for="accountrole">Account Role *</label>
                        <select id="accountrole" name="accountrole" class="form-control select2 selecterrorg" style="width: 100%;">
                            <option selected="selected" value="">-- Select Role --</option>
                            <option value="0"> User </option>
                            <option value="1"> Administrator </option>
                        </select>
                        <div id="alertaccountrole" class="alertaccountrole" style="display:none; color: red; margin-top: 5px;"> Account role cannot be null</div>    
                    </div>

                    <div class="form-group">
                        <label for="exampleInputFile">Account Status</label><br>
                        <input type="checkbox" id="accountstatus" name="accountstatus" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                    </div>

                </div>
            </form>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" id="btncreateccount" class="btn btn-primary">Create</button>
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-overlay" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div id="overlay" class="overlay d-flex justify-content-center align-items-center">
            <i class="fas fa-2x fa-sync fa-spin"></i>
        </div>
        <div class="modal-header">
            <h4 class="modal-title">Edit User Account</h4>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" id="editform" autocomplete="off"  action="#">
                <div class="card-body">

                <div class="form-group">
                        <label for="accountname">Account Name *</label>
                        <input type="hidden" class="form-control" id="editaccountid" placeholder="">
                        <input type="text" class="form-control" id="editaccountname" placeholder="">
                        <div id="alerteditaccountname" class="alerteditaccountname" style="display:none; color: red; margin-top: 5px;"> Account name cannot be null</div>    
                    </div>

                    <div class="form-group">
                        <label for="editaccountuser">Username *</label>
                        <input type="text" class="form-control" id="editaccountuser" autocomplete=off placeholder="">
                        <div id="alerteditaccountuser" class="alerteditaccountuser" style="display:none; color: red; margin-top: 5px;"> Account user cannot be null</div>  
                    </div>

                    <div class="form-group">
                        <label for="editaccountpassword">Password </label>
                        <input type="password" class="form-control" id="editaccountpassword" autocomplete="off" placeholder="Please set blank if do not to change password">
                        <div id="alerteditaccountpassword" class="alerteditaccountpassword" style="display:none; color: red; margin-top: 5px;"> Password cannot be null</div>   
                        <div id="alerteditaccountpassword2" class="alerteditaccountpassword2" style="display:none; color: red; margin-top: 5px;"> Password should have 8-12 character</div>    
                    </div>

                    <div id="pswd_info">
                        <h4>Password must meet the following requirements:</h4>
                        <ul>
                            <li id="letter" class="invalid">At least <strong>one letter</strong></li>
                            <li id="capital" class="invalid">At least <strong>one capital letter</strong></li>
                            <li id="number" class="invalid">At least <strong>one number</strong></li>
                            <li id="length" class="invalid">Be at least <strong>8 characters</strong></li>
                        </ul>
                    </div>

                    <div class="form-group">
                        <label for="editaccountpassword_cf">Comfirm Password </label>
                        <input type="password" class="form-control" id="editaccountpassword_cf" autocomplete="off" placeholder="Confirm password">
                        <div id="alerteditaccountpassword_cf" class="alerteditaccountpassword_cf" style="display:none; color: red; margin-top: 5px;"> Confirm password cannot be null</div>    
                        <div id="alerteditaccountpassword_cf2" class="alerteditaccountpassword_cf2" style="display:none; color: red; margin-top: 5px;"> Confirm password not match</div>  
                    </div>

                    <div class="form-group">
                        <label for="editaccountrole">Account Role *</label>
                        <select id="editaccountrole" name="editaccountrole" class="form-control select2 selecterrorg" style="width: 100%;">
                            <option value="0"> User </option>
                            <option value="1"> Administrator </option>
                        </select>
                        <div id="alerteditaccountrole" class="alerteditaccountrole" style="display:none; color: red; margin-top: 5px;"> Account role cannot be null</div>    
                    </div>

                    <div class="form-group">
                        <label for="exampleInputFile">Account Status</label><br>
                        <input type="checkbox" id="editaccountstatus" name="editaccountstatus" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                    </div>

                </div>
            </form>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" id="closeeditaccount" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" id="btneditaccount" class="btn btn-primary">Edit</button>
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-overlay-info" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div id="overlay-info" class="overlay d-flex justify-content-center align-items-center">
            <i class="fas fa-2x fa-sync fa-spin"></i>
        </div>
        <div class="modal-header">
            <h4 class="modal-title">Group setting</h4>
            </button>
        </div>
        <div class="modal-body">
            <ul class="nav nav-tabs" id="custom-content-above-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="custom-content-above-home-tab" data-toggle="pill" href="#custom-content-above-home" role="tab" aria-controls="custom-content-above-home" aria-selected="true">Group lists</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-content-above-profile-tab" data-toggle="pill" href="#custom-content-above-profile" role="tab" aria-controls="custom-content-above-profile" aria-selected="false">Group setting</a>
                </li>
            </ul>

            <div class="tab-content" id="custom-content-above-tabContent">
                <div class="tab-pane fade show active" id="custom-content-above-home" role="tabpanel" aria-labelledby="custom-content-above-home-tab">
                    <form method="post" id="delgroupform" autocomplete="off"  action="#">
                        <div class="card-body">
                            <label for="grouplists">Group of account lists </label>
                            <div class="table-responsive">
                                <table class="mdl-data-table" id="myTableInfo" style="display:none; width: 100%;">
                                    <thead>
                                    <tr>
                                        <th style="text-align: left;">Group ID</th>
                                        <th style="text-align: left;">Group Name</th>
                                        <th style="text-align: center;">Role</th>
                                        <th style="text-align: center;">Join date</th>
                                        <th style="text-align: center;">Tools</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                            <script>
                                function delgroup(gid,aid) {
                                    var base_url = $("#baseurl").val();

                                    Swal.fire({
                                    title: 'Do you want to delete?',
                                    text: "Please check detail before click 'Delete' a account!",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#d33',
                                    cancelButtonColor: '#3085d6',
                                    confirmButtonText: 'Delete'
                                    }).then((result) => {
                                        if (result.value) {
                                            $('#preloader').show();
                                            $.ajax({
                                            url: base_url + "api/delmemberingroup",
                                            type: 'post',
                                            dataType: 'json',
                                            data: {accountid:aid,groupid:gid},
                                                success: function (response) {
                                                    if (response == "success") {
                                                        $('#preloader').hide();
                                                        Swal.fire({
                                                            icon: 'success',
                                                            title: 'Success',
                                                            text: "User account have been leave from group.",
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
                                            })
                                        }
                                    })
                                }
                            </script>
                        </div>
                    </form>
                </div>

                <div class="tab-pane fade" id="custom-content-above-profile" role="tabpanel" aria-labelledby="custom-content-above-profile-tab">
                    <div class="card-body">
                        <label for="addgroupsetting">Add group setting</label>
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-sm-5 col-5">
                                <select id="addgroupname" name="addgroupname" class="form-control select2" style="width: 100%;">
                                    <option selected="selected" value="">-- Select Group --</option>
                                    <?php foreach ($grouplists as $value) { ?>
                                        <?php if ($value->status == "1") { ?>
                                            <option value="<?php echo $value->id; ?>"><?php echo $value->group_name; ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                                <div id="alertaddgroupname" class="alertaddgroupname" style="display:none; color: red; margin-top: 5px;"> Group select cannot be null</div>    
                            </div>

                            <div class="col-lg-5 col-md-5 col-sm-5 col-5">
                                <select id="addgrouprole" name="addgrouprole" class="form-control select2 selecterrorg" style="width: 100%;">
                                    <option selected="selected" value="">-- Select Role --</option>
                                    <option value="0"> User </option>
                                    <option value="1"> Administrator </option>
                                    <option value="2"> Owner </option>
                                </select>
                                <div id="alertaddgrouprole" class="alertaddgrouprole" style="display:none; color: red; margin-top: 5px;"> Group role cannot be null</div>    
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-2 col-2">
                                <button id="btnjoingroup" class="btn btn-success" style="width:100%;">Join Group</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer justify-content-between">
            <button type="button" id="closeinfoaccount" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>


<input id="baseurl" name="baseurl" type="hidden" value="<?php echo base_url();?>">
</body>
</html>

<!-- jQuery -->
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.material.min.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="<?=base_url();?>assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="<?=base_url();?>assets/dist/js/user.js"></script>

<style type="text/css">

#preloader {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #fff;
  opacity:0.4;
  z-index: 9999999;
}

#statuspreloader {
  width: 200px;
  height: 200px;
  position: absolute;
  left: 50%;
  top: 50%;
  background-image: url(https://raw.githubusercontent.com/niklausgerber/PreLoadMe/master/img/status.gif);
  background-repeat: no-repeat;
  background-position: center;
  margin: -100px 0 0 -100px;
}

table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>td:first-child:before, table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>th:first-child:before {
  top: 30%;
  left: 10px;
}

.mdl-data-table td:last-of-type, .mdl-data-table th:last-of-type{
  text-align: left;
}

#pswd_info {
    position:absolute;
    /* bottom:-75px; */
    /* bottom: -115px\9;  */
    /* right:55px; */
    width:350px;
    padding:15px;
    background:#fefefe;
    font-size:.875em;
    border-radius:5px;
    box-shadow:0 1px 3px #ccc;
    border:1px solid #ddd;
    z-index: 99;
}

#pswd_info h4 {
    margin:0 0 10px 0;
    padding:0;
    font-weight:normal;
}

#pswd_info::before {
    content: "\25B2";
    position:absolute;
    top:-12px;
    left:45%;
    font-size:14px;
    line-height:14px;
    color:#ddd;
    text-shadow:none;
    display:block;
}

.invalid {
    background:url(<?=base_url();?>assets/dist/img/icons/cross.png) no-repeat 0 50%;
    padding-left:22px;
    line-height:24px;
    color:#ec3f41;
}
.valid {
    background:url(<?=base_url();?>assets/dist/img/icons/tick.png) no-repeat 0 50%;
    padding-left:22px;
    line-height:24px;
    color:#3a7d34;
}

#pswd_info {
    display:none;
}

ul, li {
    margin:0;
    padding:0;
    list-style-type:none;
}

</style>

<?php 

function DateEng($strDate)
{
  $strYear = date("Y",strtotime($strDate));
  $strMonth= date("n",strtotime($strDate));
  $strDay= date("j",strtotime($strDate));
  $strHour= date("H",strtotime($strDate));
  $strMinute= date("i",strtotime($strDate));
  $strSeconds= date("s",strtotime($strDate));
  $strMonthCut = Array("","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
  $strMonthThai=$strMonthCut[$strMonth];
  return "$strDay $strMonthThai $strYear";
}
?>