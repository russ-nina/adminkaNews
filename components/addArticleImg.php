<?php
/**
 * Created by PhpStorm.
 * User: Nina
 * Date: 17.02.2019
 * Time: 13:49
 */

require_once 'functions.php';
$article_id = @$_POST["article_id"];
$img = @$_POST["img"];

addArticleImg($article_id, $img);
