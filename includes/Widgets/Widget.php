<?php
namespace CTG\Widgets;

abstract class Widget {
    // html things
    private $tag;
    // this an array of HtmlAttribute objects
    private $attributes = [];

    // widget unique name
    private $name;

    // Error messages
    private const notHtmlAttribute = "Widget attribute should be HtmlAttribute";
    private const attributeNotFound = "Attribute '%s' not found";
    private const nameShouldBeString = "Widget name should be string";
    private const tagShouldBeString = 'Tag should be string';

    // render function that will return HTML
    abstract function render();

    function setTag($tag) {
        // Make sure $tag is string
        if (!is_string($tag)) {
            throw new \Exception(self::tagShouldBeString);
        }

        $this->tag = $tag;
    }

    function getTag() {
        return $this->tag;
    }

    function addAttribute($name, $value) {
        $attribute = new HtmlAttribute($name, $value);
        $this->attributes[] = $attribute;
    }

    function getAttributes() {
        return $this->attributes;
    }

    function updateAttribute($name, $new_value) {
        foreach ($this->getAttributes() as $attribute) {
            if ($attribute->getName() == $name) {
                $attribute->setValue($new_value);
                return;
            }
        }

        throw new \Exception(sprintf(self::attributeNotFound, $name));
    }

    function getName() {
        return $this->name;
    }

    protected function setName($name) {
        if (!is_string($name)) {
            throw new \Exception(self::nameShouldBeString);
        }

        $this->name = $name;
    }

    protected function renderHelper($body) {
        $attributes = $this->getAttributes();

        $html_attributes = '';
        foreach ($attributes as $attribute) {
            $html_attributes .= ' ' . $attribute->render();
        }

        // build the html block
        $result = '<' . $this->getTag() . $html_attributes . '>';
        $result .= $body;
        $result .= '</' . $this->getTag() . ">";

        return $result;
    }

    static function isWidget($widget) {
        return is_a($widget, 'CTG\Widgets\Widget');
    }
}

// HtmlAttribute represent html attribute
class HtmlAttribute {
    private $name;
    // values are sprated by space
    private $value;

    // Error messages
    private const nameShouldBeString = 'Attribute name should be string';
    private const valueShouldBeString = 'Attribute value should be string';

    function __construct($name, $value) {
        $this->setName($name);
        $this->setValue($value);
    }

    function setName($name) {
        // TODO: check if name is valid html attribute
        if (!is_string($name)) {
            throw new \Exception(self::nameShouldBeString);
        }

        $this->name = $name;
    }

    function getName() {
        return $this->name;
    }

    function setValue($value) {
        // TODO: check if value is valid html value
        if (!is_string($value)) {
            throw new \Exception(self::valueShouldBeString);
        }

        $this->value = $value;
    }

    function getValue() {
        return $this->value;
    }

    function isHtmlAttribute($attribute) {
        return is_a($attribute, 'CTG\Widgets\HtmlAttribute');
    }

    function render() {
        return $this->name . '="' . $this->value . '"';
    }
}
