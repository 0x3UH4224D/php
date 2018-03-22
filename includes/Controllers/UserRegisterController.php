<?php
namespace CTG\Controllers;

require_once "./includes/Controllers/PageController.php";

use \CTG\Pages\MainPage;
use \CTG\Widgets\TopNavbarBox;

class LogginForm {
    private $username = null;
    private $email = null;
    private $phone = null;
    private $password = null;
}

class UserRegisterController extends PageController {
    private $user_is_loged_in = false;
    private $formdata;

    function __construct() {
        parent::__construct('تسجيل عضو جديد');
        $this->formdata = new LogginForm();
    }

    static function getUrlPattern() {
        return '/new-member/';
    }

    static function run() {
        $page = new self();
        $page->handler();
        $page->render();
    }

    protected function handler() {
        $username = isset($_POST['username']) ? $_POST['username'] : null;
        $email = isset($_POST['email']) ? $_POST['email'] : null;
        $password = isset($_POST['password']) ? $_POST['password'] : null;
        $phone = isset($_POST['phone']) ? $_POST['phone'] : null;
        echo $username . "<BR>";
        echo $email . "<BR>";
        echo $password . "<BR>";
        echo $phone . "<BR>";


    }

    protected function body() {
        require_once './includes/Views/user-register.php';
    }
}
