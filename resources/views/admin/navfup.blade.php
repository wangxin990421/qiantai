@extends('first.first')
@section('title','展示')

@section('content')
    <h3>修改底部导航</h3><br/>
    <form>
        <input type="hidden" value="{{$daoInfo->navf_id}}" id="navf_id">
        <div class="form-group">
            <label for="exampleInputEmail1">专栏名称</label>
            <input type="text" class="form-control" id="name" value="{{$daoInfo->navf_name}}" placeholder="请填写专栏名称">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">权重等级</label>
            <select class="form-control" name="weight" id="weight">
                <option   value="0">请选择权重等级</option>
                <option @if($daoInfo->weight==1) selected @endif >1</option>
                <option  @if($daoInfo->weight==2) selected @endif >2</option>
                <option @if($daoInfo->weight==3) selected @endif >3</option>
                <option @if($daoInfo->weight==4) selected @endif >4</option>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">状态</label>
            <select class="form-control" name="status" id="status">
                <option value="0">是否显示</option>
                <option @if($daoInfo->status==1) selected @endif >是</option>
                <option @if($daoInfo->status==2) selected @endif>否</option>
            </select>
        </div>

        <button type="button" class="btn btn-success" id="btn">修改专栏</button>
    </form>
    <script>
            $('#btn').click(function(){
            // alert(11111111);
            var name = $('#name').val();
            var navf_id = $('#navf_id').val();
            var weight = $('#weight').val();
            var status = $('#status').children('option:selected').attr('value');
            var data = {navf_name:name,navf_id:navf_id,weight:weight,status:status};
                    $.ajax({
                    url:'/admin/navfupDo',
                    data:data,
                    dataType:'json',
                    method:'post',
                    success:function(res){
                    // console.log(res);
                        if(res.code == 200){
                        alert(res.msg);
                        location.href='/admin/daolist';
                        }else{
                            alert(res.msg)
                        }
                    }
                 });
            });
    </script>

@endsection