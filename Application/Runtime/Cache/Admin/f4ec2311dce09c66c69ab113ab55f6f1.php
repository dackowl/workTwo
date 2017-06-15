<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>已支付订单</title>
	<link href="/work/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="/work/Public/AdminOrder/css/paidOrder.css" rel="stylesheet" type="text/css">	
	<script src="http://cdn.static.runoob.com/libs/angular.js/1.4.6/angular.min.js"></script>
</head>
<body ng-app="myApp" ng-controller="validateCtrl">
	<div class="container">
		<div class="row">
			<div class="table-responsive item_table">
				<table class="table table-bordered table-hover table-condensed">
				   	<caption class="text-center item_title">已支付订单</caption>
				   	<thead>
				      	<tr>
				         	<th class="item_cent">订单号</th>
				         	<th class="item_cent">订单会员</th>
				         	<th class="item_cent">商品名称</th>
				         	<th class="item_cent">金额</th>
				         	<th class="item_cent">下单时间</th>
				         	<th class="item_cent">数量</th>
				         	<th class="item_cent">状态</th>
				         	<th class="item_cent">操作</th>
				      	</tr>
				   	</thead>
				   	<tbody>
				      	<tr ng-repeat="x in res.paidData">
					        <td class="item_cent"><span ng-bind="x.ol_id"></span></td>
							<td class="item_cent"><span ng-bind="x.u_id"></span></td>
							<td><span ng-bind="x.s_id"></span></td>
							<td class="item_cent"><span ng-bind="x.ol_money"></span></td>
							<td class="item_cent"><span ng-bind="x.ol_ordertime"></span></td>
							<td class="item_cent"><span ng-bind="x.ol_num"></span></td>
							<td class="item_cent"><span ng-bind="x.os_id"></span></td>
							<td class="item_cent">
								<button ng-click="btn_send(x,$index)" type="button" class="btn btn-warning">
									<span class="glyphicon glyphicon-bed"></span>发货
								</button>
								<button ng-click="btn_look(x)" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
									<span class="glyphicon glyphicon-eye-open"></span>查看详情
								</button>
							</td>
				      	</tr>
					</tbody>
				</table>
			</div>
			<div class="item_page">
				<span>共<span ng-bind='res.count'></span>条</span>
	            <span>当前第<span ng-bind='res.nowPage'></span>/<span ng-bind='res.totalPage'></span>页</span>
	            <input type='button' class="btn btn-default" value='首页' ng-click='firsPage()'/>
	            <input type='button' class="btn btn-default" value='上一页' ng-click='upPage()'/>
	            <input type='button' class="btn btn-default" value='下一页' ng-click='downPage()'/>
	            <input type='button' class="btn btn-default" value='末页' ng-click='finallyPage()'/>
			</div>
			<!--详情-->
			<div class="modal fade" id="myModal" tabindex="-1" aria-hidden="true">
			    <div class="modal-dialog">
			        <div class="modal-content table-responsive">
			            <div class="modal-header">
			                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			                <h4 class="modal-title text-center">订单详情</h4>
			            </div>
			            <div class="modal-body item_orde">
			            	<div class="table-responsive">
				            	<table class="table table-bordered table-hover table-condensed">
				            		<thead>
				            			<tr>
										    <th class="item_cent">订单号</th> 
											<th class="item_cent">商品名称</th>
											<th class="item_cent">商品价格</th>
											<th class="item_cent">商品缩略图</th>
											<th class="item_cent">详情</th>
											<th class="item_cent">旅游目的地</th>
											<th class="item_cent">下单时间</th>
											<th class="item_cent">购买数量</th>
										</tr>
									</thead>
									<tbody>
						      			<tr>
											<td><span ng-bind="r[0].ol_id"></span></td>
											<td><span ng-bind="r[1].s_name"></span></td>
											<td><span ng-bind="r[0].ol_money"></span></td>
											<td><img ng-src="/work/Public/HomeEd/img/{{r[1].s_img}}" class="item_img" /></td>
											<td><span ng-bind="r[1].s_details"></span></td>
											<td><span ng-bind="r[1].s_des"></span></td>
											<td class="item_cent"><span ng-bind="r[0].ol_ordertime"></span></td>
											<td><span ng-bind="r[0].ol_num"></span></td>
										</tr>
									</tbody>
								</table>
							</div>
			            </div>
			            <div class="modal-header item_user">
			                <h4 class="modal-title text-center">买家详情</h4>
			            </div>
			            <div class="modal-body">
				            <div class="table-responsive">
				            	<table class="table table-bordered table-hover table-condensed">
				            		<thead>
					            		<tr>
					            			<th>账号</th> 
										    <th>昵称</th> 
										    <th>头像</th> 
										    <th>邮箱</th> 
										    <th>QQ</th> 
					            		</tr>
					            	</thead>
					            	<tbody>
						      			<tr>
											<td><span ng-bind="r[2].account"></span></td>
											<td><span ng-bind="r[2].nick"></span></td>
											<td><span ng-bind="r[2].h_img"></span></td>
											<td><span ng-bind="r[2].email"></span></td>
											<td><span ng-bind="r[2].qq"></span></td>
										</tr>
									</tbody>
				            	</table>
				            </div>
			           	</div>
			        </div>
			    </div>
			</div>
		</div>	
	</div>
</body>
	<script type="text/javascript">
		var paidOrader_url 	= "<?php echo U('Admin/Order/paidOrder');?>";//读取数据
		var btn_send_url	= "<?php echo U('Admin/Order/btn_send');?>";//发货
		var btn_look_url	= "<?php echo U('Admin/Order/btn_look');?>";//查看详情
  	</script>
	<script src="/work/Public/bootstrap/js/jquery.min.js"></script>
  	<script src="/work/Public/bootstrap/js/bootstrap.min.js"></script>
  	<script src="/work/Public/AdminOrder/js/paidOrder.js"></script>
</html>