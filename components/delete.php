<?php

require_once 'functions.php';
if(empty($_POST["id"])) die("Erroe");
deleteTitles($_POST["id"]);
