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
    }

    protected function body() {
        require_once './includes/Views/user-register.php';
    }
}
