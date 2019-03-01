<?php
/**
 * Created by PhpStorm.
 * User: Nina
 * Date: 19.02.2019
 * Time: 11:32
 */

require_once 'functions.php';
$name = @$_POST["name"];
$alias = @$_POST["alias"];

if(empty($_POST["name"]) || empty($_POST["alias"])) die("error");
addCategory($name, $alias);