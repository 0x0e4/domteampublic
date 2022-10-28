<head>
	<title>Объявления</title>
	<meta charset="utf-8">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
	<div style="text-align: center;">
		<?php
		$db = open_database_connection();
		$result = getHousesOfUser($_COOKIE['uid']); echo $result;
		close_database_connection($db); ?>
	</div>
</body>