<?php
namespace CTG\Widgets;

class Container extends Widget {
    // children inside this container
    private $children = [];
    // tag value could be: div, sectio, span, footer, header
    private $tag = 'div';

    // Error messages
    private const notSubclassOfWidget = 'Container can only contain subclasses of Widget';
    private const widgetNameExists = 'There is already widget with name: ';
    private const tagShouldBeString = 'Tag should be string';

    function __construct($name, $tag) {
        // Make sure that $name is string
        if (!is_string($name)) {
            throw \Exception($this->nameShouldBeString);
        }

        // Make sure $tag is string
        if (!is_string($tag)) {
            throw \Exception($this->nameShouldBeString);
        }

        // Assign the passed values
        $this->name = $name;
        $this->tag = $tag;
    }

    function add(&$widget) {
        // Make sure this widget is subclass of 'Widget' class
        if (!Widget::is_widget($widget)) {
            throw \Exception($this->notSubclassOfWidget);
        }

        // Make sure this widget doesn't have name that other widgets use
        foreach ($this->children as $child) {
            if ($child->getName() == $widget->getName()) {
                throw \Exception($this->widgetNameExists . $widget->getName());
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

    function get_children() {
        return &$this->children;
    }

    function render() {
        // TODO: not done yet, use classes and ID from Widget, and use tag insted
        //       of static 'div'
        $result = '<div>' . "\n";
        foreach ($this->children as $child) {
            $result .= $child->render() . "\n";
        }
        $result .= '</div>' . "\n";
    }
}
