<?php

class Login extends Dbh
{
    protected function findUser($user, $pass)
    {
        $query = "SELECT pass FROM users WHERE user = ? OR email = ?;";
        $statement = $this->connect()->prepare($query);

        if (!$statement->execute(array($user, $user))) {
            $statement = null;
            header("Location: ..?error=statementfailed");
            exit();
        }

        if ($statement->rowCount() == 0) {
            $statement = null;
            header("Location: ..?error=usernotfound");
            exit();
        }

        $hashPass = $statement->fetchAll(PDO::FETCH_ASSOC);
        $checkPassword = password_verify($pass, $hashPass[0]["pass"]);

        if (!$checkPassword) {
            $statement = null;
            header("Location: ..?error=incorrectpassword");
            exit();
        } else {
            $query = "SELECT * FROM users WHERE (user = ? OR email = ?) AND pass = ?;";
            $statement = $this->connect()->prepare($query);
            if (!$statement->execute(array($user, $user, $hashPass[0]["pass"]))) {
                $statement = null;
                header("Location: ..?error=statementfailed");
                exit();
            }

            if ($statement->rowCount() == 0) {
                $statement = null;
                header("Location: ..?error=usernotfound");
                exit();
            }

            $foundUser = $statement->fetchAll(PDO::FETCH_ASSOC);
            session_start();
            $_SESSION["user"] = $foundUser[0]["user"];
        }
    }
}
