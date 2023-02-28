<?php 
require_once '../controller/controller.php';
$data['tmp'] = 'main';
$data['org'] = $API->evaluate('getOrganizationList','');
$data['per_type'] = $API->evaluate('getPersonalTypesList','');
$data['per_dir'] = $API->evaluate('getPersonalDirectionsList','');
$title1 = '';
if (isset($_GET['structure'])) {
	if (isset($_GET['search'])) {
		$arg['text'] = $_GET['search'];
	}

	if (isset($_GET['paging'])) {
		$arg['paging'] = $_GET['paging'];
	}
	if (isset($_GET['req']) and $_GET['req']=='') {
		$arg['type'] = $_GET['structure'];
		if ($_GET['structure']=='organization_id') {
			$arg['list'] = $data['org'];
			$title1 = 'Організаційна структура';
		}
		if ($_GET['structure']=='position_type') {
			$arg['list'] = $data['per_type'];
			$title1 = 'За типамі співробітників';
		}
		if ($_GET['structure']=='direction') {
			$arg['list'] = $data['per_dir'];
			$title1 = 'Функціональна структура';
		}
		$request = 'getUsersByTyped';
		$title1 = $title1;
		$back = "loadwebpage('tree')";
	}else{
		$arg['fields'][$_GET['structure']] = $_GET['req'];
		$request = 'getUsersSearch';
		$back = "loadwebpage(this)";
	}








	
	$users = $API->evaluate($request,$arg);
	$data['users'] = $users['list'];
	if ($_GET['structure']=='organization_id') {
		$title2 = $data['users'][0]['org_name'];
	}
	if ($_GET['structure']=='position_type') {
		$title2 = $data['users'][0]['pos_name'];
	}
	if ($_GET['structure']=='direction') {
		$title2 = $data['users'][0]['der_name'];
	}
	$title = $title2;
	$data['count'] = $users['count'];
	$type['search'] = $_GET['structure'];
	$type['value'] = $_GET['req'];
	$result = require('../view/structure.php');
}else{
	$data['org'] = $API->evaluate('getOrganizationList','');
	$data['per_type'] = $API->evaluate('getPersonalTypesList','');
	$data['per_dir'] = $API->evaluate('getPersonalDirectionsList','');
	$result = require('../view/main.php');
}
// print_r($data['per_dir']);
return $result;
