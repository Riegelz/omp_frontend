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
                <h1 class="m-0 text-dark">Group</h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="home">Home</a></li>
                    <li class="breadcrumb-item active"><a href="<?php echo $breadcrumb;?>"><?php echo $breadcrumb;?></a></li>
                </ol>
                </div>
            </div>
            </div>
        </div>

        <div class="col-12">  
            <a class="btn-sm btn-success" href="#" data-toggle="modal" data-target="#modal-lg">
                <em class="fas fa-plus"></em> Create Group
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
                                <table class="mdl-data-table" id="myTable" style="display:none; width: 100%;">
                                    <thead>
                                    <tr>
                                        <th style="width: 5%; text-align: center;">Group ID</th>
                                        <th style="text-align: left;">Group Name</th>
                                        <th style="text-align: left;">Description</th>
                                        <th style="text-align: center;">Status</th>
                                        <th style="text-align: center;">Create Date</th>
                                        <th style="text-align: center;">Tools</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($grouplists as $num => $row){ ?>
                                        <tr>
                                            <td style="text-align: center;"><?php echo $row->id;?></td>
                                            <td style="text-align: left;"><?php echo $row->group_name;?></td>
                                            <td style="text-align: left;"><?php echo $row->group_description;?></td>
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
                                            <td style="text-align: center;"><?php echo $row->create_date;?></td>
                                            <td style="text-align: center;">
                                                <a id="editbutton<?php echo $i?>" class="btn btn-info btn-circle editbutton"  href="#<?php echo $row->id?>" data-toggle="modal" data-target="#modal-overlay"> <span class="fas fa-cog"></span> </a> 
                                                <script>
                                                    $('#editbutton<?php echo $i?>').click(function (e) { 
                                                        var base_url = $("#baseurl").val();
                                                        var groupid = $("#editbutton<?php echo $i?>").attr("href").match(/#([0-9999]+)/)[1];
                                                        $.ajax({
                                                            type: "POST",
                                                            url: base_url + "api/getgroupid",
                                                            data: {groupid:groupid},
                                                            dataType: "json",
                                                            success: function (response) {
                                                                if (response.status == "success") {
                                                                    $('#overlay').attr("style", "display: none !important");
                                                                    $("#editgroupid").val(response.data.group_id);
                                                                    $("#editgroupname").val(response.data.group_name);
                                                                    $("#editgroupdescription").val(response.data.group_description);
                                                                    if (response.data.status == "1") {
                                                                        var status = true;
                                                                    }else{
                                                                        var status = false;
                                                                    }
                                                                    $("#editgroupstatus").bootstrapSwitch('state', status);
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
                                                    text: "Please check detail before click 'Delete' a group!",
                                                    icon: 'warning',
                                                    showCancelButton: true,
                                                    confirmButtonColor: '#d33',
                                                    cancelButtonColor: '#3085d6',
                                                    confirmButtonText: 'Delete'
                                                    }).then((result) => {
                                                        $('#preloader').show();
                                                        if (result.value) {
                                                            $.ajax({
                                                            url: base_url + "api/delgroup",
                                                            type: 'post',
                                                            dataType: 'json',
                                                            data: {id:<?php echo $row->id?>},
                                                                success: function (response) {
                                                                    if (response == "success") {
                                                                        $('#preloader').hide();
                                                                        Swal.fire({
                                                                            icon: 'success',
                                                                            title: 'Deleted.',
                                                                            text: "Group has been Delete",
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
            <h4 class="modal-title">Create Group</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" id="createform" action="#">
                <div class="card-body">

                    <div class="form-group">
                        <label for="groupname">Group Name</label>
                        <input type="text" class="form-control" id="groupname" placeholder="">
                        <div id="alertgroupname" class="alertgroupname" style="display:none; color: red; margin-top: 5px;"> Group name cannot be null</div>    
                    </div>

                    <div class="form-group">
                        <label for="groupdescription">Group Description</label>
                        <textarea class="form-control" id="groupdescription" rows="3" placeholder=""></textarea>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputFile">Group Status</label><br>
                        <input type="checkbox" id="groupstatus" name="groupstatus" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                    </div>

                </div>
            </form>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" id="btncreategroup" class="btn btn-primary">Create</button>
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
            <h4 class="modal-title">Edit Group</h4>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" id="editform" action="#">
                <div class="card-body">

                    <div class="form-group">
                        <label for="editgroupname">Group Name</label>
                        <input type="hidden" class="form-control" id="editgroupid" name="editgroupid">
                        <input type="text" class="form-control" id="editgroupname" name="editgroupname">
                        <div id="alerteditgroupname" class="alerteditgroupname" style="display:none; color: red; margin-top: 5px;"> Group name cannot be null</div>    
                    </div>

                    <div class="form-group">
                        <label for="editgroupdescription">Group Description</label>
                        <textarea class="form-control" id="editgroupdescription" rows="3" placeholder=""></textarea>
                    </div>

                    <div class="form-group">
                        <label for="editgroupstatus">Group Status</label><br>
                        <input type="checkbox" id="editgroupstatus" name="editgroupstatus" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                    </div>

                </div>
            </form>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" id="closeeditgroup" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" id="btneditgroup" class="btn btn-primary">Edit</button>
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
<script src="<?=base_url();?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="<?=base_url();?>assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="<?=base_url();?>assets/dist/js/group.js"></script>

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

</style>
