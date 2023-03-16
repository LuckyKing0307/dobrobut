<?php 
require_once '../controller/controller.php';
$data['tmp'] = 'main';
$users = array();
if (isset($_GET['search'])) {
	$arg['text'] = $_GET['search'];
	if (isset($_GET['paging'])) {
		$arg['paging'] = $_GET['paging'];
	}
	$users = $API->evaluate('getUsersSearchMain',$arg);
}else{
	if (isset($_GET['paging'])) {
		$users = $API->evaluate('getUsersList',array('paging'=>$_GET['paging']));
	}else{
		$users = $API->evaluate('getUsersList',array());
	}
}
$data['org'] = $API->evaluate('getOrganizationList','');
$data['per_type'] = $API->evaluate('getPersonalTypesList','');
$data['per_dir'] = $API->evaluate('getPersonalDirectionsList','');
$data['users'] = $users['list'];
$data['count'] = $users['count'];
$data['count_list'] = $users['count_list'];
$result = require('../view/main.php');
return $data;
