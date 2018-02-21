<?php

class ViewController
{
    public $tplfile = '';
    public $data = '';
    function __construct($tpl) {
        $this->tplfile = $tpl;
    }
public function display($tpl=NULL) {
    if ($tpl !== NULL) $this->tplfile=$tpl;
    if (!(file_exists($this->tplfile))) {
        echo $this->tplfile . "template file not found";
        return false;
    }
    if ($this->data != NULL) {
        foreach ($this->data as $k => $v) {
            $$k = $v;
        }
    }
require_once($this->tplfile);
}
    public function assign($data) {
       return $this->data = $data;
    }
}