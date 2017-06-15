<?php
namespace Admin\Controller;
use Think\Controller;
class RolesController extends Controller {
    public function index(){
        $this->display();
    }
    //获取当前页的数据
    public function nowpage(){
    	// 实例化对象
        $data = M('rolestable');
        // dump($data);
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
        $rolesData = $data->order('r_id')->limit($startRow,$pageSize)->select();
        $mydata =[
            'totalPage' => $totalPage,
            'nowPage' => $nowPage,
            'rolesData' => $rolesData,
            'rol' => 1 	//成功为1
        ];
        $this->ajaxReturn($mydata);
    }
    //添加角色
    public function addRoles(){
    	// 实例化对象
    	$data = M('rolestable');

    	//获取数据
        $addName = I('post.addName','');
        $addDes = I('post.addDes','');
        if ($addName == '' || $addDes == '') {
        	$mydata =[
	            'Msg' => '信息添加错误',
	            'rol' => 0 //失败为0
	        ];
	        $this->ajaxReturn($mydata);
        }
        $addData = [
        	'rolesname' => $addName,
        	'r_des' => $addDes
        ];

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
    //删除角色
    public function del(){
    	// 实例化对象
    	$data = M('rolestable');

    	//获取数据
        $r_id = I('post.r_id','');

        if ($r_id == '') {
        	$mydata =[
	            'Msg' => '信息错误',
	            'rol' => 0 //失败为0
	        ];
	        $this->ajaxReturn($mydata);
        }
        $delData = [
        	'r_id' => $r_id
        ];
        try{
            $re = $data->where($delData)->delete();
        }catch(\Think\Exception $e){
            $mydata =[
                'Msg' => '删除失败，请先将该角色的员工删除',
                'rol' => 0  //失败为0
            ];
            $this->ajaxReturn($mydata);
        };
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
    public function infoUp(){
    	// 实例化对象
    	$data = M('mf_wo.rolestable','mf_');

    	//获取数据
        $cg_id = I('post.cg_id','');
        $cg_name = I('post.cg_name','');
        $cg_des = I('post.cg_des','');

        if ($cg_id == '' || $cg_name == '' || $cg_des == '') {
        	$mydata =[
	            'Msg' => '信息错误',
	            'rol' => 0 //失败为0
	        ];
	        $this->ajaxReturn($mydata);
        }
        $where = [
        	'r_id' => $cg_id
        ];
        $upData = [
        	'rolesname' => $cg_name,
        	'r_des' => $cg_des
        ];
        $re = $data->where($where)->save($upData);
        if ($re == false) {
			$mydata =[
				're' => $re,
	            'Msg' => '数据未修改',
	            'rol' => 0 	//失败为0
	        ];
	        $this->ajaxReturn($mydata);
		}
        $mydata =[
        	're' => $re,
            'Msg' => '修改成功',
            'rol' => 1 	//成功为1
        ];
        $this->ajaxReturn($mydata);
    }
    //修改权限
    public function cgPower(){
    	$cg_id = I('post.cg_id','');
    	if ($cg_id == '') {
        	$mydata =[
	            'Msg' => '信息错误',
	            'rol' => 0 //失败为0
	        ];
	        $this->ajaxReturn($mydata);
        }
        $powerData = M('righttable')->where("roles={$cg_id}")->find();
        if ($powerData == false || $powerData == '') {
        	$powerArr == [];
        }else{
        	$powerArr = explode(',',$powerData['menuid']);
        }
        $menuData = M('menutable')->select();
        $mydata =[
            'powerArr' => $powerArr,
            'menuData' => $menuData,
            'Msg' => '查询成功',
            'rol' => 1 //失败为0
        ];
        $this->ajaxReturn($mydata);
    }
    //保存修改权限
    public function powerUp(){
    	$cg_id = I('post.cg_id','');
    	$powerArr = I('post.powerArr','');
    	if ($cg_id == '') {
        	$mydata =[
	            'Msg' => '信息错误',
	            'rol' => 0 //失败为0
	        ];
	        $this->ajaxReturn($mydata);
        }
    	$powerStr = implode(",",$powerArr);
    	$upData = [
        	'menuid' => $powerStr
        ];
    	$re = M('righttable')->where("roles={$cg_id}")->save($upData);
    	if ($re == false) {
    		$addData = [
	        	'roles' => $cg_id,
	        	'menuid' => ''
	        ];
    		$addRe = M('righttable')->add($addData);
    		$re = M('righttable')->where("roles={$cg_id}")->save($upData);
    	}
        $mydata =[
            'Msg' => '修改成功',
            'rol' => 1 	//成功为1
        ];
        $this->ajaxReturn($mydata);
    }
}