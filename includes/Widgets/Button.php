<?php
namespace CTG\Widgets;

require_once "./includes/Widgets/Widget.php";

use \CTG\Widgets\Widget;

class Button extends Widget {
    private $label;

    private function __construct(string $label, string $type) {
        $this->setTag('button');
        $this->setLabel($label);
        $this->setType($type);
    }

    static function Submit(string $label) {
        $button = new self($label, 'submit');
        return $button;
    }

    static function Button(string $label) {
        $button = new self($label, 'button');
        return $button;
    }

    static function Reset(string $label) {
        $button = new self($label, 'reset');
        return $button;
    }

    function setLabel(string $label) {
        $this->label = $label;
    }

    function getLabel() {
        return $this->label;
    }

    function getType() {
        return $this->getAttributeValue('type');
    }

    private function setType($typ) {
        $this->addAttribute('type', $typ);
    }

    function render() {
        return $this->renderhelper($this->getLabel());
    }
}
