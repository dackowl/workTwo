<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>个人信息修改</title>
	<link href="/work/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="/work/Public/HomeEd/css/userInfoCenter.css" rel="stylesheet" type="text/css">
	<script src="/work/Public/HomeEd/js/angular.min.js"></script>
    <script src="/work/Public/angular/js/ng-file-upload.min.js"></script>
    <script src="/work/Public/angular/js/ng-file-upload-shim.min.js"></script>
</head>
<body ng-app="myApp" ng-controller="validateCtrl">
<a href="<?php echo U('Personal/personalCenter');?>">返回个人中心</a>
	<div class="container">
		<div class="row">
			<div class="col-sm-2 col-md-2 col-lg-2">
				<ul id="myTab" class="nav text-center">
					<li class="active"><a href="#myInfo" data-toggle="tab">我的信息</a></li>
					<li class=" on"><a href="#myHead" data-toggle="tab">我的头像</a></li>
					<li class=""><a href="#mySecurity" data-toggle="tab">账号安全</a></li>
					<li class=""><a href="#myWallet" data-toggle="tab">我的钱包</a></li>
				</ul>
			</div>
			<div id="myTabContent" class="tab-content col-sm-10 col-md-10 col-lg-10">
				<div class="tab-pane fade in active" id="myInfo">
					<div class="item_info"><strong>我的信息</strong></div>
					<form class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-2 control-label">昵称：</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" value="{{res.nick}}"  ng-model="res.nick">
							</div>
						</div>
						<!-- <div class="form-group">
							<label for="lastname" class="col-sm-2 control-label">性别：</label>
							<div class="col-sm-6">
								<label class="checkbox-inline">
									<input type="radio" name="optionsRadiosinline" id="optionsRadios1" value="option1" checked>男
								</label>
								<label class="checkbox-inline">
									<input type="radio" name="optionsRadiosinline" id="optionsRadios2"  value="option2">女
								</label>
								<label class="checkbox-inline">
									<input type="radio" name="optionsRadiosinline" id="optionsRadios3"  value="option2">保密
								</label>
							</div>
						</div> -->
						<div class="form-group">
							<label class="col-sm-2 control-label text-nowrap">居住城市：</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" value="{{res.address}}" ng-model="res.address">
							</div>
						</div>
						<!-- <div class="form-group">
							<label class="col-sm-2 control-label text-nowrap">出生日期：</label>
							<div class="col-sm-6">
								<input type="date" class="form-control">
							</div>
						</div> -->
						<div class="form-group">
							<label class="col-sm-2 control-label text-nowrap">个人简介：</label>
							<div class="col-sm-6">
								<textarea class="form-control item_resize" ng-model="res.profile">{{res.profile}}</textarea>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-6">
								<button type="button" class="btn btn-warning btn-lg" ng-click="infoPreserved(res)">修改</button>
							</div>
						</div>
					</form>
				</div>
				<div class="tab-pane fade" id="myHead">
					<div class="item_info"><strong>我的头像</strong></div>
					<div class="fileImg">
						<img src="http://a3-q.mafengwo.net/s10/M00/48/B5/wKgBZ1kAeeiAXfnNAABXZKqrvCE90.jpeg" class="img-circle" ng-src="/work/Public/Home/uploads/{{res.h_img}}" >
						<div class="fileCss"><a href="#" class="file" onchange="picturePreview()">选择图片<input type="file" id="files"/></a></div>
					</div>
					<div class="item_file">
						<div id="fileImg"></div>
						<button type="button" class="curr_file" ng-click="myFile(res.u_id)">上传</button>
					</div>
	                <p style="clear:left;">支持jpg、png、jpeg、gif，图片大小5M以内</p>
				</div>
				<div class="tab-pane fade" id="mySecurity">
					<div class="item_info"><strong>设置新密码</strong></div>
					<form class="form-horizontal" name="myForm">
						<div class="form-group">
							<label class="col-sm-2 control-label text-nowrap">原密码：</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="oldPwd" ng-model="oldPwd" required ng-pattern="/^[A-Za-z0-9]{6,18}$/">
							</div>
							<span style="color:red;font-size:14px;" ng-show="myForm.oldPwd.$dirty && myForm.oldPwd.$invalid">
								<span ng-show="myForm.oldPwd.$error.required">必填</span>
			                    <span ng-show="myForm.oldPwd.$error.pattern">6-18位英文或数字</span>
							</span>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label text-nowrap">新密码：</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" required ng-model='pwd' name="pwd" ng-pattern="/^[A-Za-z0-9]{6,18}$/">
							</div>
							<span style="color:red;font-size:14px;" ng-show="myForm.pwd.$dirty && myForm.pwd.$invalid">
				            	<span ng-show="myForm.pwd.$error.required">必填</span>
				                <span ng-show="myForm.pwd.$error.pattern">6-18位英文或数字</span>
				            </span>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label text-nowrap">确认密码：</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="determine" ng-model='determine' required>
							</div>
							<span style="color:red;font-size:14px;" ng-show="myForm.determine.$valid">
					        	<span ng-show="myForm.determine.$error.required">必填</span>
				                <span ng-show="determine != pwd">两次密码输入不一致</span>
				            </span>
						</div>
						<div class="form-group">
							<button type="button" class="btn btn-warning col-sm-offset-2" ng-click="register(res)" id="register" ng-disabled="!myForm.$valid">提交修改</button>
						</div>
					</form>
				</div>
				<div class="tab-pane fade" id="myWallet">
					<div class="item_info"><strong>我的钱包</strong></div>
					<div class="my_money">余额：<span class="item_symbol">￥</span><span class="currMoney">{{res.u_money}}</span></div>
					<form name="myMoney">
						<input type="text" name="item_price" required ng-model='item_price' ng-pattern="/(^[1-9]\d*(\.\d{1,2})?$)|(^0(\.\d{1,2})?$)/">
						<span ng-show="myMoney.item_price.$dirty && myMoney.item_price.$invalid" style="color:red;font-size:14px;">
			                <span ng-show="myMoney.item_price.$dirty.item_price.$error.required">必填</span>
			                <span ng-show="myMoney.item_price.$error.pattern">最多带两位小数的正实数</span>
			            </span>
						<button type="button" class="btn btn-warning" ng-click="myWallet(res)" ng-disabled="!myMoney.$valid">充值</button>
		            </form>
				</div>
			</div>
		</div>
	</div>
</body>
	<script>
		var userid="<?php echo ($login["id"]); ?>";
		console.log(userid);
		var myInfo_url 	   = "<?php echo U('Home/Personal/myInfo');?>";//我的信息
		var modifyInfo_url = "<?php echo U('Home/Personal/modifyInfo');?>";//修改我的信息
		var myHead_url 	   = "<?php echo U('Home/Personal/myHead');?>";//头像
		var picturePreview_url = "<?php echo U('Home/Personal/picturePreview');?>";//头像
		var mySecurity_url = "<?php echo U('Home/Personal/mySecurity');?>";//修改密码
		var myWallet_url   = "<?php echo U('Home/Personal/myWallet');?>";//充值
	</script>
	<script src="/work/Public/bootstrap/js/jquery.min.js"></script>
  	<script src="/work/Public/bootstrap/js/bootstrap.min.js"></script>
  	<script src="/work/Public/HomeEd/js/userInfoCenter.js"></script>
</html>