<?php

require_once dirname(__FILE__)."/mysql.php";
require_once dirname(__FILE__)."/main.php";
require_once dirname(__FILE__)."/users.php";

function isHouseValid(&$id)
{
	return isInt($id) && $db->query("SELECT COUNT(`id`) FROM `houses` WHERE `id`={$id}")->fetchColumn() > 0;
}

?>