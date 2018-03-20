<?php
namespace CTG\Widgets;

require_once "./includes/Widgets/Widget.php";

use \CTG\Widgets\Widget;

class Label extends Widget {
    private $text;

    function __construct(string $text, string $for) {
        $this->setTag('label');
        $this->setText($text);
        $this->setFor($for);
    }

    function setText(string $text) {
        $this->text = $text;
    }

    function getText() {
        return $this->text;
    }

    function setFor(string $for) {
        $this->addAttribute('for', $for);
    }

    function getFor() {
        return $this->getAttributeValue('for');
    }

    function render() {
        return $this->renderhelper($this->getText());
    }
}
