<?php
namespace CTG\Widgets;

require_once "./includes/Widgets/Widget.php";

use \CTG\Widgets\Widget;
use \CTG\Widgets\HtmlAttribute;

class Image extends Widget {
    // Error messages
    private const srcShouldBeString = "Image Source should be string";
    private const altShouldBeString = "Image AlternateText should be string";
    private const heightShouldBeString = "Image Height should be String like: 10%, 50px";
    private const widthShouldBeString = "Image Width should be String like: 10%, 50px";

    function __construct($alt, $source, $height = null, $width = null) {
        $this->setTag('img');
        $this->setCloseTag(false);

        $this->setAlternateText($alt);
        $this->setSource($source);
        if (!is_null($height)) {
            $this->setHeight($height);
        }
        if (!is_null($width)) {
            $this->setWidth($width);
        }
    }

    function setSource($source) {
        if (!is_string($source)) {
            throw new \Exception(self::srcShouldBeString);
        }

        $this->addAttribute('src', $source);
    }

    function getSource() {
        return $this->getAttributeValue('src');;
    }

    function setAlternateText($text) {
        if (!is_string($text)) {
            throw new \Exception(self::altShouldBeString);
        }

        $this->addAttribute('alt', $text);
    }

    function getAlternateText() {
        return $this->getAttributeValue('alt');
    }

    private function is_valid_size($size) {
        return preg_match('/(^[0-9]+px$|^[0-9]{1,3}%)$/', $size);
    }

    function setHeight($height) {
        if (!is_string($height) || !$this->is_valid_size($height)) {
            throw new \Exception(self::heightShouldBeString);
        }

        $this->addAttribute('height', $height);
    }

    function getHeight() {
        return $this->getAttributeValue('height');
    }

    function setWidth($width) {
        if (!is_string($width) || !$this->is_valid_size($width)) {
            throw new \Exception(self::heightShouldBeString);
        }

        $this->addAttribute('width', $width);
    }

    function getWidth() {
        return $this->getAttributeValue('width');
    }

    static function isImage($image) {
        return is_a($image, 'CTG\Widgets\Image');
    }

    function render() {
        return $this->renderHelper();
    }
}
