<?php

namespace App\Classes\Controllers;
use App\Classes\Models\User;
use App\Classes\core\Validator;
use App\Classes\Core\Session;


class AuthController
{
    private string $name;
    private string $email;
    private string $phone;
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
        $this->phone = trim($_POST["phone"] ?? "");
        $this->password = trim($_POST["password"] ?? "");
        $this->conpassword = trim($_POST["conpassword"] ?? "");

        Session::set("data", [
            "name" => $this->name,
            "email" => $this->email,
            "phone" => $this->phone
        ]);
    }

    public function register()
    {

        if (
            $error = (new Validator)->registerRules(
                $this->name,
                $this->email,
                $this->phone,
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

        $success = (new User())->add_user($this->name, $this->email, $this->phone, $this->password, "user");
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
                    "message" => "User registered successfully.",
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
                    "message" => "Registration failed.",
                    "type" => "error"
                ]
            );
            header("Location: index.php?page=register");
            exit;
        }

    }

    public function login()
    {
        Session::set("data", [
            "email" => $this->email
        ]);

        $users = (new User())->getAll();


        foreach ($users as $user) {

            if (
                $user["email"] === $this->email &&
                password_verify($this->password, $user["password"])
            ) {

                Session::set(
                    "user",
                    [
                        "role" => $user["role"],
                        "id" => $user["id"]
                    ]
                );

                Session::set(
                    "action",
                    [
                        "message" => "Login successful.",
                        "type" => "success"
                    ]
                );
                if (isset($_POST["remember"])) {
                    setcookie(
                        "user_id",
                        $user["id"],
                        time() + (60 * 60 * 24 * 30),
                        "/"
                    );
                    setcookie(
                        "user_role",
                        $user["role"],
                        time() + (60 * 60 * 24 * 30),
                        "/"
                    );
                }
                if ($user["role"] === "user") {
                    header("location:index.php?page=home");
                } else {
                    header("location:index.php?page=dashboard");
                }

                exit;
            }
        }

        Session::set(
            "action",
            [
                "message" => "The email or password is incorrect.",
                "type" => "error"
            ]
        );

        header("location:index.php?page=login");
        exit;
    }

    public function logout()
    {
        setcookie(
            "user_id",
            "",
            time() - 1,
            "/"
        );

        // Session::remove("user");
        Session::removeall();
        Session::set(
            "action",
            [
                "message" => "See you soon",
                "type" => "error"
            ]
        );
        header("location:index.php?page=home");
        exit;
    }

}

$page = $_GET["page"] ?? "";

$routes = [
    "registercontroll" => "register",
    "logincontroll" => "login",
    "logoutcontroll" => "logout",
];

if (isset($routes[$page])) {

    $method = $routes[$page];

    (new AuthController())->$method();
    exit;
}

Session::set(
    "action",
    [
        "message" => "Error. Please try again.",
        "type" => "error"
    ]
);

header("location:index.php?page=home");
exit;


