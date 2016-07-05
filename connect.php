<?php 
	require_once('./config.php');
	//require_once('article.php');
	// error_reporting(~0);
        // ini_set('display_errors', 1);
	//连库
	if(!($con = mysql_connect(HOST,USERNAME,PASSWORD))){
		echo mysql_error();
	}
	//选库
	if(!mysql_select_db('info')){
		echo mysql_error();
	}
	//字符集
	if(!mysql_query('set names utf8')){
		echo mysql_error();
	}
	// require_once('../connect.php');
	echo 'success';
?>
