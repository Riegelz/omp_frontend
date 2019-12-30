<?php
define("HEADMENUHOME","headmenuhome");
define("HEADMENUMANAGE","headmenumanage");
define("SUBMENUMANAGE","submenumanage");
define("HEADMENUCOST","headmenucost");
define("SUBMENUCOST","submenucost");
define("HEADMENUSEARCH","headmenusearch");
define("SUBMENUSEARCH","submenusearch");
define("HEADMENUSUMMARY","headmenusummary");
define("SUBMENUSUMMARY","submenusummary");
define("HOME","home");
define("GROUP","group");
define("PRODUCT","product");
define("PROMOTION","promotion");
define("USER","user");
define("ADDORDER","addorder");
define("SEARCHORDER","searchorder");
define("SEARCHCOST","searchcost");
define("SUMMARYREPORT","summaryreport");
define("ACTIVE","active");
define("MENUOPEN","menu-open");
define("HIGH","high");
define("MEDIUM","medium");
define("LOW","low");
define("ACCOUNTROLE","accountrole");
define("GROUPROLE","group_role");
$resp = pagestatus($this->session->userdata('page_status'));
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
<!-- Brand Logo -->
<a href="<?=base_url();?>" class="brand-link">
    <img src="<?=base_url();?>assets/dist/img/omp-logo3.png" alt="OMP Logo" class="brand-image" style="max-height:55px; margin-top:-14px; margin-left:0rem;">
    <span class="brand-text font-weight-light">OMP Plateform</span>
</a>

<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="<?=base_url();?>assets/dist/img/user-profile5.png" class="img-circle elevation-2" alt="User Image" style="width: 3.1rem; margin-left:-0.5rem">
        </div>
        <div class="info">
            <div style="color:#D6D8D9">Welcome</div>
            <a href="#" class="d-block"><?=$_SESSION['accountname'];?></a>
        </div>
    </div>

    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <select id="selectgroup" name="selectgroup" class="form-control select2" style="width: 100%;">
            <option selected="selected">-- Select Group --</option>
            <?php foreach ($grouplists as $value) { ?>
                <option value="<?php echo $value->id; ?>"><?php echo $value->group_name; ?></option>
            <?php } ?>
        </select>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        
        <?php if (rolemenu("dashboard")) { ?>
        <!-- Dash Board Menu -->
        <li class="nav-item">
        <a href="<?=base_url()."home";?>" class="nav-link <?php echo $resp[HOME];?>">
            <em class="nav-icon fas fa-chart-line"></em>
            <p>Dashboard</p>
        </a>
        </li>
        <?php } ?>

        <?php if (rolemenu("manage")) { ?>
        <!-- Manage Menu -->
        <li class="nav-item has-treeview <?php echo $resp[HEADMENUMANAGE];?>">
        <a href="#" class="nav-link <?php echo $resp[SUBMENUMANAGE];?>">
            <em class="nav-icon fas fa-cogs"></em>
            <p>Manage<i class="fas fa-angle-left right"></i></p>
        </a>
        <ul class="nav nav-treeview">

            <?php if (rolemenu(GROUP)) { ?>
            <li class="nav-item">
                <a href="<?=base_url()."group";?>" class="nav-link <?php echo $resp[GROUP];?>">
                    <em class="far fa-circle nav-icon"></em>
                    <p>Group</p>
                </a>
            </li>
            <?php } ?>

            <?php if (rolemenu(PRODUCT)) { ?>
            <li class="nav-item">
            <a href="<?=base_url()."product";?>" class="nav-link <?php echo $resp[PRODUCT];?>">
                <em class="far fa-circle nav-icon"></em>
                <p>Product</p>
            </a>
            </li>
            <?php } ?>

            <?php if (rolemenu(PROMOTION)) { ?>
            <li class="nav-item">
            <a href="<?=base_url()."promotion";?>" class="nav-link <?php echo $resp[PROMOTION];?>">
                <em class="far fa-circle nav-icon"></em>
                <p>Promotion</p>
            </a>
            </li>
            <?php } ?>

            <?php if (rolemenu(USER)) { ?>
            <li class="nav-item">
            <a href="<?=base_url()."user";?>" class="nav-link <?php echo $resp[USER];?>">
                <em class="far fa-circle nav-icon"></em>
                <p>User</p>
            </a>
            </li>
            <?php } ?>
        </ul>
        </li>
        <?php } ?>

        <?php if (rolemenu("cost") && isset($_SESSION['group_name'])) { ?>
        <!-- Cost Menu -->
        <li class="nav-item has-treeview <?php echo $resp[HEADMENUCOST];?>">
        <a href="#" class="nav-link <?php echo $resp[SUBMENUCOST];?>">
            <em class="nav-icon fas fa-comment-dollar"></em>
            <p>Cost<i class="fas fa-angle-left right"></i></p>
        </a>
        <ul class="nav nav-treeview">

            <?php if (rolemenu(ADDORDER)) { ?>
            <li class="nav-item">
                <a href="pages/layout/boxed.html" class="nav-link <?php echo $resp[ADDORDER];?>">
                    <em class="far fa-circle nav-icon"></em>
                    <p>Add Order</p>
                </a>
            </li>
            <?php } ?>  

            <?php if (rolemenu("addcost")) { ?>
            <li class="nav-item">
                <a href="pages/layout/boxed.html" class="nav-link <?php echo $resp[ADDCOST];?>">
                    <em class="far fa-circle nav-icon"></em>
                    <p>Add Ads & Logistic Cost</p>
                </a>
            </li>
            <?php } ?>

        </ul>
        </li>
        <?php } ?>

        <?php if (rolemenu("search") && isset($_SESSION['group_name'])) { ?>
        <!-- Search Menu -->
        <li class="nav-item has-treeview <?php echo $resp[HEADMENUSEARCH];?>">
        <a href="#" class="nav-link <?php echo $resp[SUBMENUSEARCH];?>">
            <em class="nav-icon fas fa-search"></em>
            <p>Search<i class="fas fa-angle-left right"></i></p>
        </a>
        <ul class="nav nav-treeview">

            <?php if (rolemenu(SEARCHORDER)) { ?>
            <li class="nav-item">
                <a href="pages/layout/boxed.html" class="nav-link <?php echo $resp[SEARCHORDER];?>">
                    <em class="far fa-circle nav-icon"></em>
                    <p>Search Order</p>
                </a>
            </li>
            <?php } ?>

            <?php if (rolemenu(SEARCHCOST)) { ?>
            <li class="nav-item">
                <a href="pages/layout/boxed.html" class="nav-link <?php echo $resp[SEARCHCOST];?>">
                    <em class="far fa-circle nav-icon"></em>
                    <p>Search Cost</p>
                </a>
            </li>
            <?php } ?>
        </ul>
        </li>
        <?php } ?>


        <?php if (rolemenu("summary") && isset($_SESSION['group_name'])) { ?>
        <!-- Summary Menu -->
        <li class="nav-item has-treeview <?php echo $resp[HEADMENUSUMMARY];?>">
        <a href="#" class="nav-link <?php echo $resp[SUBMENUSUMMARY];?>">
            <em class="nav-icon fas fa-table"></em>
            <p>Summary<i class="fas fa-angle-left right"></i></p>
        </a>
        <ul class="nav nav-treeview">
            <?php if (rolemenu(SUMMARYREPORT)) { ?>
            <li class="nav-item">
                <a href="pages/layout/boxed.html" class="nav-link <?php echo $resp[SUMMARYREPORT];?>">
                    <em class="far fa-circle nav-icon"></em>
                    <p>Summary Report</p>
                </a>
            </li>
            <?php } ?>
        </ul>
        </li>
        <?php } ?>

        <!-- Logout Menu -->
        <li class="nav-item">
        <a href="<?=base_url()."logout";?>" class="nav-link">
            <em class="nav-icon fas fa-sign-out-alt"></em>
            <p>Logout</p>
        </a>
        </li>
        
    </ul>
    </nav>
    <!-- /.sidebar-menu -->
