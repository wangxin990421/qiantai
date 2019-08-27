@extends('first.first')
@section('title','展示')

@section('content')
    <h3>新建导航</h3><br/>
    <form>
        <div class="form-group">
            <label for="exampleInputEmail1">专栏名称</label>
            <input type="text" class="form-control" id="name" placeholder="请填写专栏名称" style="width:224px">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">权重等级</label>
            <select class="form-control" name="weight" id="weight" style="width:224px">
                <option value="0">请选择权重等级</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">状态</label>
            <select class="form-control" name="status" id="status" style="width:224px">
                <option value="0">是否显示</option>
                <option value="1">是</option>
                <option value="2">否</option>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">请选择一个数据表</label>
            <select class="form-control" name="navbar" id="navbar" style="width:224px">
                <option value="0">请选择一个导航数据</option>
                <option value="1">顶部导航数据</option>
                <option value="2">底部导航数据</option>
            </select>
        </div>

        <button type="button" class="btn btn-success" id="btn">创建导航</button>
    </form>
    <script>
        $("#btn").click(function(){
            // alert(1111);
            var name = $('#name').val();
            var weight = $('#weight').val();
            var status =$("#status").val();
            var navbar =$("#navbar").val();
            // alert(navbar);
            // alert(status);
            // alert(name);
            // alert(weight);
            var data = {name:name,weight:weight,status:status,navbar:navbar};
            $.ajax({
                url:"/admin/daohangDo",
                method:'post',
                data:data,
                dataType:'json',
                success:function(res){
                    // console.log(res);
                    if(res.code==100 || res.code ==101){
                        alert(res.msg);
                        location.href='/admin/daolist';
                    }else{
                        alert(res.msg);
                    }
                }
            })
        })
    </script>
@endsection