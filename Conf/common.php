<?php
/*********************************************/
/* Module   : Common                         */
/* Author   : Hiren Master                   */
/* Purpose  : To set common configurations   */
/* Date     : 18/10/2018                     */
/*********************************************/

require_once("config.php");
require_once(BASE_PATH."/Util/logger.php");
require_once(BASE_PATH."/Util/util.php");
require_once(BASE_PATH."/Dbaccess/dao.php");	

$log = new logger();
global $log;

$util = new util();

class resultConstant
{
	const Success	='Success';
	const Error		='Error';
	const Warning	='Warning';
}

class resultobject
{
	public $resultStatus;
	public $resultData;
	
	function __construct()
	{
		$resultStatus = resultConstant::Success;
		$resultData = array();		
	}
}
?>