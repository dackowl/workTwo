$('.myNota').on('click', function() {
	$('.nota').slideToggle();
});
//获取个人信息
var transform = function(data) {
	return $.param(data);
}
var app = angular.module('myApp', []);
app.controller('validateCtrl', function($scope, $http) {

	$http({
		url: personalCenter_url,
		method: 'post',
		data: {
			account: ac,
		},
		headers: {
			'Content-Type': 'application/x-www-form-urlencoded'
		},
		transformRequest: transform
	}).then(function(response) {
		$scope.imgs = false;
		$scope.myNota = false;
		if (response.data.success == 1) {
			console.log(response.data);
			$scope.response = response.data.userData; //用户信息
			$scope.res = response.data.travelData; //游记信息
			$scope.val = response.data.commData; //点评信息
			if (response.data.userData.h_img != '' && response.data.userData.h_img != null) {
				$scope.imgs = !$scope.imgs;
			} else if (response.data.profile != '') {
				$scope.myNota = !$scope.myNota;
			}
		} else {
			alert(response.data);
		}
	}).catch(function(err) {
		console.log(err);
	});
	//个人简介
	$scope.preserved = function() {
			if ($scope.preserveds == undefined) {
				$('.nota').slideToggle();
				return false;
			}
			$http({
				url: preserved_url,
				method: 'post',
				data: {
					content: $scope.preserveds,
					account: "admin1" //账号
				},
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded'
				},
				transformRequest: transform
			}).then(function(res) {
				console.log(res.data);
				if (res.data.success == 1) {
					$('#item_profile').text(res.data.content);
					$('.nota').hide();
				} else {
					alert(res.data);
				}
			}).catch(function(err) {
				console.log(err);
			});
		}
		//留言
	$http({
		url: leave_contents_url,
		method: 'post',
		data: {
			account: "admin1" //账号
		},
		headers: {
			'Content-Type': 'application/x-www-form-urlencoded'
		},
		transformRequest: transform
	}).then(function(res) {
		$scope.visible = false;
		if (res.data.success == 1) {
			$scope.ress = res.data;
			$scope.vals = res.data.userData;
			$scope.visible = !$scope.visible; //显示
		}
	}).catch(function(err) {
		console.log(err);
	});

	$scope.leave = function(e) {
			// console.log(e.nick);
			$http({
				url: leave_content_url,
				method: 'post',
				data: {
					content: $scope.leave_content, //内容
					account: "admin1", //账号
				},
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded'
				},
				transformRequest: transform
			}).then(function(res) {
				$scope.visible = false;
				if (res.data.success == 1) {
					$scope.ress = res.data;
					$scope.vals = res.data.userData;
					$scope.visible = !$scope.visible; //显示
				} else {
					alert(res.data);
				}
			}).catch(function(err) {
				console.log(err);
			});
		}
		//删除留言
	$scope.leave_del = function(e, index) {
			$http({
				url: delete_leave_url,
				method: 'post',
				data: {
					msg_id: e.msg_id
				},
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded'
				},
				transformRequest: transform
			}).then(function(res) {
				console.log(res.data);
				if (res.data.success == 1) {
					$('.nota_show').eq(index).remove();
				} else {
					alert(res.data);
				}
			}).catch(function(err) {
				console.log(err);
			});
		}
		//点击回到顶部
	$scope.return_top = function() {
			$('html, body').animate({ //添加animate动画效果  
				scrollTop: 0
			}, 500);
		}
		//页面跳转
	$scope.jump_userInfo = function() {
		// 		$http({
		//  		url:delete_leave_url,
		//  		method:'post',
		//  	headers:{'Content-Type':'application/x-www-form-urlencoded'},
		//   transformRequest: transform
		//   }).then(function(res){
		//   	console.log(res.data);
		// if (res.data.success == 1){
		// 	$('.nota_show').eq(index).remove();
		// }else{
		//  	alert(res.data);
		// }
		//   }).catch(function (err) {
		//       console.log(err);
		//   });

	}
});