var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var dbr = require("./contentdb.js");
app.get('/', function(req, res) {
	res.send('<h1> node Server</h1>');
});
http.listen(8880, function() {
	console.log('listening on *:8880');
});
//在线用户
var onlineUsers = {};
//在线客服
var witer = {}
	//当前在线人数
var onlineCount = 0;
io.on('connection', function(socket) {
	console.log('连接成功了');
	//监听新用户加入
	socket.on('login', function(obj) {
		//将新加入用户的唯一标识当作socket的名称，后面退出的时候会用到
		socket.name = obj.userid;
		//检查在线列表，如果不在里面就加入
		if (!onlineUsers.hasOwnProperty(obj.userid)) {
			onlineUsers[obj.userid] = obj.username;
			//在线人数+1
			onlineCount++;
		}
		//向所有客户端广播用户加入
		// io.emit('login', {
		// 	onlineUsers: onlineUsers,
		// 	onlineCount: onlineCount,
		// 	user: obj
		// });
		console.log(obj.userid.name + '上线');
	});

	//监听用户退出(服务器断开)
	socket.on('disconnect', function() {
		//将退出的用户从在线列表中删除
		if (onlineUsers.hasOwnProperty(socket.name)) {
			//退出用户的信息
			var obj = {
				userid: socket.name,
				username: onlineUsers[socket.name]
			};

			//删除
			delete onlineUsers[socket.name];
			//在线人数-1
			onlineCount--;
		}
	});
	//监听用户发布聊天内容
	socket.on('message', function(obj) {
		//向所要发送信息对象发送消息
		io.emit(obj.to, obj);
		// console.log(obj.userid.name + "对" + obj.to + '说：' + obj.text);
		//添加聊天记录
		dbr.add(obj);

	});
	socket.on('talk', function(obj) {
		//向所要发送信息对象发送消息
		// io.emit(obj.to, obj);
		// console.log(obj.userid.name + "对" + obj.to + '说：' + obj.text);
		//添加聊天记录
		dbr.serch(io, obj.start, obj.end, obj.id);

	});
	//发送消息到客户端
	//socket.send('我发送消息到客户端');
	socket.on('reconnect', function() {
		console.log("重新连接到服务器");
	});
	//客户端ID列表 跨越所有节点，所有(所有在线的节点)
	io.clients(function(error, clients) {
		if (error) throw error;
		console.log(clients);
	});
});