<?php

require_once "functions.php";
$rout = [
    "registr" => "../pages/registr.php",
];
$pass = @$_POST["pass"];
$login = @$_POST["login"];

if (empty($pass) || empty($login)) die("error");

$name = checkLoginReg($login);
$checkCookie = @$_COOKIE[$name];

if(!$checkCookie){
    if (checkAuth($login, $pass)) {
        setcookie($login,$pass, time()+3600*24, "/", "localhost");
        header("Location:".$_SERVER['HTTP_REFERER']."admin/");
    } else {
        require_once $rout["registr"];
    }
} else{
    echo $checkCookie;
};
