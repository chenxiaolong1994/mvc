<?php


class AdminController extends Controller
{


    public function test() {
        $article = D('article');
        $data = $article->select();
        $this->assign('data',$data);
        $this->display();

    }

    public function select() {
        $article = D('article');
        $a = $article->where('id=3')->select();
        var_dump($a);
    }

    public function add() {
        $article = D('article');
        $data['title'] = 'article title';
        $data['author'] = 'plus';
        $data['content'] = 'article content,chenxiaolong is so cool,I love you';
        if($article->add($data)) {
            echo 'add success';
        } else {
            echo 'add failed';
        }
    }

    public function delete() {
        $article = D('article');
        if($article->where('id=1')->delete()) {
            echo 'delete success';
        } else {
            echo 'delete failed';
        }
    }

    public function update() {
        $article = D('article');
        $data['content'] = 'content';
        $data['author'] = 'chen';
        if($article->where('id=2')->update($data)) {
            echo 'update success';
        } else {
            echo 'update failed';
        }
    }
}