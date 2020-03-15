

<?php
include ("Controller/identity.php");
$openid1 = $openid;
?>


<!DOCTYPE html>
<html>
<head>
    <title>微控锁-绑定</title>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/buttons.css">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/form.css" rel="stylesheet">
    <link rel="stylesheet" href="css/buttons.css">

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
                <img class="img-responsive" src="img/logo2.png" alt="WeLock" style="height: 100%;width: auto;" />
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
                <li><a href="../Login/index.html">首页</a></li>
                <li><a href="../Login/index.html">开锁中心</a></li>
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
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>


<!--main-->
<div class="row clearfix banner">
    <div class="col-md-12 column">
        <br><br>

        <!--主表-->
        <div class="jumbotron container" style="width:350px">
            <h2 style="text-align: center">
                门锁绑定
            </h2>
            <br>

            <!-- 开锁模态框 -->
            <div>
                <div class="modal-dialog" role="document">
                    <div class="form">
                        <h4 class="modal-title ss" id="myModalLabel" style="font-size:25px;display: inline-block" data-index="0"></h4>
                        <form class="login-form" method='post'>
                            <input type="text" id="inputText1" placeholder="填入姓名"/>
                            <input type="text" id="inputText2" placeholder="输入锁uuid"/>
                            <button class="button button-primary button-rounded" value="" onclick="btnOk_click()">确认绑定</button>                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var openid1 = "<?php echo $openid1?>";

        function btnOk_click(){
            var name1 = $("#inputText1").val();
            var uuid1 = $("#inputText2").val();
            var jsondata={"openid":openid1,"name":name1,"uuid":uuid1};
            $.ajax({
                type: "post",
                url: "Controller/register2.php",
                data:jsondata,
                success: function(data){
                    alert(data);
                },
                error: function(){
                    alert("参数出错，请与管理员联系!");
                }
            });
        }
    </script>
</body>
</html>