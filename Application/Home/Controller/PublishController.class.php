<?php
namespace Home\Controller;
use Think\Controller;
class PublishController extends Controller {
    public function Publish(){
        if (session('?login')) {
            $id=session('login');
            // dump($id);
            $this->assign('login',$id);
        }
  		$this->display();
    }
    //游记发表
    public function add(){
    	$data = M('travel');
        $t_title = I('post.t_title','');
        $t_con = I('post.t_con','');
        $U_id=I('post.u_id','');
        if ($t_title == '' || $t_con == '') {
            $mydata =[
                'Msg' => '请填写标签和文字内容!',
                'rol' => 0 //失败为0
            ];
            $this->ajaxReturn($mydata);
        } 
        $plData = [
        	't_great' =>0,
        	't_make'  =>0,
        	't_des'   =>1,
        	't_uid'   =>$U_id,
            't_title' => $t_title,
            't_con'	  => $t_con
        ];
        $re = $data->add($plData);
        if ($re == false) {
            $mydata =[
                'Msg' => '发表失败!',
                'rol' => 0   //失败为0
            ];
            $this->ajaxReturn($mydata);
        }
        $mydata =[
            'powerArr' => $powerArr,
            'menuData' => $menuData,
            'Msg' => '发表成功!',
            'rol' => 1 //失败为0,成功为1
        ];
        $this->ajaxReturn($mydata);
    }

    function picturePreview(){
        $a = A('Common/Public');
        $b = $a->fileup();
    }
}