<input id="accountid" name="accountid" type="hidden" value="<?php echo $_SESSION['userid'];?>">
<input id="baseurl" name="baseurl" type="hidden" value="<?php echo base_url();?>">
</div>
<!-- /.sidebar -->
</aside>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2({
      theme: 'bootstrap4'
    })

    $("#selectgroup").change(function(e){
        var base_url = $("#baseurl").val();
        var groupid = $(this).children(":selected").attr("value");
        var accountid = $("#accountid").val();
        var postData = {groupid:groupid,accountid:accountid};
        $.ajax({
            url : base_url + "/api/checkgroupmember",
            type: "POST",
            dataType: 'json',
            data : postData,
            success:function(data, textStatus, jqXHR) {
                if (data == "success") {
                    location.reload();
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Select group failed.',
                        text: 'You have not permission in this group.'
                    })
                }
            },  
            error: function(jqXHR, textStatus, errorThrown) {
                Swal.fire({
                    icon: 'error',
                    title: 'Fail.',
                    text: 'Something went wrong.'
                })
            }            
        });
    });

  })
</script>

<?php

function pagestatus($value)
{
    switch ($value) {
        case 'home':
            $data[HEADMENUHOME] = MENUOPEN;
            $data[HOME] = ACTIVE;
            return $data;
            break;

        case 'user':
            $data[HEADMENUMANAGE] = MENUOPEN;
            $data[SUBMENUMANAGE] = ACTIVE;
            $data[USER] = ACTIVE;
            return $data;
            break;

        case 'group':
            $data[HEADMENUMANAGE] = MENUOPEN;
            $data[SUBMENUMANAGE] = ACTIVE;
            $data[GROUP] = ACTIVE;
            return $data;
            break;

        case 'product':
            $data[HEADMENUMANAGE] = MENUOPEN;
            $data[SUBMENUMANAGE] = ACTIVE;
            $data[PRODUCT] = ACTIVE;
            return $data;
            break;

        case 'promotion':
            $data[HEADMENUMANAGE] = MENUOPEN;
            $data[SUBMENUMANAGE] = ACTIVE;
            $data[PROMOTION] = ACTIVE;
            return $data;
            break;

        case 'addorder':
            $data[HEADMENUCOST] = MENUOPEN;
            $data[SUBMENUCOST] = ACTIVE;
            $data[ADDORDER] = ACTIVE;
            return $data;
            break;

        case 'addcost':
            $data[HEADMENUCOST] = MENUOPEN;
            $data[SUBMENUCOST] = ACTIVE;
            $data[ADDCOST] = ACTIVE;
            return $data;
            break;

        case 'searchorder':
            $data[HEADMENUSEARCH] = MENUOPEN;
            $data[SUBMENUSEARCH] = ACTIVE;
            $data[SEARCHORDER] = ACTIVE;
            return $data;
            break;

        case 'searchcost':
            $data[HEADMENUSEARCH] = MENUOPEN;
            $data[SUBMENUSEARCH] = ACTIVE;
            $data[SEARCHCOST] = ACTIVE;
            return $data;
            break;

        case 'summaryreport':
            $data[HEADMENUSUMMARY] = MENUOPEN;
            $data[SUBMENUSUMMARY] = ACTIVE;
            $data[SUMMARYREPORT] = ACTIVE;
            return $data;
            break;

        default:
            break;
    }
}

