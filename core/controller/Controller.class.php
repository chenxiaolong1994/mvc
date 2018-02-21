<?php
require_once('ViewController.class.php');
class Controller
{
    private static $instance;
    public $view = '';
    public $tplfile = '';
    public $str = array();
    function __construct($tpl){
        $this->view = new ViewController($tpl);
    }
    static public function getInstance($module,$tpl) {
    if (!(self::$instance instanceof $module)){
                  return self::$instance = new $module($tpl);
             }
        return new $module($tpl);

     }

    public function assign($key,$val) {
         $this->str[$key] = $val;
        $this->view->assign($this->str);
    }

    public function display($tpl=NULL) {
       if ($tpl !== NULL) $tpl = VIEW_PATH  . $tpl . ".php";
        $this->view->display($tpl);
        //var_dump($this->view);
    }

}