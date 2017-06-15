<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends Controller {
    public function index(){
        $this->display('/user');
    }
    //分页
    public function nowpage(){
        // 实例化对象
        $data = M('user');

        //获取数据
        $nowPage = I('post.nowPage','');
        $pageSize = I('post.pageSize','');

        if ($nowPage == '' || $pageSize == '') {
            $mydata =[
                'Msg' => '查询错误',
                'rol' => 0  //失败为0
            ];
            $this->ajaxReturn($mydata);
        }
        $count = $data->count();
        $totalPage = ceil($count/$pageSize);
        if ($totalPage == 0) {
            $totalPage = 1;
        }
        $startRow = ($nowPage-1) * $pageSize;
        $usersData = $data->limit($startRow,$pageSize)->select();
        $mydata =[
            'totalPage' => $totalPage,
            'nowPage' => $nowPage,
            'usersData' => $usersData,
            'rol' => 1  //成功为1
        ];
        $this->ajaxReturn($mydata);
    }
    
    //密码重置
    public function cgPwd(){
        $u_id = I('post.u_id','');
        if ($u_id == '') {
            $mydata =[
                'Msg' => '信息错误',
                'rol' => 0 //失败为0
            ];
            $this->ajaxReturn($mydata);
        }
        $where = [
            'u_id' => $u_id
        ];
        $cgData = [
            'pwd' => md5('12345')
        ];
        $re = M('user')->where($where)->save($cgData);
        if ($re == false) {
            $mydata =[
                'Msg' => '密码为12345',
                'rol' => 0   //失败为0
            ];
            $this->ajaxReturn($mydata);
        }
        $mydata =[
            'powerArr' => $powerArr,
            'menuData' => $menuData,
            'Msg' => '修改成功，初始密码为12345',
            'rol' => 1 //失败为0,成功为1
        ];
        $this->ajaxReturn($mydata);
    }

    //用户锁定
     public function lock(){
        $u_id = I('post.u_id','');
        $u_st = I('post.u_st','');
        if($u_st == 1)//如果状态为1
        {
            if ($u_id == '') {
            $mydata =[
                'Msg' => '信息错误',
                'rol' => 0 //失败为0
            ];
            $this->ajaxReturn($mydata);
        }
        $where = [
            'u_id' => $u_id
        ];
        $cgData = [
            'u_st' => 2
        ];
        $rel = M('user')->where($where)->save($cgData);
        if ($rel == false) {
            $mydata =[
                'Msg' => '用户已锁定，无需锁定！',
                'rol' => 0   //失败为0
            ];
            $this->ajaxReturn($mydata);
        }
        $mydata =[
            'powerArr' => $powerArr,
            'menuData' => $menuData,
            'Msg' => '用户锁定成功！',
            'rol' => 1,//失败为0,成功为1
            'ree' =>2
        ];
        $this->ajaxReturn($mydata);
        }else{//如果状态为2
            if ($u_id == '') {
            $mydata =[
                'Msg' => '信息错误',
                'rol' => 0 //失败为0
            ];
            $this->ajaxReturn($mydata);
        }
        $where = [
            'u_id' => $u_id
        ];
        $cgData = [
            'u_st' => 1
        ];
        $rel = M('user')->where($where)->save($cgData);
        if ($rel == false) {
            $mydata =[
                'Msg' => '用户未锁定，无需解锁！',
                'rol' => 0   //失败为0
            ];
            $this->ajaxReturn($mydata);
        }
        $mydata =[
            'powerArr' => $powerArr,
            'menuData' => $menuData,
            'Msg' => '用户解锁成功！',
            'rol' => 1, //失败为0,成功为1
            'ree' =>1
        ];
        $this->ajaxReturn($mydata);
        }    
    }
}