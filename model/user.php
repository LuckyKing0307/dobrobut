<?php 
require_once '../controller/controller.php';
// ini_set('display_errors', 1);
// error_reporting(E_ALL);
	if ($_GET['id']) {
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
		// print_r($data);
		$first_character_name = mb_substr($data[$main]['name'], 0, 1);
		$first_character_lastname = mb_substr($data[$main]['second_name'], 0, 1);
		$result = require('../view/user.php');
	}
?>