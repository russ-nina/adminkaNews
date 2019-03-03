<?php
/**
 * Created by PhpStorm.
 * User: Nina
 * Date: 03.03.2019
 * Time: 20:23
 */
require_once 'functions.php';
$article_id = @$_POST["article_id"];
deleteArticles($article_id);