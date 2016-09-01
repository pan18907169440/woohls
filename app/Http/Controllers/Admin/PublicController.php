<?php

namespace App\Http\Controllers\Admin;

use App\Entity\AdminRole;
use App\Entity\AdminUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Redirect;
use App\Http\Controllers\Admin\CommonController;
use App\Entity\AdminUsersLogin;
use DB;

class PublicController extends Controller
{
    /*
     * 密码加密
     */
    public function pd_md5($password)
    {
        $password = config('app.key').$password.'yihulian';
        return MD5($password);
    }

    /*
     * 返回ajax结果
     */
    public function return_ajax($status,$url,$info)
    {
        $arr = [
            'status' => $status,
            'url' => $url,
            'info' => $info,
        ];
        return $arr;
    }
    /*
     * 管理员登录
     */
    public function login(Request $request)
    {
        if($_POST){
            $username       = $request->input('username');
            $password       = $this->pd_md5($request->input('password'));
            $validate_code  = $request->input('validate_code');

            $validate_code_session = $request->session()->get('validate_code','');
            if($validate_code_session != $validate_code)
            {
                return $this->return_ajax('0','/admin/public/login','验证码不正确!');
            }

            $validator = Validator::make($request->all(), [
                'username'      =>'required',
                'password'      =>'required',
            ]);

            if ($validator->passes())
            {
                $user = DB::table('admin_users')
                    ->where('username',$username)
                    ->where('status','1')
                    ->first();
                if(empty($user)){
                    return $this->return_ajax('0','/admin/public/login','该账号被冻结，请联系管理员');
                }
                if ($username == $user->username)
                {
                    if($password == $user->password)
                    {
                        $request->session()->put('user',$user);

                        $user_login = new AdminUsersLogin;
                        $user_login->user_id            = $user->id;
                        $user_login->last_login_ip      = $request->getClientIp();
                        $user_login->last_login_time    = date('Y-m-d H:i:s');
                        $user_login->save();

                        return $this->return_ajax('1','/admin/index/index','欢迎登录');
                    }else{
                        return $this->return_ajax('0','/admin/public/login','密码不正确');
                    }
                }else{
                    return $this->return_ajax('0','/admin/public/login','用户名不存在!');
                }
            }else{
                return $this->return_ajax('0','/admin/public/login',$validator);
            }
        }else{
            $site = $request->session()->get('user');
            if(empty($site)) {
                return view('admin.public.login');
            }else{
                return Redirect::to('/admin/index/index');
            }
        }
    }


    /*
     * 管理员退出
     */
    public function getLogout(Request $request)
    {
        $site = $request->session()->get('user');
        if(!empty($site)) {
            $request->session()->forget('user');
            return Redirect::to('/admin/public/login')->with('message','你现在已经退出登录了!');
        }else{
            return Redirect::to('/admin/public/login')->with('message','已经退出登录了!');
        }

    }
    
}
