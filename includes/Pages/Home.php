<?php
namespace CTG\Pages;

require_once "./includes/Pages/Page.php";
require_once "./includes/Widgets/Navbar.php";
require_once "./includes/Widgets/LoginBox.php";

use \CTG\Pages\Page;
use \CTG\Widgets\Navbar;
use \CTG\Widgets\LoginBox;

class Home extends Page {
    private const UrlPattern = '/';

    function __construct() {
        parent::__construct('بوابة مركز الموهوبين', 'ar');
    }

    static function run() {
        $page = new self();
        $page->render();
    }

    static function getUrlPattern() {
        return self::UrlPattern;
    }

    protected function header() {
        /* $header = Page::header(); */

        $header = "<!doctype html>\n"
                . "<html lang='$this->lang'>\n"
                . "<head>\n"
                . "<meta charset='UTF-8'/>\n"
                . '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">'
                . "<title>$this->title</title>\n"
                . "</head>\n"
                . "<body style='dir: rtl; text-align: right'>";

        $navabr = new Navbar();
        $navabr->addLink('الرئيسية', '');

        return $header . "\n" . $navabr->render();
    }

    protected function body() {
        $login = new LoginBox();

        return $login->render();
    }

    protected function handler() {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            echo $_POST['username'];
            echo "\n";
            echo $_POST['password'];
        }
    }
}
