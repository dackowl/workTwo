<?php if (!defined('THINK_PATH')) exit();?> <!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta http-equvi="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="render" content="webkit">
<title>Insert title here</title>
<link rel="stylesheet" type="text/css" href="/work/Public/lwd/edit/css/after-oder.css"/>
<link rel="stylesheet" href="/work/Public/lwd/lay/css/x-admin.css" media="all">
<script src="/work/Public/lwd/js/angular.min.js"></script> 
<link href="/work/Public/lwd/css/bootstrap.min.css" rel="stylesheet"/>
</head>
<body ng-app="App" ng-controller="audit">
<div class="x-nav">
    <div class="row">
		<div class="col-lg-4"><span >当前位置  : / 订单管理  / 待审核</span></div>
		<div class="col-lg-6"></div>
		<div class="col-lg-2">
			<a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
		</div>
	</div>
</div>

<!-- Modal 查看并修改-->
<div class="modal fade" id="mendModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="ModalLabel">查看详情</h4>
      </div>
      <div class="modal-body text-center" >
	      	 <div class="text-center">
		      	   <img class='st' src="/work/Public/lwd/edit/img/{{pro.d_img}}">	      	     
	      	 </div><br>
	         <div class="input-group">
			      <span class="input-group-btn">
			        <button class="btn btn-default" type="button"> I D :</button>
			      </span>
			      <input type="text" class="form-control" aria-label="..." id="d_id" disabled="disabled" name="d_id" ng-model="pro.d_id">
			   </div><br>
	          <div class="input-group">
			      <span class="input-group-btn">
			        <button class="btn btn-default" type="button">城市:</button>
			      </span>
			      <input type="text" class="form-control" aria-label="..." id="d_city" name="d_city" ng-model="pro.d_city">
			   </div><br>
			   <div class="input-group">
			  <span class="input-group-btn">
				<button class="btn btn-default" type="button">区域:</button>
			  </span>
			  <select class="form-control" aria-label="..." id="area" name="area" ng-model="pro.d_area">
			  	<?php if(is_array($Area)): foreach($Area as $key=>$a): ?><option value="<?php echo ($a["a_id"]); ?>"><?php echo ($a["a_name"]); ?></option><?php endforeach; endif; ?>
			  </select>
			</div><br>
			   <div class="input-group">
			      <span class="input-group-btn">
			        <button class="btn btn-default" type="button">人气:</button>
			      </span>
			      <input type="text" class="form-control" aria-label="..." id="d_man" disabled="disabled" name="d_man" ng-model="pro.d_man">
			   </div><br>
			   <div class="input-group">
			      <span class="input-group-btn">
			        <button class="btn btn-default" type="button">状态:</button>
			      </span>
		      	<select class="form-control" aria-label="..." id="d_st" name="d_st" ng-model='pro.d_st'>
					<?php if(is_array($State)): foreach($State as $key=>$vs): ?><option value='<?php echo ($vs["s_id"]); ?>'><?php echo ($vs["s_name"]); ?></option><?php endforeach; endif; ?>  
			    </select>
			   </div><br>
	         <span>介绍:</span><br>
	         <textarea id="va" style="height: 110px;width: 519px;resize: none;overflow:scroll-y;" name="d_con" ng-model="pro.d_con"></textarea>
	         <br>
         </div>
		<div class="modal-footer">
		  <button type="button"  class="btn btn-default" data-dismiss="modal">关闭</button>
		  <button type="button" ng-click="save()" class="btn btn-primary">保存</button>
		</div>
	     
    </div>
  </div>
</div>	
<table class="container layui-table">
      <thead>
          <tr>
              <th style="text-align:center;">ID</th>
              <th style="text-align:center;">目的地</th>
              <th style="text-align:center;">缩略图片</th>
              <th style="text-align:center;">状态</th>
              <th style="text-align:center;">操作</th>
          </tr>
      </thead>
      <tbody>
      <?php if(is_array($Destin)): foreach($Destin as $key=>$v): ?><tr>
              <td class="text-center"><?php echo ($v["d_id"]); ?></td>
              <td class="text-center" style="cursor:pointer"><?php echo ($v["d_city"]); ?></td>
              <td class="text-center"><img class="len" src="/work/Public/lwd/edit/img/<?php echo ($v["d_img"]); ?>"/></td>
              <td class="td-status text-center">
                <?php if(is_array($State)): foreach($State as $key=>$vs): if(($vs["s_id"]) == $v["d_st"]): ?><span  class="layui-btn layui-btn-normal layui-btn-mini text-center">
				        	<?php echo ($vs["s_name"]); ?>
				    	</span><?php endif; endforeach; endif; ?>   
              </td>
              <td class="td-manage text-center">
                  <a  title="编辑" href="javascript:;" class="ml-5" style="text-decoration:none">
                      <i class="layui-icon checkin" data-toggle="modal" data-target="#mendModal">&#xe642;</i>
                  </a>
                  <a  title="删除" href="javascript:;" style="text-decoration:none">
                      <i class="layui-icon dele">&#xe640;</i>
                  </a>
              </td><?php endforeach; endif; ?>
          </tr>
      </tbody>
