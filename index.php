<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="./engine/js/main.js"></script>
<?php
require_once "./engine/config.php";
require_once "./engine/models/mysql.php";
require_once "./engine/models/users.php";

if(isset($_COOKIE['uid']) && isset($_COOKIE['token']))
{
	$GLOBALS['logged'] = checkToken($_COOKIE['uid'], $_COOKIE['token']);
}
else
	$GLOBALS['logged'] = false;

if(!isset($_GET['url'])) $_GET['url'] = "";
$_GET['url'] = strtolower($_GET['url']);

if(!$GLOBALS['logged'])
{
	switch($_GET['url'])
	{
		case "register":
		{
			include "./engine/templates/register.php";
			break;
		}
		default:
			include "./engine/templates/login.php";
	}
}

?>