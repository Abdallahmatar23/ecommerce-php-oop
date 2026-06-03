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
        $url = trim(str_replace("ecommerce/public/", "", $_SERVER['REQUEST_URI']), "/");
        $this->page = !empty($url) ? $url : "home";
        $url = explode("/", $url);
        $this->controller = !empty($url[0]) ? ucwords($url[0]) . "Controller" : "";
        $this->action = isset($url[1]) ? $url[1] : "index"; 
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
                (new PageController())->notFound();
            }
        } else {
            $pageController = new PageController();
            if (method_exists($pageController, $this->page)) {

                $pageController->{$this->page}();
            } else {
                $pageController->notFound();
            }
        }
    }
}
