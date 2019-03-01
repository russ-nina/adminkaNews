<?php

require_once 'functions.php';
$data = [];
if(isset($_GET['uploadfiles'])){
    $error = false;
    $files = [];
    $uploaddir = "../uploads/";
    if(!is_dir($uploaddir)) mkdir($uploaddir, 0777);
    foreach ($_FILES as $file){
        if(move_uploaded_file($file['tmp_name'], $uploaddir . basename($file['name']))){
            $files[]=$uploaddir . $file["name"];
            addImg($uploaddir . $file["name"]);
        } else {
            $error = true;
        }
    }
    $data = $error ? ["error" => "Ошибка загрузки файла"] : ['files'=>$files];
    echo json_encode($data);
}
