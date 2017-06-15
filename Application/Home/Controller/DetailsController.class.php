<?php
namespace Home\Controller;
use Think\Controller;

class DetailsController extends Controller {
    //详情
    function Details(){

    	if (IS_POST) {
    		$s_id = I('post.s_id','');
    		$shopData  = M('shop')->where("s_id={$s_id}")->find();//查找商品详情
      	    //格式转换
            $shopData['s_details'] = htmlspecialchars_decode($shopData['s_details']);
            $shopData['s_details'] = html_entity_decode($shopData['s_details']);
    		if(!empty($shopData)){
    			$shop_data = [
	                'shopData'  => $shopData,
	                'success'   => 1
	            ];
	            $this->ajaxReturn($shop_data);
    		}else{
    			$this->ajaxReturn("失败！");
    			exit();
    		}
    	}else{
            $pid= I('get.id','');
            if (!empty($pid)) {
                if (session('?login')) {
                    $id=session('login');
                    $this->assign('login',$id);
                }
                $this->assign('pro',$pid);
                $this->display();  
            }else{
                $this->error('地址错误',U('User/home'),3);
            }

    		
    	}
    }
    //成交记录
    function closing_record(){
        if(IS_POST){
            $nowPage = I('post.nowPage','');
            $pageSize = I('post.pageSize','');
            if (empty($nowPage) || empty($pageSize)) {
                $mydata =[
                    'Msg' => '查询错误',
                    'rol' => 0  //失败为0
                ];
                $this->ajaxReturn($mydata);
            }
            $count = M('orderlist')->count();
            $totalPage = ceil($count/$pageSize);//总页数
            if ($totalPage == 0) {
                $totalPage = 1;
            }
            $startRow = ($nowPage-1) * $pageSize;//起始下标
            $paidData = M('orderlist')->order('ol_id')->limit($startRow,$pageSize)->select();
            $shopName = M('shop');   //查询商品名
            $userName = M('user');   //查询用户名
            foreach ($paidData as $key => $value) {
                $shopDatas = $shopName->field('s_name')->where("s_id={$value['s_id']}")->find();
                $userData = $userName->field('account')->where("u_id={$value['u_id']}")->getField('account');//获得用户名
                $paidData[$key]['s_id'] = $shopDatas['s_name'];
                $paidData[$key]['u_id'] = $userData;
            }
            // dump($paidData);exit();
            $shop_data =[
                'totalPage' => $totalPage,
                'nowPage'   => $nowPage,
                'orderlist' => $paidData,
                'count'     => $count,
                'success'   => 1
            ];
            $this->ajaxReturn($shop_data);    
        }else{
            $this->display();
        }
    }
    
}