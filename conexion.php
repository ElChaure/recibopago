<?php
$dbconn = pg_connect("host=localhost dbname=talento_humano user=postgres password=123456")
	        or die('Could not connect: ' . pg_last_error());
?>
