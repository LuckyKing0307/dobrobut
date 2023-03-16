<?php 
require_once '../controller/controller.php';
$users = array();
$data['org'] = $API->evaluate('getOrganizationList','');
$data['per_type'] = $API->evaluate('getPersonalTypesList','');
$data['per_dir'] = $API->evaluate('getPersonalDirectionsList','');
$back = array();
$ident=0;
$sub_title = 'Підрозділи';
$titled = '';
if ($_GET['pod']) {
	$data['pod'] = $API->evaluate('getPods',array('type'=>$_GET['pod']));
	if ($_GET['pod']=='organization_id') {
		if (isset($_GET['id'])) {
			$arg['id'] = $_GET['id'];
			$data_dep = $API->evaluate('getOrgtyped',$arg);
			$data['list'] = $data_dep['list'];
			$titled = $data_dep['title'];
			$_GET['pod'] = 'department_id';
			$title = 'Організаційна структура';
		}
		else if (isset($_GET['parentid'])) {
			$arg['parentid'] = $_GET['parentid'];
			$data_dep = $API->evaluate('getOrgtyped',$arg);
			$data['list'] = $data_dep['list'];
			$titled = $data_dep['title'];
			$_GET['pod'] = 'department_id';
			$title = 'Організаційна структура';
		}
		else{
			$data['list'] = $data['org'];
			$title = 'Організаційна структура';
		}
	}
	if ($_GET['pod']=='department_id') {
		if (isset($_GET['id'])) {
			$arg['id'] = $_GET['id'];
			$data_dep = $API->evaluate('getOrgtyped',$arg);
			$data['list'] = $data_dep['list'];
			$titled = $data_dep['title'];
			$title = 'Організаційна структура';
		}
		else if (isset($_GET['parentid'])) {
			$arg['parentid'] = $_GET['parentid'];
			$data_dep = $API->evaluate('getOrgtyped',$arg);
			$data['list'] = $data_dep['list'];
			$titled = $data_dep['title'];
			$_GET['pod'] = 'department_id';
			$title = 'Організаційна структура';
		}else{
			$data['list'] = $data['org'];
			$title = 'Організаційна структура';
		}
	}
	if ($_GET['pod']=='position_type') {
		$data['list'] = $data['per_type'];
		$title = 'За типами співробітників';
		$sub_title = 'Типи';
	}
	if ($_GET['pod']=='direction') {
		$data['list'] = $data['per_dir'];
		$title = 'Функціональна структура';
		$sub_title = 'Функції';
	}
}
if (isset($_GET['back'])) {
	$back = json_decode($_GET['back'],1);
	$ident = count($back)-1;
	if (isset($_GET['id'])) {
		if ($back[$ident][0] == $_GET['id']) {
			$ident = $ident-1;
		}
	}
	if (isset($_GET['parentid'])) {
		if ($back[$ident][0] == $_GET['parentid']) {
			$ident = $ident-1;
		}
	}
}
echo "<pre>";
print_r($data['list']);
echo "</pre>";
$result = require('../view/pod.php');

