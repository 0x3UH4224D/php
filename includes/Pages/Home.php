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

        $links = [
            new Link('home-link', 'Home', '/index.php'),
            new Link('about-me-link', 'About Me', '/about-me.php')
        ];

        $navabr = new Navbar('topNav', $links);

        $list = new ListBox('my_list');
        $list->add($links[0]);
        $list->add($links[1]);

        return $header . "\n" . $navabr->render() . "\n" . $list->render();
    }

    protected function body() {
        $qute = new Label('mytext', 'اقتباس جميل');
        $qute->toBlockquote();

        return '<div>محتوى صفحة البوابة</div>'
        . $qute->render();
    }
}
