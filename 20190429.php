<?php
session_start();
var_dump(session_name());
echo "<br>";
var_dump(session_id());
echo "<br>";
$_SESSION['name']='lily';
$_SESSION['age']=18;
echo "<br>";
var_dump($_SESSION);
//session_unset();
//session_destroy();
echo "<br>";
var_dump($_SESSION);