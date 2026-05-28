<?php


namespace App\Services;

use App\Core\Validator\AuthValidation;
use App\Models\User;

class AuthService
{
    private AuthValidation $auth_validation;
    public function __construct()
    {
        $this->auth_validation = new AuthValidation();
    }


    public  function register(array $data)
    {
        $errors =  $this->auth_validation->validate(
            $data,
            [
                'name' => ["required", "string", "min:5", "max:20"],
                'email' => ["required", "email"],
                'phone' => ["required", "phone"],
                'password' => ["required", "password", "min:8"]
            ]
        );
        if (!empty($errors)) {
            return $errors;
        }

        $user = new User();
        $user->add($data['name'], $data['email'], $data['password'], $data['phone']);
        return;
    }


    public function login(array $data)
    {
        $errors = $this->auth_validation->validate(
            $data,
            [
                'email' => ["required", "email"],
                'password' => ["required", "password", "min:8"]
            ]
        );

        if (!empty($errors)) {
            return ["error", $errors];
        } else {
            $user = (new User)->getUser($data['email']);
          
            if ($user) {
                if ($data['email'] === $user['email'] && password_verify($data['password'], $user['password'])) {
                    return ["user", $user];
                } else {

                    return ["failed", "email or password incorrect"];
                }
            } else {

                return ["failed", "email not found "];
            }
        }
    }
}
