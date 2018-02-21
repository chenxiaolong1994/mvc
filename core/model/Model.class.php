<?php

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
    public $sqlstr = '';
    public function __construct($host,$pwd,$user,$name,$model) {
          $this->connect = mysqli_connect($host,$user,$pwd);
          $this->db = mysqli_select_db($this->connect, $name);
          $this->table = DB_PREFIX . strtolower(substr_replace($model,'',-5,5));
          $sql = "show tables";
          $res = mysqli_query($this->connect, $sql);
       while ($result = mysqli_fetch_assoc($res)) {
           $this->tablerr[] = $result;
        }
        foreach($this->tablerr as $k => $v) {
            $this->tables[] = implode('',$v);
        }
        if (!(in_array($this->table,$this->tables))) {
            exit("TABLE " . $this->table . " NOT FOUND");
        }

    }

    static function getInstance($model) {
        if (!(self::$instance instanceof $model)) {
            return self::$instance = new $model(DB_HOST,DB_PWD,DB_USER,DB_NAME,$model);
        }
        return self::$instance;
    }

    public function getSql(){
        return $this->sqlstr;
    }

    public function select() {
        $sql=$this->SelectJudge();
        $resarr = array();
        $res = mysqli_query($this->connect, $sql);
        while ($result = mysqli_fetch_assoc($res)) {
            $resarr[] = $result;
        }
        return $resarr ? $resarr : "DATA EMPTY";
    }

    public function findOne() {
        $this->limit(1);
        $res =  $this->select();
        if (is_array($res)) {
            return $res[0];
        }
    }

    public function exec($sql) {
        if(!$sql) return "SQL IS NULL";
        $res = mysqli_query($this->connect, $sql);
        while ($result = mysqli_fetch_assoc($res)) {
            $resarr[] = $result;
        }
        return $resarr ? $resarr : "DATA EMPTY";
    }

    public function add($data) {
        $keys = array_keys($data);
        $val = array_values($data);
        $fields = implode(',',$keys);
        $values = implode('\',\'',$val);
        $sql = "insert into " . $this->table . " (" .  $fields . ") values ('" . $values . "')";
        if (!($res = mysqli_query($this->connect, $sql))) {
            echo mysqli_error($this->connect);
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

    public function delete() {
        $sql = "delete from ".$this->table. implode(" ", $this->sql);
        $sql = trim($sql);
        if (!($res = mysqli_query($this->connect, $sql))) {
            echo mysqli_error($this->connect);
            return false;
        }
        return true;
    }

    public function update($data) {
        $str = '';
        foreach ($data as $k=>$v) {
            $str .= "`$k`='$v',";
        }
        $str = ' set '. trim($str,',');
        $sql = "update ".$this->table.$str.implode(" ", $this->sql);
        $sql = trim($sql);
        if (!($res = mysqli_query($this->connect, $sql))) {
            echo mysqli_error($this->connect);
            return false;
        }
        return true;
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
            $this->sqlstr = "select ". $field . " from " . $this->table . " " . implode(" ",$this->sql);
            return "select ". $field . " from " . $this->table . " " . implode(" ",$this->sql);
        } else {
            return "select * from $this->table";
        }
    }


}