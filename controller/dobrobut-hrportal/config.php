<?php

$config = array(
    'DEBUG'                => 'on',
    'PG_CONNECT'           => "host=157.90.124.249 port=5432 dbname=dobrobut user=dobrobut password=2*/St$9Cp9%!g>X2",
);

$local_config =  __DIR__  . '/config-local.php';

return array_merge($config, (array)$local_config);

