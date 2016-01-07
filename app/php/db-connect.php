<?php
//$host = "localhost";
//$user = "ailyako_korch";
//$pass = "Koril4578";
//$db = "ailyako_korch";

$host = "localhost";
$user = "root";
$pass = "";
$db = "ailyako_korch";

mysql_connect($host, $user, $pass) or die(mysql_error());
mysql_select_db($db) or die(mysql_error());