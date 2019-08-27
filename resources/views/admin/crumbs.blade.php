@extends('first.first')
@section('title','展示')

@section('content')
    <h3>新建栏目</h3><br/>
    <form>
        <div class="form-group">
            <label for="exampleInputEmail1">栏目名称</label>
            <input type="text" class="form-control" id="cru_name" placeholder="请填写栏目名称" style="width:224px">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">所属导航</label>

            <select class="form-control" name="weight" id="navo_id" style="width:224px">
                <option value="0">请选择所属导航</option>
                @foreach($data as $k=>$v)
                <option value="{{$v->navo_id}}">{{$v->navo_name}}</option>
                @endforeach
            </select>

        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">是否显示</label>
            <select class="form-control" name="status" id="cru_status" style="width:224px">
                <option value="0">是否显示</option>
                <option value="1">是</option>
                <option value="2">否</option>
            </select>
        </div>
        <button type="button" class="btn btn-success" id="btn">创建栏目</button>
    </form>
    <script>
        $('#btn').click(function(){
           // alert(1111111);
            var cru_name = $('#cru_name').val();
            var cru_status= $('#cru_status').val();
            var navo_id=$('#navo_id').val();
            // alert(navo_id);
            var data ={cru_name:cru_name,cru_status:cru_status,navo_id:navo_id};
            $.ajax({
                url:'/admin/cruadd',
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