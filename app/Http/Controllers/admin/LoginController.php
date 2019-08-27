<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
class LoginController extends Controller
{
    /**
     * 用户登录
     */

    public function login()
    {
        return view('admin/login');
    }

    /**
     * 用户登录 执行
     */

    public function loginDo()
    {
        $data= request()->input();
        $admin_name = $data['admin_name'];
        $admin_pwd = $data['admin_pwd'];
        if(empty($admin_name) || empty($admin_pwd)){
            $data = [
                'code'=>'106',
                'msg'=>'请填入登录信息！',
                'data'=>[]
            ];
            return json_encode($data,JSON_UNESCAPED_UNICODE);die;
        }
        $adminInfo = \DB::table('admin')->where(['admin_name'=>$admin_name])->first();
//        dd($adminInfo);
        if(empty($adminInfo)){
            $data = [
                'code'=>'104',
                'msg'=>'还没注册呢啊！亲！',
                'data'=>[]
            ];
            return json_encode($data,JSON_UNESCAPED_UNICODE);die;
        }else if($admin_pwd != $adminInfo->admin_pwd){
            $data = [
                'code'=>'105',
                'msg'=>'密码错误了啊！亲！',
                'data'=>[]
            ];
            return json_encode($data,JSON_UNESCAPED_UNICODE);die;
        }else{
            Redis::set('userinfo',$adminInfo->admin_id);
            $data = [
                'code'=>'200',
                'msg'=>'来了，老弟！',
                'data'=>[]
            ];

//            session('userInfo',$adminInfo);
            return json_encode($data,JSON_UNESCAPED_UNICODE);die;
        }

    }


    /**
     * 用户注册
     */

    public function register()
    {
        return view('admin/register');
    }

    /**
     * 用户注册 执行
     */

    public function registerDo()
    {
        $data = request()->input();
//        var_dump($data);
        $admin_pwd = $data['admin_pwd'];
        $admin_pwd2 = $data['admin_pwd2'];
        if(empty($data['admin_name']) || empty($data['admin_email']) || empty($data['admin_tel']) || empty($data['admin_pwd']) || empty($data['admin_pwd2'])){
            $data = [
                'code'=>'106',
                'msg'=>'请填入注册信息 ！',
                'data'=>[]
            ];
            return json_encode($data,JSON_UNESCAPED_UNICODE);die;
        }
        if($admin_pwd != $admin_pwd2){
           $data = [
               'code'=>'104',
               'msg'=>'两次密码请保持一致！',
               'data'=>[]
           ];
           return json_encode($data,JSON_UNESCAPED_UNICODE);die;
        }
      $adminInfo = \DB::table('admin')->where(['admin_name'=>$data['admin_name']])->first();
//        dd($adminInfo);
        unset($data['admin_pwd2']);
        $data['create_time']=time();
      if(!empty($adminInfo)){
          $data = [
              'code'=>'105',
              'msg'=>'该用户已经注册了！',
              'data'=>[]
          ];
          return json_encode($data,JSON_UNESCAPED_UNICODE);die;
      }else{
          $res = \DB::table('admin')->insert($data);
          if($res){
              $data=[
                  'code'=>'200',
                  'msg'=>'注册成功！',
                  'data'=>[]
              ];
              return json_encode($data,JSON_UNESCAPED_UNICODE);die;
          }
      }

    }


    /**
     * 用户修改密码
     */

    public function updatepwd()
    {
        return view('admin/updatepwd');
    }

    /**
     * 发送邮件
     */

