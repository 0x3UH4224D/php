<?php
namespace CTG\Pages;

abstract class Page {
    protected $title;
    protected $lang;
    
    function __construct($title, $lang = 'ar') {
        $this->title = $title;
        $this->lang = $lang;
    }
    
    protected function header() {
        return "<!doctype html>\n"
             . "<html lang='$this->lang'>\n"
             . "<head>\n"
             . "<meta charset='UTF-8'/>\n"
             . "<title>$this->title</title>\n"
             . "</head>\n"
             . "<body>";
    }
    
    abstract protected function body();
    
    protected function footer() {
        return "</body>\n"
             . "</html>";
    }
    
    public function render() {
        return $this->header() . "\n"
             . $this->body() . "\n"
             . $this->footer();
    }

    public function get_title() {
        return $this->title;
    }

    public function get_lang() {
        return $this->lang;
    }
}
