//滚动监听
$(function() {
        var currHeight = $("#myNavbar").offset().top; //获取高度
        var currWidth = document.body.clientWidth; //宽度
        $(window).scroll(function() {
            if ($(window).scrollTop() > currHeight) {
                $("#myNavbar").css({
                    "position": "fixed",
                    "top": "0px",
                    "width": "1170px"
                });
            } else {
                $("#myNavbar").css({
                    "position": "relative",
                    "top": "0px"
                });
                $('.item_pi').addClass('active');
            }
        });
        if (currWidth < 768) { //自适应调整
            $("#myNavbar").css({
                "width": currWidth
            });
        }
    })
    //angularjs
var transform = function(data) {
    return $.param(data);
}
var app = angular.module('myApp', []);
app.controller('validateCtrl', function($scope, $http) {
    //获取详情介绍
    $scope.p_id = pro_id;
    $scope.u_id = $login;
    console.log($scope.u_id);
    $http({
        url: bubefor,
        method: 'post',
        data: {
            p_id: $scope.p_id,
            u_id: $scope.u_id
        },
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        transformRequest: transform
    }).then(function(res) {
        //console.log(res.data);
        if (res.data.status == 0) {
            alert(res.data.msg);
        }
    }).catch(function(err) {
        console.log(err);
    });
    $http({
        url: eventDetails_url,
        method: 'post',
        data: {
            s_id: pro_id,
        },
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        transformRequest: transform
    }).then(function(res) {
        console.log(res.data);
        if (res.data.success == 1) {
            $scope.res = res.data.shopData;
            $('#contents').html(res.data.shopData['s_details']);
        } else {
            alert(res.data);
        }
    }).catch(function(err) {
        console.log(err);
    });
    //成交记录
    var pageSize = '5'; //定义每页5条数据
    function nowPage(nowPage, pageSize) {
        $http({
            url: closing_record_url,
            method: 'post',
            data: {
                nowPage: nowPage,
                pageSize: pageSize
            },
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            transformRequest: transform
        }).then(function(suc) {
            // console.log(suc.data);
            if (suc.data.success == 1) {
                $scope.suc = suc.data;
            } else {
                alert(suc.data);
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
            nowPage($scope.suc.totalPage, pageSize);
        }
        //上一页
    $scope.upPage = function() {
            if ($scope.suc.nowPage > 1) {
                $scope.suc.nowPage--;
                nowPage($scope.suc.nowPage, pageSize);
            } else {
                alert('当前已是第一页');
            }
        }
        //下一页
    $scope.downPage = function() {
            if ($scope.suc.nowPage < $scope.suc.totalPage) {
                $scope.suc.nowPage++;
                nowPage($scope.suc.nowPage, pageSize);
            } else {
                alert('当前已是最后一页');
            }
        }
        //数量加减，价格变化
    $scope.count = 1;
    $scope.plus = function() {
        $scope.count = $scope.count + 1;
        if ($scope.count > 5) {
            $scope.count = 5;
            alert("如需预订更多人数请咨询客服！");
            return false;
        }
        $scope.res.s_pri = $scope.res.s_pri * $scope.count;
    }
    $scope.minus = function() {
        $scope.count = $scope.count - 1;
        if ($scope.count < 1) {
            $scope.count = 1;
            return false;
        }
        $scope.res.s_pri = $scope.res.s_pri / ($scope.count + 1);
    }
    $scope.buy = function() {
        if ($scope.p_id == undefined || $scope.p_id == '' || $scope.u_id == undefined || $scope.u_id == '') {
            alert('请先完善信息');
        } else {
            $http({
                url: buyUrl,
                method: 'post',
                data: {
                    p_id: $scope.p_id,
                    u_id: $scope.u_id
                },
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                transformRequest: transform
            }).then(function(res) {
                //console.log(res.data);
                alert(res.data.msg);
                if (res.data.status == 2) {
                    location.reload();
                }
            }).catch(function(err) {
                console.log(err);
            });
        }
    }


});