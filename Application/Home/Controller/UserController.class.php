<?php
namespace Home\Controller;
use Think\Controller;
/**
 * 用户控制器
 * 包括用户中心，用户登录及注册
 */
class UserController extends Controller {

	/* 首页 */
	public function home(){
		// S('redis','123');
		// echo S('redis');
		if (session('?login')) {
			$id=session('login');
			// dump($id);
			$this->assign('login',$id);
		}
		$this->display();
		
	}

	/* 注册页面 */
	public function reg($username = '', $password = ''){
		if(IS_POST){
			$reg = M('user');
			$data=I('post.data','');
			if (empty($data)) {
				exit();
			}

			$user=['account'=>$data['account'],'pwd'=>$data['pwd']];
			$result =$reg->add($user);
			if (!isset($result)) {
				$msg=C(AJAX_MSG);
				$msg['sta']  ='1';
				$msg['type'] ='reg';
				$msg['data'] = C('AJAX_REG_MSG_ERR');
				echo json_encode($msg);
			}else{
				$msg=C(AJAX_MSG);
				$msg['sta']  ='0';
				$msg['type'] ='reg';
				$msg['data'] =C('AJAX_REG_MSG_SUC');
				echo json_encode($msg);
			}
		} else { 
			$this->display();
		}

	}
	//重名验证
	public function checkName(){
		if (IS_POST) {
			$login = M('user');
			$user=['account'=>I('post.data','')];
			$result = $login->where($user)->field('account')->limit(1)->find();
			if (isset($result)) {
				$msg=C(AJAX_MSG);
				$msg['sta']  ='0';
				$msg['data'] = C(AJAX_CHECKNAME_MSG);
				echo json_encode($msg);
			}else{
				$msg=C(AJAX_MSG);
				$msg['sta']  ='1';
				$msg['data'] = "";
				echo json_encode($msg);
			}
		}
		
	}
    public function VerifyImg(){
    	if (IS_POST) {
    		$code=I('post.code','');
    		$verify = new \Think\Verify(C('VERIFY'));  
    		$res=$verify->check($code,'login');
    		if ($res) {
    			$msg=C(AJAX_MSG);
				$msg['sta']  ='1';
				echo json_encode($msg);# code...
    		}else{
    			$msg=C(AJAX_MSG);
				$msg['sta']  ='0';
				echo json_encode($msg);
    		}
    	}else{
    		$Verify = new \Think\Verify(C('VERIFY'));  
			$Verify->entry('login');
    	}
   		
    }   
	/* 登录页面 */
	public function login($username = '', $password = ''){
		if(IS_POST){ //登录验证

			$user=I('post.data','');
			// dump($user);
			$login = M('user');
			$result = $login->where($user)->field('u_id,account,nick,pwd,h_img')->limit(1)->select();
			if (!empty($result)) {
		
				$user=['id'=>$result[0]['u_id'],'nick'=>$result[0]['nick'],'img'=>$result[0]['h_img'],'ac'=>$result[0]['account']];
		
				session('login',$user);
				// $this->success('登录成功！',U('Home/User/index'));
				$msg=C(AJAX_MSG);
				$msg['sta']  ='0';
				$msg['data'] = C(AJAX_LOGINS_MSG);
				echo json_encode($msg);
			}else{
				// $this->error('用户名或密码错误');
				$msg=C(AJAX_MSG);
				$msg['sta']  ='1';
				$msg['data'] = C(AJAX_LOGINF_MSG);
				echo json_encode($msg);
			}
		} else { //显示登录表单
			$this->display();

		}
	}
	public function userCanter(){
		if (session('?login')) {
			$id=session('login');
			// dump($id);
			$this->assign('login',$id);
		}
		$this->display();

	}
	public function out(){
        session('login',null);
        $this->display('User/home');
    }

}
