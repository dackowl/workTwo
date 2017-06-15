<?php
namespace bee\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	$user=session('login');
    	$this->assign('login',$user);
        $this->display();
    }
    public function user(){
    	$user=session('login');
    	$this->assign('login',$user);
        $this->display();
    }
}