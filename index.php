<?php

/*用户登录机制
1.用户登录成功后，将返回的token，userid存储起来；
2.发起post请求时，先将要post的数据URL处理，然后加上apikey，md5加密得到sign，举例：
app=Android
userid=1000
time=1451457869
apikey=34aa6d6d2daab410b98b1a752a96d460

URL处理：
app=Android&userid=1000&time=1451457869
拼接token：
app=Android&userid=1000&time=145145786934aa6d6d2daab410b98b1a752a96d460
md5加密
sign=md5(app=Android&userid=1000&time=145145786934aa6d6d2daab410b98b1a752a96d460)

比如sign=145145786934aa6d6d2daab410b98b1a752a96d460
那么post 的body 就是
app=Android&userid=1000&time=1451457869sign=145145786934aa6d6d2daab410b98b1a752a96d460

*/
/*数据库表关系
CREATE TABLE `user` (
	`userid` int(11) NOT NULL auto_increment,
    `username` VARCHAR(20) UNIQUE NOT NULL,
    `password` VARCHAR(80) NOT NULL,
    `sign` VARCHAR(80) NOT NULL,
    `token` VARCHAR(80) NOT NULL,
    `tokentime` VARCHAR(20) NOT NULL,
	PRIMARY KEY  (`userid`)
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `weekly` (
 `weeklyid` INT  AUTO_INCREMENT,
    `uid` int(11) NOT NULL,
    `title` VARCHAR(100) NOT NULL,
    `content` TEXT NOT NULL,
    `dateline` SMALLINT NOT NULL,
    PRIMARY KEY (  `weeklyid` ) ,
 	KEY `uid` (`uid`),
  CONSTRAINT `weekly_userid` FOREIGN KEY (`uid`) REFERENCES `user` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

*/




require_once('connect.php');
error_reporting(~0);
// ini_set('display_errors', 1);//代码中打开错误提示
// echo substr(sprintf('%o', fileperms('./')),-4);

