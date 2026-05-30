<?php



namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;
use App\Core\Validator;
use App\Core\Session\Session;


class AuthController extends Controller
{
    private string $name;
    private string $email;
    private string $password;
    private string $confirm_password;



    public function __construct()
    {

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $this->name = trim($_POST["name"] ?? "");
            $this->email = trim($_POST["email"] ?? "");
            $this->password = trim($_POST["password"] ?? "");
            $this->confirm_password = trim($_POST["confirm_password"] ?? "");

            Session::set("data", [
                "name" => $this->name,
                "email" => $this->email
            ]);
        }
    }

    public function register()
    {
        $validator = new Validator();
        $validator->registerRules(
            $this->name,
            $this->email,
            $this->password,
            $this->confirm_password
        );
        if (!empty($validator->getErrors())) {
            Session::set("errors", $validator->getErrors());
            redirect("register");
        }
        $success = (new User())->add_user($this->name, $this->email, $this->password, "user");
        if ($success) {
            Session::set(
                "user",
                [
                    "role" => "user",
                    "id" => $success,

                ]
            );
            Session::set("success", "User registered successfully.");


            Session::remove("data");
            header("Location:" . BASE_URL . "register");
            exit;
        } else {
            Session::set("error", "User registered successfully.");

            header("Location:" . BASE_URL . "register");
            exit;
        }
    }

    public function login()
    {

        $validator = new Validator();
        $validator->loginRules(
            $this->email,
            $this->password
        );
        if (!empty($validator->getErrors())) {

            Session::set("errors", $validator->getErrors());
            redirect("login");
        } else {
            Session::set("data", [
                "email" => $this->email
            ]);

            $users = (new User())->getAll();

            foreach ($users as $user) {
                if ($user["email"] == $this->email && password_verify($this->password, $user["password"])) {
                    Session::set(
                        "user",
                        [
                            "role" => $user["role"],
                            "id" => $user["id"],
                        ]
                    );
                    Session::set("success", "Login successful.");

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
                        redirect("home");
                    } else {
                        redirect("admin");
                    }
                }
            }
        }
        Session::set("error", "The email or password is incorrect.");
        redirect("login");
    }


    public function logout()
    {

        setcookie(
            "user_id",
            "",
            time() - 1,
            "/"
        );
        Session::removeAll();

        header("location:" . BASE_URL  . "login");
        exit;
    }
}
    
   
