<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">

    <title>后台 @yield('title')</title>

    <meta name="keywords" content="">
    <meta name="description" content="">

    <!--[if lt IE 9]>
    <!--<meta http-equiv="refresh" content="0;ie.html" />-->
    {{--<![endif]-->--}}

    <link rel="shortcut icon" href="favicon.ico"> <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- 全局js -->
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>


</head>

<body class="fixed-sidebar full-height-layout gray-bg" style="margin-top: 3%">
<div class="container">
    @yield('content')
</div>
</body>

</html>