//index.php?PATH_INFO=$1 PATH_INFO区分不同接口
$pathinfo = explode('/',$_GET['PATH_INFO']);//接口
$api = $pathinfo[0];
	$json_string = $GLOBALS['HTTP_RAW_POST_DATA'];//如果post来的数据为json格式，则$GLOBALS['HTTP_RAW_POST_DATA'];按字符串获取
 	if(ini_get("magic_quotes_gpc")=="1")
 	{
  		$json_string=stripslashes($json_string);//返回一个去除转义反斜线后的字符串（\' 转换为 ' 等等）
 	}
 	$user = json_decode($json_string);//对json解码
 	$post = array();
 	if (empty($_POST)) {//application/x-www.form-urlencoded 如果该格式的数据为空，即post上来的数据不是URL格式的
 		$post = $user;
 	}else{
 		$post = $_POST;
 	}

	$appkey = md5('NoteBook.nyiststudio.com');//key
	//479e32249a65c4f7b45e11254097c844
	if ($api&&$api==="urldemo") {//按id得到文章
		$app = 'Android';
		$time = time();//秒
		$userid = 1;
		$url = array();
		if(empty($pathinfo[1])){
			$url=array("app"=>$app,"time"=>$time,"userid"=>$userid,'appkey'=>$appkey);
		}else{
			$url = array("app"=>$app,"time"=>$time,"userid"=>$userid,'appkey'=>$appkey,$pathinfo[1] => $pathinfo[2]);
		}
		ksort($url);//排序
		$urlStr = http_build_query($url);//转成url
		$sign = md5($urlStr.$appkey);//加盐获取前门
		$url['sign'] = $sign;
		ksort($url);
		$lastUrl = http_build_query($url);
		message('url',200,$lastUrl);
	}elseif ($api&&$api==="key") {
		message('key',200,$appkey);
	}elseif ($api&&$api==="makeurl") {
		$appkey = md5('NoteBook.nyiststudio.com');
		//479e32249a65c4f7b45e11254097c844
		// $array = $post;
		$array = array();
		foreach($post as $key=>$value) {
  			$array[$key] = $time = isempty($value,$key);
		}
		ksort($array);
		$urlStr = http_build_query($array);
		$sign = md5($urlStr.$appkey);
		$array['sign'] = $sign;
		ksort($array);
		$lastUrl = http_build_query($array);
		message('url',200,$lastUrl);
	}elseif ($api&&$api==="makejson") {
		// $post = $_POST;
		$appkey = md5('NoteBook.nyiststudio.com');

		$array = array();

		foreach($post as $key=>$value) {
			if ($key != 'sign') {
  			// $ary[$key] = $value;
  				$array[$key] = $time = isempty($value,$key);
			}
		}

		$array['time'] = time();
		ksort($array);
		$urlStr = http_build_query($array);
		$sign = md5($urlStr.$appkey);
		$array['sign'] = $sign;
		
		// $array['md5'] = $sign.'***'.$urlStr.$appkey;
		ksort($array);

		//$lastUrl = http_build_query($array);
		bejson($array);
	}elseif ($api&&$api==="signupbyemail") {
		$array = array();

		foreach($post as $key=>$value) {
  			$array[$key] = $time = isempty($value,$key);
		}
		checkingSign($array);//验证签名和时间戳
		// $josn = json_encode($array);
		// message(json_encode($array),200,$array);
		//TODO


		signupbyemail($array);
	}elseif ($api&&$api==="favoriteblog") {
		$array = array();

		foreach($post as $key=>$value) {
  			$array[$key] = $time = isempty($value,$key);
		}
		// checkingSign($array);//验证签名和时间戳
		favoriteblog($array);
	}elseif ($api&&$api==="alreadyfavoriteblog") {
		$array = array();

		foreach($post as $key=>$value) {
  			$array[$key] = $time = isempty($value,$key);
		}
		// checkingSign($array);//验证签名和时间戳
		alreadyfavoriteblog($array);
	}elseif ($api&&$api==="favoritebloglist") {
		$array = array();

		foreach($post as $key=>$value) {
  			$array[$key] = $time = isempty($value,$key);
		}
		// checkingSign($array);//验证签名和时间戳
		favoritebloglist($array);
	}elseif ($api&&$api==="isblog") {//设置博客状态
		$array = array();

		foreach($post as $key=>$value) {
  			$array[$key] = $time = isempty($value,$key);
		}
		// checkingSign($array);//验证签名和时间戳
		isblog($array);//
	}elseif ($api&&$api==="mybloglist") {//设置博客状态
		$array = array();

		foreach($post as $key=>$value) {
  			$array[$key] = $time = isempty($value,$key);
		}
		// checkingSign($array);//验证签名和时间戳
		mybloglist($array);//
	}elseif ($api&&$api==="notegroup") {//设置博客所属组
		$array = array();

		foreach($post as $key=>$value) {
  			$array[$key] = $time = isempty($value,$key);
		}
		// checkingSign($array);//验证签名和时间戳
		notegroup($array);//
	}elseif ($api&&$api==="notegroupnamebyid") {//通过博客id得到博客名称
		$array = array();

		foreach($post as $key=>$value) {
  			$array[$key] = $time = isempty($value,$key);
		}
		// checkingSign($array);//验证签名和时间戳
		notegroupnamebyid($array);//
	}elseif ($api&&$api==="notegrouplist") {//笔记本列表
		$array = array();

		foreach($post as $key=>$value) {
  			$array[$key] = $time = isempty($value,$key);
		}
		// checkingSign($array);//验证签名和时间戳
		notegrouplist($array);//
	}elseif ($api&&$api==="addnotegroup") {//添加笔记本
		$array = array();

		foreach($post as $key=>$value) {
  			$array[$key] = $time = isempty($value,$key);
		}
		// checkingSign($array);//验证签名和时间戳
		// notegroup($array);//
		addnotegroup($array);
	}elseif ($api&&$api==="userinfo") {//得到用户信息
		$array = array();

		foreach($post as $key=>$value) {
  			$array[$key] = $time = isempty($value,$key);
		}
		// checkingSign($array);//验证签名和时间戳
		userinfo($array);
	}elseif ($api&&$api==="updateuserinfo") {//更新用户信息
		$array = array();

		foreach($post as $key=>$value) {
  			$array[$key] = $time = isempty($value,$key);
		}
		// checkingSign($array);//验证签名和时间戳
		updateuserinfo($array);
	}elseif ($api&&$api==="uploadfile") {
		$array = array();

		foreach($post as $key=>$value) {
  			$array[$key] = $time = isempty($value,$key);
		}
		
		$sql = sprintf("SELECT username FROM  `user` WHERE  `userid` = %s;",mysql_real_escape_string($array['uid']));
		$query = mysql_query($sql);
		$row = mysql_fetch_row($query);
		$username = $row[0];
		// $num = mysql_num_rows($query);
		if(empty($username)){
			message("上传失败！".$sql,401,NULL);
			die();
		}

		if ((($_FILES["file"]["type"] == "image/gif")
		|| ($_FILES["file"]["type"] == "image/jpeg")
		|| ($_FILES["file"]["type"] == "image/pjpeg")
		|| ($_FILES["file"]["type"] == "image/png"))
		&& ($_FILES["file"]["size"] < 2000000))
  		{
  			if ($_FILES["file"]["error"] > 0)
    		{
    			// echo  . "<br />";
    			message("Return Code: " . $_FILES["file"]["error"],402);
    		}
  			else
    		{
    			// message('文件信息',402,);

    			// echo "Upload: " . $_FILES["file"]["name"] . "<br />";
    			// echo "Type: " . $_FILES["file"]["type"] . "<br />";
    			// echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    			// echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
    			$uploaddir = '/var/www/html/images/';
    			$baseUrl = "http://".$_SERVER['SERVER_ADDR']."/images/";
    			$baseimageName = $array['type']."-".$username."-".time().strrchr($_FILES["file"]["name"], ".");
    			$headimageUrl = $baseUrl.$baseimageName;
    			if (file_exists($uploaddir. $_FILES["file"]["name"]))
      			{
      				// echo $_FILES["file"]["name"] . " already exists. ";
      				message($_FILES["file"]["name"] . " already exists. ".$array['uid'],402,$_FILES["file"]);
      			}
    			else
      			{

      				if (move_uploaded_file($_FILES['file']['tmp_name'], $uploaddir.$baseimageName)) {
    					// echo "File is valid, and was successfully uploaded.\n";
    					// message($_SERVER['SERVER_ADDR'].$array['uid']."File is valid, and was successfully uploadedStored in: " . $uploaddir . $_FILES["file"]["name"],200,$baseUrl.$baseimageName);
    					$insertsql = sprintf("update user set headimage='%s'where userid='%s'",
		mysql_real_escape_string($headimageUrl),mysql_real_escape_string($array['uid']));

						if(mysql_query($insertsql)){
							$row = array('message' => $_SERVER['SERVER_ADDR'].$array['uid']."File is valid, and was successfully uploadedStored in: " . $uploaddir .$baseUrl.$baseimageName,'code' => 200,'url' => $headimageUrl);
							bejson($row);
						}else{
							$row = array('message' => $_SERVER['SERVER_ADDR'].$array['uid']."File is valid, and was successfully uploadedStored in: " . $uploaddir . $_FILES["file"]["name"],200,$baseUrl.$baseimageName,'code' => 400);
							bejson($row);
						}

					} else {
    					// echo "Possible file upload attack!\n";
    					message($_SERVER['SERVER_ADDR'].$array['uid']."Possible file upload attack!  Stored in: " . $uploaddir . $_FILES["file"]["name"],200,$_FILES["file"]);
					}

      				// move_uploaded_file($_FILES["file"]["tmp_name"],
      				// "upload/" . $_FILES["file"]["name"]);
      				// // echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
      				// message("Stored in: " . "upload/" . $_FILES["file"]["name"],402,$_FILES["file"]);
      			}
    		}
  		}
		else
  		{
  			// echo "Invalid file";
  			message("Invalid file",402);
  		}


		
		// checkingSign($array);//验证签名和时间戳
		// $josn = json_encode($array);
		// message(json_encode($array),200,$array);
		//TODO


		// uploadFile($array);
	}elseif ($api&&$api==="addweekly") {
		$array = array();
		foreach($post as $key=>$value) {
  			$array[$key] = $time = isempty($value,$key);
		}
		checkingSign($array);
		// $josn = json_encode($array);
		// message(json_encode($array),400,$array);
		addweekly($array);		
	}elseif ($api&&$api==="delweekly") {
		$array = array();
		foreach($post as $key=>$value) {
  			$array[$key] = $time = isempty($value,$key);
		}
		checkingSign($array);
		// $josn = json_encode($array);
		// message(json_encode($array),400,$array);
		delweekly($array);		
	}elseif ($api&&$api==="updateweekly") {
		$array = array();
		foreach($post as $key=>$value) {
  			$array[$key] = $time = isempty($value,$key);
		}
		// checkingSign($array);
		updateweekly($array);		
	}elseif ($api&&$api==="weeklylist") {
		$array = array();
		foreach($post as $key=>$value) {
  			$array[$key] = $time = isempty($value,$key);
		}
		// checkingSign($array);
		weekly($array);		
	}elseif ($api&&$api==="myweekly") {
		$array = array();
		foreach($post as $key=>$value) {
  			$array[$key] = $time = isempty($value,$key);
		}
		// checkingSign($array);
		myweekly($array);//		
	}elseif ($api&&$api==="weeklybyid") {
		$array = array();
		foreach($post as $key=>$value) {
  			$array[$key] = $time = isempty($value,$key);
		}
		// checkingSign($array);
		weeklybyid($array);//		
	}elseif ($api&&$api==="article") {//按id得到文章
		$id = $post['id'];
		if (!empty($id)) {
			articleById($id);
		}else{
			errorMessage('id 不能为空',401);
		}
	}elseif ($api&&$api==="allarticle") {//得到所有的文章
		getAllArticle();
	}elseif ($api&&$api==="idlist") {//得到文章id列表
		getIdList();
	}elseif ($api&&$api==="articlelist") {//得到文章列表
		getArticleList();
	}elseif ($api&&$api==="addarticle") {//添加文章
		addArticle($title,$author,$description,$content);
	}elseif ($api&&$api==="updatearticle") {//修改文章
		if (!empty($id)) {
			updatearticle($id,$title,$author,$description,$content);
		}else{
			errorMessage('id 不能为空',401);
		}
	}elseif ($api&&$api==="deletearticle") {//删除文章
		if (!empty($id)) {
			deleteArticle($id);
		}else{
			errorMessage('id 不能为空',401);
		}
	}elseif ($api&&$api==="signup") {//注册
		$array = array();
		foreach($post as $key=>$value) {
  			$array[$key] = isempty($value,$key);
		}
		checkingSign($array);
		if (!empty($array['username']) && !empty($array['password'])) {
			$user = getUserId($array['username']);
			if ($user === '') { //检查用户名是否已经注册
				signUp($array['username'],$array['password']);
			}else{
				message('注册失败! 用户名已存在',401);
			}
		}else{
			message('用户名和密码均不能为空',401);
		}
	}elseif ($api&&$api==="signin") {//登录
		$array = array();
		// message('登录失败!',403,$post);
		// bejson($post);
		foreach($post as $key=>$value) {
  			$array[$key] = isempty($value,$key);
		}
	
		checkingSign($array);
		if (!empty($array['username']) && !empty($array['password'])) {
			$user = getUserId($array['username']);
			if ($user === '') { //检查用户名是否已经注册
				message('登录失败!',403);//403 未注册
			}else{
				if(auth($user['userid'],$array['password']))
				{
					message('登录成功',200,$user);
				}else{
					message('登录失败!',402,$user);//402 密码不正确
				}
			}
			
		}else{
			message('用户名和密码均不能为空',401);
		}
	}else{
		message('api 参数错误',400);
	}

