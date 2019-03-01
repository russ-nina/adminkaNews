<?php
/**
 * Created by PhpStorm.
 * User: Nina
 * Date: 25.02.2019
 * Time: 14:29
 */
require_once 'functions.php';
$id = @$_POST["id"];


if(empty($id)) die("error");
echo json_encode(getIdArticles($id));