</table>
	<div class="container text-center" >
		<div class="row">
			 <nav>
				<ul class="pagination">
				    <li>
				     <?php echo ($page); ?>
				    </li>
				  </ul>
			</nav> 
		</div>
	</div>  
	<div id="pageDiv" class="text-center">
        <div class="container">
            <div>
                <span style='color:green;'>当前第<span ng-bind='res.nowPage'></span>/<span ng-bind='res.totalPage'></span>页</span>
                <button class='btn btn-info'  type='button' value='首页' ng-click='firsPage()'>首页</button>
                <button class='btn btn-info' type='button' value='上一页' ng-click='upPage()'>上一页</button>
                <button class='btn btn-info' type='button' value='下一页' ng-click='downPage()'>下一页</button>
                <button class='btn btn-info' type='button' value='末页' ng-click='finallyPage()'>末页</button>
            </div>
        </div>
    </div> 
</body>
<script>
$resetst="<?php echo ($Sta["s_id"]); ?>";
console.log($resetst);
$dele_url="<?php echo U('Audit/dele');?>";
$checkin_url="<?php echo U('Audit/checkin');?>";
$men_url="<?php echo U('Audit/men');?>";
/* 

$insert_url="<?php echo U('Destin/insert');?>";
$chang_url="<?php echo U('Destin/change');?>";
$add_url="<?php echo U('Destin/add');?>"; */
var transform = function(data){
	  return $.param(data);
	}
angular.module('App', []).controller('audit', function($scope, $http) {
	$scope.pro={
			
	};
	$('.add').on("click",function(){/* 初始化添加信息 */
		$scope.pro={
				 d_city:'',
				 d_st:$resetst,
				 d_area:'',
				 d_con:'',
				 d_man:''
				 
		 	}
		console.log($scope.pro);
	})
	
	 $(".dele").on("click",function(){ /*删除目的地*/
		  $list_id=$(this).parent().parent().parent().children().eq(0).html();
		  if(confirm("是否删除？"))
	      {	            	                  
			  $http({
		            url:$dele_url,
		            method:'post', 
		            data:{'id':$list_id},
		            headers:{'Content-Type':'application/x-www-form-urlencoded'},
		            transformRequest: transform 
		            }).then(function(response){
		               if(response.data.statu=='1'){
			         	   alert(response.data.info);
			         	   location.reload();
			            }else{
			         	   alert(response.data.info);
			            }
		            }).catch(function (res){
		              console.log(res);
		          });
	       }
     }) 
     $('.checkin').on("click",function(){/*查看目的地*/
		 $listId=$(this).parent().parent().parent().children().eq(0).html();
	 $http({
            url:$checkin_url,
            method:'post', 
            data:{'id':$listId},
            headers:{'Content-Type':'application/x-www-form-urlencoded'},
            transformRequest: transform 
            }).then(function(response){
               console.log(response.data);
               $scope.pro=response.data;
            }).catch(function (res) {
              console.log(res);
          });
	 })
	 $scope.save=function(){/*修改目的地 */
		 console.log($scope.pro);
 		if(confirm("确定修改？")){
		 $http({
	         url:$men_url,
	         method:'post',
	         data:{'data':$scope.pro},
	         headers:{'Content-Type':'application/x-www-form-urlencoded'},
	         transformRequest: transform 
	         }).then(function(response){
	            //console.log(response.data);
	            if(response.data.statu=='1'){
	         	   alert(response.data.info);
	         	   location.reload();
	            }else{
	         	   alert(response.data.info);
	            }
	         }).catch(function (res) {
	           console.log(res);
	       });
         }
		 
	 }
})
</script>
<script src="/work/Public/lwd/js/jquery-3.1.0.min.js"></script>
<script src="/work/Public/lwd/js/bootstrap.min.js"></script>

<script src="/work/Public/lwd/lay/lib/layui/layui.js" charset="utf-8"></script>
<script src="/work/Public/lwd/lay/js/x-layui.js" charset="utf-8"></script>
</html>