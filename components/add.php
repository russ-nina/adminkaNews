<?php

require_once 'functions.php';
$name = @$_POST["name"];
$content = @$_POST["content"];
$date = @$_POST["date"];

if(empty($_POST["name"]) || empty($_POST["content"]) || empty($_POST["date"])) die("error");
addTitle($name, $content, $date);

