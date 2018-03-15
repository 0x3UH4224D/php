<?php
namespace CTG\Widgets;

require_once "./includes/Widgets/Widget.php";
/* require_once "./includes/Widgets/Separator.php";*/

use \CTG\Widgets\Widget;
/* use \CTG\Widgets\Separator;*/

class Container extends Widget {
    // children inside this container
    private $children = [];

    // Error messages
    private const notSubclassOfWidget = 'Container can only contain subclasses of Widget';
    private const widgetNameExists = 'There is already widget with name: ';
    private const tagShouldBeString = 'Tag should be string';

    function __construct($tag = 'div', $child = null) {
        // Assign the passed values
        $this->setTag($tag);

        if (!is_null($child)) {
            $this->add($child);
        }
    }

    function add($widget) {
        // Make sure this widget is subclass of 'Widget' class
        if (!Widget::isWidget($widget)) {
            throw new \Exception(self::notSubclassOfWidget);
        }

        // Make sure this widget doesn't have name that other widgets use
        foreach ($this->children as $child) {
            if (is_null($child->getName())) {
                continue;
            }
            if ($child->getName() == $widget->getName()) {
                throw new \Exception(self::widgetNameExists . $widget->getName());
            }
        }

        // Add the widget
        $this->children[] = $widget;
    }

    function adds(...$widegts) {
        foreach ($widegts as $widget) {
            $this->add($widget);
        }
    }

    function remove($name) {
        // get children length
        $len = count($this->children);

        // search for widget with the same name and remove it
        for ($i = 0; $i < $len; $i++) {
            if (is_null($this->children[$i].getName())) {
                continue;
            }
            if ($this->children[$i].getName() == $name) {
                unset($this->children[$i]);
                $this->children = array_keys($this->children);
                // return true if widget deleted
                return true;
            }
        }

        // return false if nothing found
        return false;
    }

    function &getChildren() {
        return $this->children;
    }

    function render() {
        $body = '' . "\n";
        foreach ($this->children as $child) {
            $body .= $child->render() . "\n";
        }

        return $this->renderHelper($body);
    }
}
