<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>商品发布</title>
	<link href="/work/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="/work/Public/AdminOrder/css/activity.css?v=1.0" rel="stylesheet" type="text/css">	
	<script src="http://cdn.static.runoob.com/libs/angular.js/1.4.6/angular.min.js"></script>
    <script src="/work/Public/angular/js/ng-file-upload.min.js"></script>
    <script src="/work/Public/angular/js/ng-file-upload-shim.min.js"></script>
</head> 
<body ng-app="myApp" ng-controller="validateCtrl">
	<div class="container">
		<div class="row">
			<h2 class="text-center">商品发布</h2>
			<hr style="margin: 10px 0;"/>
			<form class="form-horizontal" name="myForm">
				<div class="form-group">
					<label class="col-sm-2 control-label">商品标题：</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="item_title" required ng-model='item_title' ng-pattern='/^[a-zA-Z\u4e00-\u9fa5][a-zA-Z0-9\u4e00-\u9fa5]*$/'/>
					</div>
		            <span ng-show="myForm.item_title.$dirty && myForm.item_title.$invalid" class="item_warning">
		                <span ng-show="myForm.item_title.$error.required">必填</span>
		                <span ng-show="myForm.item_title.$error.pattern">只能输入汉字数字字母，并且数字不能开头</span>
		            </span>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">商品价格：</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="item_price" required ng-model='item_price' ng-pattern="/(^[1-9]\d*(\.\d{1,2})?$)|(^0(\.\d{1,2})?$)/"/>
					</div>
					<span ng-show="myForm.item_price.$dirty && myForm.item_price.$invalid" class="item_warning">
		                <span ng-show="myForm.item_price.$error.required">必填</span>
		                <span ng-show="myForm.item_price.$error.pattern">必须是两位小数的正实数</span>
		            </span>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">库存：</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="item_num" required ng-model='item_num' ng-pattern="/^[0-9]+$/"/>
					</div>
					<span ng-show="myForm.item_num.$dirty && myForm.item_num.$invalid" class="item_warning">
		                <span ng-show="myForm.item_num.$error.required">必填</span>
		                <span ng-show="myForm.item_num.$error.pattern">必须为正整数</span>
		            </span>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">图片：</label>
					<div class="col-sm-10">
	                	<a href="#" class="file">上传图片
	                		<input type="file" multiple="multiple" 
			                		id="item_detail_img" 
			                		name="item_detail_img" 
			                		onchange="angular.element(this).scope().picturePreview()" 
			                		accept="image/gif, image/png, image/jpeg, image/jpg"  
			                		ng-model='item_detail_img' 
			                		required/>
	                	</a>
	                	<div id="fileImg">
	                		<div id="up">图片预览区</div>
	                		<div class="item_detail_img_show"></div>
	                	</div>
	                </div>
	                <div ng-show='myForm.item_detail_img.$dirty && myForm.item_detail_img.$invalid' class="item_warning">
		                <span ng-show="myForm.item_detail_img.$error.required">必填</span>
		            </div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">目的地：</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="item_places" required ng-model='item_places' ng-pattern="/^([A-Za-z]|[\u4E00-\u9FA5])+$/"/>
					</div>
					<span ng-show="myForm.item_places.$dirty && myForm.item_places.$invalid" class="item_warning">
		                <span ng-show="myForm.item_places.$error.required">必填</span>
		                <span ng-show="myForm.item_places.$error.pattern">输入类型为汉字字母</span>
		            </span>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">产品描述：</label>
					<div class="col-sm-10">
						<textarea class="form-control" placeholder="写上你的精彩详情吧..."
							required
							ng-model='item_nota' 
							name="item_nota" 
							ng-pattern="/^[0-9a-zA-Z\u4e00-\u9fa5]+$/">
						</textarea>
					</div>
					<div ng-show='myForm.item_nota.$dirty && myForm.item_nota.$invalid' class="item_warning">
						<span ng-show="myForm.item_nota.$error.required">必须</span>
		                <span ng-show="myForm.item_nota.$error.pattern">输入类型为汉字字母数字</span>
		            </div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="button" class="btn btn-warning" ng-click="release_shop()" ng-disabled="myForm.$invalid">发布</button>
						<button type="button" class="btn btn-primary item_reset">重置</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</body>
	<script type="text/javascript">
		var picturePreview_url = "<?php echo U('Admin/Activity/picturePreview');?>";
		// var shop_release_url = "<?php echo U('Admin/Activity/release');?>";
		var shop_add_to_url = "<?php echo U('Admin/Activity/shop_add_to');?>";
		var fileupurl="<?php echo U('Shop/picturePreview');?>";
  	</script>
	<script src="/work/Public/bootstrap/js/jquery.min.js"></script>
	<!-- <script src="/work/Public/AdminOrder/js/ajaxfileupload.js"></script> -->
  	<script src="/work/Public/bootstrap/js/bootstrap.min.js"></script>
  	<script src="/work/Public/AdminOrder/js/activity.js?v=1.22"></script>
</html>