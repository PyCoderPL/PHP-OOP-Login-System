<?php

if (isset($_POST["submit"])) {

    $user = $_POST["user"];
    $pass = $_POST["pass"];
    $repass = $_POST["repass"];
    $email = $_POST["email"];

    include "../classes/dbh.class.php";
    include "../classes/register.class.php";
    include "../controllers/register-controller.class.php";

    $registerUser = new RegisterController($user, $pass, $repass, $email);

    $registerUser->registerUser();

    header("Location: ..?error=nonemainscript");
}
