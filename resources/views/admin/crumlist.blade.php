@extends('first.first')
@section('title','展示')

@section('content')
          <h3 style="margin-left:300px">栏目列表页</h3>
          <table class="table">
              <tr>
                  <td>栏目名称</td>
                  <td>所属导航</td>
                  <td>栏目状态</td>
                  <td>操作</td>
              </tr>
              @foreach($data as $k=>$v)
              <tr>
                  <td>{{$v->cru_name}}</td>
                  <td>{{$v->navo_name}}</td>
                  <td>
                      @if($v->cru_status==1)显示
                      @elseif($v->cru_status==2)隐藏
                      @endif
                  </td>
                  <td>
                      <button class="btn btn-danger" type="button" u_id="{{$v->cru_id}}">删除</button>
                      <a href="crumup/?cru_id={{$v->cru_id}}" class="btn btn-warning">修改</a>
                  </td>
              </tr>
              @endforeach

          </table>
          <div>
              {{$data->onEachSide(2)->links()}}
          </div>
          <script>
              $('.btn').click(function(){
                  var _this=$(this);
                  var cru_id= _this.attr('u_id');
                  // alert(cru_id);
                  var data={cru_id:cru_id};
                  $.ajax({
                      url:'/admin/crumdel',
                      data:data,
                      method:'post',
                      dataType:'json',
                      success:function(res){
                          // console.log(res);
                          if(res.code == 200){
                              alert(res.msg);
                              _this.parent('td').parent('tr').remove();
                          }else{
                              alert(res.msg);
                          }
                      }
                  });
              });
          </script>
@endsection