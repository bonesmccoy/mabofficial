<?php
session_start();

define("MAB_MAILTO", "empirico@gmail.com");

$result = array('status' => 0, 'message' => '');
$result =  (send_mail()) ? array("status" => '1') : $result;

echo json_encode($result);

function send_mail() {

	if ($_POST['token'] != $_SESSION['token']) return false;
	if (empty($_POST['first_name'])) return false;
	if (empty($_POST['email'])) return false;
	if (empty($_POST['message'])) return false;

	$sender_name = htmlentities(strip_tags($_POST['first_name']));
	$sender_email = strip_tags($_POST['email']);
	$sender_message = strip_tags($_POST['message']);
	$tpl =<<<TPL
		Message Sento from {$sender_name} - ( $sender_email )

		##################################################
		
		$sender_message

		##################################################


		End message
TPL;

	$headers = 'From: info@mabofficial.com' . "\r\n" .
    		   'Reply-To: info@mabofficial.com' . "\r\n" .
    		    'X-Mailer: PHP/' . phpversion();
	return mail ( MAB_MAILTO , "Mail from mabofficial.com" , $tpl, $headers );
}