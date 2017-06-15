<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>bee</title>
	<link rel="stylesheet" href="">
    <script>
        loginid="<?php echo ($login["id"]); ?>"
        loginUser="<?php echo ($login["nick"]); ?>";
        loginimg="<?php echo ($login["img"]); ?>";
        (loginimg == '') ? loginimg="/work/Public/vue/images/1.jpg" : loginimg=loginimg;
    </script>
    <script src="https://cdn.bootcss.com/socket.io/2.0.1/socket.io.js"></script>
	<style lang="less">
		*, *:before, *:after {
            box-sizing: border-box;
        }
        body, html {
            height: 100%;
            overflow: hidden;
        }
        body, ul {
            margin: 0;
            padding: 0;
        }
        body {
            color: #4d4d4d;
            font: 14px/1.4em 'Helvetica Neue', Helvetica, 'Microsoft Yahei', Arial, sans-serif;
            background: #f5f5f5 url('/work/Public/vue/images/bg.jpg') no-repeat center;
            background-size: cover;
        }
        ul {
            list-style: none;
        }
        #chat {
            margin: 20px auto;
            width: 800px;
        	height: 600px;
        }
    	#chat {
	        overflow: hidden;
	        border-radius: 3px;
        }
        .sidebar, .main {
            height: 100%;   
        }
        .sidebar {
            float: left;
            width: 200px;
            color: #f4f4f4;
            background-color: #2e3238;
        }
        .main {
            position: relative;
            overflow: hidden;   
            background-color: #eee;
        }
        .m-text {
            position: absolute;
            width: 100%;
            bottom: 0;
            left: 0;
        }
        .m-message {
            height: calc(100% - 160px);
        }
    	
	</style>
	<style style="less">
	    	.m-card {
	        	padding: 12px;
	        	border-bottom: solid 1px #24272C;
	        }
	        .m-card footer {
	            margin-top: 10px;
	        }
	        
	        .avatar, .name {
	            vertical-align: middle;
	        }
	        .avatar {
	            border-radius: 2px;
	        }
	        .name {
	            display: inline-block;
	            margin: 0 0 0 15px;
	            font-size: 16px;
	        }
	        .search {
	            padding: 0 10px;
	            width: 100%;
	            font-size: 12px;
	            color: #fff;
	            height: 30px;
	            line-height: 30px;
	            border: solid 1px #3a3a3a;
	            border-radius: 4px;
	            outline: none;
	            background-color: #26292E;
	        }
	    
	</style>
	<style lang="less">
	    
	        .m-list li {
	            padding: 12px 15px;
	            border-bottom: 1px solid #292C33;
	            cursor: pointer;
	            transition: background-color .1s;
	        }    
	        .m-list li:hover {
	                background-color: rgba(255, 255, 255, 0.03);
	            }
	        .m-list li.active {
	                background-color: rgba(255, 255, 255, 0.1);
	            }
	        
	        .m-list .avatar,.m-list .name {
	            vertical-align: middle;
	        }
	        .m-list .avatar {
	            border-radius: 2px;
	        }
	        .m-list .name {
	            display: inline-block;
	            margin: 0 0 0 15px;
	        }
	 
	</style>
	<style lang="less">
    .m-message {
        padding: 10px 15px;
        overflow-y: scroll;
    }    
    .m-message li {
            margin-bottom: 15px;
        }
    .m-message .time {
            margin: 7px 0;
            text-align: center;
        }    
    .m-message .time> span {
                display: inline-block;
                padding: 0 18px;
                font-size: 12px;
                color: #fff;
                border-radius: 2px;
                background-color: #dcdcdc;
            }
        
    .m-message .avatar {
            float: left;
            margin: 0 10px 0 0;
            border-radius: 3px;
        }
    .m-message .text {
            display: inline-block;
            position: relative;
            padding: 0 10px;
            max-width: calc(100% - 40px);
            min-height: 30px;
            line-height: 2.5;
            font-size: 12px;
            text-align: left;
            word-break: break-all;
            background-color: #fafafa;
            border-radius: 4px;
        }    
    .m-message .text:before {
        content: " ";
        position: absolute;
        top: 9px;
        right: 100%;
        border: 6px solid transparent;
        border-right-color: #fafafa;
    }
        
        
    .m-message .self {
        text-align: right;
    }    
    .m-message .self .avatar {
        float: right;
        margin: 0 0 0 10px;
    }
    .m-message .self .text {
        background-color: #b2e281;
    }    
    .m-message .self .text:before {
        right: inherit;
        left: 100%;
        border-right-color: transparent;
        border-left-color: #b2e281;
    }
            
</style>
<style lang="less">
    .m-text {
        height: 160px;
        border-top: solid 1px #ddd;
    }    
    .m-text textarea {
            padding: 10px;
            height: 100%;
            width: 100%;
            border: none;
            outline: none;
            font-family: "Micrsofot Yahei";
            resize: none;
        }
    
