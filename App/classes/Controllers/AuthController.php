<?php

namespace App\Classes\Controllers;
use App\Classes\Models\User;
use App\Classes\core\Validator;
use App\Classes\Core\Session;


class AuthController
{
    private string $name;
    private string $email;
    private string $password;
    private string $conpassword;

    public function __construct()
    {

        if ($_SERVER['REQUEST_METHOD'] != "POST") {
            header("location:index.php?page=home");
            exit;
        }

        $this->name = trim($_POST["name"] ?? "");
        $this->email = trim($_POST["email"] ?? "");
        $this->password = trim($_POST["password"] ?? "");
        $this->conpassword = trim($_POST["conpassword"] ?? "");

        Session::set("data", [
            "name" => $this->name,
            "email" => $this->email,
            "password" => $this->password,
            "conpassword" => $this->conpassword
        ]);
    }

    public function register()
    {

        if (
            $error = (new Validator)->registerRules(
                $this->name,
                $this->email,
                $this->password,
                $this->conpassword
            )
        ) {
            Session::set("action", [
                "message" => $error,
                "type" => "error"
            ]);
            header("Location: index.php?page=register");
            exit;
        }

        $success = (new User())->add_user($this->name, $this->email, $this->password, "user");
        if ($success) {
            Session::set(
                "user",
                [
                    "role" => "user",
                    "id" => $success
                ]
            );

            Session::set(
                "action",
                [
                    "message" => " User registed successfully",
                    "type" => "success"
                ]
            );

            Session::remove("data");
            header("location:index.php?page=home");
            exit;
        } else {

            Session::set(
                "action",
                [
                    "message" => "invalid register",
                    "type" => "error"
                ]
            );
            header("Location: index.php?page=register");
            exit;
        }

    }

}
if ($_GET["page"] == "registercontroll") {
    (new AuthController())->register();
}

