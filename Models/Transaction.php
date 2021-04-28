<?php

	include_once '../JazzCashAPI/JazzcashApi.php';

	function makeTransaction($phone, $cnic, $amount){

		$data['jazz_cash_no'] = $phone;
		$data['cnic_digits']  = $cnic;
		$data['price']       = $amount;

		$data['paymentMethod']=  'jazzcashMobile';
		/*$data['ccNo']		  =  $_POST['ccNo'];
		$data['expMonth']	  =  $_POST['expMonth'];
		$data['expYear']	  =  $_POST['expYear'];
		$data['cvv']		  =  $_POST['cvv'];*/

		$jc_api = new JazzcashApi();

		$response = $jc_api->createCharge($data);

		return $response;
	}
?>