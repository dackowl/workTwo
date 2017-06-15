<?php
return array(
	//'配置项'=>'配置值'
	'MULTI_MODULE'          =>  true,
	'DB_TYPE'				=>'mysql',// 数据库类型
	'DB_HOST'				=>'localhost',// 服务器地址
	'DB_NAME'				=>'mf_wo',// 数据库名
	'DB_USER'				=>'workOne',// 用户名
	'DB_PWD'				=>'123',// 密码
	'DB_PORT'				=>8889,// 端口
	'DB_PREFIX'				=>'MF_',// 数据库表前缀
	'DB_CHARSET'			=>'utf8',// 数据库字符集
	'DEFAULT_FILTER'        => 'strip_tags,htmlspecialchars',//I方法默认数据过滤
	'SESSION_AUTO_START'	=>'on',//session自动开启
	'DB_DEBUG'  			=>  false, // 数据库调试模式 开启后可以记录SQL日志
	//验证码配置
    'VERIFY'                =>  [
    'fontSize'              =>   30,    // 验证码字体大小
    'length'                =>   4,     // 验证码位数
    'useNoise'              =>   false, // 关闭验证码杂点
    'expire'                =>   180,	//验证码的有效期（秒）
    // 'fontttf'               =>   '5.ttf',//字体使用 ThinkPHP/Library/Think/Verify/ttfs/5.ttf
    // 'useImgBg'              =>   true,//背景图随机使用 ThinkPHP/Library/Think/Verify/bgs 目录下面的图片
    // 'useZh'                 =>   true,//中文
    'bg'                    =>   array(243, 251, 254), //	验证码背景颜色 rgb数组设置，例如 array(243, 251, 254)
    'codeSet'               =>   '1234567890',//验证码字符集合 3.2.1 新增
	// 'zhSet'                 =>   '赵钱孙李周吴郑王',//验证码字符集合（中文） 3.2.1 新增
	'seKey'                 =>	  'md5'//验证码的加密密钥
    	],
    'AJAX_LOGINF_MSG'       =>  '用户名或密码错误',
    'AJAX_LOGINS_MSG'       =>  '登录成功',

);	