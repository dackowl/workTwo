<?php
namespace Home\Controller;
use Think\Controller;
class DingdanController extends Controller {
    public function index(){
        $this->display();
    }
    //redis连接
    private function connectRedis(){
        $redis=new \Redis();
        $redis->connect(C("REDIS_HOST"),C("REDIS_PORT"));       
        return $redis;
    }
    public function before(){
    	$user_id = I("post.u_id",'0','intval');
    	if ($user_id == 0) {
            $this->ajaxReturn(array("status" => "0","msg" => "请先登录账号"));
        }
        $orderData = M('orderlist')->where('os_id=2')->select();
        $shopData = M('shop')->select();
        $this->ajaxReturn(array("status" => "1","orderData" => $orderData,'shopData'=>$shopData));
    }
    public function pay(){
    	//获取参数
        $user_id = I("post.u_id",'0','intval');
        $p_id = I("post.p_id",'0','intval');
        if ($user_id == '0' || $p_id == '0') {
        	$this->ajaxReturn(array("status" => "0","msg" => "信息错误"));
        }
        $where = [
        	'u_id' => $user_id
        ];
        $myMoney = M('user')->field('u_money')->where($where)->find();
        //print_r($myMoney['u_money']);
        $orderWhere = [
        	'u_id' => $user_id,
        	'p_id' => $p_id
        ];
        $orderData = M('orderlist')->where($orderWhere)->find();
        //print_r($orderData['ol_money']);
        //判断用户账号金额是否足够
        if ($myMoney['u_money']<$orderData['ol_money']) {
        	$this->ajaxReturn(array("status" => "0","msg" => "账户余额不足"));
        }
        $payMoney = $myMoney['u_money'] - $orderData['ol_money'];
        try{
            //商品库存减少
            $numRe = M('shop')->where("s_id={$p_id}")->setDec('s_num');
            //订单状态变成完成
            $orderRe = M('orderlist')->where("u_id={$user_id} and s_id={$p_id}")->setField('os_id',1);
            //用户金钱扣款
            $moneyRe = M('user')->where("u_id={$user_id}")->setDec('u_money',$orderData['ol_money']);
            $this->ajaxReturn(array("status" => "1","msg" => "付款成功"));
        }catch(\Think\Exception $e){
            $this->ajaxReturn(array("status" => "0","msg" => "付款失败"));
        };
    }
}