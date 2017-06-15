<?php
namespace Common\Controller;
use Think\Controller;
class PublicController extends Controller{
    public function fileup () {
		if($_FILES['file']['error'][0]>0){
			echo '上传失败';
		}else{
			$type=I('post.data','');
			$names=array();
			foreach ($_FILES['file']['tmp_name'] as $key => $value) {
				$path="Public/Home/IMG/".$type."/".date('Y-m-d-h-i-s', time())."_".$key.'.jpeg';
				$name=date('Y-m-d-h-i-s', time()).$key.'.jpeg';
				array_push($names,$name);
				move_uploaded_file($value,$path);
			}
		    echo json_encode($names);
		}

    }
}