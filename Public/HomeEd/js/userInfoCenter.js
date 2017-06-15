var transform = function(data) {
    return $.param(data);
}
var app = angular.module('myApp', ['ngFileUpload']);
app.controller('validateCtrl', function($scope, $http, Upload) {
    $http({
        url: myInfo_url,
        method: 'post',
        data: {
            u_id: userid
        },
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        transformRequest: transform
    }).then(function(res) {
        // console.log(res.data);
        if (res.data.success == 1) {
            $scope.res = res.data.data;
        }
    }).catch(function(err) {
        console.log(err);
    });
    //修改我的信息
    $scope.infoPreserved = function(e) {
            // console.log(e);
            $http({
                url: modifyInfo_url,
                method: 'post',
                data: {
                    u_id: e.u_id,
                    nick: $scope.res.nick,
                    address: $scope.res.address,
                    profile: $scope.res.profile
                },
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                transformRequest: transform
            }).then(function(res) {
                // console.log(res.data);
                if (res.data.success == 1) {
                    alert("修改成功！");
                    $scope.res.nick = res.data.content['nick'];
                    $scope.res.address = res.data.content['address'];
                    $scope.res.profile = res.data.content['profile'];
                }
            }).catch(function(err) {
                console.log(err);
            });
        }
        //上传图片
    $scope.myFile = function(e) {
            var files = document.getElementById('files');
            if (files.files.length > 4) {
                files.files.length = 4;
                // console.log(files.files.length);
                // console.log(files.files);
            }
            Upload.upload({
                //服务端接收
                url: picturePreview_url,
                //上传的同时带的参数
                data: {
                    type: 'type',
                    data: 'adr'
                },
                //上传的文件
                file: files.files
            }).progress(function(evt) {
                // 进度条
                var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
                // console.log('progess:' + progressPercentage + '%');
            }).success(function(data, status, headers, config) {
                //上传成功
                // console.log(data);
                $http({
                    url: myHead_url,
                    method: 'post',
                    data: {
                        u_id: e,
                        h_img: data
                    },
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    transformRequest: transform
                }).then(function(res) {
                    console.log(res.data);
                    if (res.data.success == 1) {
                        $scope.res.h_img = res.data.h_img;
                    }
                }).catch(function(err) {
                    console.log(err);
                });
            }).error(function(data, status, headers, config) {
                //上传失败
                console.log('error status: ' + status);
            });
        }
        //修改密
    $scope.register = function(e) {
            if (e.pwd != $scope.oldPwd) {
                alert("原始密码有误，请重新输入！");
                return false;
            } else if (e.pwd == $scope.determine) {
                alert("修改的密码一样，无需修改！");
                return false;
            }
            if (confirm("确定修改？")) {
                $http({
                    url: mySecurity_url,
                    method: 'post',
                    data: {
                        u_id: e.u_id,
                        pwd: $scope.determine
                    },
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    transformRequest: transform
                }).then(function(res) {
                    if (res.data.success == 1) {
                        alert(res.data.msg);
                        $scope.determine = '';
                    }
                }).catch(function(err) {
                    console.log(err);
                });
            }
        }
        //充值
    $scope.myWallet = function(e) {
        $now_money = $scope.item_price; //获取输入的金额
        $m = $now_money.replace(/&nbsp;/g, ""); //去掉空格
        if ($now_money == "" || $m == 0) { //判断输入空格和空不能充值成功
            alert("请输入要充值的金额，不可为空格或者0！");
            return false;
        }
        if (confirm("确定充值？")) {
            $http({
                url: myWallet_url,
                method: 'post',
                data: {
                    u_id: e.u_id,
                    u_money: e.u_money,
                    money: $scope.item_price
                },
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                transformRequest: transform
            }).then(function(res) {
                if (res.data.success == 1) {
                    alert(res.data.msg);
                    $scope.res.u_money = res.data.u_money;
                }
            }).catch(function(err) {
                console.log(err);
            });
        }
    }

});
//图片预览
function picturePreview() {
    //检验图像的格式 
    var file = document.getElementById("files").files[0];
    if (!/image\/\w+/.test(file.type) && !/\.(jpg|png|jpeg|gif)$/.test(file.type)) {
        alert("只能上传jpg|png|jpeg|gif格式图片！");
        return false;
    }
    var reader = new FileReader();
    //将文件以Data URL形式读入页面  
    reader.readAsDataURL(file);
    reader.onload = function(e) {
        var fileImg = document.getElementById("fileImg");
        //显示文件  
        fileImg.innerHTML = '<img src="' + this.result + '" alt="" />';
    };
    $('.curr_file').show();
}