function checkingSign($array = array()){
	$ary = array();
	$appkey = md5('NoteBook.nyiststudio.com');
	//479e32249a65c4f7b45e11254097c844 
	foreach($array as $key=>$value) {
  		if ($key != 'sign') {
  			$ary[$key] = $value;
  		}
	}
	ksort($ary);
	$urlStr = http_build_query($ary);
	$sign = md5($urlStr.$appkey);
	if ($array['sign'] != $sign) {
		message('签名不正确',400,$sign.'****'.$urlStr.$appkey);
		die();
	}
	$time = time() - $array['time'];
	if ($time > 300) {//300秒5分钟
		message('签名已过时',400,$time);
		die();
	}
}

function userinfo($array = array()){
	$sql = sprintf("SELECT userid,username,sex,headimage,phone,email,about FROM user WHERE `userid` = '%s'",mysql_real_escape_string($array['uid']));
	$query = mysql_query($sql);
	if($query&&mysql_num_rows($query)){
		while ($row = mysql_fetch_assoc($query)) {
			$data[] = $row;
		}
	}else{
		$data = array();
	}
	message('个人信息'.$sql,200,$data);
	return $data;
}
function updateuserinfo($array = array()){
	$sql = sprintf("update user set username='%s',sex='%s',phone='%s',about='%s' where userid='%s';",
		mysql_real_escape_string($array['username']),mysql_real_escape_string($array['sex']),mysql_real_escape_string($array['phone']),mysql_real_escape_string($array['about']),mysql_real_escape_string($array['userid']));

	if(mysql_query($sql)){
		// $row = array('message' => "修改用户信息成功!",'errorCode' => 0);
		// $data = userinfo($array);
		$sql = sprintf("SELECT userid,username,sex,headimage,phone,email,about FROM user WHERE `userid` = '%s'",mysql_real_escape_string($array['userid']));
		$query = mysql_query($sql);
		if($query&&mysql_num_rows($query)){
			while ($row = mysql_fetch_assoc($query)) {
				$data[] = $row;
			}
		}else{
			$data = array();
		}
		message('修改用户信息成功'.$sql,200,$data);
	}else{
		$row = array('message' => "修改用户信息成功!",'errorCode' => 400);
		message('修改用户信息失败'.$sql,201,$row);
	}
}


