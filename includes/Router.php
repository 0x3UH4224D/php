<?php
namespace CTG;

class Router {
    private $routes = [];
    private $notFoundRoute = null;

    function addRoute(string $pattern, callable $callback) {
        $this->routes[$pattern] = $callback;
    }

    function addPage($page) {
        $url_pattern = call_user_func($page . '::getUrlPattern');
        $this->addRoute($url_pattern, $page . '::run');
    }

    function setNotFoundRoute(callable $callback) {
        $this->notFoundRoute = $callback;
    }

    function setNotFoundPage($page) {
        $this->setNotFoundPage($page . '::run');
    }

    function getProperUrl($url) {
        $parent_path = str_replace($_SERVER['DOCUMENT_ROOT'], '', getcwd());
        return str_replace($parent_path, '', $url);
    }

    function convertUrlToPattern($url) {
        $pattern = $url;

        while (true) {
            $new_value = preg_replace('/\/:[a-zA-Z][a-zA-Z0-9_-]+\//',
                                      '/[a-zA-Z0-9_-]+/',
                                      $pattern);
            if (is_null($new_value)) {
                break;
            }

            if ($new_value == $pattern) {
                break;
            }
            
            $pattern = $new_value;
        }
        
        $pattern = str_replace('/', '\/', $pattern);
        $pattern = '/^' . $pattern . '$/';
        return $pattern;
    }

    function start($url) {
        $url = $this->getProperUrl($url);
        
        foreach ($this->routes as $pattern => $callback) {
            $page_url_pattern = $this->convertUrlToPattern($pattern);
            // echo $pattern . "<br>" . $page_url_pattern . "<br>" . $url; 
            if (preg_match($page_url_pattern, $url)) {
                call_user_func($callback);
                return;
            }
        }
    }
}
