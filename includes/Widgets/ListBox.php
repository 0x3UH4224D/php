<?php
namespace CTG\Widgets;

require_once "./includes/Widgets/Widget.php";
require_once "./includes/Widgets/Container.php";

use \CTG\Widgets\Widget;
use \CTG\Widgets\Container;
use \CTG\Widgets\HtmlAttribute;

class ListBox extends Container {
    function __construct() {
        parent::__construct('ul');
    }

    function toOrderedList() {
        $this->setTag('ol');
    }

    function toUnorderedList() {
        $this->setTag('ul');
    }

    function render() {
        $body = '' . "\n";
        foreach ($this->getChildren() as $child) {
            $body .= '<li>' . $child->render() . '</li>' . "\n";
        }

        return $this->renderHelper($body);
    }
}
