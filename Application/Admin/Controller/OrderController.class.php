<?php
namespace Admin\Controller;
use Think\Controller;

header("Content-type: text/html;charset=utf-8");
class OrderController extends Controller {
    //已支付订单
    function paidOrder(){
        if(IS_POST){
            $nowPage = I('post.nowPage','');
            $pageSize = I('post.pageSize','');
            // echo $nowPage,$pageSize;
            if (empty($nowPage) || empty($pageSize)) {
                $mydata =[
                    'Msg' => '查询错误',
                    'rol' => 0  //失败为0
                ];
                $this->ajaxReturn($mydata);
            }
            $data = M('orderlist');
            $count = $data->where('os_id != 2')->count(); // 查询不等于未付款的条数
            // dump($count);
            $totalPage = ceil($count/$pageSize);//总页数
            if ($totalPage == 0) {
                $totalPage = 1;
            }
            $startRow = ($nowPage-1) * $pageSize;//起始下标
            $paidData = $data->where("os_id != 2")->order('ol_id')->limit($startRow,$pageSize)->select();
            // dump($paidData);
            $shopState = M('orderstate');//查询状态
            $shopName = M('shop');   //查询商品名
            $userName = M('user');   //查询用户名
            foreach ($paidData as $key => $value) {
                $shopData = $shopState->field('os_state')->where("os_id={$value['os_id']}")->find();
                $shopDatas = $shopName->field('s_name')->where("s_id={$value['s_id']}")->find();
                $userData = $userName->field('account')->where("u_id={$value['u_id']}")->find();
                $paidData[$key]['os_id'] = $shopData['os_state'];//替换值
                $paidData[$key]['s_id'] = $shopDatas['s_name'];
                $paidData[$key]['u_id'] = $userData['account'];
            }
            // dump($paidData);
            $shop_data =[
                'totalPage' => $totalPage,
                'nowPage'   => $nowPage,
                'paidData'  => $paidData,
                'count'     => $count,
                'rol'       => 1  //成功为1
            ];
            $this->ajaxReturn($shop_data);    
        }else{
            $this->display();
        }
    }
    //发货
    function btn_send(){
        if (IS_POST) {
            $btn_send_ol_id = I('post.ol_id','');
            $btn_send_os_id = I('post.os_id','');
            // echo $btn_send_ol_id,$btn_send_os_id;
            if (!empty($btn_send_ol_id) && !empty($btn_send_os_id)) {
                $mod = M("orderlist");
                $curr_os_id = $mod->field('os_id')->where("ol_id={$btn_send_ol_id}")->find();//先拿商品表的的状态ID
                $state_os_id = M('orderstate')->field('os_state')->where("os_id={$curr_os_id['os_id']}")->find();//在拿状态表的状态值
                if ($state_os_id['os_state'] == $btn_send_os_id && !empty($state_os_id)){
                    $changeData = [
                        'os_id' => 3
                    ];
                    $data = $mod->where("ol_id={$btn_send_ol_id}")->save($changeData);
                    // dump($data);
                    if($data){
                        $returnAjax =[
                            'msg'        => '发货成功',
                            'statu'      => 1,
                            'curr_state' =>"已发货"
                        ];
                        $this->ajaxReturn($returnAjax);
                    }else{
                        $this->ajaxReturn("发货失败！");
                    }
                }
            }else{
                $this->ajaxReturn("发货失败！");
            }
        }else{
            $this->ajaxReturn("发货失败！");
        }
    }
    //查看详情
    function btn_look(){
        if(IS_POST){
            $btn_look_ol_id = I('post.ol_id','');
            $mod = M("orderlist");
            $data = $mod->where("ol_id={$btn_look_ol_id}")->find();
            //查商品信息
            $shopData = M('shop')->where("s_id={$data['s_id']}")->find();
            //查用户信息
            $userData = M('user')->where("u_id={$data['u_id']}")->find();
            $msg = [
                $data,$shopData,$userData
            ];
            // dump($msg);
            $this->ajaxReturn($msg);
        }else{
            $this->ajaxReturn("操作有误！");
            exit();
        }
    }
   
    //未支付订单
    function unpaidOrder(){
        if(IS_POST){
            $nowPage = I('post.nowPage','');
            $pageSize = I('post.pageSize','');
            // echo $nowPage,$pageSize;
            if (empty($nowPage) || empty($pageSize)) {
                $mydata =[
                    'Msg' => '查询错误',
                    'rol' => 0 
                ];
                $this->ajaxReturn($mydata);
            }

            $data = M('orderlist');
            $count = $data->where('os_id = 2')->count(); // 查询等于未付款的条数
            // dump($count);
            $totalPage = ceil($count/$pageSize);//总页数
            if ($totalPage == 0) {
                $totalPage = 1;
            }
            $startRow = ($nowPage-1) * $pageSize;//起始下标
            $paidData = $data->where("os_id = 2")->order('ol_id')->limit($startRow,$pageSize)->select();
            // dump($paidData);
            $shopState = M('orderstate');//查询状态
            $shopName = M('shop');   //查询商品名
            $userName = M('user');   //查询用户名
            foreach ($paidData as $key => $value) {
                $shopData = $shopState->field('os_state')->where("os_id={$value['os_id']}")->find();
                $shopDatas = $shopName->field('s_name')->where("s_id={$value['s_id']}")->find();
                $userData = $userName->field('account')->where("u_id={$value['u_id']}")->find();
                $paidData[$key]['os_id'] = $shopData['os_state'];//替换值
                $paidData[$key]['s_id'] = $shopDatas['s_name'];
                $paidData[$key]['u_id'] = $userData['account'];
            }
            // dump($paidData);
            $shop_data =[
                'totalPage' => $totalPage,
                'nowPage'   => $nowPage,
                'paidData'  => $paidData,
                'count'     => $count,
                'rol'       => 1  //成功为1
            ];
            $this->ajaxReturn($shop_data);    
        }else{
            $this->display();
        }
    }
    //获取金额/数量信息
    function btn_modify(){
        if(IS_POST){
            $btn_modify_ol_id    = I('post.ol_id','');
            if (!empty($btn_modify_ol_id)) {
                $data = M('orderlist')->where("ol_id={$btn_modify_ol_id}")->field('ol_id,ol_money,ol_num')->find();
                if(!empty($data)){
                    $this->ajaxReturn($data);
                }
            }else{
                exit();
            }
        }else{
            $this->ajaxReturn("操作有误！");
            exit();
        }
    }
    //修改价格
    function unpaidOrder_change(){
        if(IS_POST){
            $change_ol_id    = I('post.ol_id','');
            $change_ol_money = I('post.ol_money','');//价格
            $change_ol_num   = I('post.ol_num','');//数量
            if($change_ol_id != '' && $change_ol_money !='' && $change_ol_num !=''){
                $upData = [
                    'ol_money' => $change_ol_money,
                    'ol_num' => $change_ol_num,
                ];
                // dump($upData);
                $curr_data = M('orderlist')->where("ol_id={$change_ol_id}")->save($upData);
                // dump($curr_data);
                if($curr_data != false){
                    $scuessData =[
                        'ol_money' => $change_ol_money,
                        'ol_num'   => $change_ol_num,
                        'msg'      => "修改成功！",
                        'statu'    => 1  //成功为1
                    ];
                    $this->ajaxReturn($scuessData);
                }else{
                    $this->ajaxReturn("修改失败，请输入要修改的值！");
                }
            }else{
                $this->ajaxReturn("修改失败！");
                exit();
            }
        }
        else{
            $this->ajaxReturn("操作有误！");
            exit();
        }
    }
    


}
