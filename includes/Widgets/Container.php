<?php
namespace CTG\Widgets;

require_once "./includes/Widgets/Widget.php";

use \CTG\Widgets\Widget;

class Container extends Widget {
    // children inside this container
    private $children = [];

    // Error messages
    private const notSubclassOfWidget = 'Container can only contain subclasses of Widget';
    private const widgetNameExists = 'There is already widget with name: ';
    private const tagShouldBeString = 'Tag should be string';

    function __construct($name, $child = null, $tag = 'div') {
        // Assign the passed values
        $this->setName($name);
        $this->setTag($tag);

        if (!is_null($child)) {
            $this->add($child);
        }
    }

    function add(&$widget) {
        // Make sure this widget is subclass of 'Widget' class
        if (!Widget::isWidget($widget)) {
            throw new \Exception(self::notSubclassOfWidget);
        }

        // Make sure this widget doesn't have name that other widgets use
        foreach ($this->children as $child) {
            if ($child->getName() == $widget->getName()) {
                throw new \Exception(self::widgetNameExists . $widget->getName());
            }
        }

        // Add the widget
        $this->children[] = $widget;
    }

    function remove($name) {
        // get children length
        $len = count($this->children);

        // search for widget with the same name and remove it
        for ($i = 0; $i < $len; $i++) {
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
