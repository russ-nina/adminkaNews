<?php
/**
 * Created by PhpStorm.
 * User: Nina
 * Date: 26.02.2019
 * Time: 14:44
 */
require_once 'functions.php';
$img_path = @$_POST["img_path"];

//$data = [];
//if(isset($img_path)){
//    $error = false;
//    $files = [];
//    $uploaddir = "../uploads/";
//    if(!is_dir($uploaddir)) mkdir($uploaddir, 0777);
//    foreach ($_FILES as $file){
//        if(move_uploaded_file($file['tmp_name'], $uploaddir . basename($file['name']))){
//            $files[]=$uploaddir . $file["name"];
//            addImg($uploaddir . $file["name"]);
//        } else {
//            $error = true;
//        }
//    }
//    $data = $error ? ["error" => "Ошибка загрузки файла"] : ['files'=>$files];
//    echo json_encode($data);
//}

$article_id = @$_POST["article_id"];
addArticleImg($article_id, $img_path);
