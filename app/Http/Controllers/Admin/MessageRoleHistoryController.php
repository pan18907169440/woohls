<?php
namespace App\Http\Controllers\Admin;

use App\Entity\MessageSendHistory;
use Illuminate\Http\Request;
use App\Entity\Message;
use App\Models\MailClass;
use App\Entity\MessageRole;
use DB;


class MessageRoleHistoryController extends CommonController
{
    /*
     * //用户能够查看到的信息列表
     */
    public function index(Request $request)
    {
        $data =  DB::table('message_role')
            ->join('message', 'message.id', '=', 'message_role.message_id')
            ->join('admin_users_info', 'admin_users_info.id', '=', 'message_role.user_role_id')
            ->select('message_role.*', 'admin_users_info.nickname', 'message.title', 'message.file_url', 'message.file_id', 'message.id as email_id')
            ->orderBy('message_role.created_at','desc')
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
                $query->where('message_role.user_role_id', $user_id);
            })
            ->paginate(20);

        foreach ($data AS $value){
            if(!empty($value->file_url)){
                $file_url = explode(',',$value->file_url);
                $file_id = explode(',',$value->file_id);
                foreach ($file_url AS  $key=>$value2){
                    $file_urls[$key]['url'] = $file_url[$key];
                    $file_urls[$key]['file_id'] = $file_id[$key];
                }
                $value->file_id = $file_urls;
            }
        }

        $message =  DB::table('message_role')
            ->join('message', 'message.id', '=', 'message_role.message_id')
            ->join('admin_users_info', 'admin_users_info.id', '=', 'message_role.user_role_id')
            ->select('message_role.*', 'admin_users_info.nickname', 'message.title', 'message.id as email_id', 'message.body as message_body')
            ->orderBy('message_role.created_at','desc')
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
                $query->where('message_role.user_role_id', $user_id);
            })
            ->first();
        return view('admin.messageRoleHistory.index',['data'=>$data,'page'=>$data->links(),'message'=>$message]);
    }


    /*
     * 查看信息
     */
    public function messageRoleHistoryRead(Request $request,$id)
    {
        $message = Message::findOrFail($id);

        //将当前未查看的信息的状态，改为已查看
        DB::table('message_role')
            ->where(function($query) use($id,$request){
                $user_id = $request->session()->get('user')->id;

                $query->where('step','2');
                $query->where('message_id',$id);
                $query->where('user_role_id', $user_id);
            })
            ->update(['step' => 1,'updated_at'=>date('Y-m-d H:i:s')]);
        $arr = [
            'status' => 1,
            'info' => $message->body,
        ];
        if ($_POST){
            return $arr;
        }else{
            return view('admin.messageSendHistory.email_info',['message'=>$message]);
        }

    }
    /*
     * 删除记录
     */
    public function deleteMessageRole(Request $request,$id)
    {
        $message = MessageRole::findOrFail($id);
        $message->delete();
        return $this->return_ajax('1','/admin/message/messageRoleHistory','成功！');
    }

}
?>