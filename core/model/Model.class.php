<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/9/25
 * Time: 22:21
 */
class Model
{
    static $instance = '';
    public $connect = '';
    public $db = '';
    public $table = '';
    public $tablesarr = array();
    public function __construct($host,$pwd,$user,$name,$model) {
          $this->connect = mysql_connect($host,$user,$pwd);
          $this->db = mysql_select_db($name);
          $this->table = DB_PREFIX . strtolower(substr_replace($model,'',-5,5));
          $sql = "show tables";
          $res = mysql_query($sql);
       while ($result = mysql_fetch_assoc($res)) {
           $this->tablerr[] = $result;
       }
        foreach($this->tablerr as $k => $v) {
            $this->tables[] = implode('',$v);
        }
        if (!(in_array($this->table,$this->tables))) {
            exit("数据库中" . $this->table . "表不存在");
        }

    }

    static function getInstance($model) {
        if (!(self::$instance instanceof $model)) {
            return self::$instance = new $model(DB_HOST,DB_PWD,DB_USER,DB_NAME,$model);
        }
        return self::$instance;
    }

    public function select() {
        $sql = "select * from $this->table";
        $res = mysql_query($sql);
        $result = mysql_fetch_assoc($res);
        return $result ? $result : "表中无数据";
    }

    public function add($data) {
        $keys = array_keys($data);
        $val = array_values($data);
        $fields = implode(',',$keys);
        $values = implode('\',\'',$val);
        $sql = "insert into " . $this->table . " (" .  $fields . ") values ('" . $values . "')";
        if (!($res = mysql_query($sql))) {
            echo mysql_error();
            return false;
        }
        return true;
    }

    public function save() {}

    public function where(){}

    public function create() {}

    public function sql() {}

    public function limit(){}

    public function delete() {}


}