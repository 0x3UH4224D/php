<?php
namespace CTG\Widgets;

require_once "./includes/Widgets/Widget.php";

use \CTG\Widgets\Widget;
use \CTG\Widgets\HtmlAttribute;

class Link extends Widget {
    private $title;
    private $url;

    // Error messages
    private const titleShouldBeString = 'Link title should be string';
    private const urlShouldBeString = 'Link url should be string';

    function __construct($name, $title, $url) {
        $this->setName($name);
        $this->setTag('a');

        $this->addAttribute('href', $url);

        $this->setTitle($title);
        $this->setUrl($url);
    }

    function setTitle($title) {
        if (!is_string($title)) {
            throw new \Exception(self::titleShouldBeString);
        }

        $this->title = $title;
    }

    function getTitle() {
        return $this->title;
    }

    function setUrl($url) {
        if (!is_string($url)) {
            throw new \Exception(self::urlShouldBeString);
        }

        $this->url = $url;
        $this->addAttribute('href', $url);
    }


    function getUrl() {
        $this->url;
    }

    static function isLink($link) {
        return is_a($link, 'CTG\Widgets\Link');
    }

    function render() {
        return $this->renderHelper($this->getTitle());
    }
}
