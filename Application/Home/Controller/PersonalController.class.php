<?php
namespace Home\Controller;
use Think\Controller;
//修改个人信息
class PersonalController extends Controller {
    
    function personalCenter(){
    	if (IS_POST) {
    		$account = I('post.account','');
    		if (empty($account)) {
    			exit();
    		}
    		$userData   = M('user')->where("account='{$account}'")->find();//获取用户信息
    		$travelData = M('travel')->where("t_uid='{$userData['u_id']}'")->find();//获取游记信息 
    		$commData   = M('comments')->where("account='{$account}'")->find();//点评信息
    		// dump($userData);exit();
    		$messageData= M('message')->where("account='{$account}'")->select();//获取留言信息
            $response = [
    			'userData'    => $userData,
                'travelData'  => $travelData,
                'commData'    => $commData,
                'messageData' => $messageData,
                'success'     => 1
            ];
            $this->ajaxReturn($response);   
    	}else{
            if (session('?login')) {
                $id=session('login');
                // dump($id);
                $this->assign('login',$id);
            }
    		$this->display();
    	}
    }
    //个人简介
    function preserved(){
        if (!IS_POST) {
            $this->ajaxReturn("保存失败！");
            exit();
        }
        $content = I('post.content','');
        $account = I('post.account','');
        $data['profile'] = $content;
        $userData = M('user')->where("account='{$account}'")->data($data)->save();
        // dump($userData);exit();
        if ($userData == false) {
            $this->ajaxReturn("保存失败！");
            exit();
        }
        $successData = [
            'content' => $content,
            'success' => 1
        ];
        $this->ajaxReturn($successData);
    }

    //留言
    function leave_contents(){
        if (IS_POST){
            $account = I('post.account','');
            if (empty($account)) {
                exit();
            }
            $currData = M('message')->order('time desc')->select();
            $userData = M('user')->where("account='{$account}'")->field('nick,h_img')->select();//获取用户信息
            // dump($userData);exit();
            if (!empty($currData)) {
                $msg_data = [
                    'currData' => $currData,
                    'userData' => $userData,
                    'success'  => 1
                ];
                $this->ajaxReturn($msg_data);
            }
        }
    }
    function leave_content(){
    	if (IS_POST) {
    		$content = I('post.content','');
            $account = I('post.account','');
    		if (empty($content)) {
    			$this->ajaxReturn("请填写留言信息！");
    			exit();
    		}
            $data = [
                'msg_con' => $content,
                'account' => $account,
            ];
            $message_data = M('message')->add($data);
            if (empty($message_data)) {
                $this->ajaxReturn("留言失败！");
                exit();
            }
            $currData = M('message')->order('time desc')->select();
            $userData = M('user')->where("account='{$account}'")->field('nick,h_img')->select();//获取用户信息
            // dump($userData);exit();
            if (!empty($currData)) {
                $msg_data = [
                    'currData' => $currData,
                    'userData' => $userData,
                    'success'  => 1
                ];
                $this->ajaxReturn($msg_data);
            }
    	}else{
            $this->ajaxReturn("留言失败！");
            exit();
        }
    }
    //删除
    function delete_leave(){
        if (IS_POST) {
            $msg_id = I('post.msg_id','');
            if (empty($msg_id)) {
                $this->ajaxReturn("删除失败！");
                exit();
            }
            $data = [
                'msg_id' => $msg_id,
            ];
            $message_data = M('message')->where("msg_id='{$msg_id}'")->delete();
            // dump($message_data);
            if ($message_data == false || $message_data == 0) {
                $this->ajaxReturn("删除失败，请重新操作！");
                exit();
            }
            $msg_data = [
                'msg_id'  => $msg_id,
                'success' => 1
            ];
            $this->ajaxReturn($msg_data);
        }else{
            $this->ajaxReturn("删除失败！");
            exit();
        }
    }
    //页面跳转至个人信息修改
    function userInfoCenter(){
        if (session('?login')) {
                $id=session('login');
                // dump($id);
                $this->assign('login',$id);
            }
        $this->display();
    }
    //我的信息获取
    function myInfo(){
        if (IS_POST) {
            $id = I('post.u_id','');
            $data = M('user')->where("u_id='{$id}'")->find();
            if (empty($data)) {
                exit();
            }
            $userData = [
                'data'    => $data,
                'success' => 1
            ];
            $this->ajaxReturn($userData);
        }else{
            exit();
        }
    }
    //修改我的信息
    function modifyInfo(){
        if (IS_POST) {
            $id      = I('post.u_id','');
            $nick    = I('post.nick','');
            $address = I('post.address','');
            $profile = I('post.profile','');
            if (empty($id)) {
                $this->ajaxReturn("修改失败！");
                exit();
            }
            $data = [
                'nick'    => $nick,
                'address' => $address,
                'profile' => $profile
            ];
            $userData = M('user')->where("u_id='{$id}'")->save($data);
            // dump($userData);exit();
            if ($userData == false) {
                $this->ajaxReturn("修改失败！");
                exit();
            }
            $successData = [
                'content' => $data,
                'success' => 1
            ];
            $this->ajaxReturn($successData);
        }else{
            $this->ajaxReturn("修改失败！");
            exit();
        }
    }
    //图片上传
    function picturePreview(){
        $a = A('Common/Public');
        $b = $a->fileupHead();
    }
    function myHead(){
        if (IS_POST) {
            $id = I('post.u_id','');
            $img = I('post.h_img','');
            if (empty($img)) {
                $this->ajaxReturn("上传失败！");
                exit();
            }
            $data['h_img'] = $img;
            $userData = M('user')->where("u_id='{$id}'")->save($data);
            if ($userData == false) {
                $this->ajaxReturn("上传失败！");
                exit();
            }
            $successData = [
                'h_img'   => $img,
                'success' => 1
            ];
            $this->ajaxReturn($successData);
        }else{
            $this->ajaxReturn("上传失败！");
            exit();
        }
    }
    //修改密码
    function mySecurity(){
        if (IS_POST) {
            $id = I('post.u_id','');
            $pwd = I('post.pwd','');
            if (empty($id) || empty($pwd)) {
                $this->ajaxReturn("修改失败！");
                exit();
            }
            $data['pwd'] = $pwd;
            $userData = M('user')->where("u_id='{$id}'")->save($data);
            if ($userData == false || $userData == 0) {
                $this->ajaxReturn("修改失败！");
                exit();
            }
            $successData = [
                'msg'     => "修改成功",
                'success' => 1
            ];
            $this->ajaxReturn($successData);
        }else{
            $this->ajaxReturn("修改失败！");
            exit();
        }
    }
    //充值
    function myWallet(){
        if (IS_POST) {
            $id    = I('post.u_id','');
            $money = I('post.money','');
            $u_money = I('post.u_money','');
            if (empty($id) || empty($money)) {
                $this->ajaxReturn("充值失败！");
                exit();
            }
            $sum = $money+$u_money;
            $data['u_money'] = $sum;
            $userData = M('user')->where("u_id='{$id}'")->save($data);
            if ($userData == false || $userData == 0) {
                $this->ajaxReturn("充值失败！");
                exit();
            }
            $successData = [
                'msg'     => "充值成功",
                'u_money' => $sum,
                'success' => 1
            ];
            $this->ajaxReturn($successData);
        }else{
            $this->ajaxReturn("充值失败！");
            exit();
        }
    }
}