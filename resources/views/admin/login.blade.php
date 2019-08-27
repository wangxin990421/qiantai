<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <title> - 登录</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/font-awesome.css?v=4.4.0" rel="stylesheet">
    <link href="/css/animate.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/login.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <!-- 全局js -->
    <script src="/js/jquery.min.js?v=2.1.4"></script>
    <script src="/js/bootstrap.min.js?v=3.3.6"></script>
    <!-- iCheck -->
    <script src="/js/plugins/iCheck/icheck.min.js"></script>

    <script>
        if (window.top !== window.self) {
            window.top.location = window.location;
        }
    </script>

</head>

<body class="signin">
<div class="signinpanel">
    <div class="row">
        <div class="col-sm-12">
            <form method="post" action="index.html">
                {{--<h4 class="no-margins">登录：</h4>--}}
                {{--<p class="m-t-md">登录到H+后台主题UI框架</p>--}}
                <input type="text" id="admin_name" class="form-control uname" placeholder="用户名" />
                <input type="password" id="admin_pwd" class="form-control pword m-b" placeholder="密码" />
                <p class="text-muted text-center"><small>还没有注册？</small><a href="/admin/register">点此注册</a>
                    <button type="button" id="btn" class="btn btn-primary block full-width m-b">登录</button>
            </form>
        </div>
    </div>
</div>
</body>
<script>
    $('#btn').click(function(){
       // alert(1111111);
        var admin_name = $('#admin_name').val();
        var admin_pwd = $('#admin_pwd').val();
        var data = {admin_name:admin_name,admin_pwd:admin_pwd};
        $.ajax({
            url:'/admin/loginDo',
            method:'post',
            data:data,
            dataType:'json',
            success:function(res){
                // console.log(res);
                if(res.code == 200){
                    alert(res.msg);
                    location.href='/index';
                }else{
                    alert(res.msg);
                }
            }
        });
    })
</script>
</html>
