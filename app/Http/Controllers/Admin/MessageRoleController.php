<?php
namespace App\Http\Controllers\Admin;

use App\Entity\MessageSendHistory;
use Illuminate\Http\Request;
use App\Entity\Message;
use App\Models\MailClass;
use App\Entity\MessageRole;
use DB;

/*
 * 信息管理
 */
class MessageRoleController extends CommonController
{
    /*
     * 信息列表
     */
    public function index(Request $request,$id='')
    {
        $data = DB::table('message')
            ->join('message_role', 'message_role.message_id', '=', 'message.id')
            ->join('admin_users_info', 'admin_users_info.id', '=', 'message_role.user_role_id')
            ->select('message_role.*', 'admin_users_info.nickname', 'message.title', 'message.id as email_id')
            ->where(function($query) use($request){
                $starttime = $request->input('startdate');
                $endtime = $request->input('enddate');
                $status = $request->input('status');
                $keyword = $request->input('keyword');
                $user_id = $request->session()->get('user')->id;
                if (!empty($starttime) && !empty($endtime)) {
                    $query->where('message_role.created_at', '>=', $starttime)
                        ->where('message_role.created_at', '<=', $endtime);
                } else if (!empty($starttime)) {
                    $query->where('message_role.created_at', '>=', $starttime);
                } else if (!empty($endtime)) {
                    $query->where('message_role.created_at', '<=', $endtime);
                }
                if(!empty($status)){
                    $query->where('message_role.status',$status);
                }
                if(!empty($keyword)){
                    $query->where('message.title', 'like', '%'.$keyword.'%');
                }
                $query->where('message.user_id', $user_id);
            })
            ->groupBy('message_role.message_id')//去重查询
            ->paginate(20);
      
        //ajax 刷新右边数据
        if($_POST){
            $message =  DB::table('message_role')
                ->join('message', 'message.id', '=', 'message_role.message_id')
                ->join('admin_users_info', 'admin_users_info.id', '=', 'message_role.user_role_id')
                ->select('message_role.*', 'admin_users_info.nickname', 'message.title', 'message.id as email_id')
                ->where(function($query) use($id){
                    $query->where('message_role.message_id',$id);
                })
                ->get();
            $arr = [
                'status' => 1,
                'info' => $message,
            ];
            return $arr;
        }else{
            return view('admin.messageRole.index',['data'=>$data,'page'=>$data->links()]);
        }
    }


    /*
     * 删除记录
     */
    public function deleteMessageRole(Request $request,$id)
    {
        $message = MessageRole::findOrFail($id);
        $message->delete();
        return $this->return_ajax('1','/admin/message/messageRole','成功！');
    }

}
?>