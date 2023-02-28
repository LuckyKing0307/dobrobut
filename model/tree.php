<?php 
require_once '../controller/controller.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

$users = array();

$data['org'] = $API->evaluate('getOrganizationList','');
$data['per_type'] = $API->evaluate('getPersonalTypesList','');
$data['per_dir'] = $API->evaluate('getPersonalDirectionsList','');
$data['count'] = $API->evaluate('getUsersList',array())['count'];

$result = require('../view/tree.php');
