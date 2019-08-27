@extends('first.first')
@section('title','展示')

@section('content')
              <h3 style="margin-left:300px">用户修改密码</h3>
              <form class="form-horizontal"style="margin-left:300px">
                  <div class="control-group">
                      <label class="control-label" for="inputEmail" >手机号</label>
                      <div class="controls">
                          <input type="text"  placeholder="手机号" id="admin_tel">
                          <button type="button" class="btn" id="code">获取验证码</button>
                      </div>
                  </div>
                  <div class="control-group">
                      <label class="control-label" for="inputEmail">验证码</label>
                      <div class="controls">
                          <input type="text" id="admin_code" placeholder="验证码">
                      </div>
                  </div>
                  <div class="control-group">
                      <label class="control-label" for="inputPassword" >原始密码</label>
                      <div class="controls">
                          <input type="password"  id="admin_pwd" placeholder="Password">
                      </div>
                  </div>
                  <div class="control-group">
                      <label class="control-label" for="inputPassword" >新密码</label>
                      <div class="controls">
                          <input type="password"  id="admin_npwd" placeholder="Password">
                      </div>
                  </div>
                  <div class="control-group">
                      <label class="control-label" for="inputPassword" >确认密码</label>
                      <div class="controls">
                          <input type="password"  id="admin_npwd2" placeholder="Password">
                      </div>
                  </div>
                  <div class="control-group" style="margin-top:30px">
                      <div class="controls">
                          <button type="button" id="btn" class="btn btn-success ">确认修改</button>
                      </div>
                  </div>
              </form>

              <script>
                  $('#code').click(function(){
                     // alert(1111111);
                      var admin_tel = $('#admin_tel').val();
                      // alert(admin_tel);
                      var data={admin_tel:admin_tel};
                      $.ajax({
                         url:'/admin/sendemail',
                         method:'post',
                         dataType:'json',
                         data:data,
                         success:function(res){
                             // console.log(res);
                             if(res.code==200){
                                 alert(res.msg);
                             }else{
                                 alert(res.msg);
                             }
                         }
                      });
                  });

                  $('#btn').click(function(){
                     // alert(111111);
                      var admin_tel = $('#admin_tel').val();
                      var admin_code = $('#admin_code').val();
                      var admin_pwd = $('#admin_pwd').val();
                      var admin_npwd = $('#admin_npwd').val();
                      var admin_npwd2 = $('#admin_npwd2').val();
                      var data = {admin_tel:admin_tel,admin_pwd:admin_pwd,admin_npwd:admin_npwd,admin_npwd2:admin_npwd2,admin_code:admin_code};
                      $.ajax({
                          url:'/admin/uppwdDo',
                          method:'post',
                          data:data,
                          dataType:'json',
                          success:function(res){
                              // console.log(res);
                              if(res.code == 200){
                                  alert(res.msg);
                                  location.href='/';
                              }else{
                                  alert(res.msg);
                              }
                          }
                      });
                  });
              </script>
@endsection