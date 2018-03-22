<?php
require_once './includes/Controllers/HomeController.php';
require_once './includes/Controllers/UserRegisterController.php';
require_once './includes/Router.php';

use \CTG\Router;

// CSS Loaders
// main css loader
function main_css()
{
    header('Content-Type: text/css');
    require_once './theme/css/main.css';
}

// wave css loader
function wave_css()
{
    header('Content-Type: text/css');
    require_once './theme/css/lib/waves/waves.min.css';
}

// bootstrap css loader
function bootstrap_css()
{
    header('Content-Type: text/css');
    require_once './theme/css/lib/bootstrap/bootstrap.css';
}

// font-awesome css loader
function font_awesome()
{
    header('Content-Type: text/css');
    require_once './theme/css/lib/font-awesome/css/fontawesome.min.css';
}

// Javascript Loaders
// main javascript loader
function countDown()
{
    header('Content-Type: application/javascript');
    require_once './theme/js/countDown.js';
}

// jquery slim loader
function jquery_slim_js()
{
    header('Content-Type: application/javascript');
    require_once './theme/js/lib/bootstrap/jquery-3.2.1.slim.min.js';
}

// bootstrap js loader
function bootstrap_js()
{
    header('Content-Type: application/javascript');
    require_once './theme/js/lib/bootstrap/bootstrap.min.js';
}

// popper js loader
function popper()
{
    header('Content-Type: application/javascript');
    require_once './theme/js/lib/bootstrap/popper.min.js';
}

// use Router to handle REQUEST_URI
$router = new Router();

// add javascript files
$router->addRoute('/theme/js/lib/bootstrap/bootstrap.min.js', 'bootstrap_js');
$router->addRoute('/theme/js/lib/bootstrap/popper.min.js', 'popper');
$router->addRoute('/theme/js/lib/bootstrap/jquery-3.2.1.slim.min.js', 'jquery_slim_js');
$router->addRoute('/theme/js/countDown.js', 'countDown');

// add css files
$router->addRoute('/theme/css/lib/font-awesome/css/fontawesome.min.css', 'font_awesome');
$router->addRoute('/theme/css/lib/bootstrap/bootstrap.css', 'bootstrap_css');
$router->addRoute('/theme/css/lib/waves/waves.min.css', 'wave_css');
$router->addRoute('/theme/css/main.css', 'main_css');

// add pages
$router->addPage('\CTG\Controllers\HomeController');
$router->addPage('\CTG\Controllers\HomeController');
$router->addPage('\CTG\Controllers\UserRegisterController');

// Start the route here
$router->start($_SERVER['REQUEST_URI']);
?>
