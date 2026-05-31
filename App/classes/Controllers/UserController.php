<?php
namespace App\Classes\Controllers;
use App\Classes\Models\User;
use App\Classes\core\Validator;
use App\Classes\Core\Session;



class UserController
{

    private string $name;
    private string $email;
    private string $phone;
    private string $role;
    private string $password;
    private string $conpassword;

    private const ALLROLE = ["admin", "user", "superadmin"];

    public function __construct()
    {

        if ($_SERVER['REQUEST_METHOD'] != "POST" && !isset($_GET["id"])) {
            header("location:index.php?page=AddUsers");
            exit;
        }

        $this->name = trim($_POST["name"] ?? "");
        $this->email = trim($_POST["email"] ?? "");
        $this->phone = trim($_POST["phone"] ?? "");
        $this->role = trim($_POST["role"] ?? "");
        $this->password = trim($_POST["password"] ?? "");
        $this->conpassword = trim($_POST["conpassword"] ?? "");

        Session::set("info", [
            "name" => $this->name,
            "email" => $this->email,
            "phone" => $this->phone,
            "role" => $this->role
        ]);
    }

    public function Adduser()
    {
        $error = (new Validator)->registerRules(
            $this->name,
            $this->email,
            $this->phone,
            $this->password,
            $this->conpassword
        );

        if ($error) {
            Session::set("action", [
                "message" => $error,
                "type" => "error"
            ]);

            header("Location: index.php?page=AddUsers");
            exit;
        }

        if (!in_array($this->role, self::ALLROLE)) {
            Session::set("action", [
                "message" => "Invalid role selected",
                "type" => "error"
            ]);

            header("Location: index.php?page=AddUsers");
            exit;
        }

        $success = (new User())->add_user(
            $this->name,
            $this->email,
            $this->phone,
            $this->password,
            $this->role
        );

        Session::set("action", [
            "message" => $success ? "User has been added successfully." : "Add failed",
            "type" => $success ? "success" : "error"
        ]);

        Session::remove("info");

        header("Location: index.php?page=AddUsers");
        exit;
    }


    public function deleteuser()
    {
        $id = $_GET["id"] ?? null;

        if (!$id) {
            Session::set("action", [
                "message" => "Invalid ID",
                "type" => "error"
            ]);
            header("Location: index.php?page=ViewUsers");
            exit;
        }

        $success = (new User())->deleteoneuser($id);

        Session::set("action", [
            "message" => $success ? "User deleted successfully" : "Delete failed",
            "type" => $success ? "success" : "error"
        ]);

        Session::remove("info");
        header("Location: index.php?page=ViewUsers");
        exit;
    }

    public function infouser()
    {
        $id = $_GET["id"] ?? null;

        if (!$id) {
            Session::set("action", [
                "message" => "Invalid ID",
                "type" => "error"
            ]);

            header("Location: index.php?page=ViewUsers");
            exit;
        }

        header("Location: index.php?page=update_user&id=" . $id);
        exit;
    }

    public function updateuser()
    {
        $id = $_GET["id"] ?? null;

        if (!$id) {
            Session::set("action", [
                "message" => "Invalid user ID",
                "type" => "error"
            ]);

            header("Location: index.php?page=ViewUsers");
            exit;
        }

        if (
            $error = (new Validator)->update(
                $this->name,
                $this->email,
                $this->role,
                $this->phone,
                $id
            )
        ) {
            Session::set("action", [
                "message" => $error,
                "type" => "error"
            ]);
            Session::remove("info");

            header("Location: index.php?page=update_user&id=" . $id);
            exit;
        }

        $success = (new User())->updateoneuser(
            $id,
            $this->name,
            $this->email,
            $this->role,
            $this->phone,
            date("Y-m-d H:i:s")
        );

        Session::set("action", [
            "message" => $success ? "User updated successfully" : "Update failed",
            "type" => $success ? "success" : "error"
        ]);

        header("Location: index.php?page=ViewUsers");
        exit;
    }
}


if (isset($_GET["page"]) && $_GET["page"] == "Addusercontroll") {
    (new UserController())->Adduser();
    exit;
}
if (isset($_GET["page"]) && $_GET["page"] == "deleteusercontroll") {
    (new UserController())->deleteuser();
    exit;
}
if (isset($_GET["page"]) && $_GET["page"] == "infousercontroll") {
    (new UserController())->infouser();
    exit;
}
if (isset($_GET["page"]) && $_GET["page"] == "updateusercontroll") {
    (new UserController())->updateuser();
    exit;
}

Session::set(
    "action",
    [
        "message" => "Error. Please try again.",
        "type" => "error"
    ]
);
header("location:index.php?page=dashboard");
exit;
















