@extends('first.first')
@section('title','展示')

@section('content')
    <h3>修改栏目</h3><br/>
    <form>
        <input type="hidden" value="{{$cruInfo->cru_id}}" id="cru_id">
        <div class="form-group">
            <label for="exampleInputEmail1">栏目名称</label>
            <input type="text" class="form-control" value="{{$cruInfo->cru_name}}" id="cru_name" placeholder="请填写栏目名称">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">所属导航</label>

            <select class="form-control" name="weight" id="navo_id">
                <option value="0">请选择所属导航</option>
                @foreach($data as $k=>$v)
                    <option @if($cruInfo->navo_id == $v->navo_id) selected @endif value="{{$v->navo_id}}">{{$v->navo_name}}</option>
                @endforeach
            </select>

        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">是否显示</label>
            <select class="form-control" name="status" id="cru_status">
                <option value="0">是否显示</option>
                <option @if($cruInfo->cru_status==1) selected @endif  value="1">是</option>
                <option @if($cruInfo->cru_status==2) selected @endif value="2">否</option>
            </select>
        </div>
        <button type="button" class="btn btn-success" id="btn">修改栏目</button>
    </form>
    <script>
       $('#btn').click(function(){
          // alert(111111111);
           var cru_name = $('#cru_name').val();
           var navo_id = $('#navo_id').val();
           var cru_status = $('#cru_status').val();
           var cru_id = $('#cru_id').val();
           var data={cru_name:cru_name,navo_id:navo_id,cru_status:cru_status,cru_id:cru_id};
           $.ajax({
              url:'/admin/crumupDo',
              data:data,
              method:'post',
              dataType:'json',
              success:function(res){
                  // console.log(res);
                  if(res.code == 200){
                      alert(res.msg);
                      location.href='/admin/crumlist';
                  }else{
                      alert(res.msg);
                  }
              }
           });
       });
    </script>

@endsection