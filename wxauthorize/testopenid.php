<?php
/**
 * 获取用户openid
 */
error_reporting(E_ALL & ~E_NOTICE);

include './oauth2.php';
$code=$_GET['code'];//code 微信接口参数(必须)
$state=$_GET['state'];//state微信接口参数(不需传参则不用)；若传参可考虑规则： 'act'.'arg1'.'add'.'arg2'


$APPID='wxa3d16526503e71f4';
$SECRET='67e2daa17b8769ceb991abbf74c5e52a';
$REDIRECT_URL='http://www.rendersky.cn/demo/testopenid.php';//当前页面地址
// $REDIRECT_URL="http://www.rendersky.cn/qp/index.html";

$oauth2=new oauth2();
$oauth2->init($APPID, $SECRET,$REDIRECT_URL);
if(empty($code)){		
	$oauth2->get_code($state);//获取code，会重定向到当前页。若需传参，使用$state变量传参。
}
$openid=$oauth2->get_openid();//获取openid
if(!empty($openid)){
	$url="http://www.rendersky.cn/qp/index.html?openid=".$openid."";//
	 	// redirect($url);//重定向到游戏页面
	 	header('Location:'.$url);  //Location和":"之间无空格。
}
echo '</br>welcome test!';
echo '</br>code: '.$code;
echo '</br>openid: '.$openid;
?>