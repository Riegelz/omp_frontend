<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		## Check Oauth Token ##
		if (empty($this->session->userdata('accesstoken'))) {$this->auth->getNewToken();}else{$this->auth->chkSessionExpired($_SESSION['expire_token']);}
		if (empty($this->session->userdata('ompid'))) {$this->auth->getOmpID($this->session->userdata('accesstoken'));}
		if ($this->session->userdata('auth') == 'success') {redirect('home');}
	}
	
	public function index()
	{
		$this->load->view('login');
	}

}