function alreadyfavoriteblog($array = array()){//判断博客是否已经收藏
	$sql = sprintf("SELECT * FROM favoriteblog WHERE `userid` = '%s' AND `weeklyid` = '%s' ;",mysql_real_escape_string($array['uid']),mysql_real_escape_string($array['weeklyid']));
	$query = mysql_query($sql);
	if($query&&mysql_num_rows($query)){
		while ($row = mysql_fetch_assoc($query)) {
			$data[] = $row;
		}
		message('博客已收藏过',200,array('already' => "isalready"));
	}else{
		$data = array();
		message('博客未收藏',200,array('already' => "noalready"));
	}
}



function favoriteblog($array = array()){//收藏博客
/**
INSERT INTO favoriteblog (userid, weeklyid) SELECT `userid`,`weeklyid` FROM dual WHERE NOT EXISTS ( SELECT * FROM favoriteblog WHERE userid = 9 AND weeklyid = 7);
**/
	$sql = sprintf("SELECT * FROM favoriteblog WHERE `userid` = '%s' AND `weeklyid` = '%s' ;",mysql_real_escape_string($array['uid']),mysql_real_escape_string($array['weeklyid']));
	$query = mysql_query($sql);
	if($query&&mysql_num_rows($query)){
		while ($row = mysql_fetch_assoc($query)) {
			$data[] = $row;
		}
		$ary = array('already' => "isalready");

		message('博客已收藏过',200);
	}else{
		$insertsql = sprintf("INSERT into favoriteblog(userid,weeklyid) values('%s','%s')",mysql_real_escape_string($array['uid']),mysql_real_escape_string($array['weeklyid']));
		if(mysql_query($insertsql)){
			// message('收藏成功!',200,mysql_insert_id());
			$ary = array('already' => "isalready");
			message('收藏成功!',200);
		}else{
			message('收藏失败!',400);
		}
	}
}
function favoritebloglist($array = array()){//收藏博客列表
	//SELECT * FROM weekly WHERE weeklyid IN ( SELECT  `weeklyid` FROM  `favoriteblog` WHERE  `userid` =9)LIMIT 0 , 30
	// $size = empty($array('size')) ? $array('size') : 30;
	$size = 30;
	$pagenum = 0;
	if(!empty($array['size'])){
        $size = $array['size'];
    }
    if (!empty($array['pagenum'])) {
    	$pagenum = $array['pagenum'];
    }
    // SELECT info.user.username, info.weekly. * FROM  `weekly` ,  `user` WHERE info.weekly.uid = info.user.userid AND info.weekly.isblog = 1;
	$sql = sprintf("SELECT info.user.username, info.weekly. * FROM `weekly` ,  `user` WHERE info.weekly.uid = info.user.userid AND info.weekly.weeklyid IN ( SELECT  `weeklyid` FROM  `favoriteblog` WHERE  `userid` ='%s')LIMIT  %d , %d;",mysql_real_escape_string($array['uid']),$pagenum,$size);
	$query = mysql_query($sql);
	if($query&&mysql_num_rows($query)){
		while ($row = mysql_fetch_assoc($query)) {
			$data[] = $row;
		}
	}else{
		$data = array();
	}
	// message('用户博客收藏列表'.$size."pagenum".$pagenum.$sql.,200,$data);
	message('用户博客收藏列表'.$size.'pagenum'.$pagenum.$sql,200,$data);
	return $row;
}


