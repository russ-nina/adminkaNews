<?php
/**
 * Created by PhpStorm.
 * User: Nina
 * Date: 03.03.2019
 * Time: 19:41
 */
require_once 'functions.php';

$uploaddir = '../uploads';
if( ! is_dir( $uploaddir ) ) mkdir( $uploaddir, 0777 );

$files      = $_FILES;
$page_id = @$_POST["page_id"];

foreach( $files as $file ){
    $file_name = $file['name'];

    if( move_uploaded_file( $file['tmp_name'], "$uploaddir/$file_name" ) ){
        $img_path = realpath( "$uploaddir/$file_name" );
        addPageImg($page_id, $img_path);
    }
}