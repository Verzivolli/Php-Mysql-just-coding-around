<?php
date_default_timezone_set("Europe/Rome");
$CurrentTime = time();
$DateTime = strftime("%d-%B-%Y %H:%M:%S" , $CurrentTime);
echo $DateTime;
?>