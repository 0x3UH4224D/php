<?php
namespace CTG\Widgets;

require_once "./includes/Widgets/Widget.php";

use \CTG\Widgets\Widget;
use \CTG\Widgets\HtmlAttribute;

class Text extends Widget {
    private $text;
    private $plainText;

    // Error messages
    private const textShouldBeString = 'Text should be string';
    private const plaintextShouldBeBool = 'plainText should be boolean';
    private const titleLevelShouldBe1To6 = 'Title level should be between 1 and 6';
    private const titleLevelShouldBeInt = 'Title level should be integer';

    private function __construct($text, $tag = null) {
        $this->setText($text);

        if (!is_null($tag)) {
            $this->setTag($tag);
        } else {
            $this->setPlainText(true);
        }
    }

    function setPlainText($value) {
        if (!is_bool($value)) {
            throw new \Exception(self::plaintextShouldBeBool);
        }

        $this->plainText = $value;
    }

    protected function setTag($tag) {
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

    static function PlainText($text) {
        return new self($text);
    }

    private function isPlainText() {
        return $this->plainText;
    }

    static function Paragraph($text) {
        return new self($text, 'p');
    }

    static function Blockquote($text) {
        return new self($text, 'blockquote');
    }

    static function Sample($text) {
        return new self($text, 'samp');
    }

    static function Code($text) {
        return new self($text, 'code');
    }

    static function Cite($text) {
        return new self($text, 'cite');
    }

    static function KeyboardInput($text) {
        return new self($text, 'kbd');
    }

    static function Emphasized($text) {
        return new self($text, 'em');
    }

    static function Strong($text) {
        return new self($text, 'strong');
    }

    static function Small($text) {
        return new self($text, 'small');
    }

    static function Variable($text) {
        return new self($text, 'var');
    }

    static function Deleted($text) {
        return new self($text, 'del');
    }

    static function Inserted($text) {
        return new self($text, 'ins');
    }

    static function Mark($text) {
        return new self($text, 'mark');
    }

    static function Bold($text) {
        return new self($text, 'b');
    }

    static function Italic($text) {
        return new self($text, 'i');
    }

    static function PreformattedText($text) {
        return new self($text, 'pre');
    }

    static function SubscriptText($text) {
        return new self($text, 'sub');
    }

    static function SuperscriptText($text) {
        return new self($text, 'sup');
    }

    static function ShortQuotation($text) {
        return new self($text, 'q');
    }

    static function Summary($text) {
        return new self($text, 'summary');
    }

    static function Underlined($text) {
        return new self($text, 'u');
    }

    static function Incorrect($text) {
        return new self($text, 's');
    }

    static function Heading($text, $level) {
        // check if $level is int or not
        if (!is_int($level)) {
            throw new \Exception(self::titleLevelShouldBeInt);
        }

        // check if $level between 1 and 6
        if ($level > 6 || $level < 1) {
            throw new \Exception(self::titleLevelShouldBe1To6);
        }

        $tag = 'h' . $level;
        return new self($text, $tag);
    }

    static function isText($text) {
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
