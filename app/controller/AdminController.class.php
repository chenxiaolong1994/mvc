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
    $article = D('article');
    $adata = array("title" => "titletwo","content" => "content11111111","info" => "description");
     if ($article->add($adata)) {
         echo "�������ݳɹ�";
     }

    $this->display();
    //echo "aa function";
}
    public function bb() {

        echo "nihao";
    }
}