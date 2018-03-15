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

    function setTag($tag) {
        parent::setTag($tag);
        $this->setPlainText(false);
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
    }

    function toBlockquote() {
        $this->setTag('blockquote');
    }

    function toSample() {
        $this->setTag('samp');
    }

    function toCode() {
        $this->setTag('code');
    }

    function toCite() {
        $this->setTag('cite');
    }

    function toKeyboardInput() {
        $this->setTag('kbd');
    }

    function toEmphasized() {
        $this->setTag('em');
    }

    function toStrong() {
        $this->setTag('strong');
    }

    function toSmall() {
        $this->setTag('small');
    }

    function toVariable() {
        $this->setTag('var');
    }

    function toDeleted() {
        $this->setTag('del');
    }

    function toInserted() {
        $this->setTag('ins');
    }

    function toMark() {
        $this->setTag('mark');
    }

    function toBold() {
        $this->setTag('b');
    }

    function toItalic() {
        $this->setTag('i');
    }

    function toPreformattedText() {
        $this->setTag('pre');
    }

    function toSubscriptText() {
        $this->setTag('sub');
    }

    function toSuperscriptText() {
        $this->setTag('sup');
    }

    function toShortQuotation() {
        $this->setTag('q');
    }

    function toSummary() {
        $this->setTag('summary');
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
