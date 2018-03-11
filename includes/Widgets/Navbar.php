<?php
namespace CTG\Widgets;

require "./includes/Widgets/Widget.php";

use \CTG\Widgets\Widget;

class Navbar extends Widget {
    private $links;

    function addLink($link) {
        // TODO: check the type of $link

        $this->links[] = $link;
    }

    function setLinks($links) {
        $this->links = $links;
    }

    function render() {
        // TODO: use classes and ID from widget

        $result = '<div>' . "\n";
        foreach ($this->links as $key => $value) {
            $result .= "<a href=\"$value\">$key</a>" . "\n";
        }
        $result .= '</div>' . "\n";

        return $result;
    }
}
