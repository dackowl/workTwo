<?php
namespace Admin\Controller;
use Think\Controller;
class LinkController extends Controller {
    public function index(){
        $Lin = M('link'); //1.实例化 目的地表
        
        $count      = $Lin->where('f_id>=1')->count();// 查询状态为已审核满足要求的总记录数
        
        $Page       = new \Think\Page($count,6);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        
        $Link=M('link');//实例化链接
        $link_data=$Link->field('f_id,f_adr,f_name')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('Link',$link_data);
        $this->display();    
    }
    public function link(){//查看详情
        $id=I('post.id','');
        $Remen=M('link');//实例化链接
        $res=$Remen->find($id);
        echo json_encode($res); 
    }
    public function alter(){//修改
       $Alter=M('link');
       $pro=I('post.data','');
       $f_adr=$pro['f_adr'];
       $f_name=$pro['f_name'];
       $id=['f_id'=>$pro['f_id']];
       if($f_adr == "" || $f_name==""){
            $data = array(
               'statu'=>0,
               'msg' => '不能为空,请填入数据'
           );
           $this->ajaxReturn($data); 
       }else {
           $res=$Alter->where($id)->field('f_adr,f_name')->save($pro);
           if($res){
               $data = array(
                   'statu'=>1,
                   'msg' => '修改成功,刷新页面'
               );
           }else{
               $data = array(
                   'statu'=>2,
                   'msg' => '修改失败,请稍后再试'
               );
           }
           $this->ajaxReturn($data);
       }
           
   }
   public function join(){
       $Join=M('link');
       $data=I('post.data','');
       $res=$Join->add($data);
       if(!empty($res)){
           $data = array(
               'statu'=>1,
               'msg' => '提交成功,刷新页面'
           );
           }else{
               $data = array(
                   'statu'=>0,
                   'msg' => '提交失败,请稍后再试'
               );
           }
           $this->ajaxReturn($data); 
   }
   public function remove(){//删除
       $Remove=M('link');
       $id=I('post.id','');
      $data=$Remove->delete($id); // 删除id为5的用户数据
       if(!empty($data)){
           $data = array(
               'statu'=>1,
               'rmsg' => '删除成功,刷新页面'
           );
           }else{
               $data = array(
                   'statu'=>0,
                   'rmsg' => '删除失败,请稍后再试'
               );
           }
           $this->ajaxReturn($data);
       }
}    