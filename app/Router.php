<?php

declare(strict_types=1);

final class Router
{
    private array $routes = [];

    public function get(string $uri, callable|array $handler): void
    {
        $this->routes['GET'][$uri] = $handler;
    }

    public function post(string $uri, callable|array $handler): void
    {
        $this->routes['POST'][$uri] = $handler;
    }

    public function put(string $uri, callable|array $handler): void
    {
        $this->routes['PUT'][$uri] = $handler;
    }

    public function delete(string $uri, callable|array $handler): void
    {
        $this->routes['DELETE'][$uri] = $handler;
    }

    public function dispatch(
        string $method,
        string $uri
    ): void {
        $path = parse_url($uri, PHP_URL_PATH) ?? '/';

        $handler = $this->routes[$method][$path] ?? null;

        if ($handler === null) {
            http_response_code(404);
            exit('Route not found');
        }

        if (is_array($handler)) {
            [$controller, $action] = $handler;

            $instance = new $controller();

            $instance->$action();

            return;
        }

        $handler();
    }
}
