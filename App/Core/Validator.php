<?php

namespace App\Core;

use App\Models\User;

class Validator
{
    private array $errors = [];
    public function validate_required(string $value, string $message)
    {
        if (empty($value)) {
            return "$message is required";
        }
        return null;
    }

    function validate_email(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Invalid email address";
        }


        // $users = (new User())->getAll();
        // foreach ($users as $user) {
        //     if ($user["email"] === $email) {
        //         return "This email is already registered";
        //     }
        // }
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
    public function validate_password(string $password)
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

    function validate_conf_pass(string $pass, string  $password_confirm)
    {
        if ($pass !== $password_confirm) {
            return " passwords  do not match ";
        }
    }
    public function registerRules(string $name, string $email, string $pass, string $password_confirm)
    {
        $data = [
            "name" => $name,
            "email" => $email,
            "pass" => $pass,
            "password_confirm" =>  $password_confirm
        ];


        foreach ($data as $label => $value) {
            if ($error = $this->validate_required($value, $label)) {
                $this->errors[$label] = $error;
            }
        }
        if ($error = $this->validate_email($email) && empty($this->errors["email"])) {

            $this->errors["email"] =  $error;


            // return $error;
        }

        if ($error = $this->validate_password($pass) && empty($this->errors["pass"])) {

            $this->errors["pass"] = $error;
            // return $error;
        }
        if ($error = $this->validate_conf_pass($pass, $password_confirm) && empty($this->errors["pass"])) {
            $this->errors["password_confirm"] = $error;

            // return $error;
        }
    }
    public function loginRules(string $email, string $pass)
    {
        $data = [
            "email" => $email,
            "pass" => $pass

        ];


        foreach ($data as $label => $value) {
            if ($error = $this->validate_required($value, $label)) {
                $this->errors[$label] = $error;
            }
        }
        if ($error = $this->validate_email($email) && empty($this->errors["email"])) {
            $this->errors["email"] =  $error;


            // return $error;
        }

        if ($error = $this->validate_password($pass) && empty($this->errors["pass"])) {

            $this->errors["pass"] = $error;
            // return $error;
        }
    }


    public function update($name, $email, $role, $phone, $id)
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
                $this->errors[$label] = $error;
            }
        }

        if ($error = $this->validate_email_update($email, $id)) {
            $this->errors["email"] = $error;
        }
        if ($error = $this->validate_phone($phone)) {
            $this->errors["phone"] = $error;
        }

        if (!in_array($role, $ALLROLE)) {
            return "Invalid role selected";
        }


        return false;
    }

    public function contact($name, $email, $mes)
    {
        $data = [
            "name" => $name,
            "email" => $email,
            "msg" => $mes
        ];
        foreach ($data as $label => $value) {
          
            if ($error = $this->validate_required($value, $label)) {
                $this->errors[$label] = $error;
            }
        }
        if ($error = $this->validate_email($email) && empty($this->errors["email"])) {

            $this->errors["email"] =  $error;


            // return $error;
        }
        return false;
    }
    public function getErrors()
    {
        return $this->errors;
    }
}
