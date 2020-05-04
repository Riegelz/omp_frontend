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
                <h1 class="m-0 text-dark"><i class="fas fa-comment-dollar"></i> Add Cost</h1>
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
                                        <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">Ads Cost</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">Logistic Cost</a>
                                    </li>
                                </ul>

                                <div class="tab-content" id="custom-content-below-tabContent">
                                    <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                                        <div class="col-md-12">
                                            <br>
                                        </div>                                        
                                        <div class="col-md-12">
                                            <div class="card card-info">
                                                <div class="card-header">
                                                    <h3 class="card-title">Ads Cost Management</h3>
                                                </div>

                                                <div class="card-body">
                                                    <form method="post" id="formAdsCost" action="#">
                                                        <div class="row">
                                                            <div class="col-sm-6 col-m-6">
                                                                <div class="form-group">
                                                                    <label>Product* ​: </label>
                                                                    <select id="productid" name="productid" class="form-control" style="width: 100%;">
                                                                        <option selected="selected" value="">-- Select Product --</option>
                                                                        <?php foreach ($productlists as $key => $value) { ?>
                                                                            <option value="<?php echo $value->id; ?>"><?php echo $value->product_name; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                    <div class="invalid-feedback">
                                                                        Please select Product
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-6 col-m-6">
                                                                <div class="form-group">
                                                                    <label>ประเภทโฆษณา* ​: </label>
                                                                    <select id="ads" name="ads" class="form-control" style="width: 100%;">
                                                                        <option selected="selected" value="">-- Select Ads Type --</option>
                                                                        <?php foreach ($adslists as $key => $value) { ?>
                                                                            <option value="<?php echo $value->id; ?>"><?php echo $value->ads_name; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                    <div class="invalid-feedback">
                                                                        Please select Ads
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-6 col-m-6">
                                                                <div class="form-group">
                                                                    <label>ค่าใช้จ่าย* ​: </label>
                                                                    <input id="adscost" type="tel" class="form-control">
                                                                    <div class="invalid-feedback">
                                                                        Please insert Ads cost
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-6 col-m-6">
                                                                <div class="form-group">
                                                                    <label>วันที่* ​: </label>
                                                                    <input class="form-control" id="costdate" name="costdate">
                                                                    <div class="invalid-feedback">
                                                                        Please select Date
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="card-footer">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-6 col-m-6">
                                                    <button id="btnavreset" type="reset" class="btn btn-warning" style="width:50%; float:right;">Reset</button>
                                                </div>
                                                <div class="col-xs-12 col-sm-6 col-m-6">
                                                    <button id="btnavsaveorder" type="submit" class="btn btn-success" style="width:50%;">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                                        <div class="col-md-12">
                                            <br>
                                        </div>  
                                        <form method="post" id="formAdsCost" action="#">                                      
                                            <div class="col-md-12">
                                                <div class="card card-secondary">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Logistics Cost Management</h3>
                                                    </div>

                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-sm-6 col-m-6">
                                                                <div class="form-group">
                                                                    <label>Product* ​: </label>
                                                                    <select id="productid_2" name="productid_2" class="form-control" style="width: 100%;">
                                                                        <option selected="selected" value="">-- Select Product --</option>
                                                                        <?php foreach ($productlists as $key => $value) { ?>
                                                                            <option value="<?php echo $value->id; ?>"><?php echo $value->product_name; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                    <div class="invalid-feedback">
                                                                        Please select Product
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-6 col-m-6">
                                                                <div class="form-group">
                                                                    <label>ประเภทการขนส่ง* ​: </label>
                                                                    <select id="logistic" name="logistic" class="form-control" style="width: 100%;">
                                                                        <option selected="selected" value="">-- Select Logistic Type --</option>
                                                                        <?php foreach ($logisticlists as $key => $value) { ?>
                                                                            <option value="<?php echo $value->id; ?>"><?php echo $value->logistics_name; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                    <div class="invalid-feedback">
                                                                        Please select Logistic
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-6 col-m-6">
                                                                <div class="form-group">
                                                                    <label>ค่าใช้จ่าย* ​: </label>
                                                                    <input id="logisticcost" type="tel" class="form-control">
                                                                    <div class="invalid-feedback">
                                                                        Please insert Logistic cost
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-6 col-m-6">
                                                                <div class="form-group">
                                                                    <label>วันที่* ​: </label>
                                                                    <input class="form-control" id="costdate_2" name="costdate_2">
                                                                    <div class="invalid-feedback">
                                                                        Please select Date
                                                                    </div>
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
                                                        <button id="btnsavelogisticscost" type="submit" class="btn btn-success" style="width:50%;">Save</button>
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
<script src="<?=base_url();?>assets/dist/js/addcost.js"></script>

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
