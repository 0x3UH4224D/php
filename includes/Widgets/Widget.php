<?php
namespace CTG\Widgets;

// TODO: add seter and geter for global HTML attribute
abstract class Widget {
    // html things
    private $tag;
    // this an array of HtmlAttribute objects
    private $attributes = [];

    // widget unique name
    private $name;
    // whether this widget should close the HTML tage or not
    private $closeTag = true;

    // Error messages
    private const notHtmlAttribute = "Widget attribute should be HtmlAttribute";
    private const attributeNotFound = "Attribute '%s' not found";
    private const nameShouldBeString = "Widget name should be string";
    private const tagShouldBeString = 'Tag should be string';
    private const closeTagShouldBeBoolean = "CloseTag should be 'true' or 'false'";
    private const idShouldBeString = "ID should be String";
    private const classShouldBeString = "Class should be String";

    // render function that will return HTML
    abstract function render();

    protected function setTag($tag) {
        // Make sure $tag is string
        if (!is_string($tag)) {
            throw new \Exception(self::tagShouldBeString);
        }

        $this->tag = $tag;
    }

    function getTag() {
        return $this->tag;
    }

    function getAttributes() {
        return $this->attributes;
    }

    function getAttributeValue($name) {
        foreach ($this->getAttributes() as $attribute) {
            if ($attribute->getName() == $name) {
                return $attribute->getValue();
            }
        }

        return '';
    }

    protected function addAttribute($name, $value = null) {
        if (!is_null($value)) {
            foreach ($this->getAttributes() as $attribute) {
                if ($attribute->getName() == $name) {
                    $attribute->setValue($value);
                    return;
                }
            }
        }

        $attribute = new HtmlAttribute($name, $value);
        $this->attributes[] = $attribute;
    }

    /* protected function updateAttribute($name, $new_value) {
     *     foreach ($this->getAttributes() as $attribute) {
     *         if ($attribute->getName() == $name) {
     *             $attribute->setValue($new_value);
     *             return;
     *         }
     *     }

     *     throw new \Exception(sprintf(self::attributeNotFound, $name));
     * }*/

    function setID($id) {
        if (!is_string($id)) {
            throw new \Exception(self::idShouldBeString);
        }

        $this->addAttribute('id', $id);
    }

    function setClass($class) {
        if (!is_string($class)) {
            throw new \Exception(self::classShouldBeString);
        }

        $this->addAttribute('class', $class);
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

    protected function getCloseTag() {
        return $this->closeTag;
    }

    protected function setCloseTag($value) {
        if (!is_bool($value)) {
            throw new \Exception(self::closeTagShouldBeBoolean);
        }

        $this->closeTag = $value;
    }

    protected function renderHelper($body = null) {
        $attributes = $this->getAttributes();

        $html_attributes = '';
        foreach ($attributes as $attribute) {
            $html_attributes .= ' ' . $attribute->render();
        }

        // build the html block
        $result = '<' . $this->getTag() . $html_attributes . '>';
        if (!is_null($body)) {
            $result .= $body;
        }
        if ($this->getCloseTag()) {
            $result .= '</' . $this->getTag() . ">";
        }

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
    private const valueShouldBeString = "Attribute value should be string or 'null'";

    function __construct($name, $value = null) {
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

    function setValue($value = null) {
        // TODO: check if value is valid html value
        if (!is_string($value) && !is_null($value)) {
            throw new \Exception(self::valueShouldBeString);
        }

        $this->value = $value;
    }

    function getValue() {
        if (!is_null($this->value)) {
            return $this->value;
        } else {
            return '';
        }
    }

    function isHtmlAttribute($attribute) {
        return is_a($attribute, 'CTG\Widgets\HtmlAttribute');
    }

    function render() {
        if (!is_null($this->value)) {
            return $this->name . '="' . $this->value . '"';
        } else {
            return $this->name;
        }
    }
}
