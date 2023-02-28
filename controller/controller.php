<?php

use Datto\JsonRpc\Server;

require_once __DIR__ . '/dobrobut-hrportal/vendor/autoload.php';
require_once 'dobrobut-hrportal/Api.php';
require_once 'dobrobut-hrportal/utils.php';
$config = require('dobrobut-hrportal/config.php');
$API = new API($config);