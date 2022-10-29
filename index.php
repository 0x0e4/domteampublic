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

$_GET['url'] = $_SERVER['REQUEST_URI'];
$_GET['url'] = explode("?", $_GET['url'])[0];
$_GET['url'] = strtolower($_GET['url']);

if(!$GLOBALS['logged'])
{
	switch($_GET['url'])
	{
		case "/register":
		{
			include "./engine/templates/register.php";
			break;
		}
		case "/login":
		{
			include "./engine/templates/login.php";
			break;
		}
		default:
			include "./engine/templates/main_page.php";
	}
}
else
{
	switch($_GET['url'])
	{
		case "/news":
		{
			include "./engine/templates/advers.php";
			break;
		}
		case "/addadver":
		{
			$db = open_database_connection();
			if(!isset($_GET['hid']) || !isUserManager($_COOKIE['uid'], $_GET['hid'])) include "./engine/templates/advers.php";
			else
			{
				include "./engine/templates/manager/create.php";
			}
			close_database_connection($db);
			break;
		}
		default:
			include "./engine/templates/main_page.php";
	}
}

?>