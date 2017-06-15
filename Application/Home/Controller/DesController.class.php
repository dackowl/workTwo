<?php
namespace Home\Controller;
use Think\Controller;
class DesController extends Controller {
    
	public function index(){ 
        if (session('?login')) {
            $id=session('login');
            // dump($id);
            $this->assign('login',$id);
        }
		$Des_name=M('des');//区域1
		$city=$Des_name->where('d_area=1 and d_st=1')->field('d_id,d_city')->select();
		$this->assign('Des_name',$city);
		/* dump($city);
		exit; */ 
		$City=M('des');//区域2
		$city_name=$Des_name->where('d_area=2 and d_st=1')->field('d_id,d_city')->select();
		$this->assign('City',$city_name);
		// dump($city_name);
		// exit;
		$Are= M('area');//4.目的地地区添加
		$a_data =$Are->field('a_id,a_name')->select();
		$this->assign('Are',$a_data);

		$Stat=M('st');//5.添加时的实例化目的地状态
		$stat_data = $Stat->where('s_id=3')->field('s_id,s_name')->select();
		$this->assign('Stat',$stat_data[0]);//赋值目的地状态输出

		$this->display();
	}
    public function comment(){
        $com=M('comment');
        $data=$com->field('account,d_city,create_time,content')->order('create_time desc')->select();
        echo json_encode($data);
    }
    public function commen(){
        $comm=M('comment'); // 
        $proData=I('post.data','');
        $content=$proData['content'];
        $account=$proData['account'];
        if($content==""||$account==""){
            $data = array(
                'statu'=>0,
                'msg' => '内容不为空,请输入内容'
            );
            $this->ajaxReturn($data);
        }else{
            $result=$comm->add($proData);
            if(!empty($result)){
                $data = array(
                    'statu'=>1,
                    'msg' => '提交成功,请稍等'
                );
            }else{
                $data = array(
                    'statu'=>2,
                    'msg' => '提交失败,请稍后再试'
                );
            }
            $this->ajaxReturn($data);
        }
    }
   public function detail(){
       $Det=M('des');
       $pro=I('get.cname','');
       $dat=['d_city'=>$pro];
       $data = $Det->where($dat)->field('d_city,d_con,d_img')->find();
       $this->assign('Det',$data);
       $this->display();
   }
    public function sub(){
        $Sub = M("des"); // 
        $proData=I('post.data','');
        $result=$Sub->add($proData);
        if(!empty($result)){
            $data = array(
                'statu'=>1,
                'sub' => '提交成功,刷新页面'
            );
        }else{
            $data = array(
                'statu'=>0,
                'sub' => '提交失败,请稍后再试'
            );
        }
        $this->ajaxReturn($data);
    }
    public function link(){
        $link=M('link')->field('f_adr,f_name')->select();//链接查询
        $this->assign('Link',$link);
        
        $this->display();
    }
    
}