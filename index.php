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
		$users = array();

		$data['org'] = $API->evaluate('getOrganizationList','');
		$data['per_type'] = $API->evaluate('getPersonalTypesList','');
		$data['per_dir'] = $API->evaluate('getPersonalDirectionsList','');
		$data['count'] = $API->evaluate('getUsersList',array())['count'];

		$result = require('view/tree.php');?>
	<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script src="https://dobrobut.learn-solve.com/front/js/main.js" defer=""></script>
	</body>
</html>