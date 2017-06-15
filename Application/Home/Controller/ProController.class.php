<?php 
	namespace Home\Controller;
	use Think\Controller;
	/**
	 * 活动商品控制器
	 * 包括用商品数据的增删改查
	 */
	class ProController extends Controller {
		//热门活动页
		public function index()
		{
			$this->display();
		}
		//热门活动详情页
		public function procon()
		{
			$this->display();
		}
		//热门活动商品
		public function scech()
		{
			if (IS_POST) {
				$pro = M('shop');
				$map['s_num']=['gt',0];
				$list = $pro->where($map)->field('s_id,s_name,s_pri,s_img,s_num')->order('s_num')->limit(4)->select();
				$msg=C(AJAX_MSG);
				$msg['sta']  ='0';
				$msg['data'] = $list;
				echo json_encode($msg);
				
			}
		}

	}

 ?>