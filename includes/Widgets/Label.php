<?php
namespace CTG\Widgets;

require_once "./includes/Widgets/Widget.php";

use \CTG\Widgets\Widget;
use \CTG\Widgets\HtmlAttribute;

class Label extends Widget {
    private $text;
    private $plainText;

    // Error messages
    private const textShouldBeString = 'Text should be string';
    private const plaintextShouldBeBool = 'plainText should be boolean';
    private const titleLevelShouldBe1To6 = 'Title level should be between 1 and 6';
    private const titleLevelShouldBeInt = 'Title level should be integer';

    function __construct($name, $text) {
        $this->setName($name);

        $this->setText($text);
        $this->setPlainText(true);
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

    private function setPlainText($value) {
        if (!is_bool($value)) {
            throw new \Exception(self::plaintextShouldBeBool);
        }

        $this->plainText = $value;
    }

    private function getPlainText() {
        return $this->plainText;
    }

    function toParagraph() {
        $this->setTag('p');
        $this->setPlainText(false);
    }

    function toBlockquote() {
        $this->setTag('blockquote');
        $this->setPlainText(false);
    }

    function toSample() {
        $this->setTag('samp');
        $this->setPlainText(false);
    }

    function toCode() {
        $this->setTag('code');
        $this->setPlainText(false);
    }

    function toCite() {
        $this->setTag('cite');
        $this->setPlainText(false);
    }

    function toKeyboardInput() {
        $this->setTag('kbd');
        $this->setPlainText(false);
    }

    function toEmphasized() {
        $this->setTag('em');
        $this->setPlainText(false);
    }

    function toStrong() {
        $this->setTag('strong');
        $this->setPlainText(false);
    }

    function toSmall() {
        $this->setTag('small');
        $this->setPlainText(false);
    }

    function toVariable() {
        $this->setTag('var');
        $this->setPlainText(false);
    }

    function toDeleted() {
        $this->setTag('del');
        $this->setPlainText(false);
    }

    function toInserted() {
        $this->setTag('ins');
        $this->setPlainText(false);
    }

    function toIncorrect() {
        $this->setTag('s');
        $this->setPlainText(false);
    }

    function toTitle($level) {
        // check if $level is int or not
        if (!is_int($level)) {
            throw new \Exception(self::titleLevelShouldBeInt);
        }

        // check if $level between 1 and 6
        if ($level > 6 || $level < 1) {
            throw new \Exception(self::titleLevelShouldBe1To6);
        }

        $tag = 'h' . $level;
        $this->setTag($tag);
        $this->setPlainText(false);
    }

    function toPlainText() {
        $this->setPlainText(true);
    }

    static function isLabel($text) {
        return is_a($text, 'CTG\Widgets\Text');
    }

    function render() {
        if ($this->plainText) {
            return $this->text;
        } else {
            return $this->renderHelper($this->getText());
        }
    }
}
