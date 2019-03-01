<?php

?>
<h2>Регистрация</h2>
<form action="./components/new_user.php" method="post">
    <input type="text" name="mail" placeholder="mail">
    <input type="text" name="login" placeholder="login">
    <input type="text" name="name" placeholder="name">
    <input type="text" name="pass" placeholder="password">
    <input type="submit">
</form>
<a href="./?page=auth">Авторизация</a>
