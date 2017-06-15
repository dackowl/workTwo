<?php
namespace Admin\Controller;
use Think\Controller;
class DestinController extends Controller {//已审核控制器操作
    public function index(){
        $Des = M('des'); //1.实例化目的地
        
        $count      = $Des->where('d_st<3')->count();// 查询满足要求的总记录数
        
        $Page       = new \Think\Page($count,6);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $show       = $Page->show();// 分页显示输出
        
        $res=$Des->where('d_st<3')->field('d_id,d_city,d_img,d_st')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('Des',$res);//赋值目的地输出
        
        $St  = M('st');//2.修改时的实例化目的地状态
        $s_data = $St->where('s_id<3')->field('s_id,s_name')->select();
        $this->assign('St',$s_data);//赋值目的地状态输出
        
        $Sta  = M('st');//3.添加时的实例化目的地状态
        $st_data = $Sta->where('s_id=1')->field('s_id,s_name')->select();
        $this->assign('Sta',$st_data[0]);//赋值目的地状态输出
        
        $Area= M('area');//4.实例化目的地地区
        $a_data =$Area->field('a_id,a_name')->select();
        $this->assign('Area',$a_data);
        
        $Stat=M('st');//5.添加时的实例化目的地状态
        $stat_data = $Sta->where('s_id=3')->field('s_id,s_name')->select();
        $this->assign('Stat',$stat_data[0]);//赋值目的地状态输出
        // dump($stat_data);
        // exit;
        
        $this->assign('page',$show);// 赋值分页输出
        $this->display();    
    }
    public function addin(){//添加状态
        $State=M('st');
        $id=I('post.id','');
        $con=['id'=>$id];
        $res=$State->find($id);
        echo json_encode($res);
    }
    public function sub(){
        
    }
    public function check(){//查看
        $id=I('post.id','');
        $Check = M('des');
        $res=$Check ->find($id);
        echo json_encode($res);  
    }
    public function insert(){//添加
        $Insert = M("des"); // 实例化User对象
        $proData=I('post.data','');
        $result=$Insert->add($proData);
       // dump($result) ;
        if(!empty($result)){
           $data = array(
               'statu'=>1,
               'sub' => '提交成功,刷新页面'
           );
           }else{
               $data = array(
                   'sub' => '提交失败,请稍后再试'
               );
           }
           $this->ajaxReturn($data); 
    } 
    public function add(){//添加状态
        $State=M('st');
        $id=I('post.id','');
        $con=['id'=>$id];
        $res=$State->find($id);
       echo json_encode($res);
    }
    public function mend(){//修改
        $Mend = M("des"); // 实例化User对象
        $pro=I('post.data','');
        $id=['d_id'=>$pro['d_id']];
        $re=$Mend->where($id)->field('d_area,d_city,d_con,d_st')->save($pro); // 根据条件更新记录
        
        if($re){
            $data = array(
                'statu'=>1,
                'info' => '修改成功,刷新页面'
            );
        }else{
            $data = array(
                'info' => '修改失败,请稍后再试'
            );
        }
        $this->ajaxReturn($data); 
    }
    public function delOder(){ //删除
        $id=I('post.id','');
        $User = M("des"); // 实例化User对象
        $res=$User->delete($id); // 删除id为当前的用户数据
        if(!empty($res)){
            $data = array(
                'statu'=>1,
                'info' => '删除成功,刷新页面',
                'callback' => U('Destination/Index')
            );
        }else{
            $data = array(
                'info' => '删除失败,请稍后再试'
            );
        }
        $this->ajaxReturn($data); 
    } 
}    