<?php
/**
 * Created by PhpStorm.
 * User: Nina
 * Date: 19.02.2019
 * Time: 12:48
 */
require_once 'functions.php';
$name = @$_POST["name"];
$id = @$_POST["id"];
$alias = @$_POST["alias"];
if(empty($_POST["name"]) || empty($_POST["id"]) || empty($_POST["alias"])) die("error");
renameCategory($name, $id, $alias);