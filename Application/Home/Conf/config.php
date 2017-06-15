<?php
return array(
	//'配置项'=>'配置值'
	'DEFAULT_MODULE'        =>  'Home',  // 默认模块
    'DEFAULT_CONTROLLER'    =>  'User', // 默认控制器名称
    'DEFAULT_ACTION'        =>  'home', // 默认操作名称
    'DEFAULT_CHARSET'       =>  'utf-8', // 默认输出编码
    'AJAX_MSG'              =>   ['sta'=>'','type'=>'','data'=>''],//ajax返回消息格式
    'AJAX_CHECKNAME_MSG'    =>  '用户名重复',//重名验证提示
    'AJAX_REG_MSG_ERR'      =>  '注册失败',
    'AJAX_REG_MSG_SUC'      =>  '注册成功',
    'AJAX_LOGINF_MSG'       =>  '用户名或密码错误',
    'AJAX_LOGINS_MSG'       =>  '登录成功',

    'DATA_CACHE_PREFIX' => 'Redis_',//缓存前缀
    'DATA_CACHE_TYPE'=>'Redis',//默认动态缓存为Redis
    'REDIS_RW_SEPARATE' => false, //Redis读写分离 true 开启
    'REDIS_HOST'=>'127.0.0.1', //redis服务器ip，多台用逗号隔开；读写分离开启时，第一台负责写，其它[随机]负责读；
    'REDIS_PORT'=>'6379',//端口号
    'REDIS_TIMEOUT'=>'300',//超时时间
    'REDIS_PERSISTENT'=>false,//是否长连接 false=短连接
    'REDIS_AUTH'=>'test123',//AUTH认证密码
    'DATA_CACHE_TIME'       => 300,      // 数据缓存有效期 0表示永久缓存
   	
);