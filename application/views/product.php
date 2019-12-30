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
                <h1 class="m-0 text-dark"><i class="fas fa-cubes"></i> Product</h1>
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
                <em class="fas fa-plus"></em> Create Product
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
                                        <th style="width: 5%; text-align: center;">Product ID</th>
                                        <th style="text-align: left;">Product Name</th>
                                        <th style="text-align: left;">Product Group</th>
                                        <th class="none" style="text-align: left;">Product Prefix</th>
                                        <th style="text-align: left;">Product Price</th>
                                        <th class="none" style="text-align: left;">Product Detail</th>
                                        <th style="text-align: center;">Status</th>
                                        <th style="text-align: center;">Create Date</th>
                                        <th style="text-align: center;">Tools</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($productlists as $num => $row){ ?>
                                        <tr>
                                            <td style="text-align: center;"><?php echo $row->id;?></td>
                                            <td style="text-align: left;"><?php echo $row->product_name;?></td>
                                            <td style="text-align: left;"><?php echo $row->group_name;?></td>
                                            <td style="text-align: left;"><?php echo $row->product_prefix;?></td>
                                            <td style="text-align: left;"><?php echo $row->product_price;?></td>
                                            <td style="text-align: left;"><?php echo $row->product_detail;?></td>
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
                                                        var productid = $("#editbutton<?php echo $i?>").attr("href").match(/#([0-9999]+)/)[1];
                                                        $.ajax({
                                                            type: "POST",
                                                            url: base_url + "api/getproductid",
                                                            data: {productid:productid},
                                                            dataType: "json",
                                                            success: function (response) {
                                                                if (response.status == "success") {
                                                                    $('#overlay').attr("style", "display: none !important");
                                                                    $("#editproductid").val(response.data.product_id);
                                                                    $("#editproductname").val(response.data.product_name);
                                                                    $("#editproductprefix").val(response.data.product_prefix);
                                                                    $('#editproductgroup').prepend($('<option>', {
                                                                        value: response.data.group_id,
                                                                        text: response.data.group_name + " ( Default Group )",
                                                                        selected: 'selected'
                                                                    }));
                                                                    $("#editproductprice").val(response.data.product_price);
                                                                    $("#editproductdetail").val(response.data.product_detail);
                                                                    if (response.data.status == "1") {
                                                                        var status = true;
                                                                    }else{
                                                                        var status = false;
                                                                    }
                                                                    $("#editproductstatus").bootstrapSwitch('state', status);
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
                                                    text: "Please check detail before click 'Delete' a product!",
                                                    icon: 'warning',
                                                    showCancelButton: true,
                                                    confirmButtonColor: '#d33',
                                                    cancelButtonColor: '#3085d6',
                                                    confirmButtonText: 'Delete'
                                                    }).then((result) => {
                                                        if (result.value) {
                                                            $('#preloader').show();
                                                            $.ajax({
                                                            url: base_url + "api/delproduct",
                                                            type: 'post',
                                                            dataType: 'json',
                                                            data: {id:<?php echo $row->id?>,gid:<?php echo $row->group_id?>},
                                                                success: function (response) {
                                                                    if (response == "success") {
                                                                        $('#preloader').hide();
                                                                        Swal.fire({
                                                                            icon: 'success',
                                                                            title: 'Deleted.',
                                                                            text: "Product has been Delete",
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
            <h4 class="modal-title">Create Product</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" id="createform" action="#">
                <div class="card-body">

                    <div class="form-group">
                        <label for="productname">Product Name *</label>
                        <input type="text" class="form-control" id="productname" placeholder="">
                        <div id="alertproductname" class="alertproductname" style="display:none; color: red; margin-top: 5px;"> Product name cannot be null</div>    
                    </div>

                    <div class="form-group">
                        <label for="productprefix">Product Prefix</label>
                        <input type="text" class="form-control" id="productprefix" placeholder="Example : TESTS ( Eng and Number chatacter not over 5 characters )" maxlength="5">
                    </div>

                    <div class="form-group">
                        <label for="productprice">Product Price *</label>
                        <input type="tel" class="form-control" id="productprice" placeholder="">
                        <div id="alertproductprice" class="alertproductprice" style="display:none; color: red; margin-top: 5px;"> Product price cannot be null</div>    
                    </div>

                    <div class="form-group">
                        <label for="productgroup">Product Group *</label>
                        <select id="productgroup" name="productgroup" class="form-control select2" style="width: 100%;">
                            <option selected="selected" value="">-- Select Group --</option>
                            <?php foreach ($grouplists as $value) { ?>
                                <?php if ($value->status == "1") { ?>
                                    <option value="<?php echo $value->id; ?>"><?php echo $value->group_name; ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                        <div id="alertproductgroup" class="alertproductgroup" style="display:none; color: red; margin-top: 5px;"> Product group cannot be null</div>    
                    </div>

                    <div class="form-group">
                        <label for="productdetail">Product Description</label>
                        <textarea class="form-control" id="productdetail" rows="3" placeholder=""></textarea>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputFile">Product Status</label><br>
                        <input type="checkbox" id="productstatus" name="productstatus" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                    </div>

                </div>
            </form>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" id="btncreateproduct" class="btn btn-primary">Create</button>
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
                        <label for="editproductname">Product Name *</label>
                        <input type="hidden" class="form-control" id="editproductid" placeholder="">
                        <input type="text" class="form-control" id="editproductname" placeholder="">
                        <div id="alerteditproductname" class="alerteditproductname" style="display:none; color: red; margin-top: 5px;"> Product name cannot be null</div>    
                    </div>

                    <div class="form-group">
                        <label for="editproductprefix">Product Prefix</label>
                        <input type="text" class="form-control" id="editproductprefix" placeholder="Example : TESTS ( Eng and Number chatacter not over 5 characters )" maxlength="5">
                    </div>

                    <div class="form-group">
                        <label for="editproductprice">Product Price *</label>
                        <input type="tel" class="form-control" id="editproductprice" placeholder="">
                        <div id="alerteditproductprice" class="alerteditproductprice" style="display:none; color: red; margin-top: 5px;"> Product price cannot be null</div>    
                    </div>

                    <div class="form-group">
                        <label for="editproductgroup">Product Group *</label>
                        <select id="editproductgroup" name="editproductgroup" class="form-control select2" style="width: 100%;">
                            <?php foreach ($grouplists as $value) { ?>
                                <?php if ($value->status == "1") { ?>
                                    <option value="<?php echo $value->id; ?>"><?php echo $value->group_name; ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                        <div id="alerteditproductgroup" class="alerteditproductgroup" style="display:none; color: red; margin-top: 5px;"> Product group cannot be null</div>    
                    </div>

                    <div class="form-group">
                        <label for="editproductdetail">Product Description</label>
                        <textarea class="form-control" id="editproductdetail" rows="3" placeholder=""></textarea>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputFile">Product Status</label><br>
                        <input type="checkbox" id="editproductstatus" name="editproductstatus" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                    </div>

                </div>
            </form>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" id="closeeditproduct" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" id="btneditproduct" class="btn btn-primary">Edit</button>
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
<script src="<?=base_url();?>assets/dist/js/product.js"></script>

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
