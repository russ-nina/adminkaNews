<?php
/**
 * Created by PhpStorm.
 * User: Nina
 * Date: 17.02.2019
 * Time: 14:22
 */

require_once 'functions.php';
$article_id = @$_GET["article_id"];

getArticleImg($article_id);