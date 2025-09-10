<?php
// app/core/router.php
namespace MVC;

class Router {
    protected $routes = [];
    protected $db; // guardamos la conexión aquí

    public function __construct($db) {
        $this->db = $db; // inicializamos la conexión
    }

    // Método para añadir rutas
    protected function addRoute($method, $route, $target) {
        $this->routes[$method][$route] = $target;
    }

    // Métodos HTTP
    public function get($route, $target) {
        $this->addRoute('GET', $route, $target);
    }

    public function post($route, $target) {
        $this->addRoute('POST', $route, $target);
    }

    public function put($route, $target) {
        $this->addRoute('PUT', $route, $target);
    }

    // Ejecutar ruta
    public function dispatch($request_uri) {
        $request_uri = strtok($request_uri, '?');
        $request_uri = trim($request_uri, '/');
        $request_method = $_SERVER['REQUEST_METHOD'];

        if (isset($this->routes[$request_method][$request_uri])) {
            $target = $this->routes[$request_method][$request_uri];
            list($controllerName, $method) = $target;

            // Construir la clase con namespace
            $controllerClass = 'Controllers\\' . $controllerName;

            // Composer autoload manejará require automáticamente
            if (class_exists($controllerClass)) {
                $controllerInstance = new $controllerClass($this->db); // ahora $db sí está disponible

                if (method_exists($controllerInstance, $method)) {
                    $controllerInstance->$method();
                } else {
                    echo "Error: Método '{$method}' no encontrado en '{$controllerClass}'.";
                }
            } else {
                echo "Error: Clase '{$controllerClass}' no encontrada.";
            }
        } else {
            echo "<h1>404 - Página no encontrada</h1>";
        }
    }
}
