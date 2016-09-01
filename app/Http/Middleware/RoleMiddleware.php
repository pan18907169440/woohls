<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * 判断当前用户是否能够访问当前url
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        //parent::registerPolicies($gate);
        if(!empty(session('user'))){
            $permissions = \App\Entity\AdminPermission::with('roles')->get();

            $userid = session('user')->id;//获取用户session id
            $user = Auth::loginUsingId($userid);

            $url = Request::path();//获取当前路由
            $url = explode("/",$url);
            $url = '/'.$url['0'].'/'.$url['1'].'/'.$url['2'];//组装3层路由

            $link_url = new \App\User;
            $link_url = $link_url->roleUrl($userid);//查询用户所拥有的权限

            if (!empty($link_url)){
                foreach ($link_url as $link_url) {
                    $url_array[] = $link_url->name;
                }
                //将系统默认的菜单排除在外
                $sys_url = [
                    '0'=>'/admin/public/login',
                    '1'=>'/admin/public/logout',
                    '2'=>'/admin/index/index',
                ];
                $arr_url = array_merge($url_array, $sys_url);
                if(in_array($url,$arr_url)){//判断用户是否拥有当前访问权限
                    /* foreach ($permissions as $permission) {
                         $gate->define($permission->name, function($user) use ($permission) {
                             return $user->hasPermission($permission);
                          });
                     }*/
                    $response = $next($request);
                    return $response;
                }else{
                    $title = '该账号没有权限访问该链接，请联系管理员！';
                    if(Request::ajax()){
                        $arr = [
                            'status' =>  '0',
                            'info'   =>  $title,
                            'url'    =>  '/errors/503',
                        ];
                        return $arr;
                    }else{
                        return response()->view('errors.503', ['expection' => $title], 500);
                    }
                }
            }else{
                $response = $next($request);
                return $response;
            }
            //dd($link_url);

        }else{
            $response = $next($request);
            return $response;
        }


      /* $permissions = \App\Entity\AdminPermission::with('roles')->get();

       $userid = session('user')->id;//获取用户session id
       // dd($userid);
       $user = Auth::loginUsingId($userid);

       $url = Request::path();//获取当前路由
       $url = explode("/",$url);
       $url = $url['0'].'/'.$url['1'].'/'.$url['2'];//组装3层路由



       $link_url = new \App\User;
       $link_url = $link_url->roleUrl($userid);//查询用户所拥有的权限
       //dd($link_url);
      foreach ($link_url as $link_url) {
           $url_array[] = $link_url->name;
       }
       if(in_array($url,$url_array)){//判断用户是否拥有当前访问权限
           foreach ($permissions as $permission) {
                $gate = new \Illuminate\Contracts\Auth\Access\Gate;
                $gate->define($permission->name, function($user) use ($permission) {
                   return $user->hasPermission($permission);
                });
           }
           $response = $next($request);

           // 执行动作

           return $response;
       }else{
           return response()->view('errors.503', ['expection' => "该账号没有权限访问该链接，请联系管理员！"], 500);
       }*/
    }

}
