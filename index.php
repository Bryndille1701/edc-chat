<?php

require_once("init.php");
var_dump(User::getUsers());
var_dump(str_pad(rand(0,'9'.round(microtime(true))),11, "0", STR_PAD_LEFT)); 
?>