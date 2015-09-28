<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/9/25
 * Time: 22:21
 */
class Model
{
    private $sql=array(
        "field" => "",
        "where" => "",
        "order" => "",
        "limit" => "");
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
        $str=$this->SelectJudge();
        $sql =  $str ? $str : "select * from $this->table";
        $resarr = array();
        $res = mysql_query($sql);
        while ($result = mysql_fetch_assoc($res)) {
            $resarr[] = $result;
        }
        return $resarr ? $resarr : "查询不到数据";
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

    public function field($_field="*") {
        $this->sql['field'] = $_field;
        return $this;
    }

    public function where($_where='1=1') {
        $_where = explode("=",str_replace(" ","",$_where));
        $_where[1] = "'$_where[1]'";
        $_where = implode("=",$_where);
        $this->sql["where"]="WHERE ".$_where;
        return $this;
    }

    public function order($_order='id DESC') {
        $this->sql["order"]="ORDER BY ".$_order;
        return $this;
    }

    public function limit($_limit='30') {
        $this->sql["limit"]="LIMIT 0,".$_limit;
        return $this;
    }

    public function SelectJudge() {
        //$field = $this->sql['field'];
        if (empty($this->sql['field'])) {
            $this->sql['field'] = "*";
        }
        $field = $this->sql['field'];
        unset($this->sql['field']);
        $SqlStr = implode("",$this->sql);
        if (! empty($SqlStr)) {
            return "select ". $field . " from " . $this->table . " " . implode(" ",$this->sql);
        } else {
            return false;
        }
    }


}