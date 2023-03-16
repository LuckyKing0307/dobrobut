<?php 
require_once '../controller/controller.php';
$data['tmp'] = 'main';
$data['org'] = $API->evaluate('getOrganizationList','');
$data['per_type'] = $API->evaluate('getPersonalTypesList','');
$data['per_dir'] = $API->evaluate('getPersonalDirectionsList','');
$title1 = '';
$ident=0;
$back = array();
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
		if ($_GET['structure']=='department_id') {
			$arg['list'] = $API->evaluate('getDepList',$_GET['req']);
			$title = $_GET['title'];
			$title1 = $_GET['title'];
		}
		$request = 'getUsersByTyped';
		$title1 = $title1;
		$backs = "loadwebpage('tree')";
	}else{
		if ($_GET['structure']=='department_id') {
			$arg['list'] = $API->evaluate('getDepList',$_GET['req']);
			$arg['type'] = $_GET['structure'];
			$arg['fields'][$_GET['structure']] = $_GET['req'];
		}else{
			$arg['fields'][$_GET['structure']] = $_GET['req'];
			$arg['type'] = $_GET['structure'];
		}
		$request = 'getUsersSearch';
		$backs = "loadwebpage(this)";
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
	if ($_GET['structure']=='department_id') {
		$title = $_GET['title'];
		$title1 = $_GET['title'];
	}
	$title = $title2;
	$data['count'] = $users['count'];
	$data['count_list'] = $users['count_list'];
	$type['search'] = $_GET['structure'];
	$type['value'] = $_GET['req'];

	if (isset($_GET['back'])) {
		$back = json_decode($_GET['back'],1);
		$ident = count($back)-1;
	}
	$result = require('../view/structure.php');
}else{
	$data['org'] = $API->evaluate('getOrganizationList','');
	$data['per_type'] = $API->evaluate('getPersonalTypesList','');
	$data['per_dir'] = $API->evaluate('getPersonalDirectionsList','');

	if (isset($_GET['back'])) {
		$back = json_decode($_GET['back'],1);
		$ident = count($back)-1;
	}
	$result = require('../view/main.php');
}
return $result;
