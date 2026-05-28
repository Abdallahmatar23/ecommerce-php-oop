<?php

namespace App\Core;

use App\Controllers\PageController;

class App
{

    private string $page;
    private string $controller;
    private string $action;
    private array $params;

    public function __construct()
    {
        $this->prepare();
        $this->render();
    }


    private function prepare()
    {
        $url = trim(str_replace("ecommerce-db/public/", "", $_SERVER['REQUEST_URI']), "/");
        $this->page = !empty($url) ? $url : "home";
        $url = explode("/", $url);
    //    controller/method/1
        $this->controller = !empty($url[0]) ? ucwords($url[0]) . "Controller" : "";
        $this->action = isset($url[1]) ? $url[1] : "index"; // defaullt شغال ع طول لو مكتبتش  ميثود 
        unset($url[0], $url[1]);
        $this->params = !empty($url) ? array_values($url) : [];
    }
    private function render()
    {
        $controllerClass = "App\\Controllers\\{$this->controller}";
        if (class_exists($controllerClass)) {
            $controller = new $controllerClass();
            if (method_exists($controller, $this->action)) {
                call_user_func_array([$controller, $this->action], $this->params);
            } else {
                (new PageController)->show("404");
                //     echo "Method Not Exists";

            }
        } else {

            (new PageController)->show($this->page);
        }
    }
}
