<?php
// Initialize the session
require_once('./services/database.php');

session_start();

function checkAuth($email, $password)
{
    $user = DatabaseService::getInstance()->checkUser($email, $password);
    if ($user) {
        setSesstion($user);
        return true;
    } else {
        return "Email is not valid";
    }
}

function setSesstion($user)
{
    $_SESSION["user"] = $user;
}

function logoutSesstion()
{
    $_SESSION["user"] = null;
}