function rolemenu($menu)
{
    switch ($menu) {
        case 'dashboard':
            $status = getPolicy(MEDIUM);
            break;

        case 'manage':
            $status = getPolicy(HIGH);
            break;

        case 'group':
            $status = getPolicy(MEDIUM);
            break;

        case 'product':
            $status = getPolicy(MEDIUM);
            break;

        case 'promotion':
            $status = getPolicy(MEDIUM);
            break;

        case 'user':
            $status = getPolicy(MEDIUM);
            break;

        case 'cost':
            $status = getPolicy(MEDIUM);
            break;

        case 'addorder':
            $status = getPolicy(MEDIUM);
            break;

        case 'addcost':
            $status = getPolicy(MEDIUM);
            break;

        case 'search':
            $status = getPolicy(MEDIUM);
            break;

        case 'searchorder':
            $status = getPolicy(MEDIUM);
            break;

        case 'searchcost':
            $status = getPolicy(MEDIUM);
            break;

        case 'summary':
            $status = getPolicy(MEDIUM);
            break;

        case 'summaryreport':
            $status = getPolicy(MEDIUM);
            break;
        
        default:
            $status = false;
            break;
    }

    return $status;
}

function getPolicy($level)
{
    ## Account Role : 0 = User , 1 = Admin , 2 = Super Admin ##
    ## Group Role : 0 = Member , 1 = Admin , 2 = Owner ##
    switch ($level) {
        case 'low':
            $accountrole = ["0","1","2"];
            $grouprole = ["0","1","2"];
            $accountrole = in_array($_SESSION[ACCOUNTROLE],$accountrole);
            $grouprole = in_array($_SESSION[GROUPROLE],$grouprole);
            if ($accountrole == 1 || $grouprole == 1) {
                $status = true;
            }
            break;

        case 'low-medium':
            $accountrole = ["0","1","2"];
            $grouprole = ["0","1","2"];
            $accountrole = in_array($_SESSION[ACCOUNTROLE],$accountrole);
            $grouprole = in_array($_SESSION[GROUPROLE],$grouprole);
            if ($accountrole == 1 && $grouprole == 1) {
                $status = true;
            }
            break;

        case 'medium':
            $accountrole = ["0","1"];
            $grouprole = ["1","2"];
            $accountrole = in_array($_SESSION[ACCOUNTROLE],$accountrole);
            $grouprole = in_array($_SESSION[GROUPROLE],$grouprole);
            if ($accountrole == 1 || $grouprole == 1) {
                $status = true;
            }
            break;

        case 'medium-high':
            $accountrole = ["0","1"];
            $grouprole = ["1","2"];
            $accountrole = in_array($_SESSION[ACCOUNTROLE],$accountrole);
            $grouprole = in_array($_SESSION[GROUPROLE],$grouprole);
            if ($accountrole == 1 && $grouprole == 1) {
                $status = true;
            }
            break;

        case 'high':
            $accountrole = ["1","2"];
            $grouprole = ["1","2"];
            $accountrole = in_array($_SESSION[ACCOUNTROLE],$accountrole);
            $grouprole = in_array($_SESSION[GROUPROLE],$grouprole);
            if ($accountrole == 1 || $grouprole == 1) {
                $status = true;
            }
            break;

        case 'veryhigh':
            $accountrole = ["2"];
            $grouprole = ["2"];
            $accountrole = in_array($_SESSION[ACCOUNTROLE],$accountrole);
            $grouprole = in_array($_SESSION[GROUPROLE],$grouprole);
            if ($accountrole == 1 && $grouprole == 1) {
                $status = true;
            }
            break;
        
        default:
            $status = false;
            break;
    }
    return $status;
}

?>