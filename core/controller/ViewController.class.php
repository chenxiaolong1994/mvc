<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/9/25
 * Time: 0:52
 */
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
        echo $this->tplfile . "模板文件不存在";
        return false;
    }

    foreach($this->data as $k => $v) {
        $$k = $v;
    }
require_once($this->tplfile);
}
    public function assign($data) {
       return $this->data = $data;
    }
}