@extends('first.first')
@section('title','展示')

@section('content')
  <h3 style="margin-left:300px">顶部导航栏</h3>
  <table class="table table-hover">
    <tr>
      <th>顶部导航栏名称</th>
      <th>权重等级</th>
      <th>是否展示</th>
      <th>操作</th>
    </tr>

    @foreach($data as $k => $v)
      <tr>
        <td>{{$v->navo_name}}</td>
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
          <a href="navoup?navo_id={{$v->navo_id}}" class="btn btn-warning" id="up">修改</a>
            <input type="hidden" value="{{$v->navo_id}}" >
          <a href="javascript:0" class="btn btn-danger " >删除</a>
        </td>
      </tr>
    @endforeach
  </table>
  <div>
      {{$data->onEachSide(2)->links()}}
  </div>
  <h3 style="margin-left:300px">底部导航栏</h3>
  <table class="table table-hover">
    <tr>
      <th>底部导航栏名称</th>
      <th>权重等级</th>
      <th>是否展示</th>
      <th>操作</th>
    </tr>

    @foreach($res as $key => $value)
      <tr>
        <td>{{$value->navf_name}}</td>
        <td>@if($value->weight==1)1级权重
          @elseif($value->weight==2)2级权重
          @elseif($value->weight==3)3级权重
          @elseif($value->weight==4)4级权重
          @else   5级权重
          @endif
        </td>
        <td>@if($value->status==1)显示
          @elseif($value->status==2)隐藏
          @endif</td>
        <td>
            <a href="navfup?navf_id={{$value->navf_id}}" class="btn btn-info" id="up">修改</a>
            {{--<input type="hidden"  value="{{$value['navf_id']}}">--}}
            <a href="javascript:0" class="btn btn-success" u_id="{{$value->navf_id}}" >删除</a>
        </td>
      </tr>
    @endforeach
  </table>
  <div>
      {{$data->onEachSide(2)->links()}}
  </div>
  <script>
      $('.btn').click(function(){
         // alert(11111111);
          var _this = $(this);
          var navo_id = _this.prev('input').attr('value');
          var navf_id = _this.attr('u_id');
          // alert(navf_id);
          var data = {navo_id:navo_id,navf_id:navf_id};
          $.ajax({
              url:'/admin/del',
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
      });
  </script>
@endsection