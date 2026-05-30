<?php

use App\Core\Session\Session;

function showErrorField(string $field = "")
{
    if (isset($_SESSION['errors'])) {
        foreach ($_SESSION['errors'] as $key => $error) {
            if ($key == $field) {

                echo "<div class='alert alert-danger m-2 '> {$error} </div>";
                unset($_SESSION['errors'][$key]);
            }
        }
    }
}

function showMessage()
{
    if (isset($_SESSION['success'])) {
        $msg = $_SESSION['success'];
        echo "<div class='alert alert-success m-2 '> {$msg}</div>";

        unset($_SESSION['success']);
    } elseif (isset($_SESSION['error'])) {
        $msg = $_SESSION['error'];
        echo "<div class='alert alert-danger m-2 '> {$msg}</div>";

        unset($_SESSION['error']);
    }
}
function getRole()
{
    return Session::get("user")['role'] ?? null;
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
