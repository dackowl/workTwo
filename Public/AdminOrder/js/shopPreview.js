var transform = function(data) {
    return $.param(data);
}
var app = angular.module('myApp',[]);
app.controller('validateCtrl',function($scope,$http) {
	var pageSize = '5'; //定义每页5条数据
    function nowPage(nowPage,pageSize){
        $http({
        url:shop_preview_url,
        method:'post',
        data:{
            nowPage:nowPage,
            pageSize:pageSize
        },
        headers:{'Content-Type':'application/x-www-form-urlencoded'},
        transformRequest: transform
        }).then(function(res){
            if (res.data.success == 1) {
            	$scope.res = res.data;
            }else{
                alert(res.data);
            }
        }).catch(function (err) {
            console.log(err);
        });
    }
    //第一页
    nowPage('1',pageSize);
    //跳转首页
    $scope.firsPage = function(){
        nowPage(1,pageSize);
    }
    //跳转末页
    $scope.finallyPage = function(){
        nowPage($scope.res.totalPage,pageSize);
    }
    //上一页
    $scope.upPage = function(){
        if($scope.res.nowPage>1){
            $scope.res.nowPage--;
            nowPage($scope.res.nowPage,pageSize);
        }else{
            alert('当前已是第一页');
        }
    }
    //下一页
    $scope.downPage = function(){
        if($scope.res.nowPage<$scope.res.totalPage){
            $scope.res.nowPage++;
            nowPage($scope.res.nowPage,pageSize);
        }else{
            alert('当前已是最后一页');
        }
    }
    //上架
    $scope.upShow=function(e,index){
        // console.log(index);
        if(e.s_state == "已上架"){
            alert("此商品已上架在售中了哦！");
            return false;
        }
        $http({
            url:upShow_preview_url,
            method:'post',
            data:{
                s_id:e.s_id,
                s_state:e.s_state
            },
            headers:{'Content-Type':'application/x-www-form-urlencoded'},
            transformRequest: transform
        }).then(function(res){
            if(res.data.statu == 1){
                alert(res.data.msg);
                $scope.res.shopData[index]['s_state'] = res.data['curr_state'];
            }
           
        }).catch(function (err) {
            console.log(err);
        });
    }
    //下架
    $scope.downHide=function(e,index){
        if(e.s_state == "已下架"){
            alert("此商品已下架了哦！");
            return false;
        }
        $http({
            url:downHide_preview_url,
            method:'post',
            data:{
                s_id:e.s_id,
                s_state:e.s_state
            },
            headers:{'Content-Type':'application/x-www-form-urlencoded'},
            transformRequest: transform
        }).then(function(res){
            if(res.data.statu == 1){
                alert(res.data.msg);
                $scope.res.shopData[index]['s_state'] = res.data['curr_state'];
            }
        }).catch(function (err) {
            console.log(err);
        });
    }
    //获取编辑商品信息
    $scope.shop_edit = function(e,index){
        if (e.s_state == "已上架") {
            alert("销售中的商品请先下架处理，方可进行编辑修改！");
            return false;
        }
        $http({
            url:Get_edit_info_url,
            method:'post',
            data:{
                s_id:e.s_id
            },
            headers:{'Content-Type':'application/x-www-form-urlencoded'},
            transformRequest: transform
            }).then(function(res){
                $scope.suc = res.data;
                $scope.sid = index;
            }).catch(function (err) {
                console.log(err);
        });
    };
    // 编辑
    $scope.Determine=function(e){
        // console.log(e);
        console.log(this);
        $http({
            url:shop_edit_preview_url,
            method:'post',
            data:{
                s_id:e.s_id,
                s_name:e.s_name,
                s_img:e.s_img,
                s_pri:e.s_pri,
                s_num:e.s_num,
                s_des:e.s_des,
                s_details:e.s_details,
                s_state:e.s_state
            },
            headers:{'Content-Type':'application/x-www-form-urlencoded'},
            transformRequest: transform
            }).then(function(res){
                // console.log(res);
                if (res.data.statu == 1) {
                    alert(res.data.msg);
                    $('.close').click();
                    $scope.res.shopData[$scope.sid]['s_name'] = res.data['s_name'];
                    $scope.res.shopData[$scope.sid]['s_img'] = res.data['s_img'];
                    $scope.res.shopData[$scope.sid]['s_pri'] = res.data['s_pri'];
                    $scope.res.shopData[$scope.sid]['s_num'] = res.data['s_num'];
                    $scope.res.shopData[$scope.sid]['s_details'] = res.data['s_details'];
                    $scope.res.shopData[$scope.sid]['s_des'] = res.data['s_des'];
                    $scope.res.shopData[$scope.sid]['s_state'] = res.data['s_state'];
                }else{
                    alert(res.data);
                }
            }).catch(function (err) {
                console.log(err);
        })
    }
    //删除
    $scope.delete_shop=function(e,index){
        if(e.s_state == "已上架"){
            alert("销售中的商品请先下架处理哦！");
            return false;
        }
        $http({
            url:delete_shop_preview_url,
            method:'post',
            data:{
                s_id:e.s_id,
            },
            headers:{'Content-Type':'application/x-www-form-urlencoded'},
            transformRequest: transform
        }).then(function(res){
            alert(res.data);
            $scope.res.shopData.splice(index, 1);//移除
        }).catch(function (err) {
            console.log(err);
        });
    }
    //图片预览
    $scope.picturePreview = function () {
        var filetype = ['jpg','jpeg','png','gif'];
        $scope.item_detail_img = [];
        $scope.item_detail_img_type = [];
        var item_detail_img_show = document.getElementsByClassName('item_detail_img_show')[0];
        item_detail_img_show.innerHTML = "";
        var item_detail_img = document.getElementById('item_detail_img'); //得到文件信息
        
        for(let i=0;i<item_detail_img.files.length;i++){
            var fname = item_detail_img.files[i].name.split('.');
            $scope.item_detail_img_type.push(fname[1]);
            if(item_detail_img.files[i].size>1024*1024*5){//单位是B，此处不允许超过5M
                alert("图片不能超过5M");
                return false;
            }
            if(filetype.indexOf(fname[1].toLowerCase()) == -1){
                alert('仅支持jpg，png，jpeg，gif图片');
                return false;
            }
            //实例化h5的fileReader
            var file_reader = new FileReader();
            file_reader.readAsDataURL(item_detail_img.files[i]); //以base64编码格式读取图片文件
            file_reader.onload = function() {
                $scope.item_detail_img.push(this.result); //得到结果数据
                var img_show = document.getElementsByClassName('item_detail_img_show')[0];
                img_show.innerHTML += "<img src='"+$scope.item_detail_img[i]+"'/>";
            };
        }
    };
});
//编辑
$(function(){
    // $('tbody').on('dblclick','td',function(){
    //     var oldVal = $(this).text();
    //     var input = "<textarea class='item_tmp' style='height:110px;width:120px;resize:none;resize:vertical;'>"+oldVal+"</textarea>";
    //     $(this).text('');
    //     $(this).append(input);
    // });

});