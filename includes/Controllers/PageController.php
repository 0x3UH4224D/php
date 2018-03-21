<?php
namespace CTG\Controllers;

abstract class PageController {
    protected $title;
    protected $lang;
    
    function __construct($title, $lang = 'ar') {
        $this->title = $title;
        $this->lang = $lang;
    }

    abstract static function getUrlPattern();

    abstract static function run();

    abstract protected function handler();
    
    function render() {
        $this->header();
        $this->body();
        $this->footer();
    }

    protected function header() {
        require_once './includes/Views/header.php';
    }

    abstract protected function body();
    
    protected function footer() {
        require_once './includes/Views/footer.php';
    }
}
