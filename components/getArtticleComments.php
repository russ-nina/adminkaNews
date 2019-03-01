<?php
/**
 * Created by PhpStorm.
 * User: Nina
 * Date: 17.02.2019
 * Time: 14:21
 */

require_once 'functions.php';
$article_id = @$_GET["article_id"];
$limit = @$_GET["limit"];
$offset = @$_GET["offset"];

getArticleComments($article_id, $limit, $offset);