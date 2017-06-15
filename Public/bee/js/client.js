var socket = io('http://127.0.0.1:8880');
//接收所有广播消息
socket.on('msg', function(data) {
    console.log(data);
});
socket.on('connect', function() {
    console.log('连接成功');
});
socket.on('connecting', function() {
    console.log('正在连接');
});
socket.on('disconnect', function() {
    console.log('断开连接了');
});
socket.on('error', function() {
    console.log('连接错误');
});
socket.on('reconnect', function() {
    console.log('成功重连');
});
socket.on('reconnecting', function() {
    console.log('正在重连');
});
// //告诉服务端用户登录消息
// socket.emit('login', {
//     'userid': loginid,
//     'username': loginUser
// });

// //监听新用户登陆
// socket.on('login', function(o) {
//     updateSysMsg(o, 'login');
// });
// //监听用户退出 
// socket.on('logout', function(o) {
//     updateSysMsg(o, 'logout');
// });
//监听消息发送
// socket.on('message', function(obj) {
//     var isme = (obj.userid == getUserId) ? true : false;
//     var contentDiv = '<div class="media-body">' + obj.content + '</div>';
//     var usernameDiv = '<a class="media-left" href="#">' + obj.username + '</a>';
//     var section = '<li class="media">' + usernameDiv + contentDiv + '</li>';
//     var section = document.createElement('li');
//     if (isme) {
//         section.className = 'media';
//         section.innerHTML = usernameDiv + contentDiv;
//     } else {
//         section.className = 'media text-warning';
//         section.innerHTML = usernameDiv + contentDiv;
//     }
//     document.getElementById('message').appendChild(section);
// });
//更新系统消息，本例中在用户加入、退出的时候调用
// function updateSysMsg(o, action) {
//     //当前在线用户列表
//     var onlineUsers = o.onlineUsers;
//     //当前在线人数
//     var onlineCount = o.onlineCount;
//     //新加入用户的信息
//     var user = o.user;
//     //更新在线人数
//     var userhtml = '';
//     var separator = '';
//     for (key in onlineUsers) {
//         if (onlineUsers.hasOwnProperty(key)) {
//             if (action == 'login') {
//                 var userlisthtml = document.createElement('a');
//                 userlisthtml.className = "list-group-item";
//                 userlisthtml.innerHTML = onlineUsers[key];
//                 document.getElementById('userlists').appendChild(userlisthtml);
//             };
//         }
//     }
//     //添加系统消息
//     var html = '';
//     html += user.username;
//     html += (action == 'login') ? ' 加入了聊天室' : ' 退出了聊天室';
//     document.getElementById("onlinecount").innerHTML = '当前共有 ' + onlineCount + ' 人在线';
//     //添加系统消息
//     var html = '';
//     html += '<div class="well well-sm">';
//     html += user.username;
//     html += (action == 'login') ? ' 加入了聊天室' : ' 退出了聊天室';
//     html += '</div>';
//     var section = document.createElement('section');
//     section.innerHTML = html;
//     document.getElementById('message').appendChild(section);
// }
// $("#submit").click(function() {
//     var send = $("#body").val();
//     if (!send) {
//         alert('不能发送空消息');
//     } else {
//         var obj = {
//             userid: getUserId,
//             username: getUserId,
//             content: send
//         };
//         socket.emit('message', obj);
//     }
//     return false;
// });