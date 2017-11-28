<?php

$hostname="mysql4.gear.host";
$database="phpcms";
$username="phpcms";
$password="Iu8EV6-!DL4r";

$link = mysqli_connect($hostname, $username, $password);
$db_selected = mysqli_select_db($link, $database);

?>