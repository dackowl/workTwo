<?php
namespace Admin\Controller;
use Think\Controller;

header("Content-type: text/html;charset=utf-8");
class ShopController extends Controller {
    
    function shopPreview(){//商品信息展示
        if (IS_POST) {
            $nowPage = I('post.nowPage','');
            $pageSize = I('post.pageSize','');
            if (empty($nowPage) || empty($pageSize)) {
                $mydata =[
                    'Msg' => '信息查询有误！',
                    'success' => 0
                ]; 
                $this->ajaxReturn($mydata);
            }
            $data = M('shop');
            $count = $data->count(); // 查询总条数
            // dump($count);
            $totalPage = ceil($count/$pageSize);//总页数
            if ($totalPage == 0) {
                $totalPage = 1;
            }
            $startRow = ($nowPage-1) * $pageSize;//起始下标
            $shopData = $data->limit($startRow,$pageSize)->select();
            // dump($shopData);
            if(!empty($shopData)){
                $shop_data =[
                    'totalPage' => $totalPage,
                    'nowPage'   => $nowPage,
                    'shopData'  => $shopData,
                    'count'     => $count,
                    'success'   => 1
                ];
                $this->ajaxReturn($shop_data);
            }else{
                $this->ajaxReturn('未找到相关信息！');
            }
        }else{
            $this->display();
        }
    }
    //上架
    function upShow(){
        if (IS_POST) {
            $s_id=I('post.s_id','');
            $s_state=I('post.s_state','');            
            if ($s_id != '' && !empty($s_state)) {
                $data_state = M('shop')->field('s_state')->where("s_id={$s_id}")->find();
                // dump($data_state['s_state']);$data_state['s_state'] == $s_state && 
                if(!empty($data_state)){
                    $data['s_state'] = "已上架";
                    $data_state = M('shop')->where("s_id={$s_id}")->save($data);
                    if (!empty($data_state)) {
                        $returnAjax =[
                            'msg'        => '成功上架！',
                            'statu'      => 1,
                            'curr_state' => $data['s_state']
                        ];
                        $this->ajaxReturn($returnAjax);
                    }else{
                        $this->ajaxReturn("未上架成功！");
                    }
                }else{
                    $this->ajaxReturn("未上架成功！");
                }
            }
        }
    }
    //下架
    function downHide(){
        if (IS_POST) {
            $s_id=I('post.s_id','');
            $s_state=I('post.s_state','');            
            if ($s_id != '' && !empty($s_state)) {
                $data_state = M('shop')->field('s_state')->where("s_id={$s_id}")->find();
                // dump($data_state['s_state']);$data_state['s_state'] == $s_state && 
                if(!empty($data_state)){
                    $data['s_state'] = "已下架";
                    $data_state = M('shop')->where("s_id={$s_id}")->save($data);
                    if (!empty($data_state)) {
                        $returnAjax =[
                            'msg'        => '成功下架！',
                            'statu'      => 1,
                            'curr_state' => $data['s_state']
                        ];
                        $this->ajaxReturn($returnAjax);
                    }else{
                        $this->ajaxReturn("下架失败，请检查是否操作有误！");
                    }
                }else{
                    $this->ajaxReturn("下架失败，请检查是否操作有误！");
                }
            }
        }
    }
    //删除
    function delete_shop(){
        if (IS_POST) {
            $s_id=I('post.s_id','');
            if ($s_id != '') {
                $data = M('shop')->where("s_id={$s_id}")->delete();
                // dump($data);
                if ($data != false || $data != 0) {
                    $this->ajaxReturn("删除成功！");
                }else{
                    $this->ajaxReturn("删除失败，请检查是否已生产订单数据，如若有可以下架处理！");
                }
            }
        }
    }
    //获取当前编辑的商品信息
    function Get_edit_info(){
        if (IS_POST) {
            $s_id = I('post.s_id','');
            // echo $s_id;
            if ($s_id != '') {
                $data = M('shop')->where("s_id={$s_id}")->find();
                if(!empty($data)){
                    $this->ajaxReturn($data);
                }
            }else{
                $this->ajaxReturn("未获取到该商品信息！");
                exit();
            }
        }else{
            $this->ajaxReturn("未获取到该商品信息！");
        }
    }
    //修改
    function shop_edit(){
        if (IS_POST) {
            $s_id = I('post.s_id','');
            $s_name = I('post.s_name','');
            $s_img = I('post.s_img','');
            $s_pri = I('post.s_pri','');
            $s_num = I('post.s_num','');
            $s_des = I('post.s_des','');
            $s_details = I('post.s_details','');
            $s_state = I('post.s_state','');
            //echo $s_id,$s_name,$s_img,$s_pri,$s_sum,$s_des,$s_details,$s_state;
            if($s_id!='' && $s_name!='' && $s_img!='' && $s_pri!='' && $s_num!='' && $s_des!='' && $s_details!='' && $s_state!=''){
                $upData = [
                    's_name'    => $s_name,
                    's_pri'     => $s_pri,
                    's_num'     => $s_num,
                    's_state'   => $s_state,
                    's_img'     => 'pro_43.jpg',//要改
                    's_details' => $s_details,
                    's_des'     => $s_des
                ];
                $data = M('shop')->where("s_id={$s_id}")->save($upData);
                // dump($data);
                if($data != false && $data !=0){
                    $scuessData =[
                        's_name'    => $s_name,
                        's_pri'     => $s_pri,
                        's_num'     => $s_num,
                        's_state'   => $s_state,
                        's_img'     => 'adr_43.jpg',//要改
                        's_details' => $s_details,
                        's_des'     => $s_des,
                        'msg'      => "修改成功！",
                        'statu'    => 1  //成功为1
                    ];
                    $this->ajaxReturn($scuessData);
                }else if($data == 0){
                    $this->ajaxReturn("修改失败，您提交的数据都是一样的无需修改！");
                }else{
                    $this->ajaxReturn("修改失败，请输入输入是否有误！");
                }
            }
        }
    }
    //图片上传
    function picturePreview(){
        $a = A('Common/Public');
        $b = $a->fileup();
    }

    //添加商品
    function shopRelease(){
    	if(IS_POST){
            $s_name     = I('post.s_name','');
            // $s_addTime  = I('post.s_addTime','');
            $s_pri      = I('post.s_pri','');
            $s_num      = I('post.s_num','');
            $s_img      = I('post.s_img','');
            $s_details  = I('post.s_details','');
            $s_des      = I('post.s_des','');
            if(!empty($s_name) && $s_pri != '' && $s_num != '' && $s_img != '' && $s_details != '' && $s_des != '' ){
                $dataList = [
                    's_name'    => $s_name,
                    's_pri'     => $s_pri,
                    's_num'     => $s_num,
                    's_img'     => 'pro_43.jpg',//要改
                    's_details' => $s_details,
                    's_des'     => $s_des
                ];
                // dump($dataList);
                $shopData = M('shop')->add($dataList);//返回的是插入的ID
                if ($shopData != '') {
                    $this->ajaxReturn("商品发布成功！");
                }
            }else{
                $this->ajaxReturn("商品发布失败！");
                exit();
            }
        }else{
            $this->display();
        }
    }


    


}