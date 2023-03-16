<?php 
require_once '../controller/controller.php';
// ini_set('display_errors', 1);
// error_reporting(E_ALL);
	if ($_GET['id']) {
		$type_value = '';
		if (isset($_GET['type_value'])) {
			$type_value = $_GET['type_value'];
			$type_search = $_GET['type_search'];
		}
		if (isset($_GET['user_linked'])) {
			$user_linked = json_decode($_GET['user_linked'],1);
			$ident = count($user_linked)-1;
		}
		$arg['id'] = $_GET['id'];
		$data = $API->evaluate('getUsersById',$arg)['list'];
		$main = 0;
		for ($i=0; $i < count($data); $i++) { 
			if ($data[$i]['corppo_type']=='M') {
				$main = $i;
			}
		}
		if (is_array($data[$main]['header'])) {
			$first_character_headername = mb_substr($data[$main]['header']['name'], 0, 1);
			$first_character_headerlastname = mb_substr($data[$main]['header']['second_name'], 0, 1);
		}
		if (is_array($data[$main]['der_header'])) {
			$first_character_leadername = mb_substr($data[$main]['der_header']['name'], 0, 1);
			$first_character_leaderlastname = mb_substr($data[$main]['der_header']['second_name'], 0, 1);
		}

		$first_character_name = mb_substr($data[$main]['name'], 0, 1);
		$first_character_lastname = mb_substr($data[$main]['second_name'], 0, 1);
		$result = require('../view/user.php');
		// echo "<pre>";
		// print_r($data);
	}
?>