function isblog($array = array()){//设置笔记为博客
	// $dateline = time();
	$blogurl = '';
	if ($array['isblog'] == 1) {
		$blogurl = sprintf("http://114.215.152.69/php/blog/blog.php?id=%d",mysql_real_escape_string($array['weeklyid']));
	}
	$sql = sprintf("update weekly set isblog='%s',blogurl='%s' where uid='%s' AND weeklyid='%s';",
		mysql_real_escape_string($array['isblog']),$blogurl,mysql_real_escape_string($array['uid']),mysql_real_escape_string($array['weeklyid']));

	if(mysql_query($sql)){
		$row = array('message' => "设置博客成功!",'errorCode' => 0);
		message('设置博客成功'.$sql,200,$row);
	}else{
		$row = array('message' => "设置博客失败!",'errorCode' => 400);
		message('设置博客失败'.$sql,200,$row);
	}
}
function mybloglist($array = array()){//我的博客列表
	//SELECT * FROM weekly WHERE weeklyid IN ( SELECT  `weeklyid` FROM  `favoriteblog` WHERE  `userid` =9)LIMIT 0 , 30
	// $size = empty($array('size')) ? $array('size') : 30;
	$size = 30;
	$pagenum = 0;
	if(!empty($array['size'])){
        $size = $array['size'];
    }
    if (!empty($array['pagenum'])) {
    	$pagenum = $array['pagenum'];
    }
    // SELECT info.user.username, info.weekly. * FROM  `weekly` ,  `user` WHERE info.weekly.uid = info.user.userid AND info.weekly.isblog = 1;
	$sql = sprintf("SELECT * FROM  `weekly` WHERE  `uid` = %s AND `isblog` = 1 LIMIT  %d , %d;",mysql_real_escape_string($array['uid']),$pagenum,$size);
	$query = mysql_query($sql);
	if($query&&mysql_num_rows($query)){
		while ($row = mysql_fetch_assoc($query)) {
			$data[] = $row;
		}
	}else{
		$data = array();
	}
	// $row = array('list' => $data);
	// message('用户博客收藏列表'.$size."pagenum".$pagenum.$sql.,200,$data);
	message('我的博客列表'.$size.'pagenum'.$pagenum.$sql,200,$data);
	return $row;
}




function notegroup($array = array()){//设置笔记分组
	$sql = sprintf("update weekly set groupid='%s' where uid='%s' AND weeklyid='%s';",
		mysql_real_escape_string($array['groupid']),mysql_real_escape_string($array['uid']),mysql_real_escape_string($array['weeklyid']));

	if(mysql_query($sql)){
		$row = array('message' => "设置博客成功!",'errorCode' => 0);
		message('设置博客成功'.$sql,200,$row);
	}else{
		$row = array('message' => "设置博客失败!",'errorCode' => 400);
		message('设置博客失败'.$sql,200,$row);
	}
}
function notegroupnamebyid($array = array()){//通过博客id得到博客名称
/**
INSERT INTO favoriteblog (userid, weeklyid) SELECT `userid`,`weeklyid` FROM dual WHERE NOT EXISTS ( SELECT * FROM favoriteblog WHERE userid = 9 AND weeklyid = 7);
**/
	$sql = sprintf("SELECT * FROM notegroup WHERE `userid` = '%s' AND `groupid` = '%s' ;",mysql_real_escape_string($array['uid']),mysql_real_escape_string($array['groupid']));
	$query = mysql_query($sql);
	if($query&&mysql_num_rows($query)){
		while ($row = mysql_fetch_assoc($query)) {
			$data[] = $row;
		}
		// message('博客已收藏过',200,array('already' => "isalready"));
	}else{
		$data = array();
	}
	message('笔记本名称'.$sql,200,$data);
}

