<?php
/**
 * Created by PhpStorm.
 * User: Nina
 * Date: 28.09.2018
 * Time: 22:58
 */
require_once 'functions.php';
if(empty($_POST["id"])) die("Error");
deletePages($_POST["id"]);