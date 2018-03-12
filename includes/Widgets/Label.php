<?php
namespace CTG\Widgets;

require_once "./includes/Widgets/Widget.php";

use \CTG\Widgets\Widget;
use \CTG\Widgets\HtmlAttribute;

class Label extends Widget {
    private $text;

    // Error messages
    private const textShouldBeString = 'Text should be string';

    function __construct($name, $text) {
        $this->setName($name);
        $this->setTag('p');

        $this->setText($text);
    }

    function setText($text) {
        if (!is_string($text)) {
            throw new \Exception(self::textShouldBeString);
        }

        $this->text = $text;
    }

    function getText() {
        return $this->text;
    }

    function toParagraph() {
        $this->setTag('p');
    }

    function toBlockquote() {
        $this->setTag('blockquote');
    }

    static function isText($text) {
        return is_a($text, 'CTG\Widgets\Text');
    }

    function render() {
        return $this->renderHelper($this->getText());
    }
}
