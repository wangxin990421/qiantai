@extends('first.first')
@section('title','展示')

@section('content')

    <h3>新建轮播图</h3><br/>
    <form action='/admin/imgDo' method='post' enctype="multipart/form-data">
        <div class="form-group" >
            <label for="exampleInputEmail1">轮播图片</label>
            <input type="file" class="form-control"  name="img" id="img" style="width:224px">
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
                <option value="1">顶部轮播图数据</option>
                <option value="2">底部轮播图数据</option>
            </select>
        </div>
        <button type="submit" class="btn btn-info" id="btn" >添加轮播图</button>
    </form>

@endsection