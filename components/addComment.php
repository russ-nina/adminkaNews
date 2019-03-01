<?php
/**
 * Created by PhpStorm.
 * User: Nina
 * Date: 17.02.2019
 * Time: 13:37
 */

require_once 'functions.php';
$article_id = @$_POST["article_id"];
$answer_id = @$_POST["answer_id"];
$comment = @$_POST["comment"];

if(empty($_POST["answer_id"])) {
    addComment($article_id, $comment);
} else {
    addCommentAnswer($article_id, $answer_id, $comment);
};
