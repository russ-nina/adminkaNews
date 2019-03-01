<?php
/**
 * Created by PhpStorm.
 * User: Nina
 * Date: 21.02.2019
 * Time: 11:41
 */
require_once 'functions.php';
$id = @$_POST["id"];


if(empty($id)) die("error");
echo json_encode(getIdPages($id));