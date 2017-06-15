<?php
namespace Home\Controller;
use Think\Controller;

class ShopController extends Controller {
    public function index(){
        if (session('?login')) {
            $id=session('login');
            //dump($id);
            $this->assign('login',$id);
        }
    	//phpinfo();
    	$this->host();
    	//$this->hostin();
        $this->display('/shop');
    }
    public function host()
    {
    	$db = M('shop')->field('s_id,s_details,s_img,s_pri')->select();
    	$this->assign('attr', $db);
    }
    //分页
    public function nowpage(){
        // 实例化对象
        $data = M('shop');

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
}