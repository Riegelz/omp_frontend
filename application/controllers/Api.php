<?php
/**
* Report
*/
class Api extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function login()
	{
        $accesstoken = $this->session->userdata('accesstoken');
        $ompid = $this->session->userdata('ompid');
        $username = $this->input->post('user');
        $password = $this->input->post('pass');
        $jsondata = json_encode(["omp_id" => $ompid, "username" => $username, "password" => $password]);
        $url = URLAPIV1."/auth/login";
        $chkLoginAuth = $this->auth->curlPostAPI($accesstoken,$url,$jsondata);

        $jsondecode = json_decode($chkLoginAuth);
        if (isset($jsondecode->data->id->accounts[0])) {
            $authData = $jsondecode->data->id->accounts[0];
            $this->session->set_userdata(["userid" => $authData->id, "accountname" => $authData->account_name, "username" => $authData->username, "accountrole" => $authData->account_role, "auth" => "success"]);
            echo json_encode("success");
        }else{
            echo json_encode("fail");
        }
    }
    
    public function checkgroupmember()
    {
        $accesstoken = $this->session->userdata('accesstoken');
        $ompid = $this->session->userdata('ompid');
        $groupid = $this->input->post('groupid');
        $accountid = $this->input->post('accountid');
        $url = URLAPIV1."/group/omp/".$ompid."/id/".$groupid."/member/aid/".$accountid;
        $chkGroupMember = $this->auth->curlGetAPI($accesstoken,$url);

        $jsondecode = json_decode($chkGroupMember);
        if (isset($jsondecode->data->groups[0])) {
            $groupuserinfo = $jsondecode->data->groups[0];
            $this->session->set_userdata(["group_name" => $groupuserinfo->group_name, "group_role" => $groupuserinfo->group_role]);
            echo json_encode("success");
        }else{
            echo json_encode("fail");
        }
    }

    public function creategroup()
    {
        $accesstoken = $this->session->userdata('accesstoken');
        $ompid = $this->session->userdata('ompid');

        $groupname = $this->input->post('group_name');
        $groupdescription = $this->input->post('group_description');
        $status = ($this->input->post('group_status') === "true") ? "1":"0";
        $jsondata = json_encode(["omp_id" => $ompid, "group_name" => $groupname, "group_description" => $groupdescription, "status" => $status]);
        $url = URLAPIV1."/group/create_group";
        $createGroup = $this->auth->curlPostAPI($accesstoken,$url,$jsondata);

        $jsondecode = json_decode($createGroup);
        if ($jsondecode->status == 200) {
            echo json_encode("success");
        }else{
            echo json_encode($jsondecode->description);
        }
    }

    public function delgroup()
    {
        $accesstoken = $this->session->userdata('accesstoken');
        $ompid = $this->session->userdata('ompid');

        $group_id = $this->input->post('id');
        $url = URLAPIV1."/group/omp/".$ompid."/id/".$group_id;
        $delGroup = $this->auth->curlDelAPI($accesstoken,$url);

        $jsondecode = json_decode($delGroup);
        if ($jsondecode->status == 200) {
            echo json_encode("success");
        }else{
            echo json_encode($jsondecode->description);
        }
    }

    public function getgroupid()
    {
        $accesstoken = $this->session->userdata('accesstoken');
        $ompid = $this->session->userdata('ompid');
        $groupid = $this->input->post('groupid');
        $url = URLAPIV1."/group/omp/".$ompid."/id/".$groupid;
        $getGroupDetail = $this->auth->curlGetAPI($accesstoken,$url);

        $jsondecode = json_decode($getGroupDetail);
        if (isset($jsondecode->data->groups[0])) {
            $groupinfo = $jsondecode->data->groups[0];
            echo json_encode(["status" => "success", "data" => ["group_id" => $groupinfo->id,"group_name" => $groupinfo->group_name, "group_description" => $groupinfo->group_description, "status" => $groupinfo->status]]);
        }else{
            echo json_encode("fail");
        }
    }

    public function editgroup()
    {
        $accesstoken = $this->session->userdata('accesstoken');
        $ompid = $this->session->userdata('ompid');

        $groupid = $this->input->post('group_id');
        $groupname = $this->input->post('group_name');
        $groupdescription = $this->input->post('group_description');
        $status = ($this->input->post('group_status') === "true") ? "1":"0";
        $jsondata = json_encode(["omp_id" => $ompid, "id" => $groupid, "group_name" => $groupname, "group_description" => $groupdescription, "status" => $status]);
        $url = URLAPIV1."/group/edit_group";
        $createGroup = $this->auth->curlPostAPI($accesstoken,$url,$jsondata);

        $jsondecode = json_decode($createGroup);
        if ($jsondecode->status == 200) {
            echo json_encode("success");
        }else{
            echo json_encode($jsondecode->description);
        }
    }

    public function createproduct()
    {
        $accesstoken = $this->session->userdata('accesstoken');
        $ompid = $this->session->userdata('ompid');

        $product_name = $this->input->post('product_name');
        $product_prefix = $this->input->post('product_prefix');
        $product_price = $this->input->post('product_price');
        $product_detail = $this->input->post('product_detail');
        $product_group_id = $this->input->post('product_group');
        $status = ($this->input->post('product_status') === "true") ? "1":"0";
        $jsondata = json_encode(["omp_id" => $ompid, "product_name" => $product_name, "product_prefix" => $product_prefix, "product_price" => $product_price, "product_detail" => $product_detail, "product_group_id" => $product_group_id, "status" => $status]);
        $url = URLAPIV1."/product/create_product";
        $createGroup = $this->auth->curlPostAPI($accesstoken,$url,$jsondata);

        $jsondecode = json_decode($createGroup);
        if ($jsondecode->status == 200) {
            echo json_encode("success");
        }else{
            echo json_encode($jsondecode->description);
        }
    }

    public function delproduct()
    {
        $accesstoken = $this->session->userdata('accesstoken');
        $ompid = $this->session->userdata('ompid');
        $aid = $this->session->userdata('userid');

        $product_id = $this->input->post('id');
        $group_id = $this->input->post('gid');
        $url = URLAPIV1."/product/omp/".$ompid."/id/".$product_id."/aid/".$aid."/gid/".$group_id;
        $delProduct = $this->auth->curlDelAPI($accesstoken,$url);

        $jsondecode = json_decode($delProduct);
        if ($jsondecode->status == 200) {
            echo json_encode("success");
        }else{
            echo json_encode($jsondecode->description);
        }
    }

    public function getproductid()
    {
        $accesstoken = $this->session->userdata('accesstoken');
        $ompid = $this->session->userdata('ompid');
        $productid = $this->input->post('productid');
        $url = URLAPIV1."/product/omp/".$ompid."/product_list/pid/".$productid;
        $getProductDetail = $this->auth->curlGetAPI($accesstoken,$url);

        $jsondecode = json_decode($getProductDetail);
        if (isset($jsondecode->data->products[0])) {
            $productinfo = $jsondecode->data->products[0];
            echo json_encode(["status" => "success", "data" => ["product_id" => $productinfo->id,"product_name" => $productinfo->product_name, "product_prefix" => $productinfo->product_prefix, "group_id" => $productinfo->group_id, "group_name" => $productinfo->group_name, "product_price" => $productinfo->product_price, "product_detail" => $productinfo->product_detail, "status" => $productinfo->status]]);
        }else{
            echo json_encode("fail");
        }
    }

    public function editproduct()
    {
        $accesstoken = $this->session->userdata('accesstoken');
        $ompid = $this->session->userdata('ompid');

        $product_id = $this->input->post('product_id');
        $product_name = $this->input->post('product_name');
        $product_prefix = $this->input->post('product_prefix');
        $product_price = $this->input->post('product_price');
        $product_detail = $this->input->post('product_detail');
        $product_group_id = $this->input->post('product_group');
        $status = ($this->input->post('product_status') === "true") ? "1":"0";
        $jsondata = json_encode(["omp_id" => $ompid, "id" => $product_id, "product_name" => $product_name, "product_prefix" => $product_prefix, "product_price" => $product_price, "product_detail" => $product_detail, "product_group_id" => $product_group_id, "status" => $status]);
        $url = URLAPIV1."/product/edit_product";
        $editProduct = $this->auth->curlPostAPI($accesstoken,$url,$jsondata);

        $jsondecode = json_decode($editProduct);
        if ($jsondecode->status == 200) {
            echo json_encode("success");
        }else{
            echo json_encode($jsondecode->description);
        }
    }

    public function getProductName()
	{
        $accesstoken = $this->session->userdata('accesstoken');
        $ompid = $this->session->userdata('ompid');

        $group_id = $product_id = $this->input->post('gid');
        $url = URLAPIV1."/product/omp/".$ompid."/product_list/gid/".$group_id;
        $getProductDetail = $this->auth->curlGetAPI($accesstoken,$url);

        $jsondecode = json_decode($getProductDetail);
        $productinfo = $jsondecode->data->products;
        $key = 0;
        foreach ($productinfo as $value) {
            if (!empty($value) && $value != ' ') {
                $productname[$key]['id'] = $value->id;
                $productname[$key]['productname'] = $value->product_name;
            }
            $key++;
        }
        echo json_encode($productname);
    }
    
    public function createpromotion()
    {
        $accesstoken = $this->session->userdata('accesstoken');
        $ompid = $this->session->userdata('ompid');

        $group_id = $this->input->post('promotion_group');
        $product_id = $this->input->post('promotion_product');
        $promotion_name = $this->input->post('promotion_name');
        $promotion_product_amount = $this->input->post('promotion_amount');
        $promotion_price = $this->input->post('promotion_price');
        if(!empty($this->input->post('promotion_period'))){
            $datetime = explode(" - ",$this->input->post('promotion_period'));
            $promotion_period_begin = $datetime[0];
            $promotion_period_end = $datetime[1];
        }else{
            $promotion_period_begin = null;
            $promotion_period_end = null;
        }
        $status = ($this->input->post('promotion_status') === "true") ? "1":"0";
        $jsondata = json_encode(["omp_id" => $ompid, "group_id" => $group_id, "product_id" => $product_id, "promotion_name" => $promotion_name, "promotion_product_amount" => $promotion_product_amount, "promotion_price" => $promotion_price, "promotion_period_begin" => $promotion_period_begin, "promotion_period_end" => $promotion_period_end, "status" => $status]);
        $url = URLAPIV1."/promotion/create_promotion";
        $createGroup = $this->auth->curlPostAPI($accesstoken,$url,$jsondata);

        $jsondecode = json_decode($createGroup);
        if ($jsondecode->status == 200) {
            echo json_encode("success");
        }else{
            echo json_encode($jsondecode->description);
        }
    }

    public function delpromotion()
    {
        $accesstoken = $this->session->userdata('accesstoken');
        $ompid = $this->session->userdata('ompid');
        $aid = $this->session->userdata('userid');

        $promotion_id = $this->input->post('id');
        $group_id = $this->input->post('gid');
        $url = URLAPIV1."/promotion/omp/".$ompid."/id/".$promotion_id."/aid/".$aid."/gid/".$group_id;
        $delProduct = $this->auth->curlDelAPI($accesstoken,$url);

        $jsondecode = json_decode($delProduct);
        if ($jsondecode->status == 200) {
            echo json_encode("success");
        }else{
            echo json_encode($jsondecode->description);
        }
    }

    public function getpromotionid()
    {
        $accesstoken = $this->session->userdata('accesstoken');
        $ompid = $this->session->userdata('ompid');
        $promotionid = $this->input->post('promotionid');
        $url = URLAPIV1."/promotion/omp/".$ompid."/promotion_list/pid/".$promotionid;
        $getPromotionDetail = $this->auth->curlGetAPI($accesstoken,$url);

        $jsondecode = json_decode($getPromotionDetail);
        if (isset($jsondecode->data->products[0])) {
            $promotioninfo = $jsondecode->data->products[0];
            if (!empty($promotioninfo->promotion_period_begin) && $promotioninfo->promotion_period_begin != null) {
                $datetime = date("Y/m/d",strtotime($promotioninfo->promotion_period_begin)) . " - " . date("Y/m/d",strtotime($promotioninfo->promotion_period_end));
            }
            echo json_encode(["status" => "success", "data" => ["promotion_id" => $promotioninfo->id,"promotion_name" => $promotioninfo->promotion_name, "promotion_product_amount" => $promotioninfo->promotion_product_amount, "group_id" => $promotioninfo->group_id, "group_name" => $promotioninfo->group_name, "product_id" => $promotioninfo->product_id, "product_name" => $promotioninfo->product_name, "promotion_price" => $promotioninfo->promotion_price, "product_period" => $datetime, "status" => $promotioninfo->status]]);
        }else{
            echo json_encode("fail");
        }
    }

    public function editpromotion()
    {
        $accesstoken = $this->session->userdata('accesstoken');
        $ompid = $this->session->userdata('ompid');

        $promotion_id = $this->input->post('promotion_id');
        $group_id = $this->input->post('promotion_group');
        $product_id = $this->input->post('promotion_product');
        $promotion_name = $this->input->post('promotion_name');
        $promotion_product_amount = $this->input->post('promotion_amount');
        $promotion_price = $this->input->post('promotion_price');
        if(!empty($this->input->post('promotion_period'))){
            $datetime = explode(" - ",$this->input->post('promotion_period'));
            $promotion_period_begin = $datetime[0];
            $promotion_period_end = $datetime[1];
        }else{
            $promotion_period_begin = null;
            $promotion_period_end = null;
        }
        $status = ($this->input->post('promotion_status') === "true") ? "1":"0";
        $jsondata = json_encode(["omp_id" => $ompid, "id" => $promotion_id, "group_id" => $group_id, "product_id" => $product_id, "promotion_name" => $promotion_name, "promotion_product_amount" => $promotion_product_amount, "promotion_price" => $promotion_price, "promotion_period_begin" => $promotion_period_begin, "promotion_period_end" => $promotion_period_end, "status" => $status]);
        $url = URLAPIV1."/promotion/edit_promotion";
        $editPromotion = $this->auth->curlPostAPI($accesstoken,$url,$jsondata);

        $jsondecode = json_decode($editPromotion);
        if ($jsondecode->status == 200) {
            echo json_encode("success");
        }else{
            echo json_encode($jsondecode->description);
        }
    }

    public function createuser()
    {
        $accesstoken = $this->session->userdata('accesstoken');
        $ompid = $this->session->userdata('ompid');

        $account_name = $this->input->post('account_name');
        $account_user = $this->input->post('account_user');
        $account_password = $this->input->post('account_password');
        $account_role = $this->input->post('account_role');
        $status = ($this->input->post('account_status') === "true") ? "1":"0";
        $jsondata = json_encode(["omp_id" => $ompid, "account_name" => $account_name, "username" => $account_user, "password" => $account_password, "status" => $status, "account_role" => $account_role]);
        $url = URLAPIV1."/account/create_account";
        $createUser = $this->auth->curlPostAPI($accesstoken,$url,$jsondata);

        $jsondecode = json_decode($createUser);
        if ($jsondecode->status == 200) {
            echo json_encode("success");
        }else{
            echo json_encode($jsondecode->description);
        }
    }

    public function delaccount()
    {
        $accesstoken = $this->session->userdata('accesstoken');
        $ompid = $this->session->userdata('ompid');
        $aid = $this->session->userdata('userid');

        $account_id = $this->input->post('id');
        $url = URLAPIV1."/account/omp/".$ompid."/id/".$account_id;
        $delAccount = $this->auth->curlDelAPI($accesstoken,$url);

        $jsondecode = json_decode($delAccount);
        if ($jsondecode->status == 200) {
            echo json_encode("success");
        }else{
            echo json_encode($jsondecode->description);
        }
    }

    public function getaccountid()
    {
        $accesstoken = $this->session->userdata('accesstoken');
        $ompid = $this->session->userdata('ompid');
        $accountid = $this->input->post('accountid');
        $url = URLAPIV1."/account/omp/".$ompid."/id/".$accountid;
        $getPromotionDetail = $this->auth->curlGetAPI($accesstoken,$url);

        $jsondecode = json_decode($getPromotionDetail);
        if (isset($jsondecode->data->accounts[0])) {
            $accountinfo = $jsondecode->data->accounts[0];
            echo json_encode(["status" => "success", "data" => ["account_id" => $accountinfo->id,"account_name" => $accountinfo->account_name, "username" => $accountinfo->username, "account_role" => $accountinfo->account_role, "status" => $accountinfo->status]]);
        }else{
            echo json_encode("fail");
        }
    }

    public function editaccount()
    {
        $accesstoken = $this->session->userdata('accesstoken');
        $ompid = $this->session->userdata('ompid');


        $account_id = $this->input->post('account_id');
        $account_name = $this->input->post('account_name');
        $account_user = $this->input->post('account_user');
        $account_password = $this->input->post('account_password');
        $account_role = $this->input->post('account_role');
        $status = ($this->input->post('account_status') === "true") ? "1":"0";
        $jsondata = json_encode(["omp_id" => $ompid, "id" => $account_id, "account_name" => $account_name, "username" => $account_user, "password" => $account_password, "status" => $status, "account_role" => $account_role]);
        $url = URLAPIV1."/account/edit_account";
        $editAccount = $this->auth->curlPostAPI($accesstoken,$url,$jsondata);

        $jsondecode = json_decode($editAccount);
        if ($jsondecode->status == 200) {
            echo json_encode("success");
        }else{
            echo json_encode($jsondecode->description);
        }
    }

    public function getGroupByaid()
	{
        $accesstoken = $this->session->userdata('accesstoken');
        $ompid = $this->session->userdata('ompid');

        $account_id = $product_id = $this->input->get('accountid');
        $url = URLAPIV1."/group/omp/".$ompid."/group_list/aid/".$account_id;
        $getGroupDetail = $this->auth->curlGetAPI($accesstoken,$url);

        $jsondecode = json_decode($getGroupDetail);
        if ($jsondecode->data->groups) {
            foreach ($jsondecode->data->groups as $key => $value) {
                foreach ($value as $k => $info) {
                    if ($k != "status" && $k != "group_description") {
                        if ($k == "group_role") {
                            switch ($info) {
                                case 1:
                                    $color = "info";
                                    $info = '<span id="role" class="badge badge-'.$color.'">Admin</span>';
                                    break;

                                case 2:
                                    $color = "success";
                                    $info = '<span id="role" class="badge badge-'.$color.'">Owner</span>';
                                    break;
                                
                                default:
                                    $color = "secondary";
                                    $info = '<span id="role" class="badge badge-'.$color.'">Member</span>';
                                    break;
                            }
                        }
                       $datas[$key][] = $info;
                    }
                }
                $datas[$key][] = '<a href="#'.$value->id.'" class="btn btn-danger btn-circle" onclick="delgroup(' . $value->id .',' . $account_id . ')"> <span class="fas fa-trash-alt" style="color:#fff;"></span> </a>';
            }
            $groupinfo['data'] = $datas;
            echo json_encode($groupinfo);
        }else{
            echo '{"data":""}';
        }
    }

    public function delmemberingroup()
    {
        $accesstoken = $this->session->userdata('accesstoken');
        $ompid = $this->session->userdata('ompid');

        $account_id = $this->input->post('accountid');
        $group_id = $this->input->post('groupid');
        $jsondata = json_encode(["group_id" => $group_id, "account_id" => $account_id]);
        $url = URLAPIV1."/group/del_group_member";
        $delAccount = $this->auth->curlPostAPI($accesstoken,$url,$jsondata);

        $jsondecode = json_decode($delAccount);
        if ($jsondecode->status == 200) {
            echo json_encode("success");
        }else{
            echo json_encode($jsondecode->description);
        }
    }

    public function addmemberingroup()
    {
        $accesstoken = $this->session->userdata('accesstoken');
        $ompid = $this->session->userdata('ompid');

        $account_id = $this->input->post('accountid');
        $group_id = $this->input->post('groupid');
        $group_role = $this->input->post('grouprole');
        $jsondata = json_encode(["group_id" => $group_id, "account_id" => $account_id, "group_role" => $group_role]);
        $url = URLAPIV1."/group/add_group_member";
        $addAccount = $this->auth->curlPostAPI($accesstoken,$url,$jsondata);

        $jsondecode = json_decode($addAccount);
        if ($jsondecode->status == 200) {
            echo json_encode("success");
        }else{
            echo json_encode($jsondecode->description);
        }
    }

}
