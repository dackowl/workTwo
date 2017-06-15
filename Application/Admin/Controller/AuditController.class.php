<?php
namespace Admin\Controller;
use Think\Controller;
class AuditController extends Controller {//待审核控制器操作
        public function index(){   
        $Des = M('des'); //1.实例化 目的地表
        
        $count      = $Des->where('d_st=3')->count();// 查询状态为已审核满足要求的总记录数
        
        $Page       = new \Think\Page($count,3);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        
        
        $Destin=M('des');
        $res=$Destin->where('d_st=3')->field('d_id,d_city,d_img,d_st')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('Destin',$res);
        
        $State=M('st');//启用与待审核
        $data=$State->where('s_id<>2')->field('s_id,s_name')->select();
        $this->assign('State',$data);
        
        $Area= M('area');//4.实例化目的地地区
        $a_data =$Area->field('a_id,a_name')->select();
        $this->assign('Area',$a_data);
        
        $this->display();
    }
    public function dele() {//删除
        $id=I('post.id','');
        $Dele = M("des"); // 实例化User对象
        $res=$Dele->delete($id); // 删除id为当前的用户数据
        if(!empty($res)){
            $data = array(
                'statu'=>1,
                'info' => '删除成功,刷新页面'
            );
        }else{
            $data = array(
                'statu'=>0,
                'info' => '删除失败,请稍后再试'
            );
        }
        $this->ajaxReturn($data);
    }
    public function checkin() {//查看
        $id=I('post.id','');
        $Checkin = M('des');
        $res=$Checkin ->find($id);
        echo json_encode($res); 
    }
    public function men() {
        $Men = M("des"); // 实例化User对象
        $pro=I('post.data','');
        $id=['d_id'=>$pro['d_id']];
        $re=$Men->where($id)->field('d_area,d_city,d_con,d_st')->save($pro); // 根据条件更新记录
        
        if($re){
            $data = array(
                'statu'=>1,
                'info' => '修改成功,刷新页面'
            );
        }else{
            $data = array(
                'statu'=>0,
                'info' => '修改失败,请稍后再试'
            );
        }
        $this->ajaxReturn($data);
    }
}
