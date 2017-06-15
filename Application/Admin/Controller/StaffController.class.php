<?php
namespace Admin\Controller;
use Think\Controller;
class StaffController extends Controller {
    //当前网页
    public function index(){
        $this->display();
    }
    //获取当前页的数据
    public function nowpage(){
    	// 实例化对象
        $data = M('staff');

    	//获取数据
        $nowPage = I('post.nowPage','');
        $pageSize = I('post.pageSize','');

        if ($nowPage == '' || $pageSize == '') {
        	$mydata =[
	            'Msg' => '查询错误',
	            'rol' => 0 	//失败为0
	        ];
	        $this->ajaxReturn($mydata);
        }
        $count = $data->count();
        $totalPage = ceil($count/$pageSize);
        if ($totalPage == 0) {
        	$totalPage = 1;
        }
        $startRow = ($nowPage-1) * $pageSize;
        //$sql = $data->field()->order('r_id')->limit($startRow,$pageSize)->fetchSql(true)->select();
        $staffData = $data->order('s_id')->limit($startRow,$pageSize)->select();
        $rolesData = M('rolestable')->field('r_id,rolesname')->select();
        $stData = M('usest')->select();
        $mydata =[
            'totalPage' => $totalPage,
            'nowPage' => $nowPage,
            'staffData' => $staffData,
            'rolesData' => $rolesData,
            'stData' => $stData,
            'rol' => 1 	//成功为1
        ];
        $this->ajaxReturn($mydata);
    }
    //添加员工
    public function addStaff(){
    	// 实例化对象
    	$data = M('staff');

    	//获取数据
        $addName = I('post.addName','');
        $addRoles = I('post.addRoles','');
        $addAccount = I('post.addAccount','');
        $addSt = I('post.addSt','');
        if ($addName == '' || $addRoles == '' || $addAccount == '' || $addSt == '') {
        	$mydata =[
	            'Msg' => '信息添加错误',
	            'rol' => 0 //失败为0
	        ];
	        $this->ajaxReturn($mydata);
        }
        $addData = [
        	's_name' => $addName,
        	'roles' => $addRoles,
            'account' => $addAccount,
            's_pwd' => md5('123456'),
            'st' =>$addSt
        ];
        $rename = $data->where("account={$addAccount}")->find();
        if ($rename != null || $rename != false) {
            $mydata =[
                'Msg' => '该账号已存在',
                'rol' => 0  //失败为0
            ];
            $this->ajaxReturn($mydata);
        }
		$re = $data->add($addData);
		if ($re == false) {
			$mydata =[
	            'Msg' => '添加失败',
	            'rol' => 0 	//失败为0
	        ];
	        $this->ajaxReturn($mydata);
		}
        $mydata =[
            'Msg' => '添加成功',
            'rol' => 1 	//成功为1
        ];
        $this->ajaxReturn($mydata);
    }
    //删除员工
    public function del(){
    	// 实例化对象
    	$data = M('staff');

    	//获取数据
        $s_id = I('post.s_id','');

        if ($s_id == '') {
        	$mydata =[
	            'Msg' => '信息错误',
	            'rol' => 0 //失败为0
	        ];
	        $this->ajaxReturn($mydata);
        }
        $delData = [
        	's_id' => $s_id
        ];
        $re = $data->where($delData)->delete();
        if ($re == false) {
			$mydata =[
	            'Msg' => '删除失败',
	            'rol' => 0 	//失败为0
	        ];
	        $this->ajaxReturn($mydata);
		}
        $mydata =[
            'Msg' => '删除成功',
            'rol' => 1 	//成功为1
        ];
        $this->ajaxReturn($mydata);
    }
    //修改信息
    public function cgStaff(){
    	// 实例化对象
    	$data = M('staff');

    	//获取数据
        $cg_id = I('post.cg_id','');
        $cgName = I('post.cgName','');
        $cgRoles = I('post.cgRoles','');
        $cgAccount = I('post.cgAccount','');
        $cgSt = I('post.cgSt','');

        if ($cg_id == '' || $cgName == '' || $cgRoles == '' || $cgAccount == '' || $cgSt == '') {
        	$mydata =[
	            'Msg' => '信息错误',
	            'rol' => 0 //失败为0
	        ];
	        $this->ajaxReturn($mydata);
        }
        $where = [
        	's_id' => $cg_id
        ];
        $upData = [
        	's_name' => $cgName,
        	'roles' => $cgRoles,
            'account' => $cgAccount,
            'st' => $cgSt
        ];
        $re = $data->where($where)->save($upData);
        if ($re == false) {
			$mydata =[
	            'Msg' => '修改失败，数据未变化',
	            'rol' => 0 	//失败为0
	        ];
	        $this->ajaxReturn($mydata);
		}
        $mydata =[
            'Msg' => '修改成功',
            'rol' => 1 	//成功为1
        ];
        $this->ajaxReturn($mydata);
    }
    //重置密码
    public function cgPwd(){
    	$s_id = I('post.s_id','');
    	if ($s_id == '') {
        	$mydata =[
	            'Msg' => '信息错误',
	            'rol' => 0 //失败为0
	        ];
	        $this->ajaxReturn($mydata);
        }
        $where = [
            's_id' => $s_id
        ];
        $cgData = [
            's_pwd' => md5('123456')
        ];
        $re = M('staff')->where($where)->save($cgData);
        if ($re == false) {
            $mydata =[
                'Msg' => '密码为123456',
                'rol' => 0   //失败为0
            ];
            $this->ajaxReturn($mydata);
        }
        $mydata =[
            'powerArr' => $powerArr,
            'menuData' => $menuData,
            'Msg' => '修改成功，初始密码为123456',
            'rol' => 1 //失败为0,成功为1
        ];
        $this->ajaxReturn($mydata);
    }
}