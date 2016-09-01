<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Redirect;
use Session;
use DB;
use App\Entity\MessageSendHistory;
use App\Http\Controllers\Controller;
use Cookie;
use Illuminate\Http\Response;

class CommonController extends Controller
{

    public function __construct(Request $request)
    {
        //判断用户登录
         $this->check_login($request);
        //系统菜单
        $this->take_menu($request);
        //判断用户访问cookie_id
        $this->user_cookie($request);
        //消息历史记录查看
        $this->message_history($request);

    }

    /*
     * 密码加密
     */
    public function pd_md5($password)
    {
        $password = config('app.key').$password.'yihulian';
        return MD5($password);
    }

    /*
     * 判断用户是否登录
     */
    public function check_login(Request $request)
    {
        $site = $request->session()->get('user');
        $addr =  $_SERVER['SERVER_NAME'];
        if(empty($site)) {
            header('Location:http://'.$addr.'/admin/public/login');
        }else{
            return Redirect::to('/admin/index/index');
        }
    }

    /*
     * 显示系统菜单
     */
    public function take_menu(Request $request)
    {
        //系统菜单
        $menu = DB::table('admin_permissions')
            ->where('parent_id','0')
            ->orderBy('sort', 'asc')
            ->where('status', '1')
            ->get();
        foreach ($menu AS $value) {
            $value->sub = DB::table('admin_permissions')
                ->where('parent_id', $value->id)
                ->orderBy('sort', 'asc')
                ->where('status', '1')
                ->get();
        }
        //获取当前访问菜单
        $url = $request->path();//获取当前路由
        $url = explode("/",$url);
        $now_menu = '/'.$url['0'].'/'.$url['1'];//组装3层路由
        $sub_menu = '/'.$url['0'].'/'.$url['1'].'/'.$url['2'];//组装3层路由
        return view()->share(['menu'=>$menu,'now_menu'=>$now_menu,'sub_menu'=>$sub_menu]);
    }

    /*
     * 返回ajax结果
     */
    public function return_ajax($status,$url,$info)
    {
        $arr = [
            'status'    => $status,
            'url'       => $url,
            'info'      => $info,
        ];
        return $arr;
    }

    /*
     * 记录访问用户的cookie_id
     */
    public function user_cookie(Request $request)
    {
        $cookie_id = $request->cookie('cookie_id');
        if($cookie_id == null){
            $num = md5('yihulian'.time().mt_rand(1,10000000));
            //dd($num);
            Cookie::queue('cookie_id',$num, 1000);
        }
    }

    public function message_history(Request $request)
    {
        $user_id = $request->session()->get('user');
        if(!empty($user_id)){
            $data = DB::table('message_role')
                ->join('message', 'message.id', '=', 'message_role.message_id')
                ->join('admin_users_info', 'admin_users_info.id', '=', 'message_role.user_role_id')
                ->select('message_role.*', 'admin_users_info.nickname', 'message.title', 'message.id as email_id')
                ->orderBy('message_role.created_at','desc')
                ->where(function($query) use($request){
                    $user_id = $request->session()->get('user')->id;
                    $query->where('message_role.user_role_id', $user_id);
                    $query->where('message_role.step', '2');
                })
                ->paginate(50);
            return view()->share(['message_data'=>$data,'message_count'=>$data->count()]);
        }

    }



}
