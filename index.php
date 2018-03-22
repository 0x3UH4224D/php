<?php
require_once './includes/Controllers/HomeController.php';
require_once './includes/Router.php';

use \CTG\Router;


function css()
{
    header('Content-Type: text/css');
    // main
    // librarys
    require_once './theme/css/lib/bootstrap/bootstrap.css';
    require_once './theme/css/lib/font-awesome/css/fontawesome.min.css';
    require_once './theme/css/lib/waves/waves.min.css';
}

function javascript()
{
    header('Content-Type: text/javascript');
    // main
    require_once './theme/js/countDown.js';
    // library
    require_once './theme/js/lib/bootstrap/jquery-3.2.1.slim.min.js';
    require_once './theme/js/lib/bootstrap/bootstrap.min.js';
}

function popper()
{
    require_once './theme/js/lib/bootstrap/popper.min.js';
}

$router = new Router();

// pages 
$router->addPage('\CTG\Controllers\HomeController');


// theme components
    // css files
$router->addRoute('/theme/css/lib/bootstrap/bootstrap.css', 'css');
$router->addRoute('/theme/css/lib/font-awesome/css/fontawesome.min.css', 'css');
$router->addRoute('/theme/css/lib/waves/waves.min.css', 'css');
// javascript files
$router->addRoute('/theme/js/lib/bootstrap/jquery-3.2.1.slim.min.js', 'javascript');
$router->addRoute('/theme/js/lib/bootstrap/popper.min.js', 'popper');
$router->addRoute('/theme/js/lib/bootstrap/bootstrap.min.js', 'javascript');
$router->addRoute('/theme/js/countDown.js', 'javascript');





/* $router->addPage('\CTG\Pages\News');
 * $router->addPage('\CTG\Pages\AboutUs');
 * $router->addPage('\CTG\Pages\Clubs');
 * $router->addPage('\CTG\Pages\Courses'); */
$router->start($_SERVER['REQUEST_URI']);
?>
