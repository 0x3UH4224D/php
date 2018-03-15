<?php
namespace CTG\Widgets;

require_once "./includes/Widgets/Widget.php";

use \CTG\Widgets\Widget;

class Input extends Widget {
    private function __construct($type, $name) {
        $this->setType($type);
        $this->setName($name);
        $this->setTag('input');
        $this->setCloseTag(false);
    }

    static function Button($name, $label) {
        $input = new self('button', $name);
        $input->setValue($label);

        return $input;
    }

    static function Checkbox($name, $value, $is_checked = null) {
        $input = new self('checkbox', $name);
        $input->setValue($value);

        if (!is_null($is_checked)) {
            $input->setChecked();
        }

        return $input;
    }

    static function Color($name) {
        $input = new self('color', $name);

        return $input;
    }

    static function Date($name) {
        $input = new self('date', $name);

        return $input;
    }

    static function DateTimeLocal($name) {
        $input = new self('datetime-local', $name);

        return $input;
    }

    static function Email($name) {
        $input = new self('email', $name);

        return $input;
    }

    static function File($name) {
        $input = new self('file', $name);

        return $input;
    }

    static function Hidden($name) {
        $input = new self('hidden', $name);

        return $input;
    }

    static function Image($name, $src, $alt, $width = null, $height = null) {
        $input = new self('image', $name);
        $input->setSource($src);
        $input->setAlternateText($alt);

        if (!is_null($width)) {
            $input->setWidth($width);
        }

        if (!is_null($height)) {
            $input->setHeight($height);
        }

        return $input;
    }

    static function Month($name) {
        $input = new self('month', $name);

        return $input;
    }

    static function Number($name, $step = 1, $placeholder = null) {
        $input = new self('number', $name);
        $input->setStep($step);

        if(!is_null($placeholder)) {
            $input->setPlaceHolder($placeholder);
        }

        return $input;
    }

    static function Password($name, $placeholder = null, $required = true) {
        $input = new self('password', $name);

        if (!is_null($placeholder)) {
            $input->setPlaceHolder($placeholder);
        }

        if (!is_null($required)) {
            $input->setRequired();
        }

        return $input;
    }

    static function Radio($name) {
        $input = new self('radio', $name);

        return $input;
    }

    static function Range($name, $value = 0, $max = null, $min = null) {
        $input = new self('range', $name);
        $input->setValue((string)$value);

        if (!is_null($max)) {
            $input->setMax((string)$max);
        }

        if (!is_null($min)) {
            $input->setMin((string)$min);
        }

        return $input;
    }

    static function Reset($name, $label) {
        $input = new self('reset', $name);
        $input->setValue($label);

        return $input;
    }

    static function Search($name) {
        $input = new self('search', $name);

        return $input;
    }

    static function Submit($name, $label) {
        $input = new self('submit', $name);
        $input->setValue($label);

        return $input;
    }

    static function Tel($name, $placeholder = null) {
        $input = new self('tel', $name);

        if (!is_null($placeholder)) {
            $input->setPlaceHolder($placeholder);
        }

        return $input;
    }

    static function Text($name, $placeholder = null, $required = null) {
        $input = new self('text', $name);

        if (!is_null($placeholder)) {
            $input->setPlaceHolder($placeholder);
        }

        if (!is_null($required)) {
            $input->setRequired();
        }

        return $input;
    }

    static function Time($name) {
        $input = new self('time', $name);

        return $input;
    }

    static function Url($name) {
        $input = new self('url', $name);

        return $input;
    }

    static function Week() {
        $input = new self('week', $name);

        return $input;
    }

    function getType() {
        return $this->getAttributeValue('type');
    }

    private function setType($typ) {
        $this->addAttribute('type', $typ);
    }

    function setAccept($files_type) {
        $types = ['file'];
        $my_type = $this->getType();
        if (in_array($my_type, $types)) {
            $this->addAttribute('accept', $files_type);
        }
    }

    function getAccept() {
        $this->getAttributeValue('accept');
    }

    function setAutoComplete($value) {
        $types = ['text', 'search', 'url', 'tel', 'email', 'password', 'datepickers',
                  'date', 'datetime-local', 'color'];
        $my_type = $this->getType();
        if (in_array($my_type, $types)) {

            if ($value == true) {
                $this->addAttribute('autocomplete', 'on');
            } else {
                $this->addAttribute('autocomplete', 'off');
            }
        }
    }

    function getAutoComplete() {
        $value = $this->getAttributeValue('autocomplete');
        if ($value == 'on') {
            return true;
        } else {
            return false;
        }
    }

    function setAutoFocus() {
        $this->addAttribute('autofocus');
    }

    function setChecked() {
        $types = ['radio', 'checkbox'];
        $my_type = $this->getType();
        if (in_array($my_type, $types)) {
            $this->addAttribute('checked');
        }
    }

    function setDisabled() {
        $this->addAttribute('disabled');
    }

    function setMax($max) {
        $types = ['number', 'range', 'date', 'datatime', 'datetime-local', 'month', 'time', 'week'];
        $my_type = $this->getType();
        if (in_array($my_type, $types)) {
            $this->addAttribute('max', $max);
        }
    }

    function getMax() {
        return $this->getAttributeValue('max');
    }

    function setMin($min) {
        $types = ['number', 'range', 'date', 'datatime', 'datetime-local', 'month', 'time', 'week'];
        $my_type = $this->getType();
        if (in_array($my_type, $types)) {
            $this->addAttribute('min', $min);
        }
    }

    function getMin() {
        return $this->getAttributeValue('min');
    }

    function setMultiple() {
        $types = ['file', 'email'];
        $my_type = $this->getType();
        if (in_array($my_type, $types)) {
            $this->addAttribute('multiple');
        }
    }

    function setName($name) {
        parent::setName($name);
        $this->addAttribute('name', $name);
    }

    function setPattern($regex) {
        $types = ['text', 'date', 'search', 'url', 'tel', 'email', 'password'];
        $my_type = $this->getType();
        if (in_array($my_type, $types)) {
            $this->addAttribute('pattern', $regex);
        }
    }

    function getPattern() {
        return $this->getAttributeValue('pattern');
    }

    function setStep($step) {
        $types = ['number', 'range', 'date', 'datetime', 'datetime-local', 'month', 'time', 'week'];
        $my_type = $this->getType();
        if (in_array($my_type, $types)) {
            $this->addAttribute('step', $step);
        }
    }

    function getStep() {
        return $this->getAttributeValue('step');
    }

    function setPlaceHolder($text) {
        $types = ['text', 'search', 'tel', 'url', 'email', 'password'];
        $my_type = $this->getType();
        if (in_array($my_type, $types)) {
            $this->addAttribute('placeholder', $text);
        }
    }

    function getPlaceHolder() {
        return $this->getAttributeValue('placeholder');
    }

    function setRequired() {
        $this->addAttribute('required');
    }

    function setReadOnly() {
        $this->addAttribute('readonly');
    }

    function setSize($size) {
        $types = ['text', 'search', 'tel', 'url', 'email', 'password'];
        $my_type = $this->getType();
        if (in_array($my_type, $types)) {
            $this->addAttribute('size', (string)$size);
        }
    }

    function getSize() {
        return $this->getAttributeValue('size');
    }

    function setMaxLength($max) {
        $this->addAttribute('maxlength', (string)$max);
    }

    function getMaxLength() {
        return $this->getAttributeValue('maxlength');
    }

    function setValue($value) {
        if ($this->getType() != 'file') {
            $this->addAttribute('value', $value);
        }
    }

    function getValue() {
        return $this->getAttributeValue('value');
    }

    function setWidth($width) {
        if ($this->getType() == 'image') {
            $this->addAttribute('width', (string)$width);
        }
    }

    function getWidth() {
        return $this->getAttributeValue('width');
    }

    function setHeight($height) {
        if ($this->getType() == 'image') {
            $this->addAttribute('height', (string)$height);
        }
    }

    function getHeight() {
        return $this->getAttributeValue('height');
    }

    function setSource($src) {
        if ($this->getType() == 'image') {
            $this->addAttribute('src', $src);
        }
    }

    function setAlternateText($text) {
        if ($this->getType() == 'image') {
            $this->addAttribute('alt', $text);
        }
    }

    function render() {
        return $this->renderHelper();
    }
}
