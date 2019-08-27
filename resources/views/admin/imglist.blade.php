@extends('first.first')
@section('title','展示')

@section('content')
    <h3 style="margin-left:300px">顶部轮播图数据</h3>
    <table class="table table-striped">
        <tr>
            <td>图片展示</td>
            <td>图片权重</td>
            <td>图片状态</td>
            <td>图片操作</td>
        </tr>
       @foreach($data as $k=>$v)
        <tr>
            <td><img src="/upload/{{$v->car_url}}" alt="" height="40px" width="40px"></td>
            <td>
                @if($v->weight==1)1级权重
                @elseif($v->weight==2)2级权重
                @elseif($v->weight==3)3级权重
                @elseif($v->weight==4)4级权重
                @endif
            </td>
            <td>@if($v->status==1)显示
                @elseif($v->status==2)隐藏
                @endif
            </td>
            <td>
                <a href="javascript:0" class="btn btn-danger " u_id="{{$v->car_id}}">删除</a>
            </td>
        </tr>
           @endforeach
    </table>
    <div>
        {{$data->onEachSide(2)->links()}}
    </div>
    <h3 style="margin-left:300px">底部轮播图数据</h3>
    <table class="table table-striped">
        <tr>
            <td>图片展示</td>
            <td>图片权重</td>
            <td>图片状态</td>
            <td>图片操作</td>
        </tr>
        @foreach($dataf as $k=>$v)
            <tr>
                <td><img src="/upload/{{$v->car2_url}}" alt="" height="40px" width="40px"></td>
                <td>
                    @if($v->weight==1)1级权重
                    @elseif($v->weight==2)2级权重
                    @elseif($v->weight==3)3级权重
                    @elseif($v->weight==4)4级权重
                    @endif
                </td>
                <td>@if($v->status==1)显示
                    @elseif($v->status==2)隐藏
                    @endif
                </td>
                <td>
                    <input type="hidden" value="{{$v->car2_id}}">
                    <a href="javascript:0" class="btn btn-danger " >删除</a>
                </td>
            </tr>
        @endforeach
    </table>
    <div>
        {{$dataf->onEachSide(2)->links()}}
    </div>
    <script>
        $('.btn').click(function(){
            // alert(1111111);
            var _this = $(this);
            var car2_id = _this.prev('input').attr('value');
            var car_id = _this.attr('u_id');
            // alert(car_id);
            var data = {car_id:car_id,car2_id:car2_id};
            $.ajax({
                    url:'/admin/imgdel',
                    data:data,
                    method:'post',
                    dataType:'json',
                    success:function(res){
                        // console.log(res);
                        if(res.code == 102){
                            alert(res.msg);
                            _this.parent('td').parent('tr').remove();
                        }else if (res.code == 103){
                            alert(res.msg);
                            _this.parent('td').parent('tr').remove();
                        }
                    }
                });
        })
    </script>
@endsection