function notegrouplist($array = array()){//笔记本列表

	$size = 30;
	$pagenum = 0;
	if(!empty($array['size'])){
        $size = $array['size'];
    }
    if (!empty($array['pagenum'])) {
    	$pagenum = $array['pagenum'];
    }

	$sql = sprintf("SELECT * FROM notegroup WHERE `userid` = '%s' LIMIT  %d , %d;",mysql_real_escape_string($array['uid']),$pagenum,$size);
	$query = mysql_query($sql);
	if($query&&mysql_num_rows($query)){
		while ($row = mysql_fetch_assoc($query)) {
			$data[] = $row;
		}
	}else{
		$data = array();
	}
	// message('用户博客收藏列表'.$size."pagenum".$pagenum.$sql.,200,$data);
	message('笔记本列表'.$size.'pagenum'.$pagenum.$sql,200,$data);
}
function addnotegroup($array = array()){//新添笔记本
// INSERT INTO notegroup (userid, groupname) SELECT 9,"work" FROM dual WHERE NOT EXISTS ( SELECT * FROM notegroup WHERE userid = 9 AND groupname = "work");

	$insertsql = sprintf("INSERT INTO notegroup (userid, groupname) SELECT %d,'%s' FROM dual WHERE NOT EXISTS ( SELECT * FROM notegroup WHERE userid = %d AND groupname = '%s');",mysql_real_escape_string($array['uid']),mysql_real_escape_string($array['groupname']),mysql_real_escape_string($array['uid']),mysql_real_escape_string($array['groupname']));
	if(mysql_query($insertsql)){
		message('添加笔记本成功!',200,mysql_insert_id());
	}else{
		message('添加笔记本失败!'.var_dump($array),400);
	}
}
function weekly($array = array())//查看公有周报
{
	//SELECT * FROM  `weekly` WHERE  `private` =1 AND  `uid` =9
	//SELECT info.user.username, info.weekly. * FROM  `weekly` ,  `user` WHERE info.weekly.uid = info.user.userid AND info.weekly.private =0
	// $sql = sprintf("SELECT * FROM  `weekly` WHERE  `private` = 0;");
	$sql = sprintf("SELECT info.user.username, info.weekly. * FROM  `weekly` ,  `user` WHERE info.weekly.uid = info.user.userid AND info.weekly.isblog = 1;");
	$query = mysql_query($sql);
	if($query&&mysql_num_rows($query)){
		while ($row = mysql_fetch_assoc($query)) {
			$data[] = $row;
		}
	}else{
		$data = array();
	}
	// $row = array('list' => $data);
	message('周报列表',200,$data);
	
	return $row;
}
function weeklybyid($array = array())//根据weekid查询博客内容
{
	$sql = sprintf("SELECT * FROM  `weekly` WHERE  `uid` = %s AND `weeklyid` = %s;",mysql_real_escape_string($array['uid']),mysql_real_escape_string($array['weeklyid']));
	$query = mysql_query($sql);
	if($query&&mysql_num_rows($query)){
		while ($row = mysql_fetch_assoc($query)) {
			$data[] = $row;
		}
	}else{
		$data = array();
	}
	// $row = array('list' => $data);
	message('博客详情'.$sql,200,$data);
	return $row;
}
function myweekly($array = array())//查看用户自己的周报
{
	$sql = sprintf("SELECT * FROM  `weekly` WHERE  `uid` = %s;",mysql_real_escape_string($array['uid']));
	$query = mysql_query($sql);
	if($query&&mysql_num_rows($query)){
		while ($row = mysql_fetch_assoc($query)) {
			$data[] = $row;
		}
	}else{
		$data = array();
	}
	// $row = array('list' => $data);
	message('用户周报列表'.$sql,200,$data);
	return $row;
}

function addweekly($array = array())//添加周报
{
	$insertsql = sprintf("insert into weekly(title,uid,content,dateline,private,isblog) values('%s','%s','%s','%s',0,2)",
		mysql_real_escape_string($array['title']),mysql_real_escape_string($array['uid']),
		mysql_real_escape_string($array['content']),mysql_real_escape_string($array['dateline']));
	if(mysql_query($insertsql)){
		message('发布成功!',200,mysql_insert_id());
	}else{
		message('发布失败!'.var_dump($array),400);
	}
}

function delweekly($array = array())//删除周报
{
	$sql = sprintf("delete from weekly where weeklyid='%s' AND uid = '%s'",mysql_real_escape_string($array['weeklyid']),mysql_real_escape_string($array['uid']));
	
	$query = mysql_query($sql);
	if ($query){
		$row = array('message' => "删除周报成功!",'errorCode' => 0);
		bejson($row);
	}else{
		errorMessage('删除周报失败!',400);
	}
	die();
}

function updateweekly($array = array())//修改周报
{
	$dateline = time();
	$insertsql = sprintf("update weekly set title='%s',content='%s',dateline=$dateline,private='%s' where uid='%s' AND weeklyid='%s'",
		mysql_real_escape_string($array['title']),mysql_real_escape_string($array['content']),
		mysql_real_escape_string($array['private']),mysql_real_escape_string($array['uid']),mysql_real_escape_string($array['weeklyid']));

	if(mysql_query($insertsql)){
		$row = array('message' => "修改周报成功!",'errorCode' => 0);
		bejson($row);
	}else{
		$row = array('message' => "修改周报失败!",'errorCode' => 400);
		bejson($row);
	}
}

