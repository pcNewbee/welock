<?php
/**
 * Created by PhpStorm.
 * User: Aris
 * Date: 2018.9.15
 * Time: 20:08
 *
 * 门锁绑定接口
 */

$name = $_POST["name"];
$uuid = $_POST['uuid'];
$openid = $_POST['openid'];
$_mysqli = new mysqli("localhost","username","passwd","dbName");
if(!$_mysqli){
    echo "<script>alert('数据库连接失败'); history.go(-1);</script>";
}
$_mysqli->set_charset("utf8");

if($name == "" || $uuid == ""){
    echo "请确认信息完整性！";
}else {//查询uuid是否存在
    $_sq1 = "select * from locks where uuid = '$uuid'";
    $_result1 = $_mysqli->query($_sq1);
    $num = $_result1->num_rows;//统计执行结果影响的行数
    if($num == 0){
        echo "请确认输入uuid的正确性！";
    }else{

        //向用户表中插入数据
        $_sq2 = "insert into users(user_name,openid) values('$name','$openid')";
        $_mysqli->query($_sq2);

        //查出生成的user_id
        $_sq3 = "select user_id from users where openid = '$openid'";
        $_result2 = $_mysqli->query($_sq3);
        while($_assoc = $_result2->fetch_assoc()){
            $user_id = $_assoc['user_id'];

        //插入用户门锁绑定表
        $_sq4 = "insert into user_lock(user_id,lock_id) values('$user_id','lock1')";
        if($_mysqli->query($_sq4)){
            echo "绑定成功！";
        }else{
                echo "绑定失败，请重试！";
            }
        }
    }
}
?>