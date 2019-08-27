<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ColumnController extends Controller
{
    /**
     * 栏目 添加
     */

    public function column()
    {
        $data = \DB::table('crumbs')->get();
        return view('admin/column',['data'=>$data]);
    }

    /**
     * 栏目添加 执行
     */

    public function columnDo()
    {
        $data = request()->input();
//        dd($data);
        $col_name = $data['col_name'];
        if(empty($data['col_name']) || empty($data['col_weight']) || empty($data['cru_id']) || empty($data['col_status']) || empty($data['col_desc'])){
            $data= [
                'code'=>105,
                'msg'=>'专栏信息不能为空！',
                'data'=>[]
            ];
            return json_encode($data,JSON_UNESCAPED_UNICODE);die;
        }
        $colName = \DB::table('column1')->where(['col_name'=>$col_name])->first();
//        dd($colName);
        if($colName){
            $data= [
                'code'=>104,
                'msg'=>'该专栏名称已经存在了啊！',
                'data'=>[]
            ];
            return json_encode($data,JSON_UNESCAPED_UNICODE);die;
        }

        $data['create_time']=time();
        $res = \DB::table('column1')->insert($data);
        if($res){
            $data= [
                'code'=>200,
                'msg'=>'专栏数据添加成功了！',
                'data'=>[]
            ];
            return json_encode($data,JSON_UNESCAPED_UNICODE);die;
        }


    }

    /**
     * 栏目列表
     */
    public function columnlist()
    {
        $data = \DB::table('column1')->leftjoin('crumbs','column1.cru_id','=','crumbs.cru_id')->where(['column1.del'=>1])->paginate(2);
//        dd($data);
        return view('admin/columnlist',['data'=>$data]);
    }

    /**
     * 栏目 删除
     */

    public function colDel()
    {
         $col_id = request()->input('col_id');
//         dd($col_id);
        $res = \DB::table('column1')->where(['col_id'=>$col_id])->update(['del'=>2]);
        if($res){
            $data= [
                'code'=>200,
                'msg'=>'专栏数据添删除成功了！',
                'data'=>[]
            ];
            return json_encode($data,JSON_UNESCAPED_UNICODE);die;
        }

    }

    /**
     * 栏目修改
     */

    public function columnup()
    {
        $col_id = request()->input('col_id');
//        dd($col_id);
        $cruInfo = \DB::table('crumbs')->get();
        $colInfo = \DB::table('column1')->leftjoin('crumbs','column1.cru_id','=','crumbs.cru_id')->where(['column1.col_id'=>$col_id])->first();
//        dd($colInfo);
        return view('admin/clumnup',['cruInfo'=>$cruInfo,'data'=>$colInfo]);
    }

    /**
     * 栏目 修改
     */
    public function columnupDo()
    {
        $data = request()->input();
//        dd($data);
        $id = $data['col_id'];
        $res = \DB::table('column1')->where(['col_id'=>$id])->update($data);
        if($res){
            $data= [
                'code'=>200,
                'msg'=>'专栏数据添修改成功了！',
                'data'=>[]
            ];
            return json_encode($data,JSON_UNESCAPED_UNICODE);die;
        }else{
            $data= [
                'code'=>105,
                'msg'=>'专栏数据添修改失败了！',
                'data'=>[]
            ];
            return json_encode($data,JSON_UNESCAPED_UNICODE);die;
        }
    }
}
