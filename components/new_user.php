<?php

require_once 'functions.php';

$name = $_POST["name"];
$pass = $_POST["pass"];
$login = $_POST["login"];
$mail = $_POST["mail"];

if(empty($name) || empty($pass) || empty($login) || empty($mail)) die("error");

if(!checkMailReg($mail)){
    if(!checkLoginReg($login)){
        addUsers($name, $login, $pass, $mail);
        header("Location:".$_SERVER["HTTP_REFERER"]);
    } else {
        echo "login reserv";
    }
} else {
    echo "mail reserv";
}



