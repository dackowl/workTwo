//协议
var transform = function(data) {
    return $.param(data);
}
var app = angular.module('myApp', []);
app.controller('validateCtrl', function($scope, $http) {
    var pageSize = '5'; //定义每页5条数据
    function nowPage(nowPage, pageSize) {
        $http({
            url: unpaidOrder_url,
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
        //获取金额和数量
    $scope.btn_modify = function(e, index) { //获取数量和价格
        $http({
            url: btn_modify_url,
            method: 'post',
            data: {
                ol_id: e.ol_id
            },
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            transformRequest: transform
        }).then(function(res) {
            $scope.suc = res.data;
            $scope.sid = index;
        }).catch(function(err) {
            console.log(err);
        });
    };
    //修改价格
    $scope.make_over = function(e) {
            // console.log($scope.sid);
            $http({
                url: modify_url,
                method: 'post',
                data: {
                    ol_id: e.ol_id,
                    ol_num: e.ol_num,
                    ol_money: e.ol_money
                },
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                transformRequest: transform
            }).then(function(res) {
                // console.log(res.data);
                if (res.data.statu == 1) {
                    alert(res.data.msg); //修改成功
                    $('.btn_close').click();
                    // console.log(res.data['ol_money']);
                    $scope.res.paidData[$scope.sid]['ol_money'] = res.data['ol_money']; //金额
                    $scope.res.paidData[$scope.sid]['ol_num'] = res.data['ol_num']; //数量
                } else {
                    alert(res.data);
                }
            }).catch(function(err) {
                console.log(err);
            });
        }
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