<?php
namespace Admin\Controller;
use Think\Controller;
class CommController extends Controller {
    public function index(){
        $this->display('/comments');
    }
    //分页
    public function nowpage(){
        // 实例化对象
        $data = M('comments');

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

    //评论删除
    public function dele(){
        $c_id = I('post.c_id','');
        if ($c_id == '') {
            $mydata =[
                'Msg' => '信息错误',
                'rol' => 0 //失败为0
            ];
            $this->ajaxReturn($mydata);
        }
        $where = [
            'c_id' => $c_id
        ];
        $re = M('comments')->where($where)->delete();
        if ($re == false) {
            $mydata =[
                'Msg' => '删除失败',
                'rol' => 0   //失败为0
            ];
            $this->ajaxReturn($mydata);
        }
        $mydata =[
            'Msg' => '删除成功',
            'rol' => 1 //失败为0,成功为1

        ];
        $this->ajaxReturn($mydata);
    }
}