    public function sendemail()
    {
        $admin_tel = request()->input('admin_tel');
        $adminId =Redis::get('userinfo');
        $adminInfo = \DB::table('admin')->where(['admin_id'=>$adminId])->first();
//        dd($adminInfo);
        if($admin_tel != $adminInfo->admin_tel){
            $data=[
                'code'=>'104',
                'msg'=>'请确认手机号是否正确！',
                'data'=>[]
            ];
            return json_encode($data,JSON_UNESCAPED_UNICODE);die;
        }
        //阿里云 短信发送 PHP
        $code = mt_rand(1111,9999);
        Redis::set('phone',$admin_tel);
        Redis::set('code',$code);
        Redis::expire('code',60);
        $host = "http://dingxin.market.alicloudapi.com";
        $path = "/dx/sendSms";
        $method = "POST";
        $appcode = "19d24fa715164b58bb5a38de8b178609";
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "mobile=$admin_tel&param=code%3A$code&tpl_id=TP1711063";
        $bodys = "";
        $url = $host . $path . "?" . $querys;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        $data = curl_exec($curl);
//        var_dump($data);die;
        $arr = json_decode($data,true);
//        var_dump($arr);
        if($arr['return_code']==00000){
            $data=[
                'code'=>'200',
                'msg'=>'短信发送成功！验证码在一分钟内有效！',
                'data'=>[]
            ];
            return json_encode($data,JSON_UNESCAPED_UNICODE);die;
        }else{
            $data=[
                'code'=>'105',
                'msg'=>'短信发送失败！',
                'data'=>[]
            ];
            return json_encode($data,JSON_UNESCAPED_UNICODE);die;
        }

    }

    /**
     * 用户修改密码 执行
     */

    public function uppwdDo()
    {
        $data = request()->input();
//        dd($data);
        $admin_tel = $data['admin_tel'];
        $admin_pwd= $data['admin_pwd'];
        $admin_npwd = $data['admin_npwd'];
        $admin_npwd2 = $data['admin_npwd2'];
        $code = $data['admin_code'];
        $rcode = Redis::get('code');
        $rtel = Redis::get('phone');
        if($admin_tel != $rtel){
            $data=[
                'code'=>'105',
                'msg'=>'请使用正确的手机号！',
                'data'=>[]
            ];
            return json_encode($data,JSON_UNESCAPED_UNICODE);die;
        }

        if(empty($rcode)){
            $data=[
                'code'=>'106',
                'msg'=>'验证码已经失效！请在一分钟内填写！',
                'data'=>[]
            ];
            return json_encode($data,JSON_UNESCAPED_UNICODE);die;
        }else if ($code != $rcode){
            $data=[
                'code'=>'107',
                'msg'=>'请输入正确的验证码！',
                'data'=>[]
            ];
            return json_encode($data,JSON_UNESCAPED_UNICODE);die;
        }
        $adminId =Redis::get('userinfo');
        $adminInfo = \DB::table('admin')->where(['admin_id'=>$adminId])->first();
//        dd($adminInfo);
        if($admin_pwd != $adminInfo->admin_pwd){
            $data=[
                'code'=>'108',
                'msg'=>'原密码输入错误了啊！',
                'data'=>[]
            ];
            return json_encode($data,JSON_UNESCAPED_UNICODE);die;
        }
        if($admin_npwd != $admin_npwd2){
            $data=[
                'code'=>'109',
                'msg'=>'新密码请确认一致！',
                'data'=>[]
            ];
            return json_encode($data,JSON_UNESCAPED_UNICODE);die;
        }else{
            $admin_pwd = [
                'admin_pwd'=>$admin_npwd
            ];
            $res = \DB::table('admin')->where(['admin_id'=>$adminId])->update($admin_pwd);
            if($res){
                $data=[
                    'code'=>'200',
                    'msg'=>'祝贺你！密码修改成功！',
                    'data'=>[]
                ];
                return json_encode($data,JSON_UNESCAPED_UNICODE);
            }
        }



    }

    /**
     * 用户退出 登录
     */

    public function loginOut()
    {
           $res =  Redis::del('userinfo');
           if($res == 1){
               echo "<script>alert('退出登录成功！请点击跳转！');location.href='/'</script>";
           }



    }

    /**
     * 后台 首页
     */

    public function index()
    {
        $data = Redis::get('userinfo');
//        dd($data);
        if($data == ''){
        echo "<script>alert('您还没登录！请先登录！');location.href='/'</script>";
    }
        return view('admin/index');
    }
}
