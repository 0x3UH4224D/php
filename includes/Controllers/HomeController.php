<?php
namespace CTG\Controllers;

require_once "./includes/Controllers/PageController.php";

use \CTG\Pages\MainPage;
use \CTG\Widgets\TopNavbarBox;

class HomeController extends PageController {
    function __construct() {
        parent::__construct('بوابة مركز الموهوبين', 'ar');
    }

    static function getUrlPattern() {
        return '/';
    }

    static function run() {
        $page = new self();
        $page->handler();
        $page->render();
    }

    protected function handler() {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            echo $_POST['username'];
            echo "\n";
            echo $_POST['password'];
        }
    }

    protected function header() {
        parent::header();
        require_once "./includes/Views/top_navbar.php";
    }

    protected function body() {
        require_once "./includes/Views/home.php";
    }
}
