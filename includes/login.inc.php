<?php

if (isset($_POST["submit"])) {

    $user = $_POST["user"];
    $pass = $_POST["pass"];

    include "../classes/dbh.class.php";
    include "../classes/login.class.php";
    include "../controllers/login-controller.class.php";

    $loginUser = new LoginController($user, $pass);

    $loginUser->selectUser();

    header("Location: ..?error=noneloginscript");
}
