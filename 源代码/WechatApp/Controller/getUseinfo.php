<?php
/**
 * Created by PhpStorm.
 * User: Aris
 * Date: 2018.9.10
 * Time: 22:08
 *
 * 微信身份信息获取接口
 */


include("function.php");

$appid = "wx785b073e1649afa5";
$secret = "ec92ac62422edd19f353bbb7630137d2";

//第一步:取全局access_token
$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$secret";
$token = getJson($url);
//第二步:取得openid
$oauth2Url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$secret&code=$code&grant_type=authorization_code";
$oauth2 = getJson($oauth2Url);

//第三步:根据全局access_token和openid查询用户信息
$access_token = $token["access_token"];
$openid = $oauth2['openid'];
$get_user_info_url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$access_token&openid=$openid&lang=zh_CN";
$userinfo = getJson($get_user_info_url);
//打印用户信息
$nickname=$userinfo['nickname'];

function getJson($url){
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);
return json_decode($output, true);
}