</style>
</head>
<body>
	<div id="chat">
		<div class="sidebar">
			<div class="m-card">
			    <header>
			        <img class="avatar" width="40" height="40" :alt="user.name" :src="user.img">
			        <p class="name">{{user.name}}</p>
			    </header>
			    <footer>
			        <input class="search" type="text" placeholder="search user..." v-model="search">
			    </footer>
			</div>
            <div class="m-list">
		        <ul>
		            <li v-for="item in searchs" :class="{ active: sessionIndex === item.id }" @click="select(item)">
		                <img class="avatar"  width="30" height="30" :alt="item.name" :src="item.img">
		                <p class="name">{{item.name}}</p>
		            </li>
		        </ul>
		    </div>
        </div>
        <div class="main">
            <div class="m-message" v-scroll-bottom="sessionNow.messages">
		        <ul>
		        	<li @click="talks" style="text-align: center;color: blue;cursor: pointer;">点击查看历史记录</li>
		            <li v-for="item in sessionNow.messages">
		                <p class="time"><span>{{item.date | time}}</span></p>
		                <div class="main" :class="{ self: item.self }">
		                    <img class="avatar" width="30" height="30" :src="item | avatar" />
		                    <div class="text">{{item.text}}</div>
		                </div>
		            </li>
		        </ul>
		    </div>
			<div class="m-text">
		        <textarea placeholder="按 Ctrl + Enter 发送" v-model="text" @keyup="inputing"></textarea>
		    </div>
        </div>
	</div>
<script src="/work/Public/vue/js/vue.js"></script>
<script type="text/javascript" src="/work/Public/bee/js/client.js"></script>
<script>
//告诉服务用户上线
// socket.emit('login', {
//     'userid': loginid,
//     'username': loginUser
// });
// console.log(loginid);
// console.log(loginUser);
// Vue.use('vue-socker.io', 'http://localhost:8007');  
Vue.config.debug = true;
var now = new Date()
	var app = new Vue({
		el: '#chat',
		data: {
			message: 'Hello Vue!',
			user: {
	            id: loginid,
	            name: loginUser,
	            img: loginimg
	        },
	        // 用户列表
	        userList: [
	            {
	                id: 1,
	                name: '工蜂',
	                img: '/work/Public/vue/images/2.png'
	            }
	           

	        ],
	        // 会话列表
	        sessionList: [
	            {
	                userId: 1,
	                messages: [
	                    {
	                        text: '您好，第777号工蜂为您服务',
	                        date: now
	                    }
	                ]
	            }
	          
	        ],
	        // 搜索key
	        search: '',
	        // 选中的会话Index
	        sessionIndex: 1,
			sessionNow:{
	                userId: 1,
	                messages: [
	                    {
	                        text: '您好，第777号工蜂为您服务',
	                        date: now
	                    }
	                ]
	            },
            //输入框初始值
	        text:'',
            //聊天历史记录初始页
            tpage:0,
		},
        computed: {
            connectEvent:function(){
                console.log(22);
                this.httpServer = io.connect('http://127.0.0.1:8880');
                this.httpServer.emit('login', {
                    'userid': loginid,
                    'username': loginUser
                });
                this.httpServer.on('message', function (obj) {
                    console.log(obj);
                    me.onlineUserList = obj.onlineUserList;
                    me.messageList.push({type: 2, msg: obj.msg, msgUser: obj.user});
                });
            },
            searchs:function() {
            	var search=this.search;
            	var userList=this.userList;
                return userList.filter(function (item) {
                	return item.name.toLowerCase().indexOf(search.toLowerCase()) != -1
            	});;
            },
            session:function() {
                return this.sessionList[this.sessionIndex];
            },
            sessionUser:function() {
                // var users = this.userList.filter(item => item.id === this.session.userId);
                var users = this.userList.filter(function(element){
                	if(element.id==this.session.userId){
                		console(123);
                	}
                });
                return users[0];
            }
        },
        methods: {
            select:function (value) {
                this.sessionIndex = value.id;
                var snow = this.sessionList.filter(function(element){
					if(element.userId==value.id){
						return element;
					}
                })
                if(snow!=undefined){
                	this.sessionNow=snow[0];
                }else{
                	alert("系统错误");
            	}
            },
            inputing:function(e) {
                if (e.ctrlKey && e.keyCode === 13 && this.text.length) {
                    console.log(this.text );
                    if(this.text == ''){
                        alert('不能发送空消息');
                        return;
                    }

                    var obj = {
                        userid: this.user,
                        to:'witer',
                        date: new Date(),
                        text: this.text,
                        self: true

                    };
                    this.sessionNow.messages.push(obj);
                    socket.emit('message', obj);
                    this.text = '';
                }
                
            },
            talks:function(){
                var obj={
                    id:loginid,
                    start:this.tpage,
                    end:this.tpage+5
                }
                socket.emit('talk', obj);
                this.tpage=obj.end;
            }
        },
		directives: {
            // 发送消息后滚动到底部
            'scroll-bottom':function (el) {
            	var $dom=el;
                Vue.nextTick(function(){
                    $dom.scrollTop = $dom.scrollHeight - $dom.clientHeight;
                });
            }
        },
        filters: {
            // 筛选出用户头像
            avatar:function(item) {
                // 如果是自己发的消息显示登录用户的头像
                if (item.self) {
                    img=loginimg;
                }else{
                    img="/work/Public/vue/images/2.png";
                }
                return img;
            },
            // 将日期过滤为 hour:minutes
            time:function (date) {
                if (typeof date === 'string') {
                    date = new Date(date);
                }
                return date.getHours() + ':' + date.getMinutes();
            }
        },
        created:function(){
            var my=this;
            socket.on(loginid,function(obj){
                var messages={
                        text: obj.text,
                        date: obj.date
                    }
                if (obj.from==loginid) {
                    messages.self=true;
                }
                my.sessionNow.messages.push(messages);
            });
            var talks="t"+loginid;
            socket.on(talks,function(obj){
                console.log(obj);
                var messages={
                        text: obj.text,
                        date: obj.date
                    }
                    console.log(obj.from==loginid);
                if (obj.from==loginid) {
                    messages.self=true;
                }
                my.sessionNow.messages.unshift(messages);
            });
        }
		
	})

    // socket.on(loginid,function(obj){
    //     console.log(obj);
    // })
</script>

</body>
</html>