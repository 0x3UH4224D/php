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
        $qute = new Label('mytext', 'اقتباس جميل');
        $qute->setClass('h1');
        $qute->toTitle(3);

        $container = new Container('top_container', $qute);
        $container->setClass('alert alert-success');

        $main_container = new Container('main', $container);
        $container->setClass('container');

        $image = new Image('logo', '1', 'https://php.net/images/logos/php-logo.svg', '20%', '20%');

        $form = new Form('my_form', 'this.php');
        $form->add($image);

        $main_container->add($form);

        $input = Input::Reset('my', 'hi');
        $main_container->add($input);

        return '<div>محتوى صفحة البوابة</div>' . "\n"
             . $main_container->render();
    }
}
