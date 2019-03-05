<?php

require_once 'functions.php';
$tag = @$_GET["tag"];

$articles = getTagArticles($tag);
$result = array();

foreach( $articles as $article ){
    $resArticle = array(
        "id" => $article["article_id"],
        "sumcomments" => $article["comment_count"],
        "slides_img" => getArticleImg($article["article_id"]),
        "headline" => $article["headline"],
        "info" => array(
            "date" => $article["date"],
            "author" => $article["author"],
            "rank" => $article["category"],
            "tags" => $article["tag"]
        ),
        "text" => $article["content"]
    );
    array_push ($result, $resArticle);
}

echo json_encode($result);

//http://localhost/adminkaNews/components/searchTag.php?tag=Women
//SELECT * FROM `articles` WHERE `headline` LIKE "% world %"