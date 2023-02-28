<?php

use Datto\JsonRpc\Server;

require_once __DIR__ . '/vendor/autoload.php';
require_once 'Api.php';
require_once 'utils.php';

$config = require('config.php');

ini_set('display_errors', $config['DEBUG']);
error_reporting(E_ALL);

date_default_timezone_set('Europe/Kiev');

$url = $_SERVER['REQUEST_URI'];
$arr = explode('/',$url);
$url = '/'.$arr[count($arr)-1];


switch ($url) {
      case '/api':
      case '/api/':
          try {
              $inputJSON = file_get_contents('php://input');
              $input = json_decode($inputJSON, TRUE);

              $server = new Server(new Api( $config ));
              $reply = $server->reply($inputJSON);

              header('Content-Type: application/json');
              echo $reply;

          } catch (Exception $e) {
              header('Content-Type: application/json');
              echo '{"jsonrpc":"2.0","id":null,"error":{"code":-32700,"message": "'.$e->getMessage().'" }}' ;
          }

          break;

      default:
          $path = '/www';
          $path_parts = pathinfo($url);

          $file = $url;

          $name = __DIR__ . $path . $file;
          switch($path_parts['extension']){
              case 'svg':
                  $fp = fopen($name, 'rb');
                  header("Content-Type: image/svg+xml");
                  header("Content-Length: " . filesize($name));
                  fpassthru($fp);
                  break;
              case 'png':
                  $fp = fopen($name, 'rb');
                  header("Content-Type: image/png");
                  header("Content-Length: " . filesize($name));
                  fpassthru($fp);
                  break;
              case 'ico':
                  $fp = fopen($name, 'rb');
                  header("Content-Type: text/html");
                  header("Content-Length: " . filesize($name));
                  fpassthru($fp);
                  break;
              case 'js':
                  $fp = fopen($name, 'rb');
                  header("Content-Type: text/javascript");
                  fpassthru($fp);
                  break;
              case 'css':
                  header("Content-Type: text/css");
              default:
                  readfile(__DIR__ . $path . $file);
          }
}