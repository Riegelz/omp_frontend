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
    <link rel="stylesheet" href="<?=base_url();?>assets/plugins/daterangepicker/daterangepicker.css">
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
                <h1 class="m-0 text-dark"><i class="fas fa-tasks"></i> Promotion</h1>
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
                <em class="fas fa-plus"></em> Create Promotion
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
                                        <th style="width: 5%; text-align: center;">Promotion ID</th>
                                        <th style="text-align: left;">Promotion Name</th>
                                        <th class="none" style="text-align: left;">Group</th>
                                        <th class="none" style="text-align: left;">Product</th>
                                        <th style="text-align: left;">Promotion Amount</th>
                                        <th style="text-align: left;">Promotion Price</th>
                                        <th class="none" style="text-align: left;">Promotion Period</th>
                                        <th style="text-align: center;">Status</th>
                                        <th style="text-align: center;">Create Date</th>
                                        <th style="text-align: center;">Tools</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($promotionlists as $num => $row){ ?>
                                        <tr>
                                            <td style="text-align: center;"><?php echo $row->id;?></td>
                                            <td style="text-align: left;"><?php echo $row->promotion_name;?></td>
                                            <td style="text-align: left;"><?php echo $row->group_name;?></td>
                                            <td style="text-align: left;"><?php echo $row->product_name;?></td>
                                            <td style="text-align: left;"><?php echo $row->promotion_product_amount;?></td>
                                            <td style="text-align: left;"><?php echo $row->promotion_price;?></td>

                                            <?php if ($row->promotion_period_begin != null) { ?>
                                            <td style="text-align: left;"><?php echo "<b>Start from : </b>" . DateEng($row->promotion_period_begin) . " <b>to</b> " . DateEng($row->promotion_period_end);?></td>
                                            <?php }else{ ?>
                                                <td style="text-align: left;">Period not set</td>
                                            <?php } ?>

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
                                                        var promotionid = $("#editbutton<?php echo $i?>").attr("href").match(/#([0-9999]+)/)[1];
                                                        $.ajax({
                                                            type: "POST",
                                                            url: base_url + "api/getpromotionid",
                                                            data: {promotionid:promotionid},
                                                            dataType: "json",
                                                            success: function (response) {
                                                                if (response.status == "success") {
                                                                    $('#overlay').attr("style", "display: none !important");
                                                                    $("#editpromotionid").val(response.data.promotion_id);
                                                                    $("#editpromotionname").val(response.data.promotion_name);
                                                                    $("#editpromotionamount").val(response.data.promotion_product_amount);
                                                                    $('#editpromotiongroup').prepend($('<option>', {
                                                                        value: response.data.group_id,
                                                                        text: response.data.group_name + " ( Default Group )",
                                                                        selected: 'selected'
                                                                    }));
                                                                    $('#editpromotionproduct').prepend($('<option>', {
                                                                        value: response.data.product_id,
                                                                        text: response.data.product_name + " ( Default Product )",
                                                                        selected: 'selected'
                                                                    }));
                                                                    $("#editpromotionprice").val(response.data.promotion_price);
                                                                    $("#editpromotionperiod").val(response.data.product_period);
                                                                    if (response.data.status == "1") {
                                                                        var status = true;
                                                                    }else{
                                                                        var status = false;
                                                                    }
                                                                    $("#editpromotionstatus").bootstrapSwitch('state', status);

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
                                                    text: "Please check detail before click 'Delete' a promotion!",
                                                    icon: 'warning',
                                                    showCancelButton: true,
                                                    confirmButtonColor: '#d33',
                                                    cancelButtonColor: '#3085d6',
                                                    confirmButtonText: 'Delete'
                                                    }).then((result) => {
                                                        if (result.value) {
                                                            $('#preloader').show();
                                                            $.ajax({
                                                            url: base_url + "api/delpromotion",
                                                            type: 'post',
                                                            dataType: 'json',
                                                            data: {id:<?php echo $row->id?>,gid:<?php echo $row->group_id?>},
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
            <h4 class="modal-title">Create Promotion</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" id="createform" action="#">
                <div class="card-body">

                    <div class="form-group">
                        <label for="promotionname">Promotion Name *</label>
                        <input type="text" class="form-control" id="promotionname" placeholder="">
                        <div id="alertpromotionname" class="alertpromotionname" style="display:none; color: red; margin-top: 5px;"> Promotion name cannot be null</div>    
                    </div>

                    <div class="form-group">
                        <label for="promotionamount">Promotion Amount *</label>
                        <input type="tel" class="form-control" id="promotionamount" placeholder="">
                        <div id="alertpromotionamount" class="alertpromotionamount" style="display:none; color: red; margin-top: 5px;"> Promotion amount cannot be null</div>  
                    </div>

                    <div class="form-group">
                        <label for="promotionprice">Promotion Price *</label>
                        <input type="tel" class="form-control" id="promotionprice" placeholder="">
                        <div id="alertpromotionprice" class="alertpromotionprice" style="display:none; color: red; margin-top: 5px;"> Promotion price cannot be null</div>    
                    </div>

                    <div class="form-group">
                        <label for="promotiongroup">Promotion Group *</label>
                        <select id="promotiongroup" name="promotiongroup" class="form-control select2 selecterrorg" style="width: 100%;">
                            <option selected="selected" value="">-- Select Group --</option>
                            <?php foreach ($grouplists as $value) { ?>
                                <?php if ($value->status == "1") { ?>
                                    <option value="<?php echo $value->id; ?>"><?php echo $value->group_name; ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                        <div id="alertpromotiongroup" class="alertpromotiongroup" style="display:none; color: red; margin-top: 5px;"> Promotion group cannot be null</div>    
                    </div>

                    <div class="form-group">
                        <label for="promotionproduct">Promotion Product *</label>
                        <select id="promotionproduct" name="promotionproduct" class="form-control select2 selecterrorp" style="width: 100%;" disabled/>
                            <option selected="selected" value="">-- Select Product --</option>
                            <?php foreach ($grouplists as $value) { ?>
                                <?php if ($value->status == "1") { ?>
                                    <option value="<?php echo $value->id; ?>"><?php echo $value->group_name; ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                        <div id="alertpromotionproduct" class="alertpromotionproduct" style="display:none; color: red; margin-top: 5px;"> Promotion group cannot be null</div>    
                    </div>

                    <div class="form-group">
                        <label for="promotionperiod">Promotion Period</label>
                        <input class="form-control" type="text" id="promotionperiod" name="promotionperiod" placeholder="Blank : No set period" autocomplete="off"/>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputFile">Promotion Status</label><br>
                        <input type="checkbox" id="promotionstatus" name="promotionstatus" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                    </div>

                </div>
            </form>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" id="btncreatepromotion" class="btn btn-primary">Create</button>
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
            <h4 class="modal-title">Edit Promotion</h4>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" id="editform" action="#">
                <div class="card-body">

                <div class="form-group">
                        <label for="editpromotionname">Promotion Name *</label>
                        <input type="hidden" class="form-control" id="editpromotionid" placeholder="">
                        <input type="text" class="form-control" id="editpromotionname" placeholder="">
                        <div id="alerteditpromotionname" class="alerteditpromotionname" style="display:none; color: red; margin-top: 5px;"> Promotion name cannot be null</div>    
                    </div>

                    <div class="form-group">
                        <label for="editpromotionamount">Promotion Amount *</label>
                        <input type="tel" class="form-control" id="editpromotionamount" placeholder="">
                        <div id="alerteditpromotionamount" class="alerteditpromotionamount" style="display:none; color: red; margin-top: 5px;"> Promotion amount cannot be null</div>  
                    </div>

                    <div class="form-group">
                        <label for="editpromotionprice">Promotion Price *</label>
                        <input type="tel" class="form-control" id="editpromotionprice" placeholder="">
                        <div id="alerteditpromotionprice" class="alerteditpromotionprice" style="display:none; color: red; margin-top: 5px;"> Promotion price cannot be null</div>    
                    </div>

                    <div class="form-group">
                        <label for="editpromotiongroup">Promotion Group *</label>
                        <select id="editpromotiongroup" name="editpromotiongroup" class="form-control select2 selecterrorg" style="width: 100%;">
                            <?php foreach ($grouplists as $value) { ?>
                                <?php if ($value->status == "1") { ?>
                                    <option value="<?php echo $value->id; ?>"><?php echo $value->group_name; ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                        <div id="alerteditpromotiongroup" class="alerteditpromotiongroup" style="display:none; color: red; margin-top: 5px;"> Promotion group cannot be null</div>    
                    </div>

                    <div class="form-group">
                        <label for="editpromotionproduct">Promotion Product *</label>
                        <select id="editpromotionproduct" name="editpromotionproduct" class="form-control select2 selecterrorp" style="width: 100%;" disabled/>
                            <?php foreach ($grouplists as $value) { ?>
                                <?php if ($value->status == "1") { ?>
                                    <option value="<?php echo $value->id; ?>"><?php echo $value->group_name; ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                        <div id="alerteditpromotionproduct" class="alerteditpromotionproduct" style="display:none; color: red; margin-top: 5px;"> Promotion group cannot be null</div>    
                    </div>

                    <div class="form-group">
                        <label for="editpromotionperiod">Promotion Period</label>
                        <input class="form-control" type="text" id="editpromotionperiod" name="editpromotionperiod" placeholder="Blank : No set period" autocomplete="off"/>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputFile">Promotion Status</label><br>
                        <input type="checkbox" id="editpromotionstatus" name="editpromotionstatus" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                    </div>

                </div>
            </form>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" id="closeeditpromotion" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" id="btneditpromotion" class="btn btn-primary">Edit</button>
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
<script src="<?=base_url();?>assets/plugins/daterangepicker/moment.min.js"></script>
<script src="<?=base_url();?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="<?=base_url();?>assets/dist/js/promotion.js"></script>

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