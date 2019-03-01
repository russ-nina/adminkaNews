<?php
/**
 * Created by PhpStorm.
 * User: Nina
 * Date: 25.02.2019
 * Time: 16:46
 */
require_once 'functions.php';
$headline = @$_POST["headline"];
$category = @$_POST["category"];
$tag = @$_POST["tag"];
$content = @$_POST["content"];
$author = @$_POST["author"];
$filter_category = @$_POST["filter_category"];
$article_id = @$_POST["article_id"];

if(empty($_POST["headline"]) || empty($_POST["category"]) || empty($_POST["tag"]) ||empty($_POST["content"]) ||empty($_POST["author"]) ||empty($_POST["filter_category"]) ||empty($_POST["article_id"])) die("error");
redactArticle($headline, $category, $tag, $content, $author, $filter_category, $article_id);
