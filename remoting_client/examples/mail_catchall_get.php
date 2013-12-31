<?php

require('soap_config.php');


$client = new SoapClient(null, array('location' => $soap_location,
                                     'uri'      => $soap_uri,
									 'trace' => 1,
									 'exceptions' => 1));


try {
	if($session_id = $client->login($username,$password)) {
		echo 'Logged successfull. Session ID:'.$session_id.'<br />';
	}
	
	//* Set the function parameters.
	$catchall_id = 1;
	
	$mail_catchall_record = $client->mail_catchall_get($session_id, $catchall_id);

	print_r($mail_catchall_record);
	
	if($client->logout($session_id)) {
		echo 'Logged out.<br />';
	}
	
	
} catch (SoapFault $e) {
	echo $client->__getLastResponse();
	die('SOAP Error: '.$e->getMessage());
}

?>
