<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once 'controller/controller.php';
$data['tmp'] = 'main';
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Bootstrap demo</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="front/css/main.css">
	</head>
	<body>
	<?php
		$data['org'] = $API->evaluate('getOrganizationList','');
		$data['per_type'] = $API->evaluate('getPersonalTypesList','');
		$data['per_dir'] = $API->evaluate('getPersonalDirectionsList','');
		$users = $API->evaluate('getUsersList','');
		$data['users'] = $users['list'];
		$data['count'] = $users['count'];
		$data['count_list'] = $users['count_list'];
		$result = require('view/main.php');
	?>
	</body>
</html>