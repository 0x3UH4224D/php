<?php
require_once './includes/Controllers/HomeController.php';
require_once './includes/Controllers/UserRegisterController.php';
require_once './includes/Router.php';

use \CTG\Router;
<<<<<<< HEAD
$router = new Router();

// pages 
$router->addPage('\CTG\Controllers\HomeController');




/* theme components */
# css files

    // main css
    function main_css()
    {
        header('Content-Type: text/css');
        require_once './theme/css/main.css';
    }
    $router->addRoute('/theme/css/main.css', 'main_css');

    // library

    // wave css
    function wave_css()
    {
        header('Content-Type: text/css');
        require_once './theme/css/lib/bootstrap/bootstrap.css';
        require_once './theme/css/lib/waves/waves.min.css';
    }
    $router->addRoute('/theme/css/lib/waves/waves.min.css', 'wave_css');

    // bootstrap css
    function bootstrap_css()
    {
        header('Content-Type: text/css');
        require_once './theme/css/lib/bootstrap/bootstrap.css';
    }
    $router->addRoute('/theme/css/lib/bootstrap/bootstrap.css', 'bootstrap_css');

    // font-awesome css
    function font_awesome()
    {
        header('Content-Type: text/css');
        require_once './theme/css/lib/font-awesome/css/fontawesome.min.css';
    }
    $router->addRoute('/theme/css/lib/font-awesome/css/fontawesome.min.css', 'font_awesome');
    



# javascript files

    // main javascript
    function countDown()
    {
        header('Content-Type: text/javascript');
        require_once './theme/js/countDown.js';
    }

    $router->addRoute('/theme/js/countDown.js', 'countDown');

    // library

    // jquery slim 
    function jquery_slim_js()
    {
        header('Content-Type: text/javascript');
        require_once './theme/js/lib/bootstrap/jquery-3.2.1.slim.min.js';
        
    }
    $router->addRoute('/theme/js/lib/bootstrap/jquery-3.2.1.slim.min.js', 'jquery_slim_js');

    // bootstrap js
    function bootstrap_js()
    {
        header('Content-Type: text/javascript');
        require_once './theme/js/lib/bootstrap/bootstrap.min.js';
    }
    $router->addRoute('/theme/js/lib/bootstrap/bootstrap.min.js', 'bootstrap_js');

    function popper()
    {
        header('Content-Type: text/javascript');
        require_once './theme/js/lib/bootstrap/popper.min.js';
    }
    $router->addRoute('/theme/js/lib/bootstrap/popper.min.js', 'popper');

    





=======

function my_css() {
    header('Content-Type: text/css');
    require_once './theme/css/main.css';
}

$router = new Router();
$router->addRoute('/theme/css/main.css', 'my_css');
$router->addPage('\CTG\Controllers\HomeController');
$router->addPage('\CTG\Controllers\UserRegisterController');
>>>>>>> 64ceafab4023e90d79d6a46526b881dac51a810d
/* $router->addPage('\CTG\Pages\News');
 * $router->addPage('\CTG\Pages\AboutUs');
 * $router->addPage('\CTG\Pages\Clubs');
 * $router->addPage('\CTG\Pages\Courses'); */
$router->start($_SERVER['REQUEST_URI']);
?>
