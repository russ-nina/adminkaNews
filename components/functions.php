<?php


//Подключение к базе данных
function Connection(){
    static $dbh = null;
    if($dbh !== null) return $dbh;
    $dbh = new PDO("mysql:host=localhost;dbname=myblog;charset=utf8", "root", "", [
        PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC
    ]);
    return $dbh;
}

//Получение всех значений из таблицы в базе данных
function getAllTitle(){
    $dbh = Connection();
    $stmt = $dbh -> query("Select * from `titles`");
    return $stmt->fetchAll();
}
function getAllImg(){
    $dbh = Connection();
    $stmt = $dbh -> query("Select * from `img`");
    return $stmt->fetchAll();
}
function getAllPages(){
    $dbh = Connection();
    $stmt = $dbh -> query("Select * from `page`");
    return $stmt->fetchAll();
}
function getAllCategories(){
    $dbh = Connection();
    $stmt = $dbh -> query("Select * from `categories`");
    return $stmt->fetchAll();
}

function getAllArticles(){
    $dbh = Connection();
    $stmt = $dbh -> query("Select * from `articles`");
    return $stmt->fetchAll();
}

function getArticles($limit, $offset) {
    $dbh = Connection();
    $limit = (int)$limit;
    $offset = (int)$offset;
    $stmt = $dbh -> query("Select * from `articles` ORDER BY `date` DESC LIMIT {$limit} OFFSET {$offset}");
    return $stmt->fetchAll();
}

function getTagArticles($tag) {
    $dbh = Connection();
    $tag = $dbh->quote($tag);;
    $stmt = $dbh -> query("Select * from `articles` where tag = {$tag} ORDER BY `date` DESC");
    return $stmt->fetchAll();
}

function getNumPages() {
    $dbh = Connection();
    $stmt = $dbh -> query("Select COUNT(*) FROM `articles`");
    return $stmt->fetchAll();
}

function getArticleComments($article_id, $limit, $offset) {
    $dbh = Connection();
    $article_id = $dbh->quote($article_id);
    $limit = $dbh->quote($limit);
    $offset = $dbh->quote($offset);
    $stmt = $dbh -> query("Select * from `articles_comment` WHERE `article_id` = {$article_id} LIMIT {$limit} OFFSET {$offset} ORDER BY `date` DESC");
    return $stmt->fetchAll();
}

function getArticleImg($article_id) {
    $dbh = Connection();
    $article_id = $dbh->quote($article_id);
    $stmt = $dbh -> query("Select * from `articles_img` WHERE `article_id` = {$article_id}");
    return $stmt->fetchAll();
}

//Добавление значений в таблицу базы данных

