<?php
namespace CTG\Pages;

require_once "./includes/Pages/Page.php";
require_once "./includes/Widgets/Navbar.php";
require_once "./includes/Widgets/Container.php";
require_once "./includes/Widgets/Link.php";
require_once "./includes/Widgets/ListBox.php";
require_once "./includes/Widgets/Label.php";

use \CTG\Pages\Page;
use \CTG\Widgets\Navbar;
use \CTG\Widgets\Container;
use \CTG\Widgets\Link;
use \CTG\Widgets\ListBox;
use \CTG\Widgets\Label;

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
        $qute = new Label('mytext', 'اقتباس جميل');
        $qute->addAttribute('class', 'h1');
        $qute->toPlainText();

        $container = new Container('top_container', $qute);
        $container->addAttribute('class', 'alert alert-success');

        $main_container = new Container('main', $container);
        $main_container->addAttribute('class', 'container');

        return '<div>محتوى صفحة البوابة</div>' . "\n"
             . $main_container->render();
    }
}
