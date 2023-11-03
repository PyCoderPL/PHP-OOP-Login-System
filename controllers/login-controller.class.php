<?php

class LoginController extends Login
{
    private $user;
    private $pass;

    public function __construct($user, $pass)
    {
        $this->user = $user;
        $this->pass = $pass;
    }

    public function selectUser()
    {
        $this->isEmpty();
        $this->isAlphanumeric();
        $this->findUser($this->user, $this->pass);
    }


    private function isEmpty()
    {
        if (!$this->user || !$this->pass) {
            header("Location: ..?error=emptyfields");
            exit();
        }
    }

    private function isAlphanumeric()
    {
        if (!ctype_alnum($this->user)) {
            header("Location: ..?error=alphanumeric");
            exit();
        }
    }
}
