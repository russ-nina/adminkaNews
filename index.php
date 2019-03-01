<?php
require_once 'modules/header.php';
?>
<?php
$rout = [
    "registr" => "./pages/registr.php",
    "auth" => "./pages/auth.php"
];
$page = @$_GET["page"];

require_once 'modules/header.php';
require_once "./components/functions.php";
$admin =@checkLoginReg($login);
if(!@$_COOKIE[$admin]){
    if (empty($page)) require_once $rout["auth"];
    else{
        if (isset($rout[$page])) require_once $rout["$page"];
        else echo 404;
    }
} else {
    header("Location:".$_SERVER['HTTP_REFERER']."blog-master/admin/");
};

?>



<?php
require_once 'modules/footer.php';
?>
