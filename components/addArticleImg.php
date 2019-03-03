<?php
/**
 * Created by PhpStorm.
 * User: Nina
 * Date: 17.02.2019
 * Time: 13:49
 */

require_once 'functions.php';

$uploaddir = '../uploads';
if( ! is_dir( $uploaddir ) ) mkdir( $uploaddir, 0777 );

$files      = $_FILES;
$article_id = @$_POST["article_id"];

foreach( $files as $file ){
    $file_name = $file['name'];

    if( move_uploaded_file( $file['tmp_name'], "$uploaddir/$file_name" ) ){
        $img_path = realpath( "$uploaddir/$file_name" );
        addArticleImg($article_id, $img_path);
    }
}

