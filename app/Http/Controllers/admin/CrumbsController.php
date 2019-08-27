<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CrumbsController extends Controller
{
    /*
     * 栏目添加  与导航栏关联
     */

    public function addcru()
    {
        $data = \DB::table('navbaro')->get();
        return view('admin/crumbs',['data'=>$data]);
    }

    /**
     * 栏目添加  执行方法
     */

    public function cruadd()
    {
         $data = request()->input();
//         dd($data);
        $cname = $data['cru_name'];
        $nameInfo = \DB::table('crumbs')->where(['cru_name'=>$cname])->first();
        if($nameInfo){
            $data= [
                'code'=>104,
                'msg'=>'该栏目已经存在了！',
                'data'=>[]
            ];
            return json_encode($data,JSON_UNESCAPED_UNICODE);die;
        }
        $res= \DB::table('crumbs')->insert($data);
        if($res){
            $data= [
                'code'=>200,
                'msg'=>'栏目数据添加成功！',
                'data'=>[]
            ];
            return json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            $data= [
                'code'=>105,
                'msg'=>'栏目数据添加失败！',
                'data'=>[]
            ];
            return json_encode($data,JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * 栏目列表
     */

    public function crumlist()
    {
//        $data = \DB::table('crumbs')->get();
//        dd($data);
        $data = \DB::table('crumbs')->leftjoin('navbaro','crumbs.navo_id','=','navbaro.navo_id')->where(['del'=>1])->paginate(2);
//        dd($data);
        return view('admin/crumlist',['data'=>$data]);
    }

    /*
     * 栏目删除
     */
    public function crumdel()
    {
        $id = request()->input();
//        dd($id);
        $res = \DB::table('crumbs')->where(['cru_id'=>$id])->update(['del'=>2]);
        if($res){
            $data= [
                'code'=>200,
                'msg'=>'栏目数据删除成功！',
                'data'=>[]
            ];
            return json_encode($data,JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * 栏目 修改
     */
    public function crumup()
    {
        $cru_id = request()->input('cru_id');
//        dd($cru_id);
        $navInfo = \DB::table('navbaro')->get();
        $cruInfo = \DB::table('crumbs')->leftjoin('navbaro','crumbs.navo_id','=','navbaro.navo_id')->where(['cru_id'=>$cru_id])->first();
//        dd($data);
        return view('admin/crumup',['cruInfo'=>$cruInfo,'data'=>$navInfo]);
    }

    /**
     * 栏目修改  执行
     */
    public function crumupDo()
    {
       $data = request()->input();
//       dd($data);
//        unset($data);
        $res = \DB::table('crumbs')->where(['cru_id'=>$data['cru_id']])->update($data);
        if($res){
            $data= [
                'code'=>200,
                'msg'=>'栏目数据修改成功！',
                'data'=>[]
            ];
            return json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            $data= [
                'code'=>105,
                'msg'=>'栏目数据好像没有变化啊！',
                'data'=>[]
            ];
            return json_encode($data,JSON_UNESCAPED_UNICODE);
        }
    }
}
