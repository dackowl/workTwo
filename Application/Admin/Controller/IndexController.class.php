<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	$menu=M('menutable');
    	$menuDtata=$menu->select();
    	$user=session('login');
    	$this->assign('login',$user);
    	$this->assign('menu',$menuDtata);
        $this->display();
    }
    public function wellcom()
    {
    	$this->display();
    }
    public function login()
    {
    	if(IS_POST){ //登录验证

			$user=I('post.data','');
			// dump($user);
			$user=['account'=>$user['account'],'s_pwd'=>md5($user['pwd'])];
			
			$login = M('staff');
			$result = $login->where($user)->field('s_id,account,s_name,s_pwd')->limit(1)->select();
			if (!empty($result)) {
				$user=['id'=>$result[0]['s_id'],'nick'=>$result[0]['s_name']];
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
}