<?php
namespace CTG\Widgets;

require_once "./includes/Widgets/Widget.php";

use \CTG\Widgets\Widget;

class SpecialChar extends Widget {
    private function __construct($tag = null) {
        $this->setCloseTag(false);

        if (!is_null($tag)) {
            $this->setTag($tag);
        }
    }

    static function LessThan() {

    }

    static function BiggerThan() {

    }

    static function Space() {

    }

    static function Ampersand() {

    }

    static function DoubleQuotationMark() {

    }

    static function Apostrophe() {

    }

    static function Copyright() {

    }

    static function RegisteredTrademark() {

    }

    function render() {
        $this->renderHelper();
    }
}
