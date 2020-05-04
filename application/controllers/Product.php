<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        define("ACCESSTOKEN","accesstoken");
		## Check Oauth Token ##
		if (empty($this->session->userdata(ACCESSTOKEN))) {$this->auth->getNewToken();}else{$this->auth->chkSessionExpired($_SESSION['expire_token']);}
        if (empty($this->session->userdata('ompid'))) {$this->auth->getOmpID($this->session->userdata(ACCESSTOKEN));}
        if ($this->session->userdata('auth') != 'success') {redirect('login');}
	}
	
	public function index()
	{
        $this->session->set_userdata('page_status', 'product');
		$data['breadcrumb'] = "Product";
        $data['title'] = 'OMP | Product';
        
        ## Get User Group ##
        $accesstoken = $this->session->userdata(ACCESSTOKEN);
        $accountid = $this->session->userdata('userid');
        $ompid = $this->session->userdata('ompid');
        $url = URLAPIV1."/group/omp/".$ompid."/group_list/aid/".$accountid;
        $getUserGroup = json_decode($this->auth->curlGetAPI($accesstoken,$url));
        $groupdata['grouplists'] = $getUserGroup->data->groups;

        ## Get Product lists ##
        $getgroupurl = URLAPIV1."/product/omp/".$ompid."/product_list";
        $getProductList = json_decode($this->auth->curlGetAPI($accesstoken,$getgroupurl));
        $data['productlists'] = $getProductList->data->products;
        $getGroupurl = URLAPIV1."/group/omp/".$ompid."/group_list";
        $getGroup = json_decode($this->auth->curlGetAPI($accesstoken,$getGroupurl));
        $data['grouplists'] = $getGroup->data->groups;

        $this->load->view('head');
        $this->load->view('product',$data);
        $this->load->view('footer');
        $this->load->view('sidebar',$groupdata);
	}

}
