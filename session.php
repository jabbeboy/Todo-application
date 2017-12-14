<?php

session_start();

class Session
{

    private $sessionSet = false;

    function __construct()
    {
        $this->setUserStatus();
    }

    public function sessionIsSet()
    {
        return $this->sessionSet;
    }

    public function setSession($name)
    {
        $_SESSION['current_user'] = $name;
    }

    public function setUserStatus()
    {
        if (isset($_SESSION['current_user'])) {
            $this->sessionSet = true;
        } else {
            $this->sessionSet = false;
        }
    }

    public function setCurrentUser($name)
    {
        $_SESSION['current_user'] = $name;
    }

    public function unsetCurrentUser()
    {
        unset($_SESSION);
        setcookie("current_user", "", time() - 3600, "/");
        unset($_COOKIE["current_user"]);
        session_destroy();
        session_write_close();
    }
}
$session = new Session();