function signupbyemail($array = array()){
	$username = $array["username"];
	$password = $array["password"];
	$email = $array["email"];
	$insertsql = sprintf("select id from user where username='%s'",
		mysql_real_escape_string($array['username']));
	$query = mysql_query($insertsql);
	$num = mysql_num_rows($query);
	if($num==1){
		// echo '<script>alert("用户名已存在，请换个其他的用户名");window.history.go(-1);</script>';
		// exit;
		message("'$username'用户名已存在，请换个其他的用户名",401,NULL);
		die();
	}
	$password = md5(trim($password));
	// $email = trim($_POST['email']);
	$regtime = time();

	$token = md5($username.$password.$regtime); //创建用于激活识别码
	$token_exptime = time()+60*60*24;//过期时间为24小时后

	$sql = "insert into `user` (`username`,`password`,`email`,`token`,`token_exptime`,`regtime`) values ('$username','$password','$email','$token','$token_exptime','$regtime')";
	include_once("../register/smtp.class.php");
	mysql_query($sql);

	if(mysql_insert_id()){//写入成功，发邮件
    	include_once("../register/smtp.class.php");
    	$smtpserver = "smtp.163.com"; //SMTP服务器
    	$smtpserverport = 25; //SMTP服务器端口
    	$smtpusermail = "dxdwrdh@163.com"; //SMTP服务器的用户邮箱
	    $smtpuser = "dxdwrdh@163.com"; //SMTP服务器的用户帐号
	    $smtppass = "dz1215115629"; //SMTP服务器的用户密码
	    $smtp = new Smtp($smtpserver, $smtpserverport, true, $smtpuser, $smtppass); //这里面的一个true是表示使用身份验证,否则不使用身份验证.
	    $emailtype = "HTML"; //信件类型，文本:text；网页：HTML
	    $smtpemailto = $email;
	    $smtpemailfrom = $smtpusermail;
	    $emailsubject = "用户帐号激活";
	    $emailbody = "亲爱的".$username."：<br/>感谢您在我站注册了新帐号。<br/>请点击链接激活您的帐号。<br/><a href='http://114.215.152.69/php/register/active.php?verify=".$token."' target='_blank'>http://114.215.152.69/php/register/active.php?verify=".$token."</a><br/>如果以上链接无法点击，请将它复制到你的浏览器地址栏中进入访问，该链接24小时内有效。<br/>如果此次激活请求非你本人所发，请忽略本邮件。<br/><p style='text-align:right'>-------- dingzhe 敬上</p>";
	    $rs = $smtp->sendmail($smtpemailto, $smtpemailfrom, $emailsubject, $emailbody, $emailtype);
		
		if($rs==1){
			$msg = '恭喜您，注册成功！<br/>请登录到您的邮箱及时激活您的帐号！';	

		}else{
			$msg = $rs;	
		}
		// echo $msg;
		message("$msg",401,NULL);
		


	}



}

function isempty($str,$strname)
{
	if(empty($str)){
		message("'$strname' 不能为空",401,$str);
		die();
	}else{
		return $str;
	}
}

function auth($userid = '',$password = ''){

	$password = md5($password);
	$sql = "select password from user where userid = $userid";
	// echo $sql;
	$query = mysql_query($sql);
	// echo $query;
	if ($query) {
		$row = mysql_fetch_row($query);
		// var_dump($row);
		if ($row[0] === $password) {
			return true;
		}else{
			return false;
		}
	}else{
		return false;
	}

}

function message($message = '',$code = 0,$data = array()){
	$row = array('message' => $message,'code' => $code,'data' => $data);
	bejson($row);
}

function errorMessage($message = '',$errorCode = 0)//错误信息
{
	$row = array('message' => $message,'errorCode' => $errorCode);
	bejson($row);
}

// function signin($username = '',$password = ''){
// 	$password = md5($password);
// 	if ((!isset($username)) && (!empty($username)) && (!isset($password)) && (!empty($password))) {
// 		$row = array('message' => "用户名和密码均不为空",'errorCode' => 201,'username' => $username);
// 		bejson($row);
// 		die();
// 	}
		
// 	$insertsql = "insert into user(username,password,sign,token,tokentime) values('$username','$password','$sign','$token',$tokentime)";
// 	if(mysql_query($insertsql)){
// 		$row = array('message' => "注册成功!",'code' => 0);
// 		bejson($row);
// 	}else{
// 		$row = array('message' => "注册失败!",'code' => 1);
// 		bejson($row);
// 	}
// }
function signUp($username = '',$password = '')//
{
	$password = md5($password);
	$sign = md5(uniqid(mt_rand(),true));
	$token = md5(uniqid(mt_rand(),true));
	$time = time();
	$insertsql = "insert into user(username,email,password,sign,tokentime,token) values('$username','$username','$password','$sign','$time','$token');";
	// $article = array('title' => $title,'author' => $author,'description' => $description,'content' => $content,'dateline' => $dateline);
	// bejson($insertsql);
	if(mysql_query($insertsql)){

		$user = getUserId($username);
		// echo $user;
		if ($user === '') {
			// $row = array('message' => "注册失败!",'code' => 400,'data' => $username);
			message("注册失败!",401,NULL);
			// bejson($row);
			die();
		}else{
			message("注册成功!",200,$user);
			// $row = array('message' => "注册成功!",'errorCode' => 200,'data' => $user,'userid' => mysql_insert_id());
			// bejson($row);
		}
	}else{
		message('注册失败!'.$insertsql,401,NULL);
		// $row = array('message' => "注册失败!",'errorCode' => 1,'data' => $insertsql);
		// bejson($row);
	}
}

function getUserId($username = '')
{
	$insertsql = "select userid,username,sex,headimage,email,phone,about from user where username = '$username';";
	// bejson($sql);
	$query = mysql_query($insertsql);
	// echo $insertsql;
	if ($query&&mysql_num_rows($query)) {
		$row = mysql_fetch_assoc($query);
		// bejson($row);
		return $row;
	}else{
		return '';
	}

}
function outOfTable($out,$table,$input)
{
	$sql = "select $out from $table where username = '$input'";
	// bejson($sql);
	if(mysql_query($sql)){
		$row = array('message' => "æ³¨å��æ��å��!",'errorCode' => 0,'data' => $sql);
		bejson($row);
	}else{
		$row = array('message' => "æ³¨å��å¤±è´¥!",'errorCode' => 1,'data' => $sql);
		bejson($row);
	}

}


