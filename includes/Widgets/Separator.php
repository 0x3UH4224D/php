<?php
namespace CTG\Widgets;

require_once "./includes/Widgets/Widget.php";

use \CTG\Widgets\Widget;

class Separator extends Widget {
    private function __construct($tag = null) {
        $this->setCloseTag(false);

        if (!is_null($tag)) {
            $this->setTag($tag);
        }
    }

    static function NewLine() {
        return new self('br');
    }

    static function HorizontalRule() {
        return new self('hr');
    }

    function render() {
        return $this->renderHelper();
    }
}
