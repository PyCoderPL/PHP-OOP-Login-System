<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v=<?= time() ?>">
    <title>OOP PHP Login System</title>
</head>

<body>
    <nav>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Offer</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
        <ul class="menu-login">
            <?php if (isset($_SESSION["user"])) { ?>
                <li><a href=""><?= $_SESSION["user"] ?></a></li>
                <li><a href="includes/logout.inc.php">LOGOUT</a></li>
            <?php } else { ?>
                <li><a href="includes/showRegisterForm.php">SIGN UP</a></li>
                <li><a href="includes/showLoginForm.php">LOGIN</a></li>
            <?php } ?>
        </ul>
    </nav>

    <head></head>
    <main>
        <section>
            <?php if (isset($_GET["showform"]) and $_GET["showform"] == "register") { ?>
                <form class="register-form" action="includes/register.inc.php" method="post">
                    <input type="text" name="user" placeholder="Username">
                    <input type="password" name="pass" placeholder="Password">
                    <input type="password" name="repass" placeholder="Repeat password">
                    <input type="text" name="email" placeholder="E-mail">
                    <input type="submit" name="submit" value="SIGN UP">
                </form>
            <?php } elseif (isset($_GET["showform"]) and $_GET["showform"] == "login") { ?>
                <form class="login-form" action="includes/login.inc.php" method="post">
                    <input type="text" name="user" placeholder="Username">
                    <input type="password" name="pass" placeholder="Password">
                    <input type="submit" name="submit" value="LOGIN">
                </form>
            <?php } ?>
        </section>
    </main>
    <footer></footer>
</body>

</html>