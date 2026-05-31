<?php

use App\Core\Session\Session;

function showMessage(string $field = "")
{
    if (isset($_SESSION['errors'])) {
        foreach ($_SESSION['errors'] as $key => $error) {
            if ($key == $field) {

                echo "<div class='alert alert-danger m-2 '> {$error} </div>";
                // echo "<div class='alert alert-danger m-2 '> {$error[0]} </div>";
                unset($_SESSION['errors'][$key]);
            }
        }
    } elseif (isset($_SESSION['success'])) {
        $msg = $_SESSION['success'];
        echo "<div class='alert alert-success m-2 '> {$msg}</div>";

        unset($_SESSION['success']);
    }
}
function getErrors()
{
    $errors = $_SESSION['errors'] ?? [];
    unset($_SESSION['errors']);
    return $errors;
}
function showIndexedMessage(string $field = ''): void
{
    $errors = $_SESSION['errors'] ?? [];

    if ($field && !empty($errors[$field])) {

        echo '
            <div class="alert alert-danger py-2 px-3 mt-2 mb-0">
                <strong>
                    <i class="bi bi-exclamation-triangle-fill me-1"></i>
                    Error:
                </strong>
                ' . htmlspecialchars($errors[$field][0]) . '
            </div>
        ';
    }

    if (!$field && !empty($_SESSION['success'])) {

        echo '
            <div class="alert alert-success py-2 px-3 mt-2 mb-3">
                <strong>
                    <i class="bi bi-check-circle-fill me-1"></i>
                    Success:
                </strong>
                ' . htmlspecialchars($_SESSION['success']) . '
            </div>
        ';

        unset($_SESSION['success']);
    }
}
function showSuccessMessage(): void
{
    if (!empty($_SESSION['success'])) {

        echo '
            <div class="alert alert-success py-2 px-3 mt-2 mb-3">
                <center><strong>
                    <i class="bi bi-check-circle-fill me-1"></i>
                    Success:
                </strong></center>
                ' . htmlspecialchars($_SESSION['success']) . '
            </div>
        ';

        unset($_SESSION['success']);
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
