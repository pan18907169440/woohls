<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\CommonController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect;
use DB;
use App\Entity\AdverRunning;

class IndexController extends CommonController
{

    public function index(Request $request)
    {
        $data = DB::table('message')
            ->join('message_role', 'message_role.message_id', '=', 'message.id')
            ->join('admin_users_info', 'admin_users_info.id', '=', 'message_role.user_role_id')
            ->select('message_role.*', 'admin_users_info.nickname', 'message.title', 'message.id as email_id')
            ->groupBy('message_role.message_id')//去重查询
            ->where(function($query) use($request){
                $user = $request->session()->get('user');
                if(!empty($user)) {
                    $user_id = $request->session()->get('user')->id;
                    $query->where('message.user_id', $user_id);
                }
            })
            ->paginate(20);

        $user = DB::table('admin_users_login')
            ->join('admin_users_info', 'admin_users_info.id', '=', 'admin_users_login.user_id')
            ->select('admin_users_login.*', 'admin_users_info.nickname')
            ->orderBy('admin_users_login.last_login_time','desc')
            ->paginate(50);
        return view('admin.index.index',['data'=>$data,'user'=>$user]);
    }
}

?>