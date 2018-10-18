<?php
/***********************************************/
/* Module   : Request                          */
/* Author   : Hiren Master                     */
/* Purpose  : Request API Access from database */
/* Date     : 18/10/2018                       */
/***********************************************/

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


define("SERVICES",true);
$server	= ( preg_match("/192.168.0/i", $_SERVER['HTTP_HOST']) || $_SERVER['HTTP_HOST']=='localhost' )?'local':'livelocal';

require_once($_SERVER['DOCUMENT_ROOT']."/UAPI/Conf/common.php");    

global $connection;
$log=new logger();
$log->logIt("request");


$dns = "mysql:host=".$sys_mysqlhost.";dbname=".$sys_db_name;
$username = $sys_mysqluser;
$password = $sys_mysqlpwd;    
$connection=new PDO($dns,$username,$password);

@$connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$connection->setAttribute(PDO::ATTR_TIMEOUT,30);
$connection->exec("SET NAMES utf8");


$opcode="load";	

$_GET['m'] = isset($_GET['m']) ? $_GET['m'] : 'test';
$_GET['m'] = $_GET['m'] == "" ? 'test' : $_GET['m'];
$_GET['m'] = $util->safeString($_GET['m']);

$service_page =  preg_replace('/-/', '_', $_GET['m']);     


if( file_exists(BASE_PATH."/Services/".$service_page.".php")){
    require_once(BASE_PATH."/Services/".$service_page.".php");
}else{
 exit();
}

$secure_pages = array("test","users");

if( in_array($service_page, $secure_pages) ){
    $request='';
    $obj = new $service_page();
    $result=$obj->$opcode($request); 
}
?>