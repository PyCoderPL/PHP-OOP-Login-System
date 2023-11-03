<?php

class Register extends Dbh
{
    protected function insertUser($user, $pass, $email)
    {
        $hashPass = password_hash($pass, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (user, pass, email) VALUES (?, ?, ?);";
        $statement = $this->connect()->prepare($query);
        if (!$statement->execute(array($user, $hashPass, $email))) {
            $statement = null;
            header("Location: ..?error=statementfailed");
            exit();
        }
        $statement->closeCursor();
        header("Location: ..?error=inserted");
    }

    protected function findUser($user, $email)
    {
        $query = "SELECT * FROM users WHERE user = ? OR email = ?;";
        $statement = $this->connect()->prepare($query);

        if (!$statement->execute(array($user, $email))) {
            $statement = null;
            header("Location: ..?error=statementfailed");
            exit();
        }

        if ($statement->rowCount() > 0) {
            $statement = null;
            header("Location: ..?error=usertaken");
            exit();
        }
    }
}
