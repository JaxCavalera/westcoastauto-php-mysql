<?php

ob_start();
session_start();

function session_check()
{
	if (!empty($_SESSION['id']))
	{
		return true;
	}
	else
	{
		return false;
	}
}

$current_page = $_SERVER['SCRIPT_NAME'];


if (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER']))
{
	$http_referer = $_SERVER['HTTP_REFERER'];
}


/*Includes*/
require_once 'code/functions/connect.php';
require_once 'code/functions/user.php';
require_once 'code/functions/db.php';

?>