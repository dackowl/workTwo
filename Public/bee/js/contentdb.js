// redis 链接
var redis = require('redis');
var client = redis.createClient('6379', '127.0.0.1');
// redis 链接错误
client.on("error", function(error) {
	console.log(error);
});
client.select("2", function(err) {
	if (err) {
		return false;
	} else {
		console.log('connect success');
	}
});
// client.set("a", "OK");

// // This will return a JavaScript String
// client.get("a", function(err, reply) {
// 	console.log(reply.toString()); // Will print `OK`
// });
// client.llen("talk", function(err, reply) {
// 	console.log(reply); // Will print `OK`
// });
// client.lpush('c', '12');
// client.lpush('c', '123');
// client.lpush('c', '124');
// client.lpush('c', '125');
// client.lpush('c', '126');
// client.lpush('c', '127');
// client.lrange('c', 2, 4,
// 	function(err, ress) {
// 		console.log(ress);
// 	});
// client.quit();
//添加聊天记录
module.exports.add = function(mas) {
	var data = {
		from: '',
		to: mas.to,
		date: mas.date,
		text: mas.text
	};
	if (mas.userid == 'witer') {
		var keyName = "talk" + mas.to;
		data.from = 'witer';
	} else {
		var keyName = "talk" + mas.userid.id;
		data.from = mas.userid.id;
	}
	data = JSON.stringify(data);
	// console.log(keyName);
	client.lpush(keyName, data);
	// client.quit();
}
module.exports.serch = function(conn, start, end, id) {
	var keyName = "talk" + id;
	// console.log(keyName);
	client.lrange(keyName, start, end, function(err, ress) {
			for (var i = 0; i < ress.length; i++) {
				var msg = JSON.parse(ress[i]);
				var name = "t" + id;
				conn.emit(name, msg);
			}
			// conn.emit(id, ress);
		})
		// client.quit();
}