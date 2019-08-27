<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImgController extends Controller
{
    /**
     * 轮播图 添加
     */
    public function img()
    {
        return view ('admin/img');
    }
    /*
     * 轮播图 添加 执行
     */
    public function imgDo()
    {
        $data =request()->input();
//        dd($data);
        if(request()->hasFile('img')){
            $res = $this->upload('img');
//            dd($res);
            if($res['code'] == 1 && $data['navbar'] == 1) {
//                  echo 111111;die;
                $data['car_url']=$res['imgurl'];
                unset($data['navbar']);
                $res = \DB::table('carousel')->insert($data);
                if($res){
                    return redirect('admin/imglist');
//                    echo 11111;
                }
              }else if($res['code'] == 1 && $data['navbar'] == 2){
//                echo 222222;die;
                $data['car2_url']=$res['imgurl'];
                unset($data['navbar']);
                $res = \DB::table('carousel2')->insert($data);
                if($res){
                    return redirect('admin/imglist');
//                    echo 22222;
                }
              }
            }
        }

    public function upload($file)
    {
        if( request()->file($file)->isValid() ){
            $photo=request()->file($file);
            $data=$photo->store(date('Ymd'));
            return ['code'=>1,'imgurl'=>$data];
        }else{
            return ['code'=>2,'message'=>'失败'];
        }
    }

    /**
     * 轮播图  列表
     */

    public function imglist()
    {
         $data = \DB::table('carousel')->where(['del'=>1])->paginate(2);
         $dataf = \DB::table('carousel2')->where(['del'=>1])->paginate(2);
        return view('admin/imglist',['data'=>$data,'dataf'=>$dataf]);
    }

    /**
     * 轮播图 删除
     */

    public function imgdel()
    {
        if($id= request()->car_id){
            $data  = \DB::table('carousel')->where(['car_id'=>$id])->update(['del'=>2]);
//            var_dump($data);
            if ($data){
                $data= [
                    'code'=>102,
                    'msg'=>'顶部轮播图删除数据成功',
                    'data'=>[]
                ];
                return json_encode($data,JSON_UNESCAPED_UNICODE);
            }
        }
        if($id2= request()->car2_id){

//            var_dump($id2);die;
            $data  = \DB::table('carousel2')->where(['car2_id'=>$id2])->update(['del'=>2]);

//            var_dump($data);
            if($data){
                $data= [
                    'code'=>103,
                    'msg'=>'底部轮播图删除数据成功',
                    'data'=>[]
                ];
                return json_encode($data,JSON_UNESCAPED_UNICODE);
            }
        }
    }
}
