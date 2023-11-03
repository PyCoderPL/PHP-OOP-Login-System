<?php

class RegisterController extends Register
{

    private $user;
    private $pass;
    private $repass;
    private $email;

    public function __construct($user, $pass, $repass, $email)
    {
        $this->user = $user;
        $this->pass = $pass;
        $this->repass = $repass;
        $this->email = $email;
    }

    public function registerUser()
    {
        $this->checkEmpty();
        $this->checkUser();
        $this->checkPass();
        $this->checkEmail();
        $this->checkUserTaken();
        $this->insertUser($this->user, $this->pass, $this->email);
    }

    private function checkEmpty()
    {
        if (!$this->user || !$this->pass || !$this->repass || !$this->email) {
            header("Location: ..?error=emptyfields");
            exit();
        }
    }

    private function checkUser()
    {
        if (strlen($this->user) < 3) {
            header("Location: ..?error=shortusername");
            exit();
        } elseif (!ctype_alpha($this->user)) {
            header("Location: ..?error=alphanumeric");
            exit();
        }
    }

    private function checkPass()
    {
        if (strlen($this->pass) < 3) {
            header("Location: ..?error=shortpass");
            exit();
        } elseif ($this->pass !== $this->repass) {
            header("Location: ..?error=passmatch");
            exit();
        }
    }

    private function checkEmail()
    {
        $sanitizedEmail = filter_var($this->email, FILTER_SANITIZE_EMAIL);
        if ($sanitizedEmail !== $this->email) {
            header("Location: ..?error=sanitizeemail");
            exit();
        } elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            header("Location: ..?error=validateemail");
            exit();
        }
    }

    private function checkUserTaken()
    {
        if ($this->findUser($this->user, $this->email)) {
            header("Location: ..?error=userTaken");
            exit();
        }
    }
}
