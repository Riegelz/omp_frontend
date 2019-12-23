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

}
