-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2016-07-01 16:14:36
-- 服务器版本: 5.5.46-0ubuntu0.14.04.2
-- PHP 版本: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `info`
--

-- --------------------------------------------------------

--
-- 表的结构 `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL DEFAULT '',
  `author` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `dateline` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

--
-- 转存表中的数据 `article`
--

INSERT INTO `article` (`id`, `title`, `author`, `description`, `content`, `dateline`) VALUES
(1, '啊啊啊啊啊', '啥打算大润发', '人烦人v人', '床上叠床时代超市dsc十多个11111', 1446625929),
(2, '我我我我', '问问凤飞飞', '问问逗我玩二恶gf二姑父', ' 分分凡人歌4G而过而过', 1),
(6, '这是一个新文章', '这是新文章', 'this is a new article。', 'this is a new article。', 1446629742),
(7, '删除掉上传SDC', '鞍山市打扫打扫', '首都师范实得分实得分收到发生的佛挡杀佛大神', 'SD啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊', 1446629850),
(8, '测试修改文章接口是否正常', 'dz', 'edcwsx', 'eeeeeeeeee', 1449814451),
(9, 'ddddddd', 'ssdsdsdsds', 'sdaaaaaaaaaaaaaaaaaa', 'asdasdssssssssssssss', 1447223251),
(10, 'swagger-php', 'zircote', 'Generate interactive Swagger documentation for your RESTful API using doctrine annotations.', 'Features\r\n\r\nCompatible with the Swagger 2.0 specification.\r\nExceptional error reporting (with hints, context)\r\nExtracts information from code & existing phpdoc annotations.\r\nCommand-line interface available.\r\nInstallation (with Composer)\r\n\r\ncomposer require zircote/swagger-php\r\nFor cli usage from anywhere install swagger-php globally and make sure to place the ~/.composer/vendor/bin directory in your PATH so the swagger executable can be located by your system.\r\n\r\ncomposer global require zircote/swagger-php\r\nUsage\r\n\r\nAdd annotations to your php files.\r\n\r\n/**\r\n * @SWGInfo(title="My First API", version="0.1")\r\n */\r\n\r\n/**\r\n * @SWGGet(\r\n *     path="/api/resource.json",\r\n *     @SWGResponse(response="200", description="An example resource")\r\n * )\r\n */\r\nSee the Examples directory for more.\r\n', 1447223312),
(11, 'sdasdasd', 'dsaadsa', 'asdasdasdasd', 'asdasdasdasds', 1449134936),
(18, '为啥是空', 'ddd', 'sssdfdfds实得分实得分实得分', '凤飞飞空格好久哦膨润土计划【然后然后i肉几个i日你哥【让我飞呢', 1449221012),
(32, '测试修改文章接口是否正常', 'dz', '测试删除文章接口', '测试删除文章接口', 1449815218),
(33, '测试修改文章接口是否正常', 'dz', '测试删除文章接口', '测试删除文章接口', 1449815223),
(34, '测试修改文章接口是否正常', 'dz', '测试删除文章接口', '测试删除文章接口', 1449815226),
(35, '测试修改文章swagger接口是否正常', 'dz', '测试删除文章接口', '测试删除文章接口', 1449826415),
(37, 'DHC测试', 'edceee', 'edcwsx', 'eeeeeeeeee', 1449708637),
(38, 'DHC测试', 'edceee', 'edcwsx', 'eeeeeeeeee', 1449809125),
(39, 'DHC测试ddddddddaddarticle', 'edceeddde', 'edcwsx', 'eeeeeeeeee', 1449809182),
(40, 'DHC测试11', 'edceee', 'edcwsx', 'eeeeeeeeee', 1449815559),
(41, 'DHC测试11', 'edceee', 'edcwsx', 'eeeeeeeeee', 1449818635),
(43, 'swagger测试11', 'edceee', 'edcwsx', 'eeeeeeeeee', 1449826209),
(44, '测试修改文章接口是否正常', 'dz', '测试删除文章接口', '测试删除文章接口', 1451376922),
(45, '汪乐11', 'edceee', 'edcwsx', 'eeeeeeeeee', 1450682289),
(46, 'DHC测试11', 'edceee', 'edcwsx', 'eeeeeeeeee', 1451288780),
(47, 'CleanURL', 'edceee', 'edcwsx', 'eeeeeeeeee', 1451376662);

-- --------------------------------------------------------

--
-- 表的结构 `favoriteblog`
--

CREATE TABLE IF NOT EXISTS `favoriteblog` (
  `userid` int(11) NOT NULL,
  `weeklyid` int(11) NOT NULL,
  `favoriteblogid` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`favoriteblogid`),
  UNIQUE KEY `weeklyid` (`weeklyid`),
  UNIQUE KEY `weeklyid_2` (`weeklyid`),
  UNIQUE KEY `weeklyid_3` (`weeklyid`),
  KEY `userid` (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='收藏表' AUTO_INCREMENT=22 ;

--
-- 转存表中的数据 `favoriteblog`
--

INSERT INTO `favoriteblog` (`userid`, `weeklyid`, `favoriteblogid`) VALUES
(9, 90, 17),
(9, 4, 18),
(9, 92, 19),
(9, 8, 20),
(9, 1, 21);

-- --------------------------------------------------------

--
-- 表的结构 `introduce`
--

CREATE TABLE IF NOT EXISTS `introduce` (
  `about` text NOT NULL,
  `contact` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `introduce`
--

INSERT INTO `introduce` (`about`, `contact`) VALUES
('这是学习PHP的文章发布系统。', 'dingzero'),
('CREATE TABLE IF NOT EXISTS `t_user` ( \r\n  `id` int(11) NOT NULL AUTO_INCREMENT, \r\n  `username` varchar(30) NOT NULL COMMENT ''用户名'', \r\n  `password` varchar(32) NOT NULL COMMENT ''密码'', \r\n  `email` varchar(30) NOT NULL COMMENT ''邮箱'', \r\n  `token` varchar(50) NOT NULL COMMENT ''帐号激活码'', \r\n  `token_exptime` int(10) NOT NULL COMMENT ''激活码有效期'', \r\n  `status` tinyint(1) NOT NULL DEFAULT ''0'' COMMENT ''状态,0-未激活,1-已激活'', \r\n  `regtime` int(10) NOT NULL COMMENT ''注册时间'', \r\n  PRIMARY KEY (`id`) \r\n) ENGINE=MyISAM  DEFAULT CHARSET=utf8; ', 't_user');

-- --------------------------------------------------------

--
-- 表的结构 `notegroup`
--

CREATE TABLE IF NOT EXISTS `notegroup` (
  `groupid` int(11) NOT NULL AUTO_INCREMENT,
  `groupname` varchar(20) NOT NULL COMMENT '笔记本名称',
  `userid` int(11) NOT NULL COMMENT '用户id',
  PRIMARY KEY (`groupid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- 转存表中的数据 `notegroup`
