<?php
include("Controller/identity.php");
$admin = false;
session_start();
if(!isset($_SESSION["admin"]) || !$_SESSION["admin"] === true)
{//如果没有session，往下执行。跳转或刷新就不必往下执行
    ifUser();
    $admin = false;
    if(!isset($_SESSION["admin"]) || !$_SESSION["admin"] === true){
        //session验证不通过就跳转到其它
        echo '<script>window.location="404/index2.html"</script>';
        die();
    }
}
$s = $_SESSION["user"];
?>

<!DOCTYPE html>
<html>
<head>
    <title>微控锁-开锁</title>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="lib/css/bootstrap.min.css" rel="stylesheet">
    <link href="lib/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="lib/css/buttons.css">
    <link href="lib/css/bootstrap.css" rel="stylesheet">
    <link href="lib/css/form.css" rel="stylesheet">
    <link rel="stylesheet" href="lib/css/buttons.css">

    <style type="text/css">
        .nav-logo{
            float: left;
            height: 40px;
            margin-top: 5px;
            overflow: hidden;
        }
        .nav-logo a{
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>

<!--导航-->
<div class="navbar navbar-fixed-top navbar-inverse" >
    <div class="container">
        <div class="nav-logo">
            <a class="" href="http://wx.ariser.cn/Login/index.html">
                <img class="img-responsive" src="lib/img/logo2.png" alt="WeLock" style="height: 100%;width: auto;" />
            </a>
        </div>
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navBar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse navbar-right" id="navBar">
            <ul class="nav navbar-nav">
                <li><a href="index.php">首页</a></li>
                <li><a href="index.php">开锁中心</a></li>
                <li class="dropdown">
                    <a href="404/IsDeveloping.html" class="dropdown-toggle" data-toggle="dropdown">
                        个人中心<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="index.php">账号管理</a></li>
                        <li><a href="404/IsDeveloping.html">紧急报停</a></li>
                        <li><a href="404/IsDeveloping.html">成员添加</a></li>
                        <li><a href="404/IsDeveloping.html">记录查询</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="404/IsDeveloping.html" class="dropdown-toggle" data-toggle="dropdown">
                        在线商城<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="404/IsDeveloping.html">在线购锁</a></li>
                        <li><a href="404/IsDeveloping.html">产品动态</a></li>
                        <li><a href="404/IsDeveloping.html">订单查询</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="404/IsDeveloping.html" class="dropdown-toggle" data-toggle="dropdown">
                        服务中心<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="404/IsDeveloping.html">联系客服</a></li>
                        <li><a href="404/IsDeveloping.html">使用指南</a></li>
                        <li><a href="404/IsDeveloping.html">故障报修</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<script src="lib/js/jquery-3.3.1.min.js"></script>
<script src="lib/js/bootstrap.min.js"></script>


<!--main-->
<div class="row clearfix banner">
    <div class="col-md-12 column">
        <br><br>

        <!--主表-->
        <div class="jumbotron container" style="width:350px">
            <?php
            $name =  getName();
            echo "<p style='text-align: right;color:blue;font-size:15px;'>你好！".$name."</p>"
            ?>
            <h2 style="text-align: center">
                我的门锁
            </h2>
            <br>
            <div class="main" id="div1">
                <table class="table table-bordered text-center table-hover">
                    <tr>
                        <th class="text-center">门锁ID</th>
                        <th class="text-center">所在位置</th>
                        <th class="text-center">门锁状态</th>
                        <th class="text-center">操作</th>
                    </tr>
                </table>
            </div>

            <!-- 开锁模态框 -->
            <div class="modal fade modal-fullscreen" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="form">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <span style="font-size:22px">当前开锁:</span>
                        <h4 class="modal-title ss" id="myModalLabel" style="font-size:25px;display: inline-block" data-index="0"></h4>
                        <input type="text" readonly="readonly" style="background-color:white;font-size:32px;color:blue;" class="ss form-group col-xs-5 text-center" data-index="1">
                        <form class="form-horizontal" id="form_open">
                            <button type="button" class="button button-border button-rounded button-action" data-dismiss="modal" id="sign_open">开门</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- 反锁模态框 -->
            <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="form">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <span style="font-size:22px">当前反锁:</span>
                        <h4 class="modal-title ss" id="myModalLabel2" style="font-size:25px;display: inline-block" data-index="0"></h4>
                        <input type="text" readonly="readonly" style="background-color:white;font-size:32px;color:blue;" class="ss form-group col-xs-5 text-center" data-index="1">
                        <form class="form-horizontal" id="form_lock">
                            <button type="button" class="button button-border button-rounded button-caution" data-dismiss="modal" id="sign_lock">关门</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script type="text/javascript">
        //初始数据加载
        var user =<?php echo $s?>;
        refresh()
        function  refresh(){
            $.ajax({
                url:"Controller/tableController.php?userid="+user,
                type:"get",
                success: function (res) {
                    var data = jQuery.parseJSON(res)
                    var str = "";
                    for(var i=0;i<data.length;i++){
                        str = "<tr><td>"+data[i].lock_id+"</td><td>"+data[i].lock_name+"</td><td>"+data[i].lock_state+"</td><td><button class='btn btn-success btn-xs' id='open' data-toggle='modal' data-target='myModal'>开门</button><button class='btn btn-danger btn-xs' id='lock' style='margin-left: 5px'>反锁</button></td></tr>";
                        $("table>tbody").append(str)
                    }
                }
            })
        }

        //开门模态框
        var a = 0;
        $(document).on("click","#open",function(){
            $('#myModal').modal()
            a = $(this).parents("tr").index() //全局a用来查找当前的下表
            $(this).parents("tr").find("td:not(:last-child)").each(function () {
                var s = $(this).text()
//                     console.log(s)
                var b = $(this).index()

                if(b>0){
                    $("#myModal .ss[data-index='"+b+"']").val(s)
                }else{
                    $("#myModal .ss[data-index='"+b+"']").text(s)
                }
            })

        })

        //开门按钮事件
        $(document).on("click","#sign_open",function(){
            var t = $("#myModalLabel").text()
            $("#myModal").find("input").each(function (){
                var q = $(this).val()
                var s = $(this).data("index")
                $("table>tbody").children("tr").eq(a).find("td").eq(s).text(q)
            })
            $.ajax({
                url:"http://wx.ariser.cn:39999/my/test73",
                type:"POST",
                data:"action=open&user="+user+"&lockid="+t,
                success:function(res){
                    if(res=='1'){
                        alert("开锁成功！")
                    }else{
                        alert("开锁失败！")
                    }
                }
            })
        })

        //反锁
        var a = 0;
        $(document).on("click","#lock",function(){
            $('#myModal2').modal()
            a = $(this).parents("tr").index() //全局a用来查找当前的下表
            $(this).parents("tr").find("td:not(:last-child)").each(function () {
                var s = $(this).text()
//                     console.log(s)
                var b = $(this).index()

                if(b>0){
                    $("#myModal2 .ss[data-index='"+b+"']").val(s)
                }else{
                    $("#myModal2 .ss[data-index='"+b+"']").text(s)
                }
            })
        })

        //改表事件
        $(document).on("click","#sign_lock",function(){
            var t = $("#myModalLabel2").text()
            $("#myModal2").find("input").each(function () {
                var q = $(this).val()
                var s = $(this).data("index")
                $("table>tbody").children("tr").eq(a).find("td").eq(s).text(q)
            })
            $.ajax({
                url:"http://wx.ariser.cn:39999/my/test73",
                type:"POST",
                data:"action=close&user="+user+"&lockid="+t,
                success:function(res){
                    if(res=='1'){
                        alert("反锁成功！")
                    }else{
                        alert("反锁失败！")
                    }
                }
            })
        })
    </script>
</body>
</html>