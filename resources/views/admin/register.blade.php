<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title> - 注册</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="shortcut icon" href="favicon.ico"> <link href="/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/css/animate.css" rel="stylesheet">
    <link href="/css/style.css?v=4.1.0" rel="stylesheet">
    <script>if(window.top !== window.self){ window.top.location = window.location;}</script>

</head>

<body class="gray-bg">

<div class="middle-box text-center loginscreen   animated fadeInDown">
    <div>
        <div>

            <h1 class="logo-name">H+</h1>

        </div>
        <h2>欢迎注册</h2>
        {{--<p>创建一个H+新账户</p>--}}
        <form class="m-t" role="form" >
            <div class="form-group">
                <input type="text" class="form-control" placeholder="请输入用户名" id="admin_name" >
            </div>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="请输入邮箱" id="admin_email">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="请输入手机号" id="admin_tel">
            </div>
            <div class="form-group">
                <input type="password"  id="admin_pwd" class="form-control" placeholder="请输入密码">
            </div>
            <div class="form-group">
                <input type="password" id="admin_pwd2" class="form-control" placeholder="请再次输入密码">
            </div>
            <div class="form-group text-left">
                <div class="checkbox i-checks">
                    <label class="no-padding">

                {{--</div>--}}
            </div>
            <button type="button" id="btn" class="btn btn-primary block full-width m-b">注 册</button>

            <p class="text-muted text-center"><small>已经有账户了？</small><a href="login.html">点此登录</a>
            </p>

        </form>
    </div>
</div>

<!-- 全局js -->
<script src="/js/jquery.min.js?v=2.1.4"></script>
<script src="/js/bootstrap.min.js?v=3.3.6"></script>
<!-- iCheck -->
<script src="/js/plugins/iCheck/icheck.min.js"></script>
<script>
$('#btn').click(function(){
    var admin_name = $('#admin_name').val();
    var admin_email = $('#admin_email').val();
    var admin_tel = $('#admin_tel').val();
    var admin_pwd = $('#admin_pwd').val();
    var admin_pwd2 = $('#admin_pwd2').val();
    var data = {admin_name:admin_name,admin_email:admin_email,admin_tel:admin_tel,admin_pwd:admin_pwd,admin_pwd2:admin_pwd2};
    $.ajax({
        url:'/admin/registerDo',
        method:'post',
        data:data,
        dataType:'json',
        success:function(res){
            // console.log(res);
            if(res.code == 200){

                location.href='/admin/login';
            }else{
                alert(res.msg);
            }
        }
    })
})
</script>




</body>

</html>
