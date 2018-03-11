<?php
namespace CTG\Widgets;

abstract class Widget {
    // html ID, and Classes
    private $classes = [];
    private $id;

    // widget unique name
    protected $name;

    // Error messages
    private const classShouldBeString = "Class name should be string";
    private const classesShouldBeStringArray = "Classes should be array of strings";
    private const idShouldBeString = "ID should be string";
    protected const nameShouldBeString = "Widget name should be string";

    // render function that will return HTML
    abstract function render();

    function setClass($class) {
        if (!is_string($class)) {
            throw \Exception(self::classShouldBeString);
        }

        $this->classes = [$class];
    }

    function setClasses(&$classes) {
        if (!is_array($classes)) {
            throw \Exception(self::classesShouldBeStringArray);
        }

        foreach ($classes as $class) {
            if (!is_string($class)) {
                throw \Exception(self::classesShouldBeStringArray);
            }
        }

        $this->classes = $classes;
    }

    function addClass($class) {
        if (!is_string($class)) {
            throw \Exception(self::classShouldBeString);
        }

        $this->classes[] = $class;
    }


    function &getClasses() {
        return $this->classes;
    }

    function setID($id) {
        if (!is_string($id)) {
            throw \Exception(self::idShouldBeString);
        }

        $this->id = $id;
    }

    function getID() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    static function isWidget($widget) {
        return is_a($widget, 'Widget');
    }
}
