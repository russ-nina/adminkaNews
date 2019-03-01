<?php
/**
 * Created by PhpStorm.
 * User: Nina
 * Date: 28.09.2018
 * Time: 23:03
 */
require_once 'functions.php';
$name = @$_POST["name"];
$id = @$_POST["id"];
$alias = @$_POST["alias"];
$content = @$_POST["content"];
if(empty($_POST["name"]) || empty($_POST["id"]) || empty($_POST["content"]) ||empty($_POST["alias"])) die("error");
redactPages($name, $alias, $content, $id);