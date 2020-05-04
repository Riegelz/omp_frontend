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
                <h1 class="m-0 text-dark"><i class="fas fa-address-book"></i> Add Order</h1>
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
                                
                                <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">Default Form</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">Advance Form</a>
                                    </li>
                                </ul>

                                <div class="tab-content" id="custom-content-below-tabContent">
                                    <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <br>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card card-info">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Add Order (Form Format)</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1"></label>
                                                                <textarea id="importdata" class="form-control" rows="10" 
                                                                placeholder="[ ชื่อสินค้า* ]&#10;[ ประเภทการส่งสินค้า* ]  [ ราคาสินค้า ]  [ วันที่ - Optional - ]  [ เวลา - Optional - ]  [ ธนาคาร - Optional - ]&#10;[ ชื่อ นามสกุล* ]&#10;[ ที่อยู่ 1* ]&#10;[ อำเภอ* ]  [ ตำบล* ]  [ จังหวัด* ]  [ รหัสไปรษณีย์* ]&#10;[ เบอร์โทรศัพท์ ]&#10;[ อื่น ๆ - Optional - ]  "></textarea>
                                                            </div>
                                                        </div>
                                                        <a id="hintfile" class="btn btn-hint btn-info" href="#" data-toggle="modal" data-target="#modal-lg" style="color:#fff;"><span class="fa fa-info"></span> </a> <span> คลิกเพื่อดูตัวอย่างรูปแบบการบันทึก Order รูปแบบต่างๆ</span>
                                                    </div>
                                                    <!-- /.card-body -->
                                            
                                                    <div class="card-footer">
                                                        <button id="btnsaveorder" type="submit" class="btn btn-success" style="width:100%;" disabled>Save Order</button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="card card-warning">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Example Detail</h3>
                                                    </div>

                                                    <div class="card-body">
                                                        <div class="row">

                                                            <div class="col-sm-12 col-m-12">
                                                                <div class="form-group">
                                                                    <label>Tracking No. ​: </label>
                                                                    <input id="ordertracking" style="border:none; color:green;" placeholder="-- ไม่ระบุ --">
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12 col-m-12">
                                                                <div class="form-group row">
                                                                    <label for="orderproductid" class="col-sx-3 col-sm-3 col-m-3 col-form-label">ชื่อสินค้า* ​: </label>
                                                                    <div class="col-sx-9 col-sm-9 col-m-9">
                                                                        <input type="hidden" id="hiddenorderproductid">
                                                                        <select id="orderproductid" name="orderproductid" class="form-control" style="width: 100%; border:0px; outline:0px; color:#858585; display:inline-block;">
                                                                            <option selected="selected" value="" data-prefix="">-- ไม่พบข้อมูล --</option>
                                                                            <?php foreach ($_SESSION['group_product_info'] as $value) { ?>
                                                                                <option value="<?php echo $value['id']; ?>" data-prefix="<?php echo $value['productprefix']; ?>"><?php echo $value['productname']; ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12 col-m-12">
                                                                <div class="form-group">
                                                                    <label>ชื่อ - นามสกุล* ​: </label>
                                                                    <input id="ordername" style="border:none; color:green;" placeholder="-- ไม่พบข้อมูล --">
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12 col-m-12">
                                                                <div class="form-group row">
                                                                    <label for="orderlogisticid" class="col-sx-5 col-sm-5 col-m-5 col-form-label">ประเภทการส่งสินค้า* ​: </label>
                                                                    <div class="col-sx-7 col-sm-7 col-m-7">
                                                                        <input type="hidden" id="hiddenorderlogisticid">
                                                                        <select id="orderlogisticid" name="orderlogisticid" class="form-control" style="width: 100%; border:0px; outline:0px; color:#858585; display:inline-block;">
                                                                            <option selected="selected" value="" data-prefix="">-- ไม่พบข้อมูล --</option>
                                                                            <?php foreach ($_SESSION['logistic_info'] as $value) { ?>
                                                                                <option value="<?php echo $value['id']; ?>"><?php echo $value['logistics_name']; ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12 col-m-12">
                                                                <div class="form-group row">
                                                                    <input type="hidden" id="hiddenorderprice">
                                                                    <label for="orderprice" class="col-sx-4 col-sm-4 col-m-4 col-form-label">ราคาสินค้า* ​: </label>
                                                                    <div class="col-sx-8 col-sm-8 col-m-8">
                                                                        <select id="orderprice" name="orderprice" class="form-control" style="width: 100%; border:0px; outline:0px; color:#858585; display:inline-block;">
                                                                            <option selected="selected" value="" data-prefix="">-- ไม่พบข้อมูล --</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12 col-m-12">
                                                                <div class="form-group">
                                                                    <label>วันที่ ​: </label>
                                                                    <input type="hidden" id="orderdatenow" style="border:none; color:green;" value="<?php echo date("d-m-Y");?>">
                                                                    <input type="hidden" id="ordertimenow" style="border:none; color:green;" value="<?php echo date("H:i:s");?>">
                                                                    <input id="orderdate" style="border:none; color:green;" placeholder="-- ไม่พบข้อมูล --">
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12 col-m-12">
                                                                <div class="form-group row">
                                                                    <label for="orderpaymentid" class="col-sx-3 col-sm-3 col-m-3 col-form-label">ธนาคาร ​: </label>
                                                                    <div class="col-sx-9 col-sm-9 col-m-9">
                                                                        <input type="hidden" id="hiddenorderpaymentid">
                                                                        <select id="orderpaymentid" name="orderpaymentid" class="form-control" style="width: 100%; border:0px; outline:0px; color:#858585; display:inline-block;">
                                                                            <option selected="selected" value="" data-prefix="">-- ไม่พบข้อมูล --</option>
                                                                            <?php foreach ($_SESSION['payment_info'] as $value) { ?>
                                                                                <option value="<?php echo $value['id']; ?>"><?php echo $value['payment_code']; ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12 col-m-12">
                                                                <div class="form-group">
                                                                    <label>ที่อยู่ 1* ​: </label>
                                                                    <input id="orderaddress" style="border:none; color:green;" placeholder="-- ไม่พบข้อมูล --">
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12 col-m-12">
                                                                <div class="form-group">
                                                                    <label>อำเภอ* ​: </label>
                                                                    <input id="orderdistrict" style="border:none; color:green;" placeholder="-- ไม่พบข้อมูล --">
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12 col-m-12">
                                                                <div class="form-group">
                                                                    <label>ตำบล* ​: </label>
                                                                    <input id="ordersubdistrict" style="border:none; color:green;" placeholder="-- ไม่พบข้อมูล --">
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12 col-m-12">
                                                                <div class="form-group">
                                                                    <label>รหัสไปรษณีย์* ​: </label>
                                                                    <input id="orderzipcode" style="border:none; color:green;" placeholder="-- ไม่พบข้อมูล --" maxlength="5">
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12 col-m-12">
                                                                <div class="form-group">
                                                                    <label>จังหวัด* ​: </label>
                                                                    <input id="orderprovince" style="border:none; color:green;" placeholder="-- ไม่พบข้อมูล --">
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12 col-m-12">
                                                                <div class="form-group">
                                                                    <label>เบอร์โทรศัพท์ ​: </label>
                                                                    <input id="ordertelnumber" style="border:none; color:green;" placeholder="-- ไม่พบข้อมูล --" maxlength="10">
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12 col-m-12">
                                                                <div class="form-group">
                                                                    <label>อื่น ๆ ​: </label>
                                                                    <input id="orderdescription" style="border:none; color:green;" placeholder="-- ไม่พบข้อมูล --">
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                                        <div class="col-md-12">
                                            <br>
                                        </div>
                                        <form id="formAvAddorder" method="post" action="#">                                        
                                            <div class="col-md-12">
                                                <div class="card card-info">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Add Order (Advance Form)</h3>
                                                    </div>

                                                    <div class="card-body">
                                                        <div class="row">

                                                            <div class="col-sm-6 col-m-6">
                                                                <label>ชื่อสินค้า* ​: </label>
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
                                                                    <input id="avordertelnumber" class="form-control" placeholder="Ex.099XXXXXXX" maxlength="10">
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
                                                                    <select id="avorderdistrict" name="avorderdistrict" class="form-control" style="width: 100%;" disabled>
                                                                        <option selected="selected" value="">-- Select Districts --</option>
                                                                    </select>
                                                                    <div class="invalid-feedback">
                                                                        Please select District
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-6 col-m-6">
                                                                <div class="form-group">
                                                                    <label>ตำบล / แขวง* ​: </label>
                                                                    <select id="avordersubdistrict" name="avordersubdistrict" class="form-control" style="width: 100%;" disabled>
                                                                        <option selected="selected" value="">-- Select Sub Districts --</option>
                                                                    </select>
                                                                    <div class="invalid-feedback">
                                                                        Please select Sub district
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-6 col-m-6">
                                                                <div class="form-group">
                                                                    <label>รหัสไปรษณีย์* ​: </label>
                                                                    <input id="avorderzipcode" class="form-control" maxlength="5">
                                                                    <div class="invalid-feedback">
                                                                        Please insert zipcode
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-6 col-m-6">
                                                                <label>จังหวัด* ​: </label>
                                                                <select id="avprovince" name="avprovince" class="form-control">
                                                                    <option value="" selected="selected">-- Select Province --</option>
                                                                    <?php foreach ($provincelists as $value) { ?>
                                                                        <option value="<?php echo $value->id; ?>" data-province="<?php echo $value->name_th; ?>"><?php echo $value->name_th; ?></option>
                                                                    <?php } ?>
                                                                </select>
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

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="card-footer">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-6 col-m-6">
                                                        <button id="btnavreset" type="reset" class="btn btn-warning" style="width:50%; float:right;">Reset</button>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-6 col-m-6">
                                                        <button id="btnavsaveorder" type="submit" class="btn btn-success" style="width:50%;">Save Order</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div> 
                </div>
            </div>
        </section>  
    </div>
</div>


<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Example add order format</h4>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <label>COD format</label>
                    <textarea class="form-control" rows="7" disabled>
                        Adidas NMD
                        COD 0 
                        นายกอ นามสมมุติ
                        99/99 หมู่บ้านXXX หมู่ X
                        อ.xxx ต.xxx จ.xxx 10100
                        0999999999
                    </textarea><br>

                    <label>Other format</label>
                    <textarea class="form-control" rows="7" disabled>
                        Adidas NMD
                        Kerry 300
                        นายกอ นามสมมุติ
                        99/99 หมู่บ้านXXX หมู่ X
                        อ.xxx ต.xxx จ.xxx 10100
                        0999999999
                    </textarea><br>

                    <label>Order format (Full optional)</label>
                    <textarea class="form-control" rows="7" disabled>
                        Adidas NMD
                        Kerry 300 01-01-2020 Kbank
                        นายกอ นามสมมุติ
                        99/99 หมู่บ้านXXX หมู่ X
                        อ.xxx ต.xxx จ.xxx 10100
                        0999999999
                        Description etc. bla bla
                    </textarea><br>
                    <span style="color:red;">* หากไม่ระบุวันที่ ระบบจะบันทึกเวลาเป็นวันเวลาปัจจุบันที่บันทึก</span>

                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
<script src="<?=base_url();?>assets/plugins/daterangepicker/moment.min.js"></script>
<script src="<?=base_url();?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="<?=base_url();?>assets/dist/js/date.js"></script>
<script src="<?=base_url();?>assets/dist/js/addorder.js"></script>

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

.btn-hint {
    width: 15px;
    height: 15px;
    text-align: center;
    padding: 1px 0;
    font-size: 10px;
    line-height: 1.428571429;
    border-radius: 15px;
}

textarea:focus, input:focus{
    outline: none;
}

</style>
