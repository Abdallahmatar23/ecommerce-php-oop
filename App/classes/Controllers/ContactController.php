<?php
namespace App\Classes\Controllers;
use App\Classes\Models\Contact;
use App\Classes\core\Validator;
use App\Classes\Core\Session;



class ContactController
{

    private string $name;
    private string $email;
    private string $message;


    private const ALLROLE = ["admin", "user", "superadmin"];

    public function __construct()
    {

        if ($_SERVER['REQUEST_METHOD'] != "POST" && !isset($_GET["id"])) {
            header("location:index.php?page=AddUsers");
            exit;
        }

        $this->name = trim($_POST["name"] ?? "");
        $this->email = trim($_POST["email"] ?? "");
        $this->message = trim($_POST["message"] ?? "");


        Session::set("contact", [
            "name" => $this->name,
            "email" => $this->email,
            "message" => $this->message,
        ]);
    }


    public function create_contact()
    {
        $error = (new validator())->contact(
            $this->name,
            $this->email,
            $this->message
        );

        if ($error) {
            Session::set("action", [
                "message" => $error,
                "type" => "error"
            ]);

            header("Location: index.php?page=contact");
            exit;
        }
        $userId = $_SESSION["user"]["id"] ?? null;

        $success = (new Contact())->contactdb(
            $userId,
            $this->name,
            $this->email,
            $this->message
        );

        Session::set("action", [
            "message" => $success ? "Message sent successfully! <br>
                                    I will contact you soon." : "Contact failed",
            "type" => $success ? "success" : "error"
        ]);
        Session::remove("contact");

        header("Location: index.php?page=contact");
        exit;
    }

    public function readcontact()
    {
        if (isset($_GET["id"])) {

            (new Contact())->markAsRead($_GET["id"]);

            Session::set("action", [
                "message" => "Message marked as read successfully.",
                "type" => "success"
            ]);

            header("Location: index.php?page=ContactsUsers");
            exit;
        }

        Session::set("action", [
            "message" => "Something went wrong.",
            "type" => "error"
        ]);

        header("Location: index.php?page=ContactsUsers");
        exit;
    }
}




$page = $_GET["page"] ?? "";

$routes = [

    "contactcontroller" => "create_contact",
    "readcontactcontroll" => "readcontact",

];

if (isset($routes[$page])) {

    $method = $routes[$page];
    (new ContactController())->$method();
    exit;

}

header("location:index.php?page=404");
exit;
















