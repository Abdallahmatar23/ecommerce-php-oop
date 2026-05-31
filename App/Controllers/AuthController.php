<?php



namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;
use App\core\Validator;
use App\Core\Session\Session;
use App\Repositories\ProductRepository;
use App\Repositories\UserRepository;


class AuthController extends Controller
{
    private string $name = '';
    private string $email = '';
    private string $password = '';
    private string $confirm_password = '';
    private ProductRepository $repo;



    public function __construct()
    {
        $repo = new UserRepository();

        // if ($_SERVER['REQUEST_METHOD'] == "POST") {

        //     $this->name = trim($_POST["name"]) ?? "";
        //     $this->email = trim($_POST["email"]) ?? "";
        //     $this->password = trim($_POST["password"]) ?? "";
        //     $this->confirm_password = trim($_POST["confirm_password"]) ?? "";

        //     Session::set("data", [
        //         "name" => $this->name,
        //         "email" => $this->email
        //     ]);
        // }
    }

    public function register()
    {

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $this->name = trim($_POST["name"]) ?? "";
            $this->email = trim($_POST["email"]) ?? "";
            $this->password = trim($_POST["password"]) ?? "";
            $this->confirm_password = trim($_POST["confirm_password"]) ?? "";
        }
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
        // if ((new Validator)->getErrors() ) {
        //     Session::set("action", [
        //         "message" => $error,
        //         "type" => "error"
        //     ]);
        //     header("Location:" . BASE_URL . "register");
        //     exit;
        // }

        $success = (new User())->add_user($this->name, $this->email, $this->password, "user");
        if ($success) {
            Session::set(
                "user",
                [
                    "role" => "user",
                    "id" => $success,

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
            header("Location:" . BASE_URL . "home");
            exit;
        } else {

            Session::set(
                "action",
                [
                    "message" => "Registration failed.",
                    "type" => "error"
                ]
            );
            header("Location:" . BASE_URL . "register");
            exit;
        }
    }

    public function login()
    {

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            Session::set("data", [
                "name" => $this->name,
                "email" => $this->email
            ]);
        }
        // Session::set("data", [
        //     "email" => $this->email
        // ]);

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
                        "id" => $user["id"],
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
                    header("location:" . BASE_URL  . "home");
                } else {
                    header("location:" . BASE_URL  . "admin");
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

        header("location:" . BASE_URL . "login");
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
        Session::removeAll();

        header("location:" . BASE_URL  . "login");
        exit;
    }
    public function users()
    {
        $users = $this->repo->getAll();
        $this->view('admin/users', ['users' => $users]);
    }
}
    
    // if ($_GET["page"] == "registercontroll") {
    //     (new AuthController())->register();
    // }
    // if ($_GET["page"] == "logincontroll") {
    //     (new AuthController())->login();
    // }
    // if ($_GET["page"] == "logoutcontroll") {
    //     (new AuthController())->logout();
    // }
