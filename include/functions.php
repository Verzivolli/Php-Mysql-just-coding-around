<?php

function Redirect($New_location){
    header("Location:".$New_location);
    exit;
}


?>