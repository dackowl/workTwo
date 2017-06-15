var transform = function(data) {
    return $.param(data);
}
var app = angular.module('myApp', ['ngFileUpload']);
app.controller('validateCtrl', function($scope, $http, Upload) {
    $scope.release_shop = function() {
            var item_detail_img = document.getElementById('item_detail_img');
            if (item_detail_img.files.length > 4) {
                item_detail_img.files.length = 4;
                console.log(item_detail_img.files.length);
                console.log(item_detail_img.files);
            }
            Upload.upload({
                //服务端接收
                url: fileupurl,
                //上传的同时带的参数
                data: {
                    type: 'type',
                    data: 'adr'
                },
                //上传的文件
                file: item_detail_img.files
            }).progress(function(evt) {
                // 进度条
                var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
                console.log('progess:' + progressPercentage + '%');
            }).success(function(data, status, headers, config) {
                //上传成功
                console.log(data);
            }).error(function(data, status, headers, config) {
                //上传失败
                console.log('error status: ' + status);
            });
            // $http({
            //     url: shop_add_to_url,
            //     method: 'post',
            //     data: {
            //         s_name: $scope.item_title,
            //         // s_addTime:$scope.item_time,
            //         s_pri: $scope.item_price,
            //         s_num: $scope.item_num,
            //         s_img: $scope.item_detail_img,
            //         s_details: $scope.item_nota,
            //         s_des: $scope.item_places
            //     },
            //     headers: {
            //         'Content-Type': 'application/x-www-form-urlencoded'
            //     },
            //     transformRequest: transform
            // }).then(function(res) {
            //     alert(res.data);
            //     $('.item_reset').click();
            // }).catch(function(err) {
            //     console.log(err);
            // })
        }
        //图片预览
    $scope.picturePreview = function() {
        var filetype = ['jpg', 'jpeg', 'png', 'gif'];
        $scope.item_detail_img = [];
        $scope.item_detail_img_type = [];
        var item_detail_img_show = document.getElementsByClassName('item_detail_img_show')[0];
        item_detail_img_show.innerHTML = "";
        var item_detail_img = document.getElementById('item_detail_img'); //得到文件信息
        if (item_detail_img.files.length < 4) {
            flenth = item_detail_img.files.length;
        } else {
            flenth = 4;
        }

        for (let i = 0; i < flenth; i++) {
            var fname = item_detail_img.files[i].name.split('.');
            $scope.item_detail_img_type.push(fname[1]);
            if (item_detail_img.files[i].size > 1024 * 1024 * 5) { //单位是B，此处不允许超过5M
                alert("图片不能超过5M");
                return false;
            }
            if (filetype.indexOf(fname[1].toLowerCase()) == -1) {
                alert('仅支持jpg，png，jpeg，gif图片');
                return false;
            }
            //实例化h5的fileReader
            var file_reader = new FileReader();
            file_reader.readAsDataURL(item_detail_img.files[i]); //以base64编码格式读取图片文件
            file_reader.onload = function() {
                $scope.item_detail_img.push(this.result); //得到结果数据
                var img_show = document.getElementsByClassName('item_detail_img_show')[0];
                img_show.innerHTML += "<img src='" + $scope.item_detail_img[i] + "'/>";
            };
        }
    };
});

//重置
$('.item_reset').on('click', function() {
    $(".form-control").val('');
    $(".item_detail_img_show").html('');
});