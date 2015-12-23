<?php
$host = "localhost";
$user = "ailyako_korch";
$pass = "4578rtui40507080";
$db = "ailyako_korch";

mysql_connect($host, $user, $pass) or die(mysql_error());
mysql_select_db($db) or die(mysql_error());