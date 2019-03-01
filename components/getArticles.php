<?php
/**
 * Created by PhpStorm.
 * User: Nina
 * Date: 17.02.2019
 * Time: 14:19
 */

require_once 'functions.php';
$limit = @$_GET["limit"];
$offset = @$_GET["offset"];

getArticles($limit, $offset);