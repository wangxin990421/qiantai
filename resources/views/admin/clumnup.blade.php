@extends('first.first')
@section('title','展示')

@section('content')
    <h3>修改专栏</h3><br/>
    <form>
        <input type="hidden" value="{{$data->col_id}}" id="col_id">
        <div class="form-group">
            <label for="exampleInputEmail1">专栏名称</label>
            <input type="text" class="form-control" id="col_name" value="{{$data->col_name}}" placeholder="请填写专栏名称" style="width:224px">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">专栏权重</label>
            <input type="text" class="form-control" id="col_weight" value="{{$data->col_weight}}" placeholder="请填写专栏名称" style="width:224px">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">所属栏目</label>
            <select class="form-control" name="weight" id="cru_id" style="width:224px">
                <option value="0">请选择所属栏目</option>
                @foreach($cruInfo as $k=>$v)
                    <option @if($data->cru_id == $v->cru_id) selected  @endif value="{{$v->cru_id}}">{{$v->cru_name}}</option >
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">是否显示</label>
            <select class="form-control" name="status" id="col_status" style="width:224px">
                <option value="0">是否显示</option>
                <option @if($data->col_status==1) selected @endif value="1">是</option>
                <option  @if($data->col_status==2) selected @endif value="2">否</option>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">专栏详情</label>
            <div>
                <div id="editor">
                    <p>{{$data->col_desc}}</p>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-success" id="btn">修改专栏</button>
        <script type="text/javascript" src="/wangEditor-3.1.1/Editor/release/wangEditor.min.js"></script>
        <script type="text/javascript">
            var E = window.wangEditor
            var editor = new E('#editor')
            // 或者 var editor = new E( document.getElementById('editor') )
            editor.create()
        </script>
    </form>
    <script>
        $('#btn').click(function() {
            // alert(1111111);
            var col_name = $('#col_name').val();
            // alert(col_name);
            var col_weight = $('#col_weight').val();
            // alert(col_weight);die;
            var cru_id = $('#cru_id').val();
            var col_status= $('#col_status').val();
            var col_desc = $('#col_desc').val();
            var col_id = $('#col_id').val();
            var data = {col_name:col_name,col_weight:col_weight,cru_id:cru_id,col_status:col_status,col_desc:col_desc,col_id:col_id};
            $.ajax({
                url:'/admin/columnupDo',
                data:data,
                method:'post',
                dataType:'json',
                success:function(res){
                    // console.log(res);
                    if(res.code == 200){
                        alert(res.msg);
                        location.href='/admin/columnlist';
                    }else{
                        alert(res.msg);
                    }
                }
            })
        });
    </script>
@endsection