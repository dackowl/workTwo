<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>
            X-admin v1.0
        </title>
        <meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="format-detection" content="telephone=no">
<link rel="stylesheet" href="/work/Public/xamin/css/x-admin.css" media="all">
<script src="/work/Public/xamin/lib/layui/layui.js" charset="utf-8"></script>
<script src="/work/Public/xamin/js/x-admin.js"></script>

        <script>
        var user="<?php echo ($login["nick"]); ?>";
        if(user==undefined){
            window.location.href="<?php echo u('Index/login');?>"
        }
        </script>
    </head>
    <body>
        <div class="layui-layout layui-layout-admin">
            <div class="layui-header header header-demo">
                <div class="layui-main">
                    <a class="logo" href="#">
                        蜂窝控制台
                    </a>
                    <ul class="layui-nav" lay-filter="">
                      <li class="layui-nav-item"><img src="/work/Public/xamin/images/logo.png" class="layui-circle" style="border: 2px solid #A9B7B7;" width="35px" alt=""></li>
                      <li class="layui-nav-item">
                        <a href="javascript:;"><?php echo ($login["nick"]); ?></a>
                        <dl class="layui-nav-child"> <!-- 二级菜单 -->
                          <dd><a href="">个人信息</a></dd>
                          <dd><a href="<?php echo u('Index/login');?>">切换帐号</a></dd>
                          <dd><a href="<?php echo u('Index/login');?>">退出</a></dd>
                        </dl>
                      </li>
                    <li class="layui-nav-item">
                        <a href="" title="消息">
                            <i class="layui-icon" style="top: 1px;">&#xe63a;</i>
                        </a>
                    </li>
                      <li class="layui-nav-item x-index"><a href="http://localhost:8888/work">前台首页</a></li>
                    </ul>
                </div>
            </div>
            <div class="layui-side layui-bg-black x-side">
                <div class="layui-side-scroll">
                    <ul class="layui-nav layui-nav-tree site-demo-nav" lay-filter="side">
                    <?php if(is_array($menu)): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(($vo["pid"]) == "0"): ?><li class="layui-nav-item">
                                <a class="javascript:;" href="javascript:;">
                                    <i class="layui-icon" style="top: 3px;"></i><cite><?php echo ($vo["m_name"]); ?></cite>
                                </a>
                                <dl class="layui-nav-child">
                                    <?php if(is_array($menu)): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vc): $mod = ($i % 2 );++$i; if($vo['m_id'] == $vc['pid']): ?><dd class="">
                                            <dd class="">
                                                <a href="javascript:;" _href="<?php echo ($vc["src"]); ?>">
                                                    <cite><?php echo ($vc["m_name"]); ?></cite>
                                                </a>
                                            </dd>
                                        </dd><?php endif; endforeach; endif; else: echo "" ;endif; ?>    
                                </dl>
                            </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>  
                        <li class="layui-nav-item" style="height: 30px; text-align: center">
                        </li>
                    </ul>
                </div>

            </div>
            <div class="layui-tab layui-tab-card site-demo-title x-main" lay-filter="x-tab" lay-allowclose="true">
                <div class="x-slide_left"></div>
                <ul class="layui-tab-title">
                    <li class="layui-this">
                        我的桌面
                        <i class="layui-icon layui-unselect layui-tab-close">ဆ</i>
                    </li>
                </ul>
                <div class="layui-tab-content site-demo site-demo-body">
                    <div class="layui-tab-item layui-show">
                        <iframe frameborder="0" src="<?php echo U('Index/wellcom');?>" class="x-iframe"></iframe>
                    </div>
                </div>
            </div>
            <div class="site-mobile-shade">
            </div>
        </div>
        <script>
        var _hmt = _hmt || [];
        (function() {
          var hm = document.createElement("script");
          hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
          var s = document.getElementsByTagName("script")[0]; 
          s.parentNode.insertBefore(hm, s);
        })();
        </script>
    </body>
</html>