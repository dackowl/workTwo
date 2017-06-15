<?php
namespace Home\Controller;
use Think\Controller;
class BuyController extends Controller {
    public function index(){
        session_start();
        $this->display();
    }
    //redis连接
    private function connectRedis(){
        $redis=new \Redis();

        $redis->connect(C("REDIS_HOST"),C("REDIS_PORT"));       
        return $redis;
    }
    //现在初始化里面定义后边要使用的redis参数
    public function _initialize(){
        $goods_id = I("post.p_id",'0','intval');
        $user_id = I("post.u_id",'0','intval');      
        if($goods_id){
            $this->goods_id = $goods_id;
            $this->user_queue_key = "goods_".$goods_id."_user";//当前商品队列的用户情况
            $this->goods_num_key = "goods".$goods_id;//当前商品的库存队列
        }
        $this->user_id = $user_id;
    }
    //客户点击进入商品详情时，先将当前商品的库存进行队列存入redis
    public function before(){
        $where['s_id'] = $this->goods_id;
        $goods = M("shop")->where($where)->field('s_num,s_id')->find();
        if($goods['s_num'] > 0){
            $redis = $this->connectRedis();
            $getUserRedis = $redis->hGetAll("{$this->user_queue_key}");
            $gnRedis = $redis->llen("{$this->goods_num_key}");
            /* 如果没有会员进来队列库存 */
            if(!count($getUserRedis) && !$gnRedis){
                for ($i = 0; $i < $goods['s_num']; $i ++) {
                    $redis->lpush("{$this->goods_num_key}", 1);
                }
            }
            $resetRedis = $redis->llen("{$this->goods_num_key}");
            if(!$resetRedis){
                $this->ajaxReturn(array("status" => "0","msg" => "目前已售完！"));
            }
        }else{
            $this->ajaxReturn(array("status" => "0","msg" => "当前产品已经售完"));
        }
        $this->ajaxReturn(array("status" => "1","msg" => '加载成功'));
    }
    //进入购买的排队队列
    public function buy(){
        //判断客户是否已经登录
        if ($this->user_id == 0) {
            $this->ajaxReturn(array("status" => "0","msg" => "请先登录账号"));
        }
        //判断商品状态
        // $where['s_id'] = $this->goods_id;
        // $goods_info = M('shop')->where($where)->field('s_id,s_state')->find();
        // if ($goods_info['s_state'] == '未上架') {
        //     $this->ajaxReturn(array("status" => "0","msg" => "该商品还未上架！"));
        // }
        
        /* redis 队列 */  
        $redis = $this->connectRedis();
        /* 进入队列  */
        $goods_num_key = $redis->llen("{$this->goods_num_key}");
        if($goods_num_key){
            // 判断用户是否已在队列
            if (!$redis->hGet("{$this->user_queue_key}", $this->user_id)) {
                $condition['u_id'] = $this->user_id;
                $condition['s_id'] = $this->goods_id;
                $cartlist = M('orderlist')->where($condition)->count();
                if ($cartlist==0) {
                    $goods_num_key = $redis->lpop("{$this->goods_num_key}");
                    // 插入抢购用户信息
                    $info = array(
                        "user_id" => $this->user_id,
                        "goods_id" => $this->goods_id,
                        "create_time" => time()
                    );
                    $redis->hSet("{$this->user_queue_key}", $this->user_id, serialize($info));
                    
                    $shopData = M('shop')->where("s_id={$this->goods_id}")->find();
                    // 插入订单表
                    $userinfo['u_id'] = $this->user_id;
                    $userinfo['s_id'] = $this->goods_id;
                    $userinfo['ol_money'] = $shopData['s_pri'];
                    $userinfo['ol_num'] = "1";
                    // dump($userinfo);
                    $re = M('orderlist')->data($userinfo)->add();
                    $this->ajaxReturn(array("status" => "1",'msg'=>"成功购买"));
                }else{
                    $this->ajaxReturn(array("status" => "0",'msg'=>"您已经购买过了该产品"));
                }
            }else{
                $this->ajaxReturn(array("status" => "0",'msg'=>'已经下单成功'));
            }
        }else{
            $this->ajaxReturn(array("status" => "2","msg" => "系统繁忙,请刷新！"));
        }
    }
    //清空
    public function clearRedis(){
        $redis = $this->connectRedis();
        unset($_SESSION['olid']);
        $re = $redis->flushall();
        $this->ajaxReturn(array("status" => "1","msg" => $re));
    }
}