function addArticle($title = '',$author = '',$description = '',$content = '')//添加文章
{
	if (!(isset($title) && (!empty($title)))) {
		$row = array('message' => "标题不能为空!",'errorCode' => 201,'title' => $title);
		bejson($row);
		die();
	}
	$dateline = time();
	$insertsql = "insert into article(title,author,description,content,dateline) values('$title','$author','$description','$content',$dateline)";
	$article = array('title' => $title,'author' => $author,'description' => $description,'content' => $content,'dateline' => $dateline);
	if(mysql_query($insertsql)){
		$row = array('message' => "发布文章成功!",'errorCode' => 0,'data' => $article);
		bejson($row);
	}else{
		$row = array('message' => "发布文章失败!",'errorCode' => 1);
		bejson($row);
	}
}

function updateArticle($id = '',$title = '',$author = '',$description = '',$content = '')//修改文章
{
	if (!(isset($id) && (!empty($id)))) {
		$row = array('message' => "没有该文章!",'errorCode' => 201);
		bejson($row);
		die();
	}
	$dateline = time();
	$oldArticle = getArticleById($id);
	$insertsql = "update article set title='$title',author='$author',description='$description',content='$content',dateline=$dateline where id=$id";
	$article = array('title' => $title,'author' => $author,'description' => $description,'content' => $content,'dateline' => $dateline);
	if(mysql_query($insertsql)){
		$row = array('message' => "修改文章成功!",'errorCode' => 0,'oldArticle' => $oldArticle ,'data' => $article);
		bejson($row);
	}else{
		$row = array('message' => "修改文章失败!",'errorCode' => 400);
		bejson($row);
	}
}

function deleteArticle($id)//删除文章
{
	$article = getArticleById($id);
	// echo $article;
	$sql = "delete from article where id=$id";
	$query = mysql_query($sql);
	if ($query){
		$row = array('message' => "删除文章成功!",'errorCode' => 0,'data' => $article);
		bejson($row);
	}else{
		errorMessage('删除文章失败!',400);
	}
	die();
	// return $row;
}

function getIdList()//得到文章id列表
{
	$sql = "select id from article";
	$query = mysql_query($sql);
	if($query&&mysql_num_rows($query)){
		while ($row = mysql_fetch_assoc($query)) {
			$data[] = $row;
		}
	}else{
		$data = array();
	}
	bejson($data);
	return $data;
}

function getArticleList()//得到文章列表
{

	$sql = "select id,title,author,description from article";
	$query = mysql_query($sql);
	if($query&&mysql_num_rows($query)){
		while ($row = mysql_fetch_assoc($query)) {
			$data[] = $row;
		}
	}else{
		$data = array();
	}
	$row = array('list' => $data);
	bejson($row);
	return $row;
}

function getAllArticle()//得到所有的文章
{
	$sql = "select * from article";
	$query = mysql_query($sql);
	if($query&&mysql_num_rows($query)){
		while ($row = mysql_fetch_assoc($query)) {
			$data[] = $row;
		}
	}else{
		$data = array();
	}
	$row = array('list' => $data);
	bejson($row);
	return $row;
}
function getArticleById($id)//根据id得到文章详情
{
	$sql = "select * from article where id = $id";
	$query = mysql_query($sql);
	if ($query&&mysql_num_rows($query)) {
		$row = mysql_fetch_assoc($query);
	}
	// bejson($row);
	return $row;
}
function articleById($id)//根据id得到文章详情
{
	bejson(getArticleById($id));
}

function bejson($row)//转json
{
	header('Content-Type: application/json');
	$json = json_encode($row);
	echo $json;
}

/**
 * @SWG\Swagger(
 *	   @SWG\Info(title="Article API", version="0.1.0"),
 *     host="192.168.1.111",
 *     schemes={"http"},
 *     basePath="/php",
 *	   consumes={"application/json"},
 *	   produces={"application/json"}
 * )
 */
/**
 * @SWG\Get(
 *   path="/api.php",
 *   summary="list products",
 *   tags={"GetArticle"},
 *   description="The article API",
 *   operationId="getArticleById",
 *   @SWG\Parameter(
 *   	name="id",
 *   	in="query",
 *      description="Tags to filter by",
 *      required=true,
 *      type="string"
 *     ),
 *   @SWG\Parameter(
 *   	name="api",
 *   	in="query",
 *      description="Tags to filter by",
 *      required=true,
 *      type="string"
 *     ),
 *   @SWG\Response(
 *     response=200,
 *     description="A list with products",
 *	   @SWG\Schema(
 *         @SWG\Property(
 *             property="id",
 *			   example="8",
 *             type="string"
 *         ),
  *        @SWG\Property(
 *             property="title",
 *			   example="准备回家了",
 *             type="string"
 *         ),
  *        @SWG\Property(
 *             property="author",
 *			   example="今天学习的有收获",
 *             type="string"
 *         ),
  *        @SWG\Property(
 *             property="description",
 *			   example="后台写好了",
 *             type="string"
 *         ),
  *        @SWG\Property(
 *             property="content",
 *			   example="得等到的 是的撒大神带的 额凤飞飞",
 *             type="string"
 *         ),
  *        @SWG\Property(
 *             property="dateline",
 *			   example="1446630056",
 *             type="string"
 *         )
 *		)
 *   ),
 *   @SWG\Response(
 *     response="default",
 *     description="an ""unexpected"" error"
 *   )
 * )
 **/

?>

