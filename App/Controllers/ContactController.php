<?php

namespace App\Controllers;

use App\Models\Contact;
use App\Core\Controller;
use App\Core\Session\Session;
use App\Core\Validator;



class ContactController extends Controller
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
        } else {
            $this->name = trim($_POST["name"] ?? "");
            $this->email = trim($_POST["email"] ?? "");
            $this->message = trim($_POST["msg"] ?? "");

            Session::set("contact", [
                "name" => $this->name,
                "email" => $this->email,
                "message" => $this->message,
            ]);
        }
    }


    public function create_contact()
    {

        $validator = new Validator();

        $validator->contact(
            $this->name,
            $this->email,
            $this->message
        );

        if (!empty($validator->getErrors())) {
            Session::set("errors", $validator->getErrors());
            redirect("page/contact");
        }
        $userId = $_SESSION["user"]["id"] ?? null;

        $success = (new Contact())->contactToDb(
            $userId,
            $this->name,
            $this->email,
            $this->message
        );
        if ($success) {
            Session::set("success", "Message sent successfully! <br> I will contact you soon.");
        } else {
            Session::set("error",  "Contact failed");
        }

        Session::remove("contact");

        header("Location:" . VIEWS . "store/contact");
        exit;
    }

    public function readcontact()
    {
        if (isset($_GET["id"])) {

            (new Contact())->markAsRead($_GET["id"]);

            Session::set("success", "Message marked as read successfully.");

            header("Location: " . VIEWS . "admin/ContactsUsers");
            exit;
        }

        Session::set("error", "Something went wrong.");

        header("Location: " . VIEWS . "admin/ContactsUsers");
        exit;
    }
}




// $page = $_GET["page"] ?? "";

// $routes = [

//     "contactcontroller" => "create_contact",
//     "readcontactcontroll" => "readcontact",

// ];

// if (isset($routes[$page])) {

//     $method = $routes[$page];
//     (new ContactController())->$method();
//     exit;
// }

// header("location:index.php?page=404");
// exit;
