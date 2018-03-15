<?php
namespace CTG\Pages;

require_once "./includes/Pages/Page.php";
require_once "./includes/Widgets/Navbar.php";
require_once "./includes/Widgets/Container.php";
require_once "./includes/Widgets/Link.php";
require_once "./includes/Widgets/ListBox.php";
require_once "./includes/Widgets/Label.php";
require_once "./includes/Widgets/Image.php";
require_once "./includes/Widgets/Form.php";
require_once "./includes/Widgets/Input.php";

use \CTG\Pages\Page;
use \CTG\Widgets\Navbar;
use \CTG\Widgets\Container;
use \CTG\Widgets\Link;
use \CTG\Widgets\ListBox;
use \CTG\Widgets\Label;
use \CTG\Widgets\Image;
use \CTG\Widgets\Form;
use \CTG\Widgets\Input;

class Home extends Page {
    function __construct() {
        Page::__construct('بوابة مركز الموهوبين', 'ar');
    }

    protected function header() {
        $header = Page::header();

        $navabr = new Navbar('top_nav');
        $navabr->addLink('home-link', 'Home', '/index.php');
        $navabr->addLink('about-me-link', 'About Me', '/about-me.php');

        return $header . "\n" . $navabr->render();
    }

    protected function body() {
        $username = Input::Text('username', 'Enter your name', true);
        $password = Input::Password('password', 'Enter your password', true);
        $remember_me = Input::Checkbox('remember', 'remember_me', true);
        $submit = Input::Submit('login_btn', 'Login');

        $login_form = new Form('login', 'post');
        $login_form->add($username);
        $login_form->add($password);
        $login_form->add($remember_me);
        $login_form->add($submit);

        return $login_form->render();
    }

    function handler() {
        if (isset($_POST['username'])) {
            echo $_POST['username'];
        }
    }
}
