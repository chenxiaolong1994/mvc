<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/9/23
 * Time: 15:09
 */

class AdminController extends Controller
{


public function aa($data) {
   // print_r($data);
    $str = "hello world";
    $this->assign("a",$str);
    $this->assign("data",$data);
    $this->display();
    //echo "aa function";
}
    public function bb() {

        echo "nihao";
    }
}