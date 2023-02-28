<?php

const API_GET = 'GET';
const API_POST = 'POST';
const API_PUT = 'PUT';

function generateNumericOTP($n):string
{
    // Take a generator string which consist of
    // all numeric digits
    $generator = "1357902468";
    // Iterate for n-times and pick a single character
    // from generator and append it to $result

    // Login for generating a random character from generator
    //     ---generate a random number
    //     ---take modulus of same with length of generator (say i)
    //     ---append the character at place (i) from generator to result

    $result = "";
    for ($i = 1; $i <= $n; $i++) {
        $result .= substr($generator, (rand() % (strlen($generator))), 1);
    }
    // Return result
    return $result;
}

function generateUUID(): string
{
    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        // 32 bits for "time_low"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

        // 16 bits for "time_mid"
        mt_rand( 0, 0xffff ),

        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand( 0, 0x0fff ) | 0x4000,

        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand( 0, 0x3fff ) | 0x8000,

        // 48 bits for "node"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );
}

function getIPAddress() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function setPIDFile($aName):string {
    $tmp_dir = sys_get_temp_dir();
    $filename = "/".$aName;
    if (file_exists($tmp_dir. $filename)) die(" Script already running\n PID file:".$tmp_dir. $filename."\n" );
    $pid_file = fopen($tmp_dir. $filename, 'wb');
    if (!$pid_file) {
        die(' Error creating the file ' . $tmp_dir. $filename);
    }
    fclose($pid_file);
    return $tmp_dir. $filename;
}

function equal_array($arr){
    $ArrayObject = new ArrayObject($arr);
    return $ArrayObject->getArrayCopy();
}

/**
 * function xml2array
 *
 * This function is part of the PHP manual.
 *
 * The PHP manual text and comments are covered by the Creative Commons
 * Attribution 3.0 License, copyright (c) the PHP Documentation Group
 *
 * @author  k dot antczak at livedata dot pl
 * @date    2011-04-22 06:08 UTC
 * @link    http://www.php.net/manual/en/ref.simplexml.php#103617
 * @license http://www.php.net/license/index.php#doc-lic
 * @license http://creativecommons.org/licenses/by/3.0/
 * @license CC-BY-3.0 <http://spdx.org/licenses/CC-BY-3.0>
 */
function xml2array ( $xmlObject, $out = array () )
{
    foreach ( (array) $xmlObject as $index => $node )
        $out[$index] = ( is_object ( $node ) ) ? xml2array ( $node ) : $node;

    return $out;
}

function em($aCode,$aMessage) {
    $error = ["error_code"=>$aCode,"error_message"=>$aMessage];
    return json_encode($error,JSON_UNESCAPED_UNICODE);
}

function null_val($val) {
    return $val !== '' ? $val : null;
}

function ch_mlpl($array): bool
{
    foreach ($array as $value) {
        if ($value === false ){
            return false;
        }
    }
    return true;
}

function CalculateFileLines($file_name): int
{
    $line_count = 0;
    try {
        $handle = fopen($file_name, "r");
        while (!feof($handle)) {
            $line = fgets($handle);
            $line_count++;
        }
    } finally {
        if (isset($handle)) fclose($handle);
    }
    return $line_count;
}

function ReturnFirstFileLine($file_name): string
{
    $result = '';
    try {
        $handle = fopen($file_name, "r");
        if (!feof($handle)) {
            $result = fgets($handle);
        }
    } finally {
        if (isset($handle)) fclose($handle);
    }
    return $result;
}



function file_upload_max_size() {
    static $max_size = -1;

    if ($max_size < 0) {
        // Start with post_max_size.
        $post_max_size = parse_size(ini_get('post_max_size'));
        if ($post_max_size > 0) {
            $max_size = $post_max_size;
        }

        // If upload_max_size is less, then reduce. Except if upload_max_size is
        // zero, which indicates no limit.
        $upload_max = parse_size(ini_get('upload_max_filesize'));
        if ($upload_max > 0 && $upload_max < $max_size) {
            $max_size = $upload_max;
        }
    }
    return $max_size;
}

function parse_size($size) {
    $unit = preg_replace('/[^bkmgtpezy]/i', '', $size); // Remove the non-unit characters from the size.
    $size = preg_replace('/[^0-9\.]/', '', $size); // Remove the non-numeric characters from the size.
    if ($unit) {
        // Find the position of the unit in the ordered string which is the power of magnitude to multiply a kilobyte by.
        return round($size * pow(1024, stripos('bkmgtpezy', $unit[0])));
    }
    else {
        return round($size);
    }
}

class Log
{
    protected   $log;

    function __construct()
    {
        $this->log = [];
    }

    public function toLog($data) {
        $this->log[] = "[".date( "d.m.Y H:i:s")."] ". $data;
        echo $data."\n";
    }

    public function getLog()  {
        return implode(PHP_EOL,$this->log);
    }

    public function Clear() {
        $this->log = [];
    }
}
