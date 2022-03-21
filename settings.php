<?php
header("Cache-Control: no-store, no-cache, must-revalidate");

ini_set("output_buffering", 0);  // off
ini_set("zlib.output_compression", 1);  // off
ini_set("implicit_flush", 1);  // on
ini_set("display_errors", 1);
error_reporting(E_ALL);
ini_set('output_buffering', 'On');

define('MYSQL_SERVER', '');
define('MYSQL_USER', '');
define('MYSQL_PASSWORD', '');
define('MYSQL_DB', '');


function db_connect(){
	$link = mysqli_connect(MYSQL_SERVER, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB)
		or die("Error: ".mysqli_error($link));
	if(!mysqli_set_charset($link, "utf8mb4")){
		printf("Error: ".mysqli_error($link));
	}
	return $link;
}

$link = db_connect();

function del_tags($txt, $tag) {
    $tags = explode(',', $tag);

    do {
        $tag = array_shift($tags);
        $txt = preg_replace("~<($tag)[^>]*>|(?:</(?1)>)|<$tag\s?/?>~x", '', $txt);
    } while (!empty($tags));

    return $txt;
}

function getRealIpAddr(){
	if(!empty($_SERVER['HTTP_CLIENT_IP'])){
		$ip=$_SERVER['HTTP_CLIENT_IP'];
	}else if (!empty($_SERVER['HTTP_X_FORWARDER_FOR'])){
		$ip=$_SERVER['HTTP_X_FORWARDER_FOR'];
	} else {
		$ip=$_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}
