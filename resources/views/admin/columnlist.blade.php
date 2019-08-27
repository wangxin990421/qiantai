@extends('first.first')
@section('title','展示')

@section('content')
    <h3 style="margin-left:300px">专栏列表页</h3>
    <table class="table">
        <tr>
            <td>专栏名称</td>
            <td>所属栏目</td>
            <td>专栏状态</td>
            <td>专栏权重</td>
            <td>专栏详情</td>
            <td>添加时间</td>
            <td>操作</td>
        </tr>
        @foreach($data as $k=>$v)
            <tr>
                <td>{{$v->col_name}}</td>
                <td>{{$v->col_name}}</td>
                <td>
                    @if($v->col_status==1)显示
                    @elseif($v->col_status==2)隐藏
                    @endif
                </td>
                <td>{{$v->col_weight}}级权重</td>
                <td>{{$v->col_desc}}</td>
                <td>{{date('Y-m-d',$v->create_time)}}</td>
                <td>
                    <button class="btn btn-danger" type="button" u_id="{{$v->col_id}}">删除</button>
                    <a href="columnup/?col_id={{$v->col_id}}" class="btn btn-warning">修改</a>
                </td>
            </tr>
        @endforeach
    </table>
    <div>
        {{$data->onEachSide(2)->links()}}
    </div>
    <script>
        $('.btn').click(function(){
            // alert(111111);
            var _this = $(this);
            var col_id = _this.attr('u_id');
            // alert(col_id);
            var data = {col_id:col_id};
            $.ajax({
                url:'/admin/colDel',
                method:'post',
                data:data,
                dataType:'json',
                success:function(res){
                    if(res.code == 200){
                       alert(res.msg);
                        _this.parent('td').parent('tr').remove();
                    }else{
                        alert(res.msg);
                    }
                }
            })
        });
    </script>
@endsection