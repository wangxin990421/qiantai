<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DaohangController extends Controller
{
    /**
     * 添加导航 页面
     */
    public function adddao()
    {
        return view('admin/daohang');
    }

    /**
     * 添加导航 执行
     */

    public function daohangDo()
    {
        $data = request()->input();
//        var_dump($data);\
        if(empty($data['name']) || empty($data['status']) || empty($data['weight'])){
            $data= [
                'code'=>102,
                'msg'=>'输入数据不能被空',
                'data'=>[]
            ];
            return json_encode($data,JSON_UNESCAPED_UNICODE);die;
        }
        if ($data['navbar'] == 1){
            unset($data['navbar']);
            $data = [
                'navo_name'=>$data['name'],
                'status'=>$data['status'],
                'weight'=>$data['weight'],
            ];
            $res = \DB::table('navbaro')->insert($data);
//            var_dump($data);
            if($res){
                $data= [
                    'code'=>100,
                    'msg'=>'顶部导航栏添加数据成功',
                    'data'=>[]
                ];
                return json_encode($data,JSON_UNESCAPED_UNICODE);
            }
        }else{
            unset($data['navbar']);
//            unset($data['status']);
            $data = [
                'navf_name'=>$data['name'],
                'status'=>$data['status'],
                'weight'=>$data['weight'],
            ];
            $res = \DB::table('navbarf')->insert($data);
            if ($res){
                $data= [
                    'code'=>101,
                    'msg'=>'底部导航栏添加数据成功',
                    'data'=>[]
                ];
                return json_encode($data,JSON_UNESCAPED_UNICODE);
            }
        }
    }
    /**
     * 导航栏 列表
     */

    public function daolist()
    {
        //查询顶部 数据
        $ondata = \DB::table('navbaro')->paginate(2);
        $fodata = \DB::table('navbarf')->paginate(2);
        return view('admin/daolist',['data'=>$ondata,'res'=>$fodata]);
    }

    /**
     *导航栏 列表 删除
     */
    public function del()
    {
        if($id= request()->navo_id){
            $data  = \DB::table('navbaro')->where(['navo_id'=>$id])->delete();
//            var_dump($data);
            if ($data){
                $data= [
                    'code'=>102,
                    'msg'=>'顶部导航栏删除数据成功',
                    'data'=>[]
                ];
                return json_encode($data,JSON_UNESCAPED_UNICODE);
            }
        }
        if($id2= request()->navf_id){

//            var_dump($id2);die;
            $data  = \DB::table('navbarf')->where(['navf_id'=>$id2])->delete();

//            var_dump($data);
            if($data){
                $data= [
                    'code'=>103,
                    'msg'=>'底部导航栏删除数据成功',
                    'data'=>[]
                ];
                return json_encode($data,JSON_UNESCAPED_UNICODE);
            }
        }
    }

    //顶部导航栏 数据修改
    public function navoup()
    {
        $id = request()->input();
//        dd($id);
        $daoInfo = \DB::table('navbaro')->where(['navo_id'=>$id])->first();
//        dd($daoInfo);
        return view('admin/navoup',['daoInfo'=>$daoInfo]);
    }
    /**
     * 顶部导航栏 修改执行
     */
    public function navoupDo()
    {
      $data = request()->input();
//      dd($data);
        $res = \DB::table('navbaro')->where(['navo_id'=>$data['navo_id']])->update($data);
//        dd($res);
        if($res){
            $data= [
                'code'=>200,
                'msg'=>'顶部导航栏数据修改成功！',
                'data'=>[]
            ];
            return json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            $data= [
                'code'=>105,
                'msg'=>'你没修改！你点啥！',
                'data'=>[]
            ];
            return json_encode($data,JSON_UNESCAPED_UNICODE);
        }
    }

    //底部导航栏 数据修改
    public function navfup()
    {
        $id = request()->input();
//        dd($id);
        $daoInfo = \DB::table('navbarf')->where(['navf_id'=>$id])->first();
//        dd($daoInfo);
        return view('admin/navfup',['daoInfo'=>$daoInfo]);
    }

    public function navfupDo()
    {
        $data = request()->input();
//      dd($data);
        $res = \DB::table('navbarf')->where(['navf_id'=>$data['navf_id']])->update($data);
//        dd($res);
        if($res){
            $data= [
                'code'=>200,
                'msg'=>'底部导航栏数据修改成功！',
                'data'=>[]
            ];
            return json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            $data= [
                'code'=>105,
                'msg'=>'你没修改！你点啥！',
                'data'=>[]
            ];
            return json_encode($data,JSON_UNESCAPED_UNICODE);
        }
    }
}
