<?php
namespace CTG\Controllers;

require_once "./includes/Controllers/PageController.php";
require_once "./includes/Models/User.php";
require_once "./includes/Models/Database.php";

use \CTG\Models\User;
use \CTG\Models\Database;

class HomeController extends PageController {
    private $user_is_admin = false;
    private $user_is_loged_in = false;
    private $username = null;

    function __construct() {
        parent::__construct('بوابة مركز الموهوبين');
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
        session_start();

        $user = User::findById(2);
        var_dump($user);

        if (isset($_POST['username']) && isset($_POST['password'])) {
            echo $_POST['username'];
            echo "\n";
            echo $_POST['password'];
        }
    }

    protected function body() {
        require_once "./includes/Views/navbar.php";
        if ($this->user_is_admin) {
            require_once "./includes/Views/admin-navbar.php";
        }
        require_once "./includes/Views/home.php";
    }
}
