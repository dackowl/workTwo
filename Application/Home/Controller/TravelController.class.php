<?php
namespace Home\Controller;
use Think\Controller;
class TravelController extends Controller {
    public function index(){
    	if (session('?login')) {
			$id=session('login');
			// dump($id);
			$this->assign('login',$id);
		}
        $this->display();
    }
    public function sc()
    {
    	$t=M('Travel');
    	$data=$t->select();
    	echo json_encode($data);
    }
}