<?php


class Router {
    private $routes = [];
    private $notFoundRoute = null;

    function addRoute(string $pattern, $callback) {
        if (!is_callable($callback)) {
            throw new \Exception('second parameter should be callable');
        }

        $this->routesp[] = [$regex, $callback];
    }

    function addNotFoundRoute($callback) {
        if (!is_callable($callback)) {
            throw new \Exception('Not found route should be callable');
        }

        $this->notFoundRoute = $callback;
    }

    function start($url) {
        // TODO

    }
}