function addArticle($headline, $category, $tag, $content, $author, $filter_category) {
    $dbh = Connection();
    $headline = $dbh->quote($headline);
    $category = $dbh->quote($category);
    $tag = $dbh->quote($tag);
    $content = $dbh->quote($content);
    $author = $dbh->quote($author);
    $filter_category = $dbh->quote($filter_category);
    $dbh->query(
        "insert into `articles` (`headline`, `category`, `tag`, `content`, `author`, `filter_category`) 
          values ({$headline}, {$category}, {$tag}, {$content}, {$author}, {$filter_category});");
    return $dbh->lastInsertId();
}

function addComment($article_id, $comment) {
    $dbh = Connection();
    $article_id = $dbh->quote($article_id);
    $comment = $dbh->quote($comment);
    $dbh->exec(
        "insert into `articles_comment` (`article_id`, `comment`) 
          values ({$article_id}, {$comment});
          UPDATE articles set `comment_count` = (SELECT COUNT(*) FROM articles_comment WHERE `article_id` = {$article_id}) WHERE `article_id` = {$article_id};");
}

function addCommentAnswer($article_id, $answer_id, $comment) {
    $dbh = Connection();
    $article_id = $dbh->quote($article_id);
    $answer_id = $dbh->quote($answer_id);
    $comment = $dbh->quote($comment);
    $dbh->exec(
        "insert into `articles_comment` (`article_id`, `answer_id`, `comment`) 
          values ({$article_id}, {$answer_id}, {$comment});
          UPDATE articles set `comment_count` = (SELECT COUNT(*) FROM articles_comment WHERE `article_id` = {$article_id}) WHERE `article_id` = {$article_id};");
}

function addArticleImg($article_id, $img_path) {
    $dbh = Connection();
    $article_id = $dbh->quote($article_id);
    $img_path = $dbh->quote($img_path);
    $dbh->exec(
        "insert into `articles_img` (`article_id`, `img_path`) 
          values ({$article_id}, {$img_path})");
}

function addPageImg($page_id, $img_path) {
    $dbh = Connection();
    $page_id = $dbh->quote($page_id);
    $img_path = $dbh->quote($img_path);
    $dbh->exec(
        "UPDATE `page` SET `img_path` = {$img_path} WHERE `id` = {$page_id}");
}

function addImg($name){
    $dbh = Connection();
    $name = $dbh->quote($name);
    $dbh->exec("insert into `articles_img` (`img_path`) values ({$name})");
}
function addPages($name, $cont, $alias){
    $dbh = Connection();
    $name = $dbh->quote($name);
    $cont = $dbh->quote($cont);
    $alias = $dbh->quote($alias);
    $dbh->exec("insert into `page` (`name`, `content`, `alias`) values ({$name}, {$cont}, {$alias})");
    return $dbh->lastInsertId();
}
function addCategory($name, $alias){
    $dbh = Connection();
    $name = $dbh->quote($name);
    $alias = $dbh->quote($alias);
    $dbh->exec("insert into `categories` (`name`, `alias`) values ({$name}, {$alias})");
}

//Выборка данных по id из таблицы в базе данных
function getIdArticles($id){
    $dbh = Connection();
    $id = (int)$id;
    $stmt = $dbh -> query("Select * from `articles` where `article_id` = {$id}");
    return $stmt->fetch();
}
function getIdArt(){
    $dbh = Connection();
    $stmt = $dbh -> query("Select * from `articles` where `article_id`");
    return $stmt->fetchAll();
}
function getIdPages($id){
    $dbh = Connection();
    $id = (int)$id;
    $stmt = $dbh -> query("Select * from `page` where `id` = {$id}");
    return $stmt->fetch();
}
function getIdCategory($id){
    $dbh = Connection();
    $stmt = $dbh -> query("Select * from `categories` where id = {$id}");
    return $stmt->fetch();
}

//Удаление значений из таблицы в базе данных по id

function deleteArticles($article_id){
    $dbh = Connection();
    $article_id = (int)$article_id;
    $dbh->exec("delete from `articles` where `article_id`={$article_id}");
    $dbh->exec("delete from `articles_img` where `article_id`={$article_id}");
}
function deletePages($id){
    $dbh = Connection();
    $id = (int)$id;
    $dbh->exec("delete from `page` where `id`={$id}");
}
function deleteCategory($id){
    $dbh = Connection();
    $id = (int)$id;
    $dbh->exec("delete from `categories` where `id`={$id}");
}

//Изменение значений в таблице из базы данных по id
function redactArticle($headline, $category, $tag, $content, $author, $filter_category, $article_id){
    $dbh = Connection();
    $headline = $dbh->quote($headline);
    $category = $dbh->quote($category);
    $tag = $dbh->quote($tag);
    $content = $dbh->quote($content);
    $author = $dbh->quote($author);
    $filter_category = $dbh->quote($filter_category);
    $article_id = (int)$article_id;
    $dbh->exec("UPDATE `articles` SET `headline`= {$headline},`category`= {$category},`tag`= {$tag},`content`= {$content},`author`= {$author},`filter_category`= {$filter_category} WHERE `article_id` = {$article_id}");
}
function redactPages($name, $alias, $content, $id){
    $dbh = Connection();
    $name = $dbh->quote($name);
    $alias = $dbh->quote($alias);
    $content = $dbh->quote($content);
    $id = (int)$id;
    $dbh->exec("UPDATE `page` SET `name`= {$name},`alias`={$alias},`content`={$content} WHERE `id` = {$id}");
}
function renameCategory($name, $id, $alias){
    $dbh = Connection();
    $name = $dbh->quote($name);
    $alias = $dbh->quote($alias);
    $id = (int)$id;
    $dbh->exec("UPDATE `categories` SET `name`= {$name},`alias`={$alias} WHERE `id` = {$id}");
}

//Авторизация регистрация
function addUsers($name, $login, $pass, $mail){
    $dbh = Connection();
    $name = $dbh->quote($name);
    $login = $dbh->quote($login);
    $pass = $dbh->quote($pass);
    $mail = $dbh->quote($mail);
    $dbh->exec("insert into `user` (`name`, `login`, `pass`, `mail`) values ({$name}, {$login}, {$pass}, {$mail})");
}
function checkMailReg($mail){
    $dbh = Connection();
    $mail = $dbh->quote($mail);
    $stmt = $dbh ->query("Select * from `user` where `mail` = {$mail}");
    return $stmt->fetch();
}
function checkLoginReg($login){
    $dbh = Connection();
    $login = $dbh->quote($login);
    $stmt = $dbh -> query("Select * from `user` where `login` = {$login}");
    return $stmt->fetch();
}
function checkAuth($login, $pass){
    $dbh = Connection();
    $login = $dbh->quote($login);
    $pass = $dbh->quote($pass);
    $stmt = $dbh -> query("Select * from `user` where `login` = {$login} and `pass` = {$pass}");
    return $stmt->fetch();
}
