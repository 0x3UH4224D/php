<?php
namespace CTG\Pages;

require_once "./includes/Pages/Page.php";
require_once "./includes/Widgets/Navbar.php";
require_once "./includes/Widgets/Container.php";
require_once "./includes/Widgets/Link.php";
require_once "./includes/Widgets/ListBox.php";
require_once "./includes/Widgets/Text.php";
require_once "./includes/Widgets/Image.php";
require_once "./includes/Widgets/Form.php";
require_once "./includes/Widgets/Input.php";
require_once "./includes/Widgets/Separator.php";

use \CTG\Pages\Page;
use \CTG\Widgets\Navbar;
use \CTG\Widgets\Container;
use \CTG\Widgets\Link;
use \CTG\Widgets\ListBox;
use \CTG\Widgets\Text;
use \CTG\Widgets\Image;
use \CTG\Widgets\Form;
use \CTG\Widgets\Input;
use \CTG\Widgets\Separator;

class Home extends Page {
    function __construct() {
        Page::__construct('بوابة مركز الموهوبين', 'ar');
    }

    protected function header() {
        $header = Page::header();

        $navabr = new Navbar();
        $navabr->addLink('Home', '/index.php');
        $navabr->addLink('About Me', '/about-me.php');

        return $header . "\n" . $navabr->render();
    }

    protected function body() {
        $login_form = new Form('post');
        $login_form->adds(
            Text::PlainText('Username: '),
            Input::Text('username', 'Enter your name', true),
            Separator::NewLine(),
            Text::PlainText('Password: '),
            Input::Password('password', 'Enter your password', true),
            Separator::NewLine(),
            Input::Checkbox('remember', 'remember_me', true),
            Separator::NewLine(),
            Input::Submit('login_btn', 'Login'),
            new Link('Forget password', '/forget-password.php')
        );

        return $login_form->render();
    }

    function handler() {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            echo $_POST['username'];
            echo "\n";
            echo $_POST['password'];
        }
    }
}
