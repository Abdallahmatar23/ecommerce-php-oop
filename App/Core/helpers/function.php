<?php

use App\Core\Session\Session;

function showMessage(string $field = "")
{
    if (isset($_SESSION['errors'][$field])) {
        foreach ($_SESSION['errors'][$field] as $error) {
            echo "<div class='alert alert-danger m-2 '> {$error} </div>";
        }
        unset($_SESSION['errors'][$field]);
    } elseif (isset($_SESSION['error'])) {
        $msg = $_SESSION['error'];
        echo "<div class='alert alert-danger m-2 '> {$msg} </div>";
        unset($_SESSION['error']);
    } elseif (isset($_SESSION['success'])) {
        $msg = $_SESSION['success'];
        echo "<div class='alert alert-success m-2 '> {$msg}</div>";

        unset($_SESSION['success']);
    }
}

function getRole()
{
    return getUser()['role'] ?? null;
}

function getUser()
{
    return Session::getSession("user") ?? null;
}

function isAdmin()
{
    if (getRole() === 'admin') {
        return true;
    }
    return false;
}


function redirect(string $path): void
{
    header("Location:" . BASE_URL . $path);
    exit;
}
