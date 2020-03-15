<?php
/**
 * Created by PhpStorm.
 * User: Aris
 * Date: 2018.9.15
 * Time: 20:08
 *
 * 门锁状态表展示接口
 */

$t = $_GET['userid'];
$_mysqli = new mysqli();
$_mysqli->connect("localhost","username","userpasswd","sqlname");
if(mysqli_connect_error()){
    echo "连接数据库失败了";
}
$_mysqli->set_charset("utf8");

$sql = "select * from locks,user_lock where user_lock.user_id=$t and locks.lock_id=user_lock.lock_id";
$result = $_mysqli->query($sql);
$data = array();
while($row=$result->fetch_assoc()){
    $data[] = $row;
}
echo json_encode($data,JSON_UNESCAPED_UNICODE);//注意返回json格式到前台
?>