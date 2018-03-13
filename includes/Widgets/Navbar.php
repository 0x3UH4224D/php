<?php
namespace CTG\Widgets;

require_once "./includes/Widgets/Widget.php";
require_once "./includes/Widgets/Link.php";

use \CTG\Widgets\Widget;
use \CTG\Widgets\Link;

class Navbar extends Widget {
    private $links = [];

    // Error messages
    private const notLink = 'Navbar can only contain Link objects';

    function __construct($name, $links = []) {
        $this->setName($name);
        $this->setTag("navbar");

        $this->setLinks($links);
    }

    function addLink($name, $title, $url) {
        $link = new Link($name, $title, $url);
        $this->links[] = $link;
    }

    function setLinks($links) {
        // make sure passed array contains links objects
        foreach ($links as $link) {
            if (!Link::isLink($link)) {
                throw new \Exception(self::notLink);
            }
            
            $this->links = $links;
        }
    }

    function render() {
        $body = "\n";
        foreach ($this->links as $link) {
            $body .= $link->render() . "\n";
        }

        return $this->renderHelper($body);
    }
}
