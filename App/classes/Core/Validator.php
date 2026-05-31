<?php
namespace App\Classes\Core;
use App\Classes\Models\User;
class Validator
{
    public function validate_required($value, $messg)
    {
        if (empty($value)) {
            return "$messg is required";
        }
        return null;
    }

    public function validate_email($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Invalid email address";
        }

        $users = (new User())->getall();
        foreach ($users as $user) {
            if ($user["email"] === $email) {
                return "This email is already registered";
            }
        }
    }
    public function validate_email_update($email, $id)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Invalid email address";
        }

        $users = (new User())->getAll();

        foreach ($users as $user) {

            if ($user["id"] == $id) {
                continue;
            }

            if ($user["email"] === $email) {
                return "This email is already registered";
            }
        }

        return null;
    }

    public function validate_phone($phone)
    {
        if (!preg_match('/^01[0-9]{9}$/', $phone)) {
            return "Invalide phone";
        }
    }
    public function validate_password($password)
    {
        if (strlen($password) < 8) {
            return "Password must be at least 8 characters long";
        }

        if (!preg_match("/[A-Z]/", $password)) {
            return "Password must contain at least one uppercase letter";
        }

        if (!preg_match("/[a-z]/", $password)) {
            return "Password must contain at least one lowercase letter";
        }

        if (!preg_match("/[0-9]/", $password)) {
            return "Password must contain at least one number";
        }

        return null;
    }

    function validate_conf_pass($pass, $password_confirm)
    {
        if ($pass !== $password_confirm) {
            return " passwords  do not match ";
        }
    }
    public function registerRules($name, $email, $phone, $pass, $password_confirm)
    {
        $data = [
            "Name" => $name,
            "Email" => $email,
            "Phone" => $phone,
            "Password" => $pass,
            "Confirm Password" => $password_confirm
        ];


        foreach ($data as $label => $value) {
            if ($error = $this->validate_required($value, $label)) {
                return $error;
            }
        }
        if ($error = $this->validate_email($email)) {
            return $error;
        }
        if ($error = $this->validate_phone($phone)) {
            return $error;
        }

        if ($error = $this->validate_password($pass)) {
            return $error;
        }
        if ($error = $this->validate_conf_pass($pass, $password_confirm)) {
            return $error;
        }

        return false;
    }
    public function update($name, $email, $role, $phone,$id)
    {
        $ALLROLE = ["admin", "user", "superadmin"];
        $data = [
            "Name" => $name,
            "Email" => $email,
            "Role" => $role,
            "Phone" => $phone,
        ];


        foreach ($data as $label => $value) {
            if ($error = $this->validate_required($value, $label)) {
                return $error;
            }
        }
        if ($error = $this->validate_email_update($email, $id)) {
            return $error;
        }
        if ($error = $this->validate_phone($phone)) {
            return $error;
        }

        if (!in_array($role, $ALLROLE)) {
            return "Invalid role selected";
        }


        return false;
    }

}
