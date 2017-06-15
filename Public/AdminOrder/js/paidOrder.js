//协议
var transform = function(data) {
    return $.param(data);
}
var app = angular.module('myApp', []);
app.controller('validateCtrl', function($scope, $http) {
    var pageSize = '5'; //定义每页5条数据
    function nowPage(nowPage, pageSize) {
        $http({
            url: paidOrader_url,
            method: 'post',
            data: {
                nowPage: nowPage,
                pageSize: pageSize
            },
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            transformRequest: transform
        }).then(function(res) {
            //console.log(res.data);
            if (res.data.rol == 0) {
                alert(res.data.Msg);
            } else {
                $scope.res = res.data;
            }
        }).catch(function(err) {
            console.log(err);
        });
    }
    //第一页
    nowPage('1', pageSize);
    //跳转首页
    $scope.firsPage = function() {
            nowPage(1, pageSize);
        }
        //跳转末页
    $scope.finallyPage = function() {
            nowPage($scope.res.totalPage, pageSize);
        }
        //上一页
    $scope.upPage = function() {
            if ($scope.res.nowPage > 1) {
                $scope.res.nowPage--;
                nowPage($scope.res.nowPage, pageSize);
            } else {
                alert('当前已是第一页');
            }
        }
        //下一页
    $scope.downPage = function() {
            if ($scope.res.nowPage < $scope.res.totalPage) {
                $scope.res.nowPage++;
                nowPage($scope.res.nowPage, pageSize);
            } else {
                alert('当前已是最后一页');
            }
        }
        //发货
    $scope.btn_send = function(e, index) {
        // console.log(e);
        if (e.os_id == "已发货") {
            alert("此商品已发货了");
            return false;
        }
        if (confirm("确定发货么？")) {
            $http({
                url: btn_send_url,
                method: 'post',
                data: {
                    ol_id: e.ol_id,
                    os_id: e.os_id
                },
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                transformRequest: transform
            }).then(function(res) {
                if (res.data.statu == 1) {
                    alert(res.data.msg); //发货成功
                    $scope.res.paidData[index]['os_id'] = res.data['curr_state'];
                } else {
                    alert(res.data);
                }
            }).catch(function(err) {
                console.log(err);
            });
        }
    };
    $scope.btn_sends = function(e, index) {
        // console.log(e);
        if (e.os_id == "已发货") {
            alert("此商品已发货了");
            return false;
        }
        if (confirm("确认收货？")) {
            $http({
                url: btn_send_url,
                method: 'post',
                data: {
                    ol_id: e.ol_id,
                    os_id: e.os_id
                },
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                transformRequest: transform
            }).then(function(res) {
                if (res.data.statu == 1) {
                    alert(res.data.msg); //发货成功
                    $scope.res.paidData[index]['os_id'] = res.data['curr_state'];
                } else {
                    alert(res.data);
                }
            }).catch(function(err) {
                console.log(err);
            });
        }
    };
    //查看
    $scope.btn_look = function(e) {
        // console.log(e);
        $http({
            url: btn_look_url,
            method: 'post',
            data: {
                ol_id: e.ol_id
            },
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            transformRequest: transform
        }).then(function(r) {
            // console.log(r.data);
            $scope.r = r.data;
        }).catch(function(err) {
            console.log(err);
        })
    };


});