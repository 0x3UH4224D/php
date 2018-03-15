<?php
namespace CTG\Widgets;

require_once "./includes/Widgets/Container.php";

use \CTG\Widgets\Container;

class Form extends Container {
    // Error messages
    private const notVaildMethod = "Form method can only be 'get' and 'post'";
    private const actionShouldBeString = "Form Action should be string";
    private const acceptCharsetShouldBeString = "Form AcceptCharset should be string";
    private const autoCompleteShouldBeBool = "Form AutoComplete should be 'true' or 'false'";

    function __construct($name, $method = 'get', $action = '') {
        parent::__construct($name);
        $this->setTag('form');

        $this->setMethod($method);
        $this->setAction($action);
    }

    function setMethod($method) {
        if (!is_string($method)) {
            throw new \Exception(self::notVaildMethod);
        }

        if ($method != 'post' && $method != 'get') {
            throw new \Exception(self::notVaildMethod);
        }

        $this->addAttribute('method', $method);
    }

    function getMethod() {
        return $this->getAttributeValue('method');
    }

    function setAction($action) {
        if (!is_string($action)) {
            throw new \Exception(self::acceptCharsetShouldBeString);
        }

        $this->addAttribute('action', $action);
    }

    function getAction() {
        return $this->getAttributeValue('action');
    }

    function setAcceptCharset($charset) {
        if (!is_string($charset)) {
            throw new \Exception(self::acceptCharsetShouldBeString);
        }

        $this->addAttribute('accept-charset', $charset);
    }

    function getAcceptCharset() {
        return $this->getAttributeValue('accept-charset');
    }

    function setAutoComplete($value) {
        if (!is_bool($value)) {
            throw new \Exception(self::autoCompleteShouldBeBool);
        }

        if ($value == true) {
            $this->addAttribute('autocomplete', 'on');
        } else {
            $this->addAttribute('autocomplete', 'off');
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
}
