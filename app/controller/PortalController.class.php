<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/9/23
 * Time: 15:09
 */

class PortalController extends Controller
{


public function aa($data) {
   // print_r($data);
    echo "portal aa";
    $str = "hello world";
    $this->assign("a",$str);
    $this->assign("data",$data);
    $this->display("admin/aa");
    //echo "aa function";
}
    public function bb() {

        echo "nihao";
    }
}