<?php
namespace app\core;

class App
{

    private $routes = [];

    public function addRoute($url, $handler) {
        $url = preg_replace('/{([^\/]+)}/', '(?<$1>[^\/]+)', $url);
        $this->routes[$url] = $handler;
    }
    function __construct()
    {
        //call the appropriate controller class and method to handle the HTTP Request
        // $this->addRoute('Person/edit/{id}', 'Person,edit');
        // print_r($this->routes);
        // exit();

        //routing version 0.1
        $url = $_GET['url'];

        $routes = ['Person/register' => 'Person,register',
                    'Person/complete_registration' => 'Person,complete_registration',
                    'Person/' => 'Person,list',
                    'Person/delete' => 'Person,delete',
                    'Person/edit' => 'Person,edit',
                    'Person/update' => 'Person,update'];

        //one by one compare the url to resolve the route
        
        foreach($routes as $routeUrl => $controllerMethod) {
            if ($url == $routeUrl) { //match the route
                [$controller, $method] = explode(',' , $controllerMethod);
                $controller = '\\app\\controllers\\'.$controller;
                $controller = new $controller();
                $controller->$method();
                //make sure that we don't run a second route
                break;
            }
        }
    }
}