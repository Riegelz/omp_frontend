<link rel="icon" type="image/png" sizes="16x16" href="<?=base_url();?>assets/dist/img/favicon-16x16.png">
<link rel="stylesheet" href="<?=base_url();?>assets/plugins/fontawesome-free/css/all.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Tempusdominus Bbootstrap 4 -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<!-- iCheck -->
<link rel="stylesheet" href="<?=base_url();?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="<?=base_url();?>assets/dist/css/adminlte.min.css">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="<?=base_url();?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
<!-- Daterange picker -->
<link rel="stylesheet" href="<?=base_url();?>assets/plugins/daterangepicker/daterangepicker.css">
<!-- Select2 -->
<link rel="stylesheet" href="<?=base_url();?>assets/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="<?=base_url();?>assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
<!-- Left navbar links -->
<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" style="top:3px;" data-widget="pushmenu" href="#"><em class="fas fa-bars"></em></a>
    </li>   
</ul>

<!-- Right navbar links -->
<ul class="navbar-nav ml-auto">
    <li class="nav-item d-none d-sm-inline-block">
        <?php if(isset($_SESSION['group_name'])) { echo "<b>Group</b> : " . $_SESSION['group_name']; }else{ "";}?>
        <?php if(isset($_SESSION['group_role'])) { echo "( " . getStatusRole() . " ) <b>|</b> "; }else{ "";}?>
        <?php echo "<b>Status</b> : " . getStatusUser();?>
    </li>
</ul>
</nav>
<!-- /.navbar -->

<style type="text/css">

li.nav-item.d-none.d-sm-inline-block {
  margin-top:-5px;
}

</style>

<?php 

    function getStatusUser() {
        switch ($_SESSION['accountrole']) {
            case 0:
                $status = 'User';
                break;

            case 1:
                $status = 'Administrator';
                break;

            case 2:
                $status = 'Super Administrator';
                break;
            
            default:
            $status = 'Unknown';
                break;
        }

        return $status;
    }

    function getStatusRole() {
        switch ($_SESSION['group_role']) {
            case 0:
                $status = 'Member';
                break;

            case 1:
                $status = 'Admin';
                break;

            case 2:
                $status = 'Owner';
                break;
            
            default:
            $status = 'Unknown';
                break;
        }

        return $status;
    }

?>