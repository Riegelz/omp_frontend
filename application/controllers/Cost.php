<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Cost extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        define("ACCESSTOKEN","accesstoken");
		## Check Oauth Token ##
		if (empty($this->session->userdata(ACCESSTOKEN))) {$this->auth->getNewToken();}else{$this->auth->chkSessionExpired($_SESSION['expire_token']);}
        if (empty($this->session->userdata('ompid'))) {$this->auth->getOmpID($this->session->userdata(ACCESSTOKEN));}
        if ($this->session->userdata('auth') != 'success') {redirect('login');}
        // echo "<pre>";
        // print_r($_SESSION);
	}
	
	public function addorder()
	{
        $this->session->set_userdata('page_status', 'addorder');
		$data['breadcrumb'] = "Add Order";
        $data['title'] = 'OMP | Add Order';
        
        ## Get User Group ##
        $accesstoken = $this->session->userdata(ACCESSTOKEN);
        $accountid = $this->session->userdata('userid');
        $ompid = $this->session->userdata('ompid');
        $url = URLAPIV1."/group/omp/".$ompid."/group_list/aid/".$accountid;
        $getUserGroup = json_decode($this->auth->curlGetAPI($accesstoken,$url));
        $groupdata['grouplists'] = $getUserGroup->data->groups;

        ## Get Province ##
        $url = URLAPIV1."/other/province";
        $getUserGroup = json_decode($this->auth->curlGetAPI($accesstoken,$url));
        $data['provincelists'] = $getUserGroup->data->province;

        $this->load->view('head');
        $this->load->view('addorder',$data);
        $this->load->view('footer');
        $this->load->view('sidebar',$groupdata);
    }

}