--

INSERT INTO `notegroup` (`groupid`, `groupname`, `userid`) VALUES
(1, 'note', 0),
(2, 'work', 0),
(3, 'study', 0),
(4, 'weekly', 9),
(13, 'work', 9),
(14, 'note', 9);

-- --------------------------------------------------------

--
-- 表的结构 `t_user`
--

CREATE TABLE IF NOT EXISTS `t_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL COMMENT '用户名',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `email` varchar(30) NOT NULL COMMENT '邮箱',
  `token` varchar(50) NOT NULL COMMENT '帐号激活码',
  `token_exptime` int(10) NOT NULL COMMENT '激活码有效期',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态,0-未激活,1-已激活',
  `regtime` int(10) NOT NULL COMMENT '注册时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- 转存表中的数据 `t_user`
--

INSERT INTO `t_user` (`id`, `username`, `password`, `email`, `token`, `token_exptime`, `status`, `regtime`) VALUES
(14, 'ding', 'e10adc3949ba59abbe56e057f20f883e', 'dxdwrdh@163.com', 'd60e4b1a1b8b396f989c753b1108ee6b', 1460619066, 1, 1460532666),
(15, 'dingzhe', 'e10adc3949ba59abbe56e057f20f883e', 'dxdwrdh@163.com', '703699e95612d3ef82bbdb2367bb92bb', 1460619121, 0, 1460532721);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userid` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `username` varchar(20) NOT NULL COMMENT '用户名',
  `sex` varchar(5) NOT NULL COMMENT '性别',
  `headimage` varchar(60) NOT NULL COMMENT '头像URL',
  `password` varchar(80) NOT NULL COMMENT '密码',
  `phone` varchar(11) NOT NULL COMMENT '手机号',
  `email` varchar(30) NOT NULL COMMENT '邮箱',
  `about` varchar(300) NOT NULL COMMENT '个人简介',
  `sign` varchar(80) NOT NULL,
  `token` varchar(80) NOT NULL COMMENT '账户激活码',
  `token_exptime` int(10) NOT NULL COMMENT '激活码有效时间',
  `status` tinyint(1) NOT NULL COMMENT '是否激活',
  `tokentime` varchar(20) NOT NULL,
  `regtime` int(10) NOT NULL COMMENT '注册时间',
  PRIMARY KEY (`userid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`userid`, `username`, `sex`, `headimage`, `password`, `phone`, `email`, `about`, `sign`, `token`, `token_exptime`, `status`, `tokentime`, `regtime`) VALUES
(1, '丁哲', '', '', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '0c144b82302c57e0c4ea45ecd0c041ff', '17481d7f9b0357cc89cf7469d49f269a', 0, 0, '1451469430', 0),
(2, 'dingzhe', '', '', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '17b4ef4a94694608e3ab3cb064beaa16', 'cb1553c8ad16ddea871d63648400a687', 0, 0, '1451469440', 0),
(3, 'dingzh', '', 'http://114.215.152.69/images/headimage-dingzh-1462446998.png', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', 'ef7c97ceb1f08ac71f9bbdccee407c2e', '0dc2979b4aaf4b7b2cd6e2791ae3a918', 0, 0, '1451469445', 0),
(4, 'dingz', '', '', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', 'de78d5af3689e865e58ea81ea4674eb0', 'fa560de4381aea856f9cf15cd224b201', 0, 0, '1451469447', 0),
(5, 'ding', '', '', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', 'd14e8c4fc2720b3aa68ebcaa086c5d54', '37c3f36cec1b045a4a0ee85e0690c7a8', 0, 0, '1451469451', 0),
(6, 'din', '', '', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '3fe04fe9c280df47ea49038b6754010e', '58de071977f5c45b92d004ed6119609c', 0, 0, '1451469454', 0),
(7, 'di', '', '', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', 'e822a2c8d3f88c9f24590b4622d42426', '4eba608662097e64b0c75344ea55da08', 0, 0, '1451469457', 0),
(8, 'd', '', '', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '7cfd879d4990adc6f4c0200284822916', 'ecfbff475b261d11bd5c75d07589e3fc', 0, 0, '1451469459', 0),
(9, 'dz', '男', 'http://114.215.152.69/images/icon-dz-1463150985.jpg', 'e10adc3949ba59abbe56e057f20f883e', '158399253', '', 'dingzheqqqqq', '9760321e35b66bf7b1ac8122bd16802a', '99047bd679be73644b436e9c8663311e', 0, 0, '1451469464', 0),
(10, '丁', '', '', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '4f7fbadce62eb68a624893b243ac0f38', 'e14169a7861b1ec2b1fbc0f327def952', 0, 0, '1451896891', 0),
(11, 'dddd', '', '', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', 'b853d06ae06f8c68696d0a1b5f668d1b', 'af261b6b2a0aca9ea55a0487e2e8f94a', 0, 0, '1451897160', 0),
(12, 'dingzero', '', '', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', 'b9f8465a139e83989fa0ec0547019cd4', '8f9397ce3a430698e070643427fae538', 0, 0, '1452331023', 0),
(13, '1111', '', '', 'e10adc3949ba59abbe56e057f20f883e', '', '1111', '', '29dc58f2cff74fa25c9804bc4d9f99a1', '386cb0d2d6b6771e997d624a85836856', 0, 0, '1463145543', 0),
(14, '2222', '', '', 'e10adc3949ba59abbe56e057f20f883e', '', '2222', '', 'e4190ab1a23c6d8717748f4ab9d88028', 'd6ee130e1cfabb9fd3a88a1125bd23b5', 0, 0, '1463145916', 0),
(15, '333', '', '', 'e10adc3949ba59abbe56e057f20f883e', '', '333', '', '5bb889aec08f4e10afe3692ccf276ebf', '4c98c1871c7e39ec58cf9d9e73926a89', 0, 0, '1463145953', 0),
(16, '4444', '', 'http://114.215.152.69/images/icon-4444-1463145998.jpg', 'e10adc3949ba59abbe56e057f20f883e', '', '4444', '', 'd646c406eea681e9d5c84d00c10a5d1d', '508a86c31ad1e24296d641f966bd7af4', 0, 0, '1463145967', 0),
(17, '123456', '', 'http://114.215.152.69/images/icon-123456-1463151055.jpg', 'e10adc3949ba59abbe56e057f20f883e', '', '123456', '', 'c72cb9dd7b82fb8a381db4c380274de3', 'c0f82c42e8c69f001676da7a91f71948', 0, 0, '1463151039', 0),
(18, '123456789@qq.com', '', '', '25f9e794323b453885f5181f1b624d0b', '', '123456789@qq.com', '', '255c12a854207fbeda8550ece0b7b9c1', 'f6ed283a8ad56c8f779b58ce68cd344b', 0, 0, '1467189378', 0),
(19, '11111', '', 'http://114.215.152.69/images/icon-11111-1467189559.jpg', 'b0baee9d279d34fa1dfd71aadb908c3f', '', '11111', '', '7119f54327ef23ee747f9ce7e42188c8', 'fac555ffed05f9d9fb9f42036c2b0a24', 0, 0, '1467189434', 0);

-- --------------------------------------------------------

--
-- 表的结构 `weekly`
--

CREATE TABLE IF NOT EXISTS `weekly` (
  `weeklyid` int(11) NOT NULL AUTO_INCREMENT COMMENT '周报id',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `title` varchar(100) NOT NULL COMMENT '标题',
  `content` text NOT NULL COMMENT '正文内容',
  `createtime` varchar(10) NOT NULL COMMENT '创建时间',
  `updatetime` varchar(10) NOT NULL COMMENT '更新时间',
  `isblog` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1为博客2为笔记',
  `blogurl` varchar(50) NOT NULL COMMENT '博客地址',
  `dateline` varchar(10) NOT NULL,
  `private` tinyint(1) DEFAULT '1',
  `groupid` int(11) NOT NULL DEFAULT '1' COMMENT '笔记本id',
  PRIMARY KEY (`weeklyid`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=102 ;

--
-- 转存表中的数据 `weekly`
--

INSERT INTO `weekly` (`weeklyid`, `uid`, `title`, `content`, `createtime`, `updatetime`, `isblog`, `blogurl`, `dateline`, `private`, `groupid`) VALUES
(1, 2, 'idea', '1.一个idea；  （想法）\r\n2.产品经理根据idea，分析用户画像，将需求具体话；（需求文档）\r\n3.产品经理在白板上，画出产品的具体交互流程，然后用axure设计出具体的交互原型；（白板交互原型，交互原型文档）\r\n4.UI 设计根据原型文档，设计出具体应用每个页面的UI，使用工具有Ps，Ai，Sketch；（app每个页面的UI图加标注（markman），及应用中需要的切图）；\r\n5.客户端工程师根据，UI及交互原型，完成产品的编码；（客户端应用）\r\n6.后端工程师根据需要文档，设计与实现server。（Server）', '', '', 1, 'http://114.215.152.69/php/blog/blog.php?id=1', '2016', 1, 0),
(2, 2, '测试', 'bbbbbbb', '', '', 2, '', '32767', 1, 0),
(3, 2, 'MySQL学习', '如果上一查询没有产生 AUTO_INCREMENT 的值，则 mysql_insert_id() 返回 0。如果需要保存该值以后使用，要确保在产生了值的查询之后立即调用 mysql_insert_id()。   ', '', '', 1, 'http://114.215.152.69/php/blog/blog.php?id=3', '1462689741', 0, 0),
(4, 2, '控制器view的生命周期', '控制器view的生命周期：viewDidLoad -> viewWillAppear -> viewWillLayoutSubviews -> viewDidLayoutSubviews\n-> viewDidAppear -> viewWillDisappear -> viewDidDisappear', '', '', 2, '', '32767', 1, 0),
(5, 9, 'dz的周报', '浏览器和服务器都在使用 TCP/IP\n因特网浏览器和因特网服务器均使用 TCP/IP 来连接因特网。浏览器使用 TCP/IP 来访问因特网服务器，服务器使用 TCP/IP 向浏览器传回 HTML。aaaaa', '', '', 1, 'http://114.215.152.69/php/blog/blog.php?id=5', '1463150499', 0, 4),
(6, 9, 'dz的周报2', '据 Adobe 官方博客，这款工具在 2015 年初就提出，现在处于内测完善阶段。这是一款面向于 UX 设计师的专用工具，项目代号是 Project Comet，预计在 2016 年会推出两个公测版本，上半年版本包含核心功能，下半年将根据用户反馈继续完善，并添加众多高级功能', '', '', 1, 'http://114.215.152.69/php/blog/blog.php?id=6', '1463118754', 0, 0),
(7, 1, '丁哲的周报', '专注于设计和布局功能，包括绘图、编辑形状和路劲、编辑文字、添加渐变和阴影等', '', '', 1, 'http://114.215.152.69/php/blog/blog.php?id=7', '1462689788', 0, 0),
(8, 9, '数据传递的几种方式', '1. 线程\n2. block\n3. KVO\n4. 通知\n5. 代理', '', '', 1, 'http://114.215.152.69/php/blog/blog.php?id=8', '1462691698', 0, 13),
(88, 9, 'iOS 关键字', '1. description  描述，描写；类型；说明书\n2. Key-Value Observing(观察的；注意的；观察力敏锐的) KVO\n3. assign  分配；指派；[计][数] 赋值', '', '', 1, 'http://114.215.152.69/php/blog/blog.php?id=88', '1463120095', 0, 0),
(89, 9, 'Reveal 使用', '1.  vim ~/.lldbinit\n2.  添加\n```\ncommand alias reveal_load expr (Class)NSClassFromString(@"IBARevealLoader") == nil ? (void *)dlopen("/Applications/Reveal.app/Contents/SharedSupport/iOS-Libraries/libReveal.dylib", 0x2) : ((void*)0)\n\ncommand alias reveal_start expr (void)[(NSNotificationCenter*)[NSNotificationCenter defaultCenter] postNotificationName:@"IBARevealRequestStart" object:nil];\n```\n\n3.暂停项目，lldb输入 reveal_load,reveal_start\n\n\n4.破解 \nrm ~/Library/Preferences/com.ittybittyapps.Reveal.plist', '', '', 1, 'http://114.215.152.69/php/blog/blog.php?id=89', '32767', 0, 0),
(90, 9, 'Swagger', '# [Swagger](https://github.com/swagger-api)\n\n  Swagger是公司iOS项目中用到的另一个框架，这是个啥东西，说实话，刚开始的时候，swagger在国内能找到的中文资料，少的可怕，现在博客多了起来，甚至有分享的视频。\n\n  * [swagger ui教程，API文档生成神器]( http://blog.didibird.com/2015/06/23/swagger-ui-tutorials-api-documentation-generation-artifact/)\n  * [通过Swagger进行API设计，与Tony Tam的一次对话](http://www.infoq.com/cn/articles/swagger-interview-tony-tam)\n  * 视频：GitCafe技术负责人吴江分享的[开发实践：使用Swagger快速打造REST API文档](http://www.infoq.com/cn/presentations/use-swagger-create-rest-api-document)，目前能见到的已经公开应用的国内公司，我知道也就[GitCafe](https://api.gitcafe.com/apidoc/)\n\nSwagger是一种和语言无关的规范和框架，用于定义服务接口，主要用于描述 RESTful的API。它专注于为API创建优秀的文档和客户端库。\n\n\n  简单来说，就是写接口文档的，不过就是能够交互测试文档。\n  <br />\n  ![](http://114.215.152.69/images/headimage-dingzh-1462446998.png)\n  一般的打开方式也就是服务器工程师，拿来写接口的文档，但是它的野心并不仅仅于此，而且写文档仅仅是比较基本的打开方式。我总结的打开方式有三种：\n  1. 你是写服务器的，那可以引入swagger，通过代码注释，生成一份交互式文档。（like：[swagger-php](https://github.com/zircote/swagger-php)）\n  2. 你是客户端开发工程师，可以根据已有的接口文档，写swagger.yaml，通过swagger-codegen，生成客户端SDK,将会省你很大的功夫去一个一个的写接口，写类。但是学习成本较高。\n\n  ![](http://114.215.152.69/images/headimage-dingzh-1462446998.png)\n  3. 你是全栈，OK，你只需要在swagger.yaml中设计你的接口，然后swagger可以为你生成php或者JAVA的Restful API代码，也可以生成iOS，Android，Qt等各种客户端代码。\n\n  ![](http://114.215.152.69/images/headimage-dingzh-1462446998.png)\n  公司的项目用的是第二种，用[Swagger-editor](http://editor.swagger.io/)编写接口描述文件,类似于这样', '', '', 1, 'http://114.215.152.69/php/blog/blog.php?id=90', '1463118740', 0, 0),
(91, 9, 'Offscreen Render 离屏渲染', '1) drawRect\n2) layer.shouldRasterize = true;\n3) 有mask或者是阴影(layer.masksToBounds, layer.shadow*)；\n4）Text（UILabel, CATextLayer, Core Text, etc）', '', '', 1, 'http://114.215.152.69/php/blog/blog.php?id=91', '32767', 0, 0),
(92, 9, 'iOS 设计模式', '1.编码是门艺术\n>1.设计模式降低维护难度\n2.为解决大型项目遇到的特定存在的问题；适配器模式--接口适配\n3.学习设计模式的必要性--轻松开发大型项目；知道面向对象语言的三种特性（封装，继承，多态）\n4.\n\n2.设计模式的基本原则\n>1.开闭原则--一个模块的修改，应该对扩展开放，对修改关闭\n>>* （开闭原则的开放，对扩展开放）需要对一个在项目中已经用了很多的模块进行修改，不要对其修改，应该继承这个模块，然后扩展出需要的方法\n>>* （开闭原则的关闭，对修改关闭）不能对该基础模块进行修改，因为有可能会影响到使用它的其他组件 \n\n>2.理氏代换原则--子类，父类可以相互替换\n>>* 父类尽量提供完善的抽象接口，供子类重载使用\n\n>3.依赖倒转原则--抽象不依赖于细节，细节依赖于抽象\n>>* 不要把不相关的接口暴露出去，破坏封装性；\n\n>4.接口隔离原则--接口只做必要的事情\n>>* 尽量确保接口只做必要的事情\n\n>5.合成/聚合与复用--从一个类扩展出一个方法，尽量不用继承，把这个类当做一个组件\n>>* 新建一个容器，在这个容器内，把这个类当成一个组件添加进去，然后在容器内进行扩展\n\n\n3.设计模式的类型\n>1.gof（Gang Of Four） patterns 四个人写的设计模式；\n2.并发设计模式，线程相关的设计模式；\n3.框架级设计模式，MVC，MVVM；\n\n4.设计模式的功能\n>1.对象创建\n2.接口适配  设计模式\n3.对象去耦  观察者\n4.抽象集合  组合模式\n5.行为扩展  访问者\n6.算法封装  策略模式\n7.对象访问  代理模式\n8.对象状态  备忘录\n\n', '', '', 1, 'http://114.215.152.69/php/blog/blog.php?id=92', '32767', 0, 0),
(93, 9, 'Html + CSS 笔记', '#html\n`<html>` 根标签\n\n`<head>`标签用于定义文档的头部，它是所有头部元素的容器。头部元素有`<title>`、`<script>`、 `<style>`、`<link>`、`<meta>`等标签;\n\n\n`<title>`标签之间的文字内容是网页的标题信息，它会出现在浏览器的标题栏中。网页的title标签用于告诉用户和搜索引擎这个网页的主要内容是什么，搜索引擎可以通过网页标题，迅速的判断出网页的主题。每个网页的内容都是不同的，每个网页都应该有一个独一无二的title。\n\n`<meta>`  `<meta charset="UTF-8">`\n\n`<link>`\n\n`<body>`标签之间的内容是网页的主要内容，如`<h1>`、`<p>`、`<a>`、`<img>`等网页内容标签，在这里的标签中的内容会在浏览器中显示出来;\n\n`<p>`段落\n`<hx>`标题\n`<strong>`,`<em> 加粗，斜体`\n`<span>`标签是没有语义的，它的作用就是为了设置单独的样式用的\n`<blockquote>`作用也是引用别人的文本。但它是对长文本的引用;\n`<q>`引用的文本不用加双引号，浏览器会对q标签自动添加双引号;\n`&nbsp 空格`\n`<hr>`分隔线\n`<address>`这些联系地址信息如公司的地址就可以`<address>`标签。也可以定义一个地址（比如电子邮件地址）、签名或者文档的作者身份;\n`<code>`编程代码，当代码为一行代码时，可以使用`<code>`标签;\n\n`<pre>`标签不只是为显示计算机的源代码时用的，在你需要在网页中预显示格式时都可以使用它，只是`<pre>`标签的一个常见应用就是用来展示计算机的源代码。`\n\n`<ul> <li>`ul-li是没有前后顺序的信息列表,ul-li在网页中显示的默认样式一般为：每项li前都自带一个圆点;\n\n`<ol> <li>`有序列表;\n\n`<div>`标签的作用就相当于一个容器', '', '', 1, 'http://114.215.152.69/php/blog/blog.php?id=93', '1462618176', 0, 0),
(94, 9, '新插入一条数据', 'INSERT INTO users_roles\r\n\r\n(userid, roleid)\r\n\r\nSELECT ''userid_x'', ''roleid_x''\r\n\r\nFROM dual\r\n\r\nWHERE NOT EXISTS (\r\n\r\n　　SELECT * FROM users_roles\r\n\r\n　　WHERE userid = ''userid_x''\r\n\r\n　　AND roleid = ''roleid_x''\r\n\r\n);', '', '', 2, '', '', 1, 1),
(96, 9, '2016-05-12[08:41:01]', '512', '', '', 2, '', '1463013661', 0, 1),
(97, 12, '2016-05-13[12:57:37]', '这是一篇笔记', '', '', 2, '', '1463115458', 0, 1),
(98, 9, '2016-05-13[10:38:38]', 'Aaaaaaasasasasas', '', '', 2, '', '1463150318', 0, 1),
(99, 19, '2016-06-29[04:38:04]', 'Dddddd', '', '', 2, '', '1467189484', 0, 1),
(100, 19, '2016-06-29[04:38:12]', 'Dddddd', '', '', 2, '', '1467189493', 0, 1),
(101, 19, '2016-06-29[04:38:16]', 'Dddddd', '', '', 2, '', '1467189497', 0, 1);

--
-- 限制导出的表
--

--
-- 限制表 `favoriteblog`
--
ALTER TABLE `favoriteblog`
  ADD CONSTRAINT `favoriteblog_userid` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);

--
-- 限制表 `weekly`
--
ALTER TABLE `weekly`
  ADD CONSTRAINT `weekly_userid` FOREIGN KEY (`uid`) REFERENCES `user` (`userid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
