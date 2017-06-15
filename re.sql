drop database if exists mf_wo;
create database mf_wo 
default CHARACTER SET 'utf8' 
COLLATE 'utf8_general_ci';
use mf_wo;

/* 用户状态表 */
create table MF_useSt(	
	s_id int(2) auto_increment primary key,
	s_name varchar(16)
)ENGINE=INNODB;
insert into MF_useSt values
(1,'正常'),
(2,'锁定');

/* 客户表 */
DROP TABLE IF EXISTS mf_user;
create table mf_user(	
	u_id int(16) auto_increment primary key,
	account varchar(100), #账号	
	pwd varchar(32), #密码
	nick varchar(100), #昵称
	h_img varchar(100), #头像
	paypwd varchar(32), #支付密码
	email varchar(100), #邮箱
	qq int(12), #QQ
	u_money float, #财富
	u_st int(2), #状态
	regtime timestamp default current_timestamp, #注册时间
	lasttime timestamp, #登陆时间
	foreign key (u_st) references MF_useSt(s_id)
)ENGINE=INNODB DEFAULT CHARSET=utf8;
insert into MF_user(account,pwd,nick,email,qq,u_money,u_st)values('admin',123456,'恩恩','229269101@qq.com',229269101,999,1);
insert into MF_user(account,pwd,nick,email,qq,u_money,u_st)values('admin',123456,'恩恩','229269101@qq.com',229269101,999,1);
insert into MF_user(account,pwd,nick,email,qq,u_money,u_st)values('admin',123456,'恩恩','229269101@qq.com',229269101,999,1);
insert into MF_user(account,pwd,nick,email,qq,u_money,u_st)values('admin',123456,'恩恩','229269101@qq.com',229269101,999,1);
insert into MF_user(account,pwd,nick,email,qq,u_money,u_st)values('admin',123456,'恩恩','229269101@qq.com',229269101,999,1);
insert into MF_user(account,pwd,nick,email,qq,u_money,u_st)values('admin',123456,'恩恩','229269101@qq.com',229269101,999,1);


-- 角色表
create table MF_rolestable(	
	r_id int(2) auto_increment primary key,
	rolesname varchar(32),	#角色名
	r_des varchar(64)	#功能介绍
)ENGINE=INNODB;
insert into MF_rolestable (rolesname,r_des) values
('超级管理员','系统管理员'),
('经理','添加员工查看报表等'),
('普通业务员','添加商品等'),
('客服','客服人员');

-- 菜单表
create table MF_menutable(	
	m_id int(2) auto_increment primary key,
	m_name varchar(32),	#菜单名
	pid int(2),	#父id
	src varchar(32) default null	#菜单对应路径
)ENGINE=INNODB;
insert into MF_menutable (m_id,m_name,pid) values
(1,'系统管理',0),
(2,'活动管理',0),
(3,'游记管理',0),
(4,'用户管理',0),
(5,'评论管理',0),
(6,'订单管理',0),
(7,'目的地管理',0),
(8,'数据管理',0),
(9,'客服',0),
(10,'友情链接',0);
insert into MF_menutable (m_name,pid,src) values
('用户管理',1,"admin/staff/index"),
('角色管理',1,"admin/roles/index"), 
('添加活动',2,"admin/Shop/shopRelease"),
('活动查看',2,"admin/Shop/shopPreview"),
('游记查看',3,"./application/views/creatSalesView.php"),
('用户查看',4,"admin/User/index"),
('活动评论',5,"admin/Comm/index"),
('目的地评论',5,"./application/views/salesShowView.php"),
('未支付订单',6,"admin/Order/unpaidOrder"),
('已支付订单',6,"admin/Order/paidOrder"),
('目的地添加',7,"admin/Audit/index"),
('目的地查看',7,"admin/Destin/index"), 
('目的地审核',7,"admin/Audit/index"),
('报表',8,"./application/views/reportsView.php"),
('日志',8,"./application/views/logsView.php"),
('蜜蜂',9,"bee/Index/index"),
('友情链接',10,"admin/Link/index");

/* 权限表 */
create table MF_righttable(	
	ri_id int(4) auto_increment primary key,
	roles int(2),	#角色id
	menuid varchar(64)	#该角色包含的菜单id
)ENGINE=INNODB;
insert into MF_righttable (roles,menuid) values
(1,'1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22'),
(2,'1,2,3,4,5,6,7,8,9,11,12,13,14,15,16,17,18,19,20,21,22'),
(3,'2,11,12'),
(4,'4,5,8,14,15,16,22');
/* 员工表 */
create table MF_staff(	
	s_id int(8) auto_increment primary key,
	s_name varchar(32),	#员工名
	roles int(2),	#对应的角色ID
	account varchar(16) unique,	#员工账号
	s_pwd varchar(32),	#员工登录密码
	st int(2) default 1, #员工状态
	regtime timestamp default current_timestamp, #注册时间
	lasttime timestamp, #登陆时间
	foreign key (roles) references MF_rolestable(r_id),
	foreign key (st) references MF_useSt(s_id)
)ENGINE=INNODB;
insert into MF_staff (s_name,roles,account,s_pwd) values
('超级管理员',1,'admin','e10adc3949ba59abbe56e057f20f883e'),
('经理',2,'222','e10adc3949ba59abbe56e057f20f883e'),
('推销员',3,'333','e10adc3949ba59abbe56e057f20f883e'),
('客服',4,'444','e10adc3949ba59abbe56e057f20f883e');
-- 商品表
DROP TABLE IF EXISTS mf_shop;
create table mf_shop(
	s_id int(8) auto_increment primary key,
	s_name varchar(300) not null, #商品名字
	s_img varchar(50) not null, #商品缩略图
	s_pri int(8) not null, #价格
	s_details varchar(100), #详情
	s_sum int(5), #总数
	s_num int(5), #库存
	s_des varchar(20) not null, #目的地
	s_state varchar(10) not null default "未上架",  #状态
	s_time timestamp default current_timestamp, #上架时间
	s_addtime timestamp not null default current_timestamp #发布时间
)ENGINE=INNODB DEFAULT CHARSET=utf8;

INSERT INTO mf_shop(s_name,s_img,s_pri,s_details,s_sum,s_num,s_des)VALUES('暑期', 'adr_41.jpg','1111','曼谷','100','65','曼谷');
INSERT INTO mf_shop(s_name,s_img,s_pri,s_details,s_sum,s_num,s_des)VALUES('暑期1', 'adr_42.jpg','2222','曼谷','100','65','曼谷');
INSERT INTO mf_shop(s_name,s_img,s_pri,s_details,s_sum,s_num,s_des)VALUES('暑期2', 'adr_43.jpg','5555','曼谷','100','65','曼谷');
INSERT INTO mf_shop(s_name,s_img,s_pri,s_details,s_sum,s_num,s_des)VALUES('暑期3', 'adr_44.jpg','3333','曼谷','100','65','曼谷');
INSERT INTO mf_shop(s_name,s_img,s_pri,s_details,s_sum,s_num,s_des)VALUES('暑期4', 'adr_45.jpg','7777','曼谷','100','65','曼谷');
INSERT INTO mf_shop(s_name,s_img,s_pri,s_details,s_sum,s_num,s_des)VALUES('暑期5', 'adr_46.jpg','6666','曼谷','100','65','曼谷');
DROP TABLE IF EXISTS `MF_st`;
create table MF_st(
	s_id int(1) auto_increment primary key,	
	s_name varchar(15) not null #状态名字
)ENGINE=INNODB;
insert into MF_st(s_name) values('启用'),('禁用'),('待审核');

-- 地区
DROP TABLE IF EXISTS `MF_area`;
create table MF_area(
	a_id int(8) auto_increment primary key, #主键id
	a_name varchar(15) not null #地区名字
)ENGINE=INNODB;
insert into MF_area(a_name) values('华中'),('华东');


