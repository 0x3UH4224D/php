<?php
require_once './includes/Pages/Home.php';
require_once './includes/Router.php';

use \CTG\Pages\Home;
use \CTG\Router;

$router = new Router();
$router->addPage('\CTG\Pages\Home');
/* $router->addPage('\CTG\Pages\News');
 * $router->addPage('\CTG\Pages\AboutUs');
 * $router->addPage('\CTG\Pages\Clubs');
 * $router->addPage('\CTG\Pages\Courses'); */
$router->start($_SERVER['REQUEST_URI']);
?>
