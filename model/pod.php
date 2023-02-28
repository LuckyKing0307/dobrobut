<?php 
require_once '../controller/controller.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

$users = array();
$data['org'] = $API->evaluate('getOrganizationList','');
$data['per_type'] = $API->evaluate('getPersonalTypesList','');
$data['per_dir'] = $API->evaluate('getPersonalDirectionsList','');
if ($_GET['pod']) {
	$data['pod'] = $API->evaluate('getPods',array('type'=>$_GET['pod']));
	if ($_GET['pod']=='organization_id') {
		$data['list'] = $data['org'];
		$title = 'Організаційна структура';
	}
	if ($_GET['pod']=='position_type') {
		$data['list'] = $data['per_type'];
		$title = 'За типамі співробітників';
	}
	if ($_GET['pod']=='direction') {
		$data['list'] = $data['per_dir'];
		$title = 'Функціональна структура';
	}
}
$result = require('../view/pod.php');
