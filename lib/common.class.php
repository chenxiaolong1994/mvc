<?php
class common{
    private static $instance;
    static public function getInstance() {
        if (!(self::$instance instanceof self)) {
             self::$instance = new self;
        }
        return self::$instance;
    }

    public function get_query_string($string) {
        $query = explode('&',$string);
        array_shift($query);
        array_shift($query);
        if (count($query) == 0) {
            return false;
        }
        $index = array();
        $value = array();
        foreach ($query as $v) {
            $query_name = substr($v,0,strpos($v,"="));
            $query_arg = substr($v,strpos($v,"=")+1);
            $index[] = $query_name;
            $value[] = $query_arg;
        };
        $queryArr = array_combine($index,$value);
        return $queryArr;
    }

    public function route($module,$action,$arr = NULL) {
        $class_path = CONTROLLER_PATH  . ucfirst($module) . "Controller.class.php";
        if (!(file_exists(CONTROLLER_PATH  . ucfirst($module) . "Controller.class.php"))) {
            echo "MODULE " . $module . "NOT FOUND";
            return false;
        };
        require_once(CORE_CONTROLLER  . "Controller.class.php");
        require_once($class_path);
        $tpl = VIEW_PATH  . $module . "/" . $action . ".php" ;
        $m = $module . "Controller";
        $m = ucfirst($m);
        $obj = $m::getInstance($m,$tpl);
        //var_dump($obj);
         //print_r($arr);
        $method = get_class_methods($obj);
        if (!(in_array($action,$method))) {
            echo $module . " FUNCTION " . $action . " NOT FOUND";
            return false;
        }
        $obj->$action($arr);

    }
}