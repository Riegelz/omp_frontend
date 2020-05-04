<?php

class Auth {

    public function __construct()
	{
		define("DATEFORMAT","Y-m-d H:i:s");
		define("TOKEN","token");
	}

    public function getNewToken() {
		$CI =& get_instance();
		$curlGetToken = json_decode($this->curlGetToken(["user" => OMPUSER, TOKEN => OMPTOKEN],URLGETTOKEN));
		if (!isset($curlGetToken->error)) {
			$CI->session->set_userdata(["accesstoken" => $curlGetToken->access_token, "expire_token" => date(DATEFORMAT, strtotime('+' . (int)$curlGetToken->expires_in . ' second'))]);
		}else{
			$CI->session->sess_destroy();
		}
    }

	public function chkSessionExpired($sessiontime) {
		$CI =& get_instance();
		$currentTime = date(DATEFORMAT);
		if ($currentTime >= $sessiontime) {
            $curlGetToken = json_decode($this->curlGetToken(["user" => OMPUSER, TOKEN => OMPTOKEN],URLGETTOKEN));
            if (!isset($curlGetToken->error)) {
				$CI->session->set_userdata(["accesstoken" => $curlGetToken->access_token, "expire_token" => date(DATEFORMAT, strtotime('+' . (int)$curlGetToken->expires_in . ' second'))]);
			}else{
				$CI->session->sess_destroy();
			}
		}
	}

	public function getOmpID($accesstoken) {
		$CI =& get_instance();
		$url = URLAPIV1."/auth/ompuser/".OMPUSER."/omptoken/".OMPTOKEN;
		$getOmpID = json_decode($this->curlGetAPI($accesstoken,$url));
		if ($getOmpID->status === 200 && $getOmpID->data->accounts[0]->status === "1") {
			$CI->session->set_userdata(["ompid" => $getOmpID->data->accounts[0]->id]);
		}else{
			$CI->session->sess_destroy();
		}
	}

	public function curlGetToken($dataToken,$url) {

        $auth = base64_encode($dataToken['user'].":".$dataToken['token']);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "grant_type=client_credentials",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/x-www-form-urlencoded",
                "Authorization: Basic " . $auth,
                "cache-control: no-cache"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;

	}
	
	public function curlGetAPI($auth,$url) {

        $curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_POSTFIELDS => "",
			CURLOPT_HTTPHEADER => array(
				"Content-Type: application/json",
				"Authorization: Bearer " . $auth,
				"cache-control: no-cache"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		return $response;

	}
	
	public function curlPostAPI($auth,$url,$jsondata) {

        $curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => $jsondata,
			CURLOPT_HTTPHEADER => array(
				"Content-Type: application/json",
				"Authorization: Bearer " . $auth,
				"cache-control: no-cache"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		return $response;

    }
	
	public function curlDelAPI($auth,$url) {

        $curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "DELETE",
			CURLOPT_POSTFIELDS => "",
			CURLOPT_HTTPHEADER => array(
				"Content-Type: application/json",
				"Authorization: Bearer " . $auth,
				"cache-control: no-cache"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		return $response;

	}

}
