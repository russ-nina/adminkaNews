<?php
/**
 * Created by PhpStorm.
 * User: Nina
 * Date: 17.02.2019
 * Time: 13:20
 */

require_once 'functions.php';
$headline = @$_POST["headline"];
$category = @$_POST["category"];
$tag = @$_POST["tag"];
$content = @$_POST["content"];
$author = @$_POST["author"];
$filter_category = @$_POST["filter_category"];

$article_id = addArticle($headline, $category, $tag, $content, $author, $filter_category);
$json = array ('article_id' => $article_id);
echo json_encode($json);



