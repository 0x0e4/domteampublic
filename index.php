<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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

include "./engine/templates/login.php";

?>