<?php

require_once dirname(dirname(__FILE__)).'/config.php';

function open_database_connection()
{
	try {
    	$link = new PDO("mysql:host=".MYSQL_HOST.";dbname=".MYSQL_DB, MYSQL_USER, MYSQL_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    }
    catch (PDOException $e) {
		die("Невозможно подключиться к базе данных!");
	}

    return $link;
}

function close_database_connection(&$link)
{
    $link = null;
    return true;
}

?>