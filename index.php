<?php
require_once './includes/Controllers/HomeController.php';
require_once './includes/Router.php';

use \CTG\Router;

$router = new Router();
$router->addPage('\CTG\Controllers\HomeController');
/* $router->addPage('\CTG\Pages\News');
 * $router->addPage('\CTG\Pages\AboutUs');
 * $router->addPage('\CTG\Pages\Clubs');
 * $router->addPage('\CTG\Pages\Courses'); */
$router->start($_SERVER['REQUEST_URI']);
?>
