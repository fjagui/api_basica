<?php
namespace App\Core;

class Router
{
    /** @var Route[] */
    /*contiene nombre, ruta y array con controlador y accioón*/ 
    private $routes = array();

    public function add($route )
    {
        $this->routes[] = $route;
    }

    public function match(string $request)
    {
 
    $matches=array();
    foreach ($this->routes as $route) {
        $patron=$route['path'];
        if (preg_match($patron, $request)){
            
            $matches = $route;
        }
        
    }
 
    return $matches;    
    }

/*
    public function handleRequest(string $request)
    {
        $matches = [];
        foreach ($this->routes as $route) {
            if (preg_match($route->path, $request, $matches)) {
                // $matches[0] will always be equal to $request, so we just shift it off
                array_shift($matches);
                // here comes the magic
                $class = new ReflectionClass($route->controller);
                $method = $class->getMethod($route->method);
                // we instantiate a new class using the elements of the $matches array
                $instance = $class->newInstance(...$matches);
                // equivalent:
                // $instance = $class->newInstanceArgs($matches);
                // then we call the method on the newly instantiated object
                $method->invoke($instance);
                // finally, we return from the function, because we do not want the request to be handled more than once
                return;
            }
        }
        throw new RuntimeException("The request '$request' did not match any route.");
    }*/
}