<?php
/*********************************************/
/* Module   : Config                         */
/* Author   : Hiren Master                   */
/* Purpose  : To set database configurations */
/* Date     : 18/10/2018                     */
/*********************************************/

defined("VERSION") or define("VERSION","1.0.0.1");
global $logsPath;

defined("BASE_PATH") or define("BASE_PATH",$_SERVER['DOCUMENT_ROOT'].'/UAPI');

$logsPath = BASE_PATH.'/Logs/';

$serverurl = (isset($_SERVER["HTTPS"])?(strtolower($_SERVER["HTTPS"])=="on"?"https://":"http://"):"http://").$_SERVER['HTTP_HOST']."";

$sys_db_name = "api_challenge";
$sys_mysqlhost = "localhost";
$sys_mysqluser = "root";
$sys_mysqlpwd = "root";
$connection = "";





?>