-- 目的地
DROP TABLE IF EXISTS `mf_des`;
create table MF_des(
	d_id int(10) auto_increment primary key, #目的地主键id
	d_area int(8) not null, #所属地区
	d_city varchar(72) not null, #目的地名称
	d_con varchar(576), #目的地简介
	d_img varchar(15), #目的地缩略图
	d_man int(8), #目的地人气
	d_st int(1),#审核状态 
	foreign key (d_area) references MF_area(a_id)
)ENGINE=INNODB;
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("1","北京","北京，位于华北平原，有着三千余年的建城史和八百五十余年的建都史。北京是中华人民共和国首都、中央直辖市、中国国家中心城市，也是中国政治、文化、教育和国际交流中心。是一座传统与现代交融的城市。这里既有古典风韵，又具时尚气息。","adr_1.jpg","65266","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("1","厦门","厦门又名鹭岛，是福建省下辖的一个副省级城市，位于福建东南部，闽南地区。厦门市是中华人民共和国15个副省级城市之一，享有省级经济管理权限并拥有地方立法权；既是中国最早实行对外开放政策的四个经济特区之一，又是十个国家综合配套改革试验区之一（即“新特区”）。厦门和金门对望，是大陆距离台湾最近的地方。","adr_2.jpg","45740","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("1","香港","香港，英文名为Hong Kong。它是一个充满诱惑感的城市，是全球最富裕、经济最发达和生活水平最高的地区之一，是“亚洲四小龙”之一，是国际金融商贸中心之一，是世界大都会之一，然而除了这散发着金钱味道的“第一”后面，香港还150年惊心动魄的巨变，有着中西合璧的丰富文化，有着一颗容纳种族、语言、地域的包容之心。","adr_3.jpg","40351","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("1","大理","大理白族自治州地处云南省中部偏西，东巡洱海，西及点苍山脉，是中国西南边疆开发较早的地区之一。地处低纬高原，四季温差不大，常年气候温和，土地肥沃，以秀丽山水和少数民族风情闻名于世，境内以蝴蝶泉、洱海、崇圣寺三塔等景点最有代表性。","adr_4.jpg","28667","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("1","重庆","重庆市位于中国内陆西南部、长江上游。重庆四面环山，依山而建，又有长江和嘉陵江在此交汇，别名江城，又称山城。四川盆地东南部，为北京、天津、上海三市总面积的2.39倍，是中国面积最大的城市。重庆别称山城、渝都、雾都、桥都，中华人民共和国直辖市，国家中心城市，长江上游地区经济中心和金融中心。","adr_5.jpg","30796","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("1","青岛","青岛位于山东半岛南端，是中国东部沿海地区重要的交通枢纽和海外游客入出中国的主要口岸，世界性区域贸易中心，东北亚国际航运中心，山、海、城相融相拥的城市，成为中国最优美的海滨风景带。青岛拥有国际性海港和区域性枢纽空港。","adr_6.jpg","34610","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("1","张家界","张家界位于湖南西北部，保存着完好的青石板路及古民居。澧水中上游，属武陵山脉腹地，为中国最重要的旅游城市之一。张家界旅游资源丰富。大自然的鬼斧神工，造就了美妙绝伦的张家界景观，长居水泥森林之中，到此地所感受到的美妙，难以用言辞表达。 有土家族民族特色和两千多年历史文化的古镇，至今仍保存完好。","adr_7.jpg","17027","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("1","九寨沟","九寨沟位于四川省阿坝藏族羌族自治州九寨沟县漳扎镇，沟内分布108个湖泊。九寨沟四季景色迷人。动植物资源丰富，种类繁多，原始森林遍布，栖息着大熊猫等十多种稀有和珍贵野生动物。被誉为“美丽的童话世界”。 水是九寨沟景观的主角。碧绿晶莹的溪水好似项链般穿插于森林与浅滩之间。色彩斑斓的湖泊和气势宏伟的瀑布令人目不暇接。","adr_8.jpg","19632","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("1","昆明","昆明的西山犹如睡美人般静卧与滇池之上，大观楼上的长联，述写出五百里滇池的波澜壮阔，金殿里陈圆圆的雕像屹立于湖心，历经百年沧桑风雨，物是人非，徒留一句“冲冠一怒为红颜”的感叹，自古英雄难过美人关，一代枭雄吴三桂也终究拜倒在美女的裙裾之下。","adr_9.jpg","33528","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("1","乌镇","古镇民居临河而建、傍桥而市，镇内民风纯朴，是江南水乡“小桥、流水、人家”的典范。乌镇是国家AAAAA级景区，全国二十个黄金周预报景点及江南六大古镇之一。乌镇是典型的江南水乡古镇，素有“鱼米之乡，丝绸之府”之称。曾名乌墩和青 墩，具有六千余年悠久历史。水阁，乌镇由此又被称为“中国最后的枕水人家”。","adr_10.jpg","22868","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("1","青海湖","青海湖是中国最大的内陆高原湖泊，也是中国最大的咸水湖，由祁连山的大通山、日月山与青海南山之间的断层陷落形成。青海湖的蒙古语为“库库诺尔”，藏语为“错温布”，都意为：青色的海。青海湖湖水干净、清澈，附近景区沿湖分布，以原子城（西海镇）为起点，主要景区为日月山、沙岛、151基地（二郎剑景区）、鸟岛、金银滩草原。","adr_11.jpg","13408","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("1","大连","大连是辽宁省第二大城市，东北地区经济发达城市。是一个充满魔力的海滨城市。大连地理位置优越，是京津的门户，与日本、韩国、朝鲜和俄罗斯远东地区相邻。蓝天、碧海、青山、白石、连绵起伏的海岸，潮起潮落的大海，风景如诗如画，一派旖旎的海滨风光。大连美妙的自然风光，加上多彩的人文景观，更让人流连忘返。","adr_12.jpg","21646","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("1","香格里拉","云南省迪庆藏族自治州香格里拉县青藏高原南缘，横断山脉腹地，是滇、川、藏三省区交汇处。香格里拉素有“高山大花园”、“动植物王国”、“有色金属王国”的美称。在香格里拉县的普达措国家公园，分布着两个高原湖泊：属都湖与碧塔海。香格里拉是一个自然景观、人文景观的富集区域，是国家八大黄金旅游热线之一。","adr_13.jpg","17345","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("1","婺源","婺源县位于位于中国江西省东北部，上饶市北部。婺源素有“书乡”、“茶乡”之称，是全国著名的文化与生态旅游县。婺源为古徽州府所辖的六县之一，也是徽州文化的发祥地之一。境内古村落遍布乡野，保存完整，且独具徽派风格，被外界誉为“中国最美乡村”、“一颗镶嵌在赣、浙、皖三省交界处的绿色明珠”。","adr_14.jpg","11024","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("1","呼伦贝尔","呼伦贝尔草原是世界四大草原之一，被称为世界上最好的草原。在这片地域辽阔、风光旖旎的地方，有松涛激荡的大兴安岭林海、水草丰美的草原、蜿蜒曲折的莫尔格勒河……你还可以住在俄罗斯特色的“木刻楞”里，吃上一顿俄式大餐，感受边陲小镇的异国风情。这里就像一幅绚丽的画卷，而人们便是草原上欢乐的小羊。","adr_15.jpg","5245","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("1","垦丁","《少年派的奇幻漂流》里，PI最终上岸时战胜自我、重新开始美好生活的秀美海滩的取景地就在垦丁。这片国境之南，有来自太平洋的风，有碧蓝纯净海滨风光，有坚持原创鼓励个性的“春天呐喊”音乐节，有希腊的浪漫、夏威夷的热情，一切都忽隐忽现在文艺小清新的格调里。境内的主要景点绝大多数都在垦丁国家公园的范围内，垦丁国家公园是台湾第一座国家公园，每到落山风开始的季节就会有许多来自北方的珍贵鸟类来此避冬。此外，海底的珊瑚景观也是垦丁国家公园的一大特色。随着电影《海角七号》和《少年派的奇幻漂流》热映，更使得恒春与垦丁声名大噪。","adr_16.jpg","8326","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("1","扬州","扬州，地处江苏省中部，长江下游北岸。扬州现在是全国首批24座历史文化名城之一，是中国首批优秀旅游城市。扬州市区不大，且大多集中于广陵区和古运河沿岸，体力稍好的，步行就能逛遍扬州。个园、何园、瘦西湖、大明寺是到扬州来不可错过的经典景点。","adr_17.jpg","16952","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("1","济南","济南市又称泉城，是中国山东省省会及最大城市，山东省政治、文化、教育中心，华东五大城市之一，中国历史文化名城。济南拥有2700多年的历史， 是中华文明的重要发祥地之一，是龙山文化的发祥地。因境内有“七十二名泉”故被称为“泉城”，并素有“四面荷花三面柳，一城山色半城湖”的美誉。济南是个少数民族聚集的地方。","adr_18.jpg","20477","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("1","涠洲岛","涠洲岛是中国最年轻的火山岛，也是广西最大的海岛。从高空鸟瞰，涠洲岛像一枚弓型翡翠浮在大海中。沿海海水碧蓝见底，海底活珊瑚、名贵海产瑰丽神奇，种类繁多，岛上植被茂密，风光秀美，奇特的海蚀、海积地貌，火山熔岩让人称绝，在《中国国家地理》杂志“选美中国”活动中，涠洲岛被评为“中国十大最美丽海岛”，位列第二。","adr_19.jpg","5014","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("1","贵阳","贵阳，是一座山城，因为在贵山之阳而得名。贵阳又称作“林城”，被誉为“高原第二春城”，春城昆明美在热情浓艳，贵阳则美在灵秀洁净。贵阳的多数景区多以“公园”命名，公园里有着连绵不尽的葱翠山峰、碧湖溶洞，充分的证明了贵州的好山好水无处不在。除却山清水秀，惬意自在也是贵阳的一张名片，整个城市生活节奏舒缓，不像大都市那样紧张。","adr_20.jpg","10830","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("1","色达","色达位于甘孜藏自治州西北部，东邻阿坝藏羌族自治州壤塘县，北与青海省班玛、达日两县接壤，西、南海拔4127米，辖4区2镇15乡、66个行政村，大部分从事畜牧业生产。色达有著名的喇荣寺五明佛学院，五明佛学院是世界上最大的佛学院，具有悠久的历史气息。","adr_21.jpg","2804","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("1","舟山","舟山，有着丰富的自然资源，舟山群岛自然风光秀丽，气候宜人，山海景观奇特、名胜古迹众多。“海天佛国”普陀山、“列岛晴沙”嵊泗、“东海蓬莱”岱山、“沙雕故乡”朱家尖、“金庸笔下”桃花岛、“文化名城”定海，“城市渔港”沈家门，“蓬莱仙岛”岱山等，1390个岛屿象一颗颗璀璨的珍珠，洒落在浩瀚无垠的大海中，玩海、吃海鲜是这里永恒的主题……","adr_22.jpg","8623","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("1","北戴河","北戴河区为我国著名旅游度假区，二十里长、曲折平坦的沙质海滩，沙软潮平，背靠树木葱郁的联峰山，构成了一道美丽的风景。北戴海滨地处河北省秦皇岛市的西 部，与北京，天津，秦皇岛，兴城，葫芦岛形成一条黄金旅游带。","adr_23.jpg","16868","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("1","高雄","高雄全年长夏无冬，一派热带风光，是一座美丽的海港城市。一条“爱河”缓缓流过高雄市区，为高雄增添了无限风光和浪漫气息；有“台湾西湖”美誉的西子湾风景区拥有多处独具特色的旅游景点，为南台湾最富盛名的观光地区，全区风光旖旎，适宜欣赏湖光水色、泛舟垂钓。位于左营的莲池潭风景区也有孔庙、龙虎塔、春秋阁等多处观光景点；从鼓山乘坐轮渡来到旗津岛，岛上有旗津海岸公园和旗津海水浴场，还有旗津灯塔和旗后炮台，更有美味海鲜值得前去品尝。","adr_24.jpg","8000","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("1","甘南","甘南藏族自治州是全国十个藏族自治州之一，位于中国甘肃省南部， 甘南藏族自治州地处青藏高原东北边缘。以优美的藏族弹唱闻名于藏区。甘南是丝绸之路和唐蕃古道的重要组成部分。","adr_25.jpg","4308","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("1","威海","威海市为山东省港口城市。威海城区在明以前，为海滨渔村。汉称石落村。元改称清泉夼。明洪武年间，为防倭寇侵扰，设立“威海卫”。威海市是全国投资硬环境40优城市，也是全国综合经济实力50强城市。硬朗的山和澎湃的水，润泽的山和柔美的水，丰茂的山和碧蓝的水，山和水的种种风貌。山和水就是一只闪亮的皇冠，成为威海最壮美的华服。","adr_26.jpg","13505","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("1","宏村","宏村，古称弘村，是古黟桃花源里一座奇特的牛形古村落，枕雷岗面南湖，山水明秀，享有“中国画里的乡村”之美称。 宏村距今约有900年的历史，至今依旧较好地保存着数百户粉墙青瓦、鳞次栉比的古民居群，特别是精雕细镂、飞金重彩的承志堂、敬修堂；气度恢宏、古朴宽敞的东贤堂、三立堂；森严的叙仁堂、上元厅等祠堂和南湖书院；巷门幽深，青石街道旁古朴的观店铺……同平滑似镜的月沼和碧波荡漾的南湖，雷岗上参天古木、民居庭院中的百年牡丹与探过墙头的青藤石木，构成一个完美的艺术整体。","adr_27.jpg","7681","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("1","台中","台中市是台湾省的直辖市之一，位于台湾中部，是台湾中部唯一的直辖市。北与苗栗县、新竹县接壤、南临彰化县、南投县、东隔中央山脉与宜兰县、花莲县相邻，西临台湾海峡。台中市是台湾中小企业与精密机械最重要的聚集地，许多台湾的著名企业都将总部设在台中。台中市的旅游资源以艺术人文展示馆为主，如自然科学博物馆、台湾美术馆、台中市立文化中心、台中民俗公园、丰乐雕塑公园等；若要欣赏自然风光或娱乐，则须至东北郊的大坑风景区一带，当地以亚哥花园、东山乐园最具知名度。台湾许多著名的小吃，在台中都可以找到，市内还有众多的个性餐厅及庭园餐厅。","adr_28.jpg","5813","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("1","腾冲 ","腾冲是位于中国云南省西部中缅边境的一个县。中国大陆唯一的火山地热并存地区。历史上曾是古西南丝绸之路的要冲。由于地理位置重要，历代都派重兵驻守，明代还建造了石头城，称之为“极边第一城”。腾冲99座火山、88处温泉，其中高黎贡山是横断山脉的明珠，在亚欧板块和印度板块的激烈碰撞中生成。腾冲不但有蔚为壮观的火山群、地热群，还有火山奇观。","adr_29.jpg","4810","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("1","郑州 ","曾是华夏文明的发源地，承载着璀璨的千年文明，日月轮回，朝代更迭，在历史的舞台上演绎过精彩，在悠悠岁月中饱经沧桑，现在的它虽已洗尽铅华，但在历史的推动下这里又孕育出新的美丽，郑州——正如那滔滔的黄河之水，向世人源源不绝的展示着其昔日与今朝的无限魅力……文物古迹众多，有古城、古文化、古墓葬、古建筑、古关隘和古战场在内的遗址遗迹达1万余处。","adr_30.jpg","14713","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("1","林芝 ","被称为“西藏江南”的林芝地区位于西藏东南部、拉萨以东。林芝大部地区气候湿润，景色宜人，少数民族以门巴族和珞巴族为主。对于初到拉萨有高原反应的朋友来说，建议先去海拔最低的林芝地区，对缓解高原反应很有帮助。优美的田园风光，恍惚中让你有置身江南之感。","adr_31.jpg","8979","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("1","张掖","古人有诗曰“不望祁连山顶雪，错把张掖当江南”，雪景、冰山、林海、草地、湖泊、碧水、沙砾相映成趣，既具有南国风韵，又具有塞上风情。境内有着得天独厚的自然景观，有着美不胜收的原生态城市湿地，气势磅礴的彩色丹霞地貌，西北最美的油菜花海，亚洲最大的万匹军马驰骋，独特裕固族风情， 祁连山旷野风光，戈壁滩冰川奇峰。","adr_32.jpg","6459","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("1","太原","太原既有被岁月重新雕琢的古老石窟，也有不同宗教信仰的各种寺院，还有繁华的“迎泽大街”和获得联合国环境规划署颁发的“改善人类居住环境范例奖”的汾河公园等。双塔永祚寺，其“双塔凌霄”已成为太原的标志。除此还有晋祠古典园林，其宋代的建筑和塑像尤为珍贵；天龙山佛教石窟，石雕像为中原地区罕见的佳作；龙山道教石窟，是中国仅有的元代道教石窟。","adr_33.jpg","13173","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("1","惠州","惠州是客家人的重要聚居地和集散地之一，旅居海外华人华侨、港澳台同胞居“客家四州”之首，被称为“客家侨都”。素有“广东黄山”之称的南昆山国家森林公园，自然景色蔚为奇观，有“古代桃源今代存”之美誉；素有""岭南第一山""之称的罗浮山，林木品种齐全，野生动、植物资源丰富，是国家4A级旅游景区；由""五湖""、""六桥""、""十四景""组成的惠州西湖，是以山水资源为主体，融自然景观和人文景观于一体的城市型湖泊。","adr_34.jpg","7204","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("1","乐山","乐山位于四川盆地西南部，古称“嘉州”，境内自然资源丰富，江河纵横，拥有岷江、大渡河、青衣江和众多中小河流，乐山、峨眉山等高低山峦，素有“天下山水之观在蜀，蜀之胜曰嘉州”美誉，是一座名副其实的“山水之城”，蜀地胜境。","adr_35.jpg","12578","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("1","大同","大同是山西省第二大城市，国家重能源基地，国际较有影响力城市素有“中国雕塑之都”，素有“凤凰城”和“中国煤都”之称。在文化上，以云冈石窟、北魏悬空寺为代表的北魏文化；以华严寺、善化寺、观音堂、觉山寺塔、圆觉寺塔为代表的辽金文化；以边塞长城、兵堡、龙壁、明代大同府城为代表的明清文化，构成了鲜明的地域文化特色，可以概括为平城文化、边塞文化和佛教文化。","adr_36.jpg","7746","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("1","常州","常州自古崇文重教，经济发达，是近代民族工商业的发祥地，也是科教、创新以及公益慈善的名城。丘陵山区的峰峦、怪石、奇洞，也为常州带来了秀丽的风光。青龙山的青龙、白虎两洞，怪石嶙峋，千姿百态，栩栩如生；有“伍牙飞翠”之美称伍员山、茅山的三宫五观、九峰三十六洞更为这著名的道教圣地增添了神秘的色彩。","adr_37.jpg","10902","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("1","佛山","佛山是一座历史悠久 的文化名城，是广东省下辖的一个地级市。佛山是闻名的“武术之乡”，这里是黄飞鸿、李小龙的故乡，是中国南派武术的主要发源地。佛山也是粤剧的发源地，有着独特的岭南文化气息，是为岭南文化代表广府文化的兴盛之地。是珠三角的经济重地，一个荣耀千年的商贸名城，用生生不息的陶都圣火锻造出“敢为人先，崇文务实”的城市。","adr_38.jpg","9641","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("1","川西","川西指四川西部，多指四川阿坝州甘孜州等地区。这个地区自然风景优美迷人，九寨沟、黄龙、卧龙自然保护区、四姑娘山、米亚罗红叶风景区、九曲黄河十八弯等风景名胜都位于川西地区，是四川省风景最迷人的一个地区，也是旅游和户外的理想去处！","adr_39.jpg","1100","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("1","云台山","以山称奇的云台山，位于河南焦作市修武县境内，到处是奇峰秀岭。主峰茱萸峰海拔1308米，有千阶云梯栈道达峰顶，可望千里太行深处，领略到“会当凌绝顶，一览众山小”的意境。此外，云台山也以水称绝，素以“三步一泉，五步一瀑，十步一潭”而闻名。","adr_40.jpg","6414","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("1","甘孜","甘孜位于雅砻江上游。“甘孜县境内的景点包括，雅安贡嘎雪山，稻城亚丁神山，九龙梅地贡嘎山，塔公雅拉雪山，巴塘措普沟，康区著名的寺庙—南无寺等。传说甘孜城的西北坡有一块形如绵羊的白玉，毛泽洁白无瑕，阳光照射下闪闪发亮，光彩夺目，十分美丽。甘孜县境内有鹿茸、麝香、贝母、虫草等名贵药材和鹿、水獭、马鸡等珍贵动物。","adr_41.jpg","4188","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("1","九份","九份为昔日的台湾採金中心，后因电影《悲情城市》在此取景，展示了它独特的旧式建筑、坡地以及风情，而吸引了国内外的注目，成为了一个很受欢迎的观光景点。九份整个小镇座落于山坡地上，依旧保留着日治时代的旧式建筑，有独特的山坡和阶梯式建筑景观，夜景尤其美丽。","adr_42.jpg","5302","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("1","泰安","泰安是中国山东省中部下辖的一个地级市，名取“国泰民安”之意，泰安的最有价值最有名的景点首推泰山，很多时候，泰山甚至成了泰安的代名词，当然，如果有时间，泰山的虎山公园，天平湖公园也可以一同游览。","adr_43.jpg","9881","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("1","阿尔山","阿尔山是一座植被茂密的天然氧吧，这里曾是电影《夜宴》的外景地。国家森林公园景区里包含了天池、三潭峡、杜鹃湖、石塘林等多个景点。阿尔山市坐落在一个巨大的矿泉群体之中。花红、树绿、天蓝、水清，甚至看得见终年不化的积雪白冰。每年五月，大兴安岭鲜艳的杜鹃花就开满了山坡，穿着厚厚的冬衣欣赏傲雪的杜鹃仿佛置身于人间的仙境，美不胜收。","adr_44.jpg","3251","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("1","长春","长春是亚洲第一的森林城，城市绿化率已经达到78%，居于亚洲大城市之冠，不仅市区绿树成荫，就连城市周边也是绿色的海洋，绕城高速公路（五环路）两侧90公里长、550米宽的绿化带，是城市一道美丽的风景。冬季冰雪旅游更是长春的特色，在这里不但可以滑雪、溜冰、参加雪地汽车拉力赛，还可以欣赏冰雕、雪雕等各类冰雪艺术品，是名副其实的“冰雪奇缘”之旅。","adr_45.jpg","11134","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("2","雨崩","雨崩村位于梅里雪山的五子峰脚下，景色优美，民风淳朴，真乃世外桃源。因目前无公路可通，进入雨崩需徒步或骑马18公里，翻越3,700米垭 口。在雨崩，自然之神毫无保留的发挥着他的想象力，鬼斧神工之下，雨崩村最终成为神奇的香格里拉的缩影，因其地理环境独特，所以人烟稀少，全村只有几十户人家，有西当方向和尼农方向两条驿道，以西当驿道更为方便。","adr_46.jpg","3065","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("2","石家庄","石家庄市是河北省省会，北靠首都北京，古称“京畿之地”，素有“南北通衢、燕晋咽喉”之称，地理位置十分优越，旅游资源十分丰富，有秀美自然风光，有珍贵文物古迹。石家庄市各种体系完备，实力雄厚。","adr_47.jpg","10279","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("2","同里","同里镇，位于太湖之畔古运河之东。建于宋代，至今已有1000多年历史，是名副其实的水乡古镇。为江南六大著名水乡之一，面积33公顷，为五个湖泊环抱，由网状河流将镇区分割成七个岛。古镇风景优美，镇外四面环水。同里连同周庄、甪直三个江南水乡古镇也已经列入联合国教科文组织申报世界遗产名单。","adr_48.jpg","8476","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("2","呼和浩特","呼和浩特是一座有400多年建城历史、具鲜明民族特点和众多名胜古迹的塞外名城。这里有各种召庙50多座，城郊有不少风光秀丽的草原旅游点，牛羊遍地，鸟语花香，大黑河南岸有一座传诵古今的西汉古墓——昭君墓，青冢兀立、巍峨壮观；有“塞外西湖”之称的哈素海，是天然湖泊，晴空碧水，蔚蓝一色；与蒙古风情街相连的伊斯兰风情街，以沙漠黄为主，绿白相间为副色，圆形殿顶、高耸的柱式塔楼，让人领略到浓郁的伊斯兰风情。","adr_49.jpg","6634","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("2","东北","中国东北地区，简称中国东北、东北、东北地区、东北三省或东三省，是中国的一个地理大区，狭义上指由辽宁、吉林、黑龙江等三省构成的区域，广义上包括辽宁、吉林、黑龙江，以及旧为东三省管辖之内蒙古东四盟市（呼伦贝尔市、兴安盟、赤峰市、通辽市）。总面积126万平方公里，占国土面积的13%；2004年GDP总量1.6万亿元，占全国的11.76%；人口1.2亿，占全国的9.18%。东北地区坐拥中国最大的平原东北平原，土壤肥沃，是我国重要的粮食产区。东北地区还是我国重要的重工业基地，一度占有中国90%的重工业基地。东北地区旅游资源丰富，森林、草原、湿地、冰雪、工业、农业旅游资源在全国独具特色，生态环境优越，是中国重要的冰雪旅游和避暑度假旅游目的地。","adr_50.jpg","1330","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("2","韶关","广东著名历史文化名城，历史上岭南有名重镇，全国著名的“有色金属之乡”。  韶关旅游资源丰富，主要有丹霞山、南华禅寺、珠玑巷、马坝人遗址、梅关古道、广东大峡谷、满堂客家大围、南岭国家自然保护区等。 珠玑巷里追寻时光流逝下斑驳的历史，丹霞山上赞叹大自热的神奇，南华寺里感受六祖慧能的佛宗禅意，在梅关古道上看红梅傲雪，遥想当年虎踞龙盘，一夫当关万夫莫开的雄浑气势......","adr_51.jpg","6245","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("2","衡山","衡山，又名南岳，是我国的五岳之一。衡山自古天下闻名，以壮美的自然风光和佛、道两教并存的人文景观而著称。处处是茂松修竹，终年翠绿；奇花异草，四时飘香，自然景色十分秀丽，因而又有“南岳独秀”的美称。祝融峰之高，藏经殿之秀，水帘洞之奇，方广寺之深堪称“衡山四绝”，春观花、夏看云、秋望日、冬赏雪为“衡山四季佳景”。","adr_52.jpg","1559","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("2","纳木错","纳木错湖，又称腾格里海、腾格里湖，是在中国仅次于青海湖的第二大咸水湖。它位于西藏拉萨市以 北当雄、班戈两县之间。湖的形状近似长方形，东西长70多千米，南北宽30多千米，面积1920多平方千米。湖水最大深度33米，蓄水量768亿立方米， 为世界上海拔最高的大型湖泊。“纳木错”为藏语，而这个湖的蒙古语名称为“腾格里海”，两种名称都是“天湖”之意。","adr_53.jpg","8997","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("2","武当山","武当山是道教圣地，位于湖北省西北部的十堰市丹江口境内，高峰林立，天柱峰海拔1612米。武当山是联合国公布的世界文化遗产地之一，是中国国家重点风景名胜区，同时也是道教名山和武当拳的发源地，被誉为”亘古无双胜境，天下第一仙山”。","adr_54.jpg","3946","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("2","丽水","被誉为“浙南林海”。丽水市山清水秀、古迹众多，拥有国家级、省级风景区多处，自然风光美不胜收，人文景观如群星璀璨，交相辉映，是生态旅游休闲度假胜地。丽水是全国最大的畲族聚居地，景宁畲族自治县是全国唯一的畲族自治县。","adr_55.jpg","3563","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("2","霞浦","霞浦是闽东最古老的县，建县史有1700多年，曾是闽东的政治、经济、文化中心， 素有“闽浙要冲、海滨邹鲁""之誉，也是中国的“海带之乡”、“紫菜之乡”、“鱼米之乡”。霞浦山清水秀，旅游资源丰富，主要景点有宋朝朱熹讲学地“秀泉”、人称“海国桃源”的杨家溪、省级文物保持单位大京城堡、有“闽东小普陀”之称的三沙留云洞、获“闽东北戴河”之誉的天然海滨浴场——外浒沙滩、“中国道教名山”之一的葛洪山、“摄影宝地”北岐滩涂、“畲族小说歌发祥地”白露坑以及沿海天然沙滩、岛屿、港湾各具特色。","adr_56.jpg","2628","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("2","潮州","潮州，位于广东东部，东与福建省接壤，是国家历史文化名城、潮州文化的重要发源地，素有“岭海名邦”、“岭东首邑”等美誉。潮州有众多属于自己的独特文化：潮绣、潮州戏、潮州木雕、潮州菜、潮州功夫茶、潮州民居等。潮州旅游资源也极其丰富，有新旧潮州八景，潮州以其独特的魅力吸引着众多游客前来游玩。","adr_57.jpg","3651","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("2","乌兰布统","乌兰布统位于内蒙古自治区，距北京仅300多公里，是清朝木兰围场的一部分。这里是丘陵与平原交错地带，森林和草原有机结合，既具有南方优雅秀丽的阴柔，又具有北方粗犷雄浑的阳刚，兼具南秀北雄之美。","adr_58.jpg","1518","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("2","中山","中山市是中国广东省下辖的地级市，位于珠江三角洲中南部，旧称“香山”，1925年，为纪念刚刚去世的孙中山，香山易名为中山。中山市经济发展迅速，文化历史悠久，自然风光秀丽，历史古迹众多，民间艺术丰富，人才辈出，是人杰地灵之地。","adr_59.jpg","8271","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("2","龙脊梯田","龙脊梯田距桂林市区77公里，是一个规模宏大的梯田群，梯田海拔最高1,180米，最低380米，共分为金坑·大寨红瑶梯田观景区、平安壮族梯田观景区、龙脊古壮寨梯田观景区。线条行云流水，潇洒柔畅；规模磅礴壮观，气势恢弘，有“梯田世界之冠”的美誉，比起精致的巴厘岛德格拉朗梯田壮丽许多。在这里和谐宁静的梯田风光、与世不争的人居生态环境，吸引着更多的中外游人前来休闲渡假。人们远离了喧嚣的都市，吃在农家，住在农家，释放了压力、亲近了自然，真正融入到田园牧歌般的生活当中，成为了中外游客来到桂林的首选目的地。","adr_60.jpg","3752","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("2","上饶","上饶市简称饶，位于江西省东北部，东联浙江、南挺福建、北接安徽，处于长三角经济区、海西经济区、鄱阳湖生态经济区三区交汇处，是江西省对接长三角的最前沿。上饶是典型的江南鱼米之乡。自古就有“上乘富饶、生态之都”、“八方通衢”和“豫章第一门户”之称。上饶市是江西省旅游资源最丰富的市，名山胜迹星罗棋布，早在唐朝就已是闻名遐迩的旅游胜地，历代官宦名流、文人墨客留下的观光游记、诗词歌咏数不胜数。境域拥有丰富的绿色自然风光、红色革命遗址、古色文化遗存、蓝色淡水湖泊。你可以到中国最美乡村婺源看油菜花海，到道教名山三清山看“奇峰怪石、古树名花、流泉飞瀑、云海雾涛”，还有龟峰、彩虹桥、石城等景点也瑰丽无比。","adr_61.jpg","4327","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("2","酒泉","酒泉市位于甘肃省西北部，河西走廊西端，是甘肃省面积最大的城市。酒泉为汉代河西四郡之一，自古是中原通往西域的交通要塞，丝绸之路的重镇。酒泉，山脉连 绵，戈壁浩瀚，盆地毗连，构成了雄浑独特的西北风光。既有银妆素裹的冰川雪景，也有碧波溪流的平原绿洲，还有沙漠戈壁的海市蜃楼。","adr_62.jpg","4115","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("2","壶口瀑布","壶口瀑布，是黄河上唯一的黄色大瀑布，也是中国的第二大瀑布，号称“黄河奇观”，其奔腾汹涌的气势是中华民族精神的象征。壶口瀑布东濒山西省临汾市吉县壶 口镇，西临陕西省延安市宜川县壶口乡。距太原大约5、6个小时车程；距西安大约2个多小时车程。1988年被确定为中国国家重点风景名胜区，1991年被 评为“中国旅游胜地四十佳”，2002年，晋升为国家地质公园。","adr_63.jpg","4816","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("2","枸杞岛","枸杞岛位于菜园镇东30.6公里处，东近嵊山，是嵊泗列岛中仅次于泗礁山的第二大岛，因岛上遍生中药材枸杞灌木而得名。枸杞岛略呈""T""字型，以山地为主，山顶多裸岩，沟谷处植被甚茂。森林覆盖率达53%以上，居嵊泗县各岛首位，岛上有山海奇观、小西天、大王沙滩等景点。","adr_64.jpg","1277","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("2","塞罕坝","塞罕坝位于内蒙古高原与冀北山地的交汇地带，地形结构和植被复杂。全园规划6大类型景观，被誉为“水的源头，云的故乡，花的世界，林的海洋，珍禽异兽的天堂”。属国家一级旅游资源，“生态、皇家、民俗”独具特色。","adr_65.jpg","3919","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("2","湖州","湖州是一座具有2300多年历史的江南古城，位于浙江省北部，有优美的自然景观和众多历史人文景观，是中国蚕丝文化、茶文化、湖笔文化的发祥地之一，被称为南太湖明珠。深厚的文化底蕴与优美的自然风光使湖州旅游资源丰富，形成了湖州独具特色的市区太湖风情游、长兴文化旅、南浔古镇游、莫干山风景游、安吉竹乡游等经典旅游线路。","adr_66.jpg","5343","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("2","徐州","徐州，苏北最大城市，中国第二大铁路枢纽，长三角的“北大门”。徐州历史悠久，有“九朝帝王徐州籍”之说，因其拥有大量文化遗产、名胜古迹和深厚的历史底蕴，也被称作“东方雅典”。徐州兼有北方的雄厚和南方的秀美，是一个独具特色优秀的风景旅游胜地。","adr_67.jpg","5763","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("2","曲阜","曲阜， 三皇肇启，五帝龙兴，文采郁郁，礼乐之都。之所以享誉全球，是与孔子的名字紧密相连的。“千年礼乐归东鲁，万古衣冠拜素王”东鲁即曲阜，素王即孔子。你可以游曲阜三孔，拜至圣孔子、欣赏古迹、品尝天下第一宴—孔府宴；游寿丘少昊陵，赏上古黄帝诞生地；逛洙泗书院，找寻儒家文化的源头；去孟母林，瞻仰“四大贤母”之首，真可谓是一次“思想的行走”。","adr_68.jpg","8390","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("2","清远","清远有独特风光的高山峡谷、河流湖泊、原始森林、溶洞温泉等奇特景观。景点甚多，飞霞风景名胜区、清新温矿泉、宝晶宫、英西峰林、连州地下河、湟川三峡、三排瑶寨、大旭山瀑布群、新兴的以“唐风禅韵”为主体所打造的御金街少林禅院和凤凰台等等。不管你是漂流、探险，还是游山玩水，或者泡温泉、赛龙舟、吃美食，清远都不会让你失望。","adr_69.jpg","6700","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("2","安顺","安顺，中国优秀旅游城市，全国甲类旅游开放城市，安顺市是贵州省第三大城市，全国唯一的“深化改革，促进多种经济成分共生繁荣，加快发展”改革试验区，民 用航空产业国家高技术产业基地，贵州历史文化名城，是“贵州加快发展的经济特区”，世界喀斯特风光旅游优选地区，全国 六大黄金旅游热线之一和贵州西部旅游中心。","adr_70.jpg","3847","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("2","屏东","屏东是台湾最南的县，素有“台湾的南洋”之称。有佳冬萧宅、屏东孔庙、恒春古城、鹅銮鼻灯塔等著名的古迹，还有耀眼的阳光、碧绿的海洋，绵延的沙滩、五彩的珊瑚礁，洋溢着南太平洋岛屿般的慵懒气氛。","adr_71.jpg","3783","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("2","台南","台南，身为台湾最早发展的城市，这座古城已经有数百年的历史，又因独特的文化和历史背景，成了近年来旅游观光胜地。台南有回溯赤嵌楼的历史，荷人所建的普罗民遮城，以及城堡大门和文昌阁旁的炮座遗迹可供凭吊。海安路一带有许多气氛很好的酒吧和露天热炒店，还有日本居酒屋、火锅店等等，在海安路上一定可以找到你喜欢的一种度过夜晚的方式。","adr_72.jpg","4644","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("2","南投","南投位于台湾中部，是台湾唯一的内陆县，历经数百年的移民融合，当地原住民虽和后来的平埔族、汉人，在平地共同生活，但各族群仍保有原来的聚落与风俗民情，形成了南投特有的浓厚人文景观；而昔日震撼全台的抗日英勇事迹--雾社事件，至今于古战场旧址，仍立有纪念碑，供后人凭吊。还有著名的清境农场，风景优美，清爽宜人，是夏季的避暑胜地。","adr_73.jpg","4030","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("2","阳江","阳江历史悠久，可与广州相媲美。依山傍海，东北为天露山，西北为云雾山，山海兼优，自然风光秀丽，有碧海银滩、奇峰碧波、峰林溶洞、温泉瀑布、湖光山色和灿烂的人文景观，主要景点有：马尾岛，东方银滩风景区，北洛湾风景区，珍珠湾、鸳鸯湖、金山森林公园等。真是一个上山下水的好地方。","adr_74.jpg","4965","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("2","吐鲁番","吐鲁番是丝绸之路上的一颗美丽的明珠，位于新疆维吾尔自治区中东部地区。是天山东部山间盆地，又称为“火洲”。吐鲁番是中国内地连接中国新疆、中亚地区及南北疆的交通枢纽。这是一座神秘的城市，从最早的交河故城，到高昌故城，有人类智慧结晶——坎儿井，有苏公塔、石窟寺、火焰山。虽然面积不大，却融合了各种宗教、民族文明。","adr_75.jpg","6131","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("2","密云","密云地处北京市东北部燕山山脉脚下，历史悠久，既是全国农业生态试点县，又是全国绿化先进县，国家生态县，被誉为“北京山水大观，首都郊野公园”，是华北通往东北、内蒙古的重要门户，故有“京师锁钥”之称。","adr_76.jpg","1354","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("2","崇明岛","崇明岛，地处长江口，长江奔泻东下，流入河口流速变缓，所挟大量泥沙于此逐渐沉积，形成一个个的河口沙岛，从露出水面到最后形成大岛，经历了千余年的涨坍 变化。全岛地势平坦，土地肥沃，林木茂盛，物产富饶，是有名的鱼米之 乡。明太祖朱元璋曾称之为“东海瀛洲”，是中国第三大岛。绿树成荫的环岛大堤，犹如一条绿色巨龙，盘伏在长江口上。","adr_77.jpg","5385","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("2","台州","台州市，位于中国浙江省沿海中部，是浙江省下辖的一个地级市。台州市自然风光雄奇秀丽、古朴庄严、玄远清幽；人文景观源远流长、内涵丰富、独放异彩。台州旅游以“佛、山、海、城、洞”五景最具特色，拥有国家重点风景名胜区天台山、长屿硐天和国家级历史文化名城临海。","adr_78.jpg","4485","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("2","木兰围场","清代皇家猎苑——木兰围场，位于河北省东北部（承德市围场满族蒙古族自治县），与内蒙古草原接壤；这里自古以来就是一处水草丰美、禽兽繁衍的草原。“千里 松林”曾是辽帝狩猎之地，“木兰围场”又是清代皇帝举行“木兰秋狝”之所。清朝是著名的皇帝狩猎之所。如今在青山碧野之中 仍存有古朴典雅的七通碑，独特的庙宫合一建筑——东庙宫，富有传奇色彩的练兵台、将军泡子，成为游人凭吊怀古的好去处。","adr_79.jpg","3073","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("2","岳阳","岳阳市位于中国湖南省东北部，东倚幕阜山，西抱洞庭湖，北枕长江，区位优越，风景秀丽，土地肥沃，物产丰富，素有“鱼米之乡”的美誉。岳阳矿产资源丰富，矿藏矿点200多处，其中钒矿蓄量居亚洲之冠。岳阳集名山、名水、名楼、名人、名文于一体，是中华文化重要的始源地之一。其中有岳阳楼、慈氏塔、鲁肃墓、岳州文庙、洞庭湖中的君山和扁山、城南的南湖公园为著名游览地。","adr_80.jpg","5601","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("2","太白山","太白山位于秦岭山脉中段，周至、太白和眉县的交界处，总面积56,325公顷，主峰拔仙台海拔 3,767.2米，是中国大陆东半壁的最高名山。即使在盛夏时节山顶也终年积雪，从关中平原远眺白雪皑皑，堪称奇观。“太白积雪六月天”自古为著名的关中八景之一。太白山以森林景观为主体，苍山奇峰、清溪碧潭、文物古迹点缀其间。","adr_81.jpg","2523","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("2","喀什","喀什市古称“疏勒”，历史上是横贯亚欧大陆“丝绸之路”中国南、北、中三路在 西端交汇的商埠重镇，是著名的“安西四镇”之一。有如新疆最大的艾提尕尔清真寺，异域风情浓重的高台民居，风光独特的卡拉库里湖，以及她所映衬的慕士塔格峰，还有海拔最高的口岸——红其拉甫口岸。","adr_82.jpg","3224","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("2","海陵岛","海陵岛位于中国广东省阳江市西南端的南海北部海域，以“南海1号，丝路水道”的美誉入选中国十大宝岛，以“南中国海边的明珠”和“阳光、沙滩、海水的完美结合”，被评为中国最美十大海岛之一，享有""南方北戴河""和""东方夏威夷""的美称。海陵岛四面环海，冬无严寒，夏无酷暑，四季如春，海水浴时间长达8个月。","adr_83.jpg","1263","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("2","龙胜","龙胜位于广西壮族自治区东北部，是桂北少数民族最集中的地方，也是中南地区第一个成立的民族自治县。由于地势东、南、北三面高而西部低，龙胜素有“万山环峙，五水分流”之说。一层层梯田从山脚盘绕到山顶，层次分明；距离县城不远的龙胜温泉，水中含有多种益于人体的微量元素，同样吸引了不少游客前往。","adr_84.jpg","3255","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("2","汉中","汉中是国家历史文化名城、中国优秀旅游城市、国家生态示范区建设试点地区、全国双拥模范城。有着“汉家发祥地，中华聚宝盆”的美誉，这里是丝绸之路开拓者张骞的故里、四大发明造纸术发明家蔡伦的封地和葬地，三国大将魏延葬地。韩信、诸葛亮、曹操等帝王将相曾在这里建功立业，李白、杜甫、陆游、苏轼等伟大诗人曾探访、辗转或生活在这片土地上，并留下了瑰丽的墨迹诗章。","adr_85.jpg","3711","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("2","丹巴","丹巴，被誉为“中国最美丽的乡村”，位于四川省甘孜藏族自治州。丹巴旅游资源丰富多彩，自然风光神奇美丽，“天然盆景”、党岭风光，集雪山、森林、海子、温泉、草甸于一体；墨尔多神山，纳山、水、林、崖、洞108圣景于一炉，是休闲度假、探险旅游、回归自然的最佳去处。还有古碉、莫斯卡格萨尔石刻等人文景观，出了阿兰·达瓦卓玛这样女子的美人谷，可谓人杰地灵。","adr_86.jpg","3491","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("2","景洪","景洪位于中国云南省西双版纳傣族自治州境内，西双版纳傣族几乎全民信仰南传上座部佛教。逛宗庙，欣赏其建筑风格，感受其宗教文化；野象谷中建有一些大树旅馆和观象台，旅客如有耐心，可看见野象到河边饮水、嬉戏、洗澡；原始森林公园融汇了独特的原始森林自然风光和迷人的民族风情，能看到孔雀东南飞、猴子表演，这里是是北回归线以南保存最完好的热带沟谷雨林。","adr_87.jpg","3982","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("2","德钦","德钦县位于云南省迪庆藏族自治州西北部，地处青藏高原的南延部分，境内有气势磅礴、巍峨耸峙的的雪山群，尤以梅里雪山为著称，又有幽深迷人、如镜似玉的高山湖泊和草甸，还有金碧辉煌的庙宇神殿和神秘的藏传佛教文化，更有绚丽多彩的民族文化和民间艺术。","adr_88.jpg","4708","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("2",	"赤水","赤水市位于中国贵州省西北部，赤水河下游，历为 川黔边贸纽带、经济文化重镇，是黔北通往巴蜀的重要门户，素有“川黔锁钥”、“黔北边城”之称。赤水是全国十大竹乡之一，有竹类40余种，以楠竹著名，有 “楠竹之乡”之称。赤水因美丽而神秘的赤水河贯穿全境而得名，更因中国工农红军“四渡赤水”以及赤水丹霞世界自然遗产而扬名中外。","adr_89.jpg","2295","1");
insert into MF_des(d_area,d_city,d_con,d_img,d_man,d_st)values("2","汶川","走进汶川，你可以去感受世界上最古老的羌文化，欣赏绚丽的羌族刺绣，观看历经千载而不倒的羌寨、碉房和邛笼仍在雪山下耸立，还有被称为世界桥梁先驱的悬筒和溜索仍在峡谷上空荡漾；如果你是冒险家，你可以在这里攀岩、漂流、滑翔、科学探险、野营、生存挑战等，累了来一场西羌药蒸，既可陶冶身心，又可以强健体魄。","adr_90.jpg","6427","1");



-- 友情链接
DROP TABLE IF EXISTS `MF_link`;
create table MF_link(
	f_id int(8) auto_increment primary key, #主键id
	f_adr varchar(255),
	f_name varchar(15) not null 
)ENGINE=INNODB;
insert into MF_link(f_adr,f_name) values('http://china.makepolo.com','马可波罗');
insert into MF_link(f_adr,f_name) values('http://www.onlylady.com','Onlylady女人志');
insert into MF_link(f_adr,f_name) values('http://trip.elong.com','艺龙旅游指南');
insert into MF_link(f_adr,f_name) values('http://www.cncn.com','欣欣旅游网');
insert into MF_link(f_adr,f_name) values('http://www.8264.com','户外运动');
insert into MF_link(f_adr,f_name) values('http://www.yue365.com','365音乐网');
insert into MF_link(f_adr,f_name) values('http://ishare.iask.sina.com.cn','爱问共享资料');
insert into MF_link(f_adr,f_name) values('http://www.uzai.com','旅游网');
insert into MF_link(f_adr,f_name) values('http://www.zongheng.com','小说网');
insert into MF_link(f_adr,f_name) values('http://www.yue365.com','学习啦');
insert into MF_link(f_adr,f_name) values('http://www.yododo.com','游多多自助游');
insert into MF_link(f_adr,f_name) values('http://www.gebilaoshi.com','教育');
insert into MF_link(f_adr,f_name) values('http://www.yue365.com','365音乐网');
insert into MF_link(f_adr,f_name) values('http://huoche.mafengwo.cn','火车时刻表');
insert into MF_link(f_adr,f_name) values('http://www.lvmama.com','驴妈妈旅游网');
insert into MF_link(f_adr,f_name) values('http://www.haodou.com','好豆美食网');
insert into MF_link(f_adr,f_name) values('http://www.taoche.com','二手车');
insert into MF_link(f_adr,f_name) values('http://www.lvye.cn','绿野户外');
insert into MF_link(f_adr,f_name) values('http://www.tuniu.com','途牛旅游网');
insert into MF_link(f_adr,f_name) values('http://www.mapbar.com','图吧');
insert into MF_link(f_adr,f_name) values('http://www.chnsuv.com','SUV联合越野');
insert into MF_link(f_adr,f_name) values('http://www.uc.cn','手机浏览器');
insert into MF_link(f_adr,f_name) values('http://sh.city8.com','上海地图');
insert into MF_link(f_adr,f_name) values('http://www.tianqi.com','天气预报查询');
insert into MF_link(f_adr,f_name) values('http://www.ly.com','同程旅游');
insert into MF_link(f_adr,f_name) values('http://www.tieyou.com','火车票');
insert into MF_link(f_adr,f_name) values('http://you.ctrip.com','携程旅游');
insert into MF_link(f_adr,f_name) values('http://www.jinjiang.com','锦江旅游');
insert into MF_link(f_adr,f_name) values('http://www.huoche.net','火车时刻表');
insert into MF_link(f_adr,f_name) values('http://www.tripadvisor.cn','TripAdvisor');
insert into MF_link(f_adr,f_name) values('http://www.tianxun.com','天巡网');
insert into MF_link(f_adr,f_name) values('http://www.zizaike.com','自在客');
insert into MF_link(f_adr,f_name) values('http://www.zuzuche.com','租租车');
insert into MF_link(f_adr,f_name) values('http://www.5fen.com','五分旅游网');
insert into MF_link(f_adr,f_name) values('http://www.zhuna.cn','酒店预订');
insert into MF_link(f_adr,f_name) values('http://www.ailvxing.com','爱旅行网');
insert into MF_link(f_adr,f_name) values('http://360.mafengwo.cn/all.php','旅游');
insert into MF_link(f_adr,f_name) values('http://vacations.ctrip.com','旅游网');
insert into MF_link(f_adr,f_name) values('http://www.wed114.cn','wed114结婚网');
insert into MF_link(f_adr,f_name) values('http://www.chexun.com','车讯网');
insert into MF_link(f_adr,f_name) values('http://www.aoyou.com','遨游旅游网');
insert into MF_link(f_adr,f_name) values('http://www.91.com','手机');
insert into MF_link(f_adr,f_name) values('http://www.mafengwo.cn/s/link.html','更多友情链接&gt;&gt;');
-- 订单状态表
drop table if exists MF_orderstate;
create table mf_orderstate(
	os_id int primary key auto_increment,
	os_state text(20) not null
)ENGINE=INNODB DEFAULT CHARSET=utf8;

insert into MF_orderState(os_state)values('已付款'),('未付款'),('已发货'),('待发货'),('退款中'),('交易成功'),('交易关闭'),('确认收货'),('评价');
-- 商品表
DROP TABLE IF EXISTS mf_shop;
create table mf_shop(
	s_id int(8) auto_increment primary key,
	s_name varchar(300) not null, #商品名字
	s_img varchar(50) not null, #商品缩略图
	s_pri int(8) not null, #价格
	s_details varchar(100), #详情
	s_sum int(5), #总数
	s_num int(5), #库存
	s_des varchar(20) not null, #目的地
	s_state varchar(10) not null default "未上架",  #状态
	s_time timestamp default current_timestamp, #上架时间
	s_addtime timestamp not null default current_timestamp #发布时间
)ENGINE=INNODB DEFAULT CHARSET=utf8;

INSERT INTO mf_shop(s_name,s_img,s_pri,s_details,s_sum,s_num,s_des)VALUES('暑期', 'adr_41.jpg','1111','曼谷','100','65','曼谷');
INSERT INTO mf_shop(s_name,s_img,s_pri,s_details,s_sum,s_num,s_des)VALUES('暑期1', 'adr_42.jpg','2222','曼谷','100','65','曼谷');
INSERT INTO mf_shop(s_name,s_img,s_pri,s_details,s_sum,s_num,s_des)VALUES('暑期2', 'adr_43.jpg','5555','曼谷','100','65','曼谷');
INSERT INTO mf_shop(s_name,s_img,s_pri,s_details,s_sum,s_num,s_des)VALUES('暑期3', 'adr_44.jpg','3333','曼谷','100','65','曼谷');
INSERT INTO mf_shop(s_name,s_img,s_pri,s_details,s_sum,s_num,s_des)VALUES('暑期4', 'adr_45.jpg','7777','曼谷','100','65','曼谷');
INSERT INTO mf_shop(s_name,s_img,s_pri,s_details,s_sum,s_num,s_des)VALUES('暑期5', 'adr_46.jpg','6666','曼谷','100','65','曼谷');

-- 订单列表
drop table if exists MF_orderlist;
create table mf_orderlist(
	ol_id int primary key auto_increment,
	ol_money decimal not null,	#价格
	ol_ordertime timestamp not null DEFAULT CURRENT_TIMESTAMP,#下单时间
	ol_num int not null,	#数量
	u_id int not null,	#用户外键
	foreign key(u_id) references mf_user(u_id),
	s_id int not null,	#商品外键
	foreign key(s_id) references mf_shop(s_id),
	os_id int not null,	#订单状态外键
	foreign key(os_id) references mf_orderState(os_id)
)ENGINE=INNODB auto_increment=2017520;

insert into MF_orderList(ol_money,ol_num,u_id,s_id,os_id)values
	('888','5','1','1','1'),('6666','2','2','2','2'),('2255','3','1','3','2'),('1888','3','1','5','1'),
	('888','5','1','1','1'),('6666','2','2','2','2'),('2255','3','1','3','2'),('1888','3','1','5','1'),
	('888','5','1','1','1'),('6666','2','2','2','2'),('2255','3','1','3','2'),('1888','3','1','5','1'),
	('888','5','1','1','1'),('6666','2','2','2','2'),('2255','3','1','3','2'),('1888','3','1','5','1'),
	('888','5','1','1','1'),('6666','2','2','2','2'),('2255','3','1','3','2'),('1888','3','1','5','1'),
	('888','5','1','1','1'),('6666','2','2','2','2'),('2255','3','1','3','2'),('1888','3','1','5','1'),
	('888','5','1','1','1'),('6666','2','2','2','2'),('2255','3','1','3','2'),('1888','3','1','5','1');
-- 游记
create table MF_Travel(
	t_id int(8) auto_increment primary key, #id主键
	t_uid int(8) not null, #发表用户id
	t_title varchar(50) not null, #标题
	t_des int(4), #目的地
	t_con text, #内容
	t_great int(8), #点击数
	t_make int(8), #收藏数
	t_time timestamp not null default current_timestamp, #发布时间
	foreign key (t_uid) references MF_user(u_id),
	foreign key (t_des) references MF_des(d_id)
)ENGINE=INNODB;

/*商品评论表*/
create table MF_comments(
	c_id int(4) auto_increment primary key,
	account varchar(16), #用户账号,
	s_name varchar(256),
	c_con text
);
