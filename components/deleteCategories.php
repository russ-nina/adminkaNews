<?php
/**
 * Created by PhpStorm.
 * User: Nina
 * Date: 19.02.2019
 * Time: 12:42
 */
require_once 'functions.php';
if(empty($_POST["id"])) die("Erroe");
deleteCategory($_POST["id"]);