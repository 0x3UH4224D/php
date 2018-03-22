<?php
require_once './includes/Controllers/HomeController.php';
require_once './includes/Router.php';

use \CTG\Router;
function my_css()
{
    require_once './theme/css/main.css';
}
$router = new Router();
$router->addPage('\CTG\Controllers\HomeController');
$router->addRoute('/theme/css/main.css', 'my_css');
// $router->addRoute('\theme\css\main.css', 'my_css');
/* $router->addPage('\CTG\Pages\News');
 * $router->addPage('\CTG\Pages\AboutUs');
 * $router->addPage('\CTG\Pages\Clubs');
 * $router->addPage('\CTG\Pages\Courses'); */
$router->start($_SERVER['REQUEST_URI']);
?>
