<?php
/**
 * Created by PhpStorm.
 * User: Nina
 * Date: 17.02.2019
 * Time: 14:19
 */

require_once 'functions.php';
$limit = @$_POST["limit"];
$offset = @$_POST["offset"];

echo json_encode(getArticles($limit, $offset));