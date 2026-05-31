<?php

namespace App\Core;

use App\Models\User;

class Validator
{
    private array $errors = [];
    public function validate_required(string $fieldName, mixed $val)
    {
        if (empty($val)) {
            return "$fieldName is required";
        }
        return null;
    }

    function validate_email(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Invalid email address";
        }


        $users = (new User())->getAll();
        foreach ($users as $user) {
            if ($user["email"] === $email) {
                return "This email is already registered";
            }
        }
        return null;
    }

    public function validate_password(string $password)
    {
        if (empty($password)) {
            return "Password must be at least 8 characters long\n
                and include uppercase, lowercase,\n
                number, and special character.";
        }
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


        foreach ($data as $fieldName => $value) {
            if ($error = $this->validate_required($fieldName, $value)) {
                $this->errors[$fieldName][] = $error;
            }
        }
        // if ($error = $this->validate_email($email) && empty($this->errors["email"])) {
        if ($error = $this->validate_email($email)) {

            $this->errors["email"][] =  $error;
            // return $error;
        }

        if ($error = $this->validate_password($pass)) {

            $this->errors["pass"][] = $error;
            // return $error;
        }
        if ($error = $this->validate_conf_pass($pass, $password_confirm)) {
            $this->errors["password_confirm"][] = $error;
        }
        return $this->errors;
    }
    public function getErrors()
    {
        return $this->errors;
    }
}
