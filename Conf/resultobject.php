<?php
/************************************************************************/
/* Module   : Result Objects                                            */
/* Author   : Hiren Master                                              */
/* Purpose  : Create Result Object for displaying result on redirection */
/* Date     : 18/10/2018                                                */
/************************************************************************/

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