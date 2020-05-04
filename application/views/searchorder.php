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
                <h1 class="m-0 text-dark"><i class="fas fa-search"></i> Search Order</h1>
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

        <section class="content">
            <div class="row">
                <div class="col-12">  
                    <div class="card">  
                        <div class="card-body">
                            <div class="table-responsive">


                                <div class="col-md-12">
                                    <br>
                                </div>   
                                                                    
                                <div class="col-md-12">
                                    <div class="card card-info">
                                        <div class="card-header">
                                            <h3 class="card-title">Search Filter Option</h3>
                                        </div>

                                        <div class="card-body">
                                            <form method="post" id="formAdsCost" action="#">
                                                <div class="row">

                                                    <div class="col-sm-6 col-m-6">
                                                        <div class="form-group">
                                                            <label>ชื่อ - นามสกุล ​: </label>
                                                            <input id="ordername" type="text" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6 col-m-6">
                                                        <div class="form-group">
                                                            <label>เบอร์โทรศัพท์ ​: </label>
                                                            <input id="ordertelnumber" type="text" class="form-control" maxlength="10">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6 col-m-6">
                                                        <div class="form-group">
                                                            <label>Tracking ID ​: </label>
                                                            <input id="ordertracking" type="text" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6 col-m-6">
                                                        <div class="form-group">
                                                            <label>Product ​: </label>
                                                            <select id="productid" name="productid" class="form-control" style="width: 100%;">
                                                                <option selected="selected" value="">-- Select Product --</option>
                                                                <?php foreach ($productlists as $key => $value) { ?>
                                                                    <option value="<?php echo $value->id; ?>"><?php echo $value->product_name; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6 col-m-6">
                                                        <div class="form-group">
                                                            <label>ประเภทการจัดส่ง ​: </label>
                                                            <select id="order_logistic" name="order_logistic" class="form-control" style="width: 100%;">
                                                                <option selected="selected" value="">-- Select Logistic Type --</option>
                                                                <?php foreach ($logisticlists as $key => $value) { ?>
                                                                    <option value="<?php echo $value->id; ?>"><?php echo $value->logistics_name; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6 col-m-6">
                                                        <div class="form-group">
                                                            <label>ธนาคารรับโอน ​: </label>
                                                            <select id="order_payment" name="order_payment" class="form-control" style="width: 100%;">
                                                                <option selected="selected" value="">-- Select Payment Type --</option>
                                                                <?php foreach ($paymentlists as $key => $value) { ?>
                                                                    <option value="<?php echo $value->id; ?>"><?php echo $value->payment_code; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-3 col-m-3">
                                                        <div class="form-group">
                                                            <label>จังหวัด ​: </label>
                                                            <select id="province" name="province" class="form-control" style="width: 100%;">
                                                                <option selected="selected" value="">-- Select Province --</option>
                                                                <?php foreach ($provincelists as $key => $value) { ?>
                                                                    <option value="<?php echo $value->id; ?>" data-province="<?php echo $value->name_th; ?>"><?php echo $value->name_th; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-3 col-m-3">
                                                        <div class="form-group">
                                                            <label>อำเภอ ​: </label>
                                                            <select id="district" name="district" class="form-control" style="width: 100%;" disabled>
                                                                <option selected="selected" value="">-- Select Districts --</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-3 col-m-3">
                                                        <div class="form-group">
                                                            <label>ตำบล ​: </label>
                                                            <select id="subdistrict" name="subdistrict" class="form-control" style="width: 100%;" disabled>
                                                                <option selected="selected" value="">-- Select Sub stricts --</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-3 col-m-3">
                                                        <div class="form-group">
                                                            <label>รหัสไปรษณีย์ ​: </label>
                                                            <input id="zipcode" type="tel" class="form-control" maxlength="5">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4 col-m-4">
                                                        <div class="form-group">
                                                            <label>สถานะการจ่ายเงิน ​: </label>
                                                            <select id="order_status" name="order_status" class="form-control" style="width: 100%;">
                                                                <option selected="selected" value="">-- Select Order Status --</option>
                                                                <option value="recieved">Recieved (ชำระเงินแล้ว)</option>
                                                                <option value="waiting">Waiting (รอดำเนินการ)</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4 col-m-4">
                                                        <div class="form-group">
                                                            <label>วันที่ ​: </label>
                                                            <input class="form-control" id="orderdate" name="orderdate">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4 col-m-4">
                                                        <div class="form-group">
                                                            <label>บันทึกโดย ​: </label>
                                                            <select id="order_by_account_id" name="order_by_account_id" class="form-control" style="width: 100%;">
                                                                <option selected="selected" value="">-- Select User --</option>
                                                                <?php foreach ($userlists as $key => $value) { ?>
                                                                    <option value="<?php echo $value->id; ?>"><?php echo $value->account_name; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-xs-12 col-sm-12 col-m-12">
                                                        <button id="btnsearchorder" type="submit" class="btn btn-success" style="width:100%;">Search</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card-footer">
                                    <table class="mdl-data-table" id="myTable" style="display:none; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;">ID</th>
                                                <th style="text-align: center;">Status</th>
                                                <th style="text-align: center;">Product Name</th>
                                                <th style="text-align: center;">Customer Name</th>
                                                <th class="none" style="text-align: center;">Transaction ID</th>
                                                <th class="none" style="text-align: center;">Address</th>
                                                <th class="none" style="text-align: center;">District</th>
                                                <th class="none" style="text-align: center;">Sub District</th>
                                                <th class="none" style="text-align: center;">Zipcode</th>
                                                <th class="none" style="text-align: center;">Province</th>
                                                <th style="text-align: center;">Telnumber</th>
                                                <th style="text-align: center;">Cost</th>
                                                <th class="none" style="text-align: center;">Payment</th>
                                                <th class="none" style="text-align: center;">Logistic</th>
                                                <th style="text-align: center;">Order Date</th>
                                                <th class="none" style="text-align: center;">Description</th>
                                                <th class="none" style="text-align: center;">Tracking ID</th>
                                                <th class="none" style="text-align: center;">Creat by</th>
                                                <th style="text-align: center;">Tools</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div> 
                    </div> 
                </div>
            </div>
        </section>  
    </div>
</div>



<div class="modal fade" id="modal-overlay" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
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
                    <div class="row">
                        <div class="col-sm-6 col-m-6">
                            <label>ชื่อสินค้า* ​: </label>
                            <input id="avorderid" type="hidden" class="form-control">
                            <input id="avordertransaction" type="hidden" class="form-control">
                            <input id="avordercountry" type="hidden" class="form-control">
                            <select id="avorderproductid" name="avorderproductid" class="form-control" style="width: 100%;" required>
                                <option selected="selected" value="" data-prefix="">-- Select Product --</option>
                                <?php foreach ($_SESSION['group_product_info'] as $value) { ?>
                                    <option value="<?php echo $value['id']; ?>" data-prefix="<?php echo $value['productprefix']; ?>"><?php echo $value['productname']; ?></option>
                                <?php } ?>
                            </select>
                            <div class="invalid-feedback">
                                Please select Product
                            </div>
                        </div>

                        <div class="col-sm-6 col-m-6">
                            <div class="form-group">
                                <label>Tracking No. ​: </label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <button id="btngentracking" type="button" class="btn btn-success">Generate Tracking</button>
                                    </div>
                                    <input id="avordertracking" class="form-control" placeholder="Ex.TESTXXXXXXXXXX">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 col-m-4">
                            <label>ประเภทการส่งสินค้า* ​: </label>
                            <select id="avorderlogisticid" name="avorderlogisticid" class="form-control" style="width: 100%;">
                                <option selected="selected" value="" data-prefix="">-- Select Logistic --</option>
                                <?php foreach ($_SESSION['logistic_info'] as $value) { ?>
                                    <option value="<?php echo $value['id']; ?>"><?php echo $value['logistics_name']; ?></option>
                                <?php } ?>
                            </select>
                            <div class="invalid-feedback">
                                Please select Logistics
                            </div>
                        </div>

                        <div class="col-sm-4 col-m-4">
                            <label>ราคาสินค้า* ​: </label>
                            <input id="avorderprice" type="text" class="form-control" list="pname" placeholder="-- Input or Select  --">
                            <datalist id="pname">
                            </datalist>
                            <div class="invalid-feedback">
                                Please Insert cost
                            </div>
                        </div>

                        <div class="col-sm-4 col-m-4">
                            <div class="form-group">
                                <label>วันที่ ​: </label>
                                <input class="form-control" type="text" id="avorderdate" name="avorderdate">
                                <div class="invalid-feedback">
                                    Please select Date
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-m-6">
                            <div class="form-group">
                                <label>ชื่อ - นามสกุล* ​: </label>
                                <input id="avordername" class="form-control">
                                <div class="invalid-feedback">
                                    Please insert order name
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-m-6">
                            <div class="form-group">
                                <label>เบอร์โทรศัพท์ ​: </label>
                                <input id="avordertelnumber" type="tel" class="form-control" placeholder="Ex.099XXXXXXX" maxlength="10">
                            </div>
                        </div>

                        <div class="col-sm-12 col-m-12">
                            <div class="form-group">
                                <label>ที่อยู่ 1* ​: </label>
                                <textarea id="avorderaddress" class="form-control" rows="4"></textarea>
                                <div class="invalid-feedback">
                                    Please insert address
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-m-6">
                            <div class="form-group">
                                <label>อำเภอ / เขต* ​: </label>
                                <input id="avorderdistrict" class="form-control">
                                <div class="invalid-feedback">
                                    Please select District
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-m-6">
                            <div class="form-group">
                                <label>ตำบล / แขวง* ​: </label>
                                <input id="avordersubdistrict" class="form-control">
                                <div class="invalid-feedback">
                                    Please select Sub district
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-m-6">
                            <div class="form-group">
                                <label>รหัสไปรษณีย์* ​: </label>
                                <input id="avorderzipcode" type="tel" class="form-control" maxlength="5">
                                <div class="invalid-feedback">
                                    Please insert zipcode
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-m-6">
                            <label>จังหวัด* ​: </label>
                            <input id="avprovince" class="form-control">
                            <div class="invalid-feedback">
                                Please select Province
                            </div>
                        </div>

                        <div class="col-sm-12 col-m-12">
                            <label>ธนาคาร ​: </label>
                            <select id="avorderpaymentid" name="avorderpaymentid" class="form-control">
                                <option selected="selected" value="" data-prefix="">-- Select Bank --</option>
                                <?php foreach ($_SESSION['payment_info'] as $value) { ?>
                                    <option value="<?php echo $value['id']; ?>"><?php echo $value['payment_code']; ?></option>
                                <?php } ?>
                            </select>
                            <div class="invalid-feedback">
                                Please select Bank payment
                            </div>
                            <br>
                        </div>

                        <div class="col-sm-12 col-m-12">
                            <div class="form-group">
                                <label>อื่น ๆ ​: </label>
                                <textarea id="avorderdescription" class="form-control" rows="4"></textarea>
                            </div>
                        </div>

                        <div class="col-sm-4 col-m-4">
                            <div class="form-group">
                                <label>สถานะการจ่ายเงิน ​: </label>
                                <select id="avorderstatus" name="avorderstatus" class="form-control" style="width: 100%;">
                                    <option selected="selected" value="">-- Select Order Status --</option>
                                    <option value="recieved">Recieved (ชำระเงินแล้ว)</option>
                                    <option value="waiting">Waiting (รอดำเนินการ)</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select Order status
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 col-m-4">
                            <div class="form-group">
                                <label>บันทึกโดย ​: </label>
                                <select id="avorder_by_account_id" name="avorder_by_account_id" class="form-control" style="width: 100%;">
                                    <option selected="selected" value="">-- Select User --</option>
                                    <?php foreach ($userlists as $key => $value) { ?>
                                        <option value="<?php echo $value->id; ?>"><?php echo $value->account_name; ?></option>
                                    <?php } ?>
                                </select>
                                <div class="invalid-feedback">
                                    Please select User created
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" id="closeeditorder" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" id="btneditorder" class="btn btn-primary">Edit</button>
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
<script src="<?=base_url();?>assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?=base_url();?>assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script src="<?=base_url();?>assets/plugins/daterangepicker/moment.min.js"></script>
<script src="<?=base_url();?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="<?=base_url();?>assets/dist/js/date.js"></script>
<script src="<?=base_url();?>assets/dist/js/searchorder.js"></script>

<script>
    function delorder(id) {
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
                url: base_url + "api/delorderlist",
                type: 'post',
                dataType: 'json',
                data: {orderid:id},
                    success: function (response) {
                        if (response == "success") {
                            $('#preloader').hide();
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: "Order have been delete.",
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

    function editorder(id) {
        var base_url = $("#baseurl").val();
        $.ajax({
            type: "POST",
            url: base_url + "api/editorderlist",
            data: {order_id:id},
            dataType: "json",
            success: function (response) {
                if (response) {
                    $("#avorderid").val(response[0].id)
                    $("#avordertransaction").val(response[0].transaction_id)
                    $("#avorderproductid").val(response[0].product_id)
                    $("#avordercountry").val(response[0].order_country)
                    $("#avordertracking").val(response[0].order_tracking_id)
                    $("#avorderlogisticid").val(response[0].order_logistics_id)
                    $("#avorderlogisticid").val(response[0].order_logistics_id)
                    $("#avorderprice").val(response[0].order_cost)
                    $("#avorderdate").val(response[0].order_datetime)
                    $("#avordername").val(response[0].order_name)
                    $("#avordertelnumber").val(response[0].order_telnumber)
                    $("#avorderaddress").val(response[0].order_address)
                    $("#avorderzipcode").val(response[0].order_zipcode)
                    $("#avorderpaymentid").val(response[0].order_payment_id)
                    $("#avorderdescription").val(response[0].order_description)
                    $("#avorderdistrict").val(response[0].order_district)
                    $("#avordersubdistrict").val(response[0].order_subdistrict)
                    $("#avprovince").val(response[0].order_province)
                    $("#avorderstatus").val(response[0].order_status)
                    $("#avorder_by_account_id").val(response[0].order_by_account_id)
                    $('#overlay').attr("style", "display: none !important");
                }
            }
        });
    }
</script>

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
