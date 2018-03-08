<?php
namespace CTG\Pages;

require "./includes/Core/Page.php";
require "./includes/Widgets/Navbar.php";

use \CTG\Core\Page;
use \CTG\Widgets\Navbar;

class Home extends Page {
    function __construct() {
        Page::__construct('بوابة مركز الموهوبين', 'ar');
    }

    protected function header() {
        $header = Page::header();
        $navabr = new Navbar();
        return $header . "\n" . $navabr->render();
    }

    protected function body() {
        return '<div>محتوى صفحة البوابة</div>';
    }
}
