<?php
/**
 * Created by PhpStorm.
 * User: Nina
 * Date: 28.09.2018
 * Time: 20:47
 */
require_once 'functions.php';
$name = @$_POST["name"];
$content = @$_POST["content"];
$alias = @$_POST["alias"];

if(empty($_POST["name"]) || empty($_POST["content"]) || empty($_POST["alias"])) die("error");
addPages($name, $content, $alias);