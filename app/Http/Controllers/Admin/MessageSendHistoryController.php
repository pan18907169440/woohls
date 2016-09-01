<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Entity\MessageSendHistory;
use App\Entity\Message;

use DB;

/*
 * 信息发送记录
 */
class MessageSendHistoryController extends CommonController
{
    /*
     * 记录列表
     */
    public function index(Request $request)
    {
        $data = DB::table('message_send_history')
            ->join('message', 'message.id', '=', 'message_send_history.email_id')
            ->select( 'message_send_history.*','message.title as message_title')
            ->where(function($query) use($request){
                $starttime = $request->input('startdate');
                $endtime = $request->input('enddate');
                $keyword = $request->input('keyword');
                $user_id = $request->session()->get('user')->id;
                if (!empty($starttime) && !empty($endtime)) {
                    $query->where('message_send_history.created_at', '>=', $starttime)
                        ->where('message_send_history.created_at', '<=', $endtime);
                } else if (!empty($starttime)) {
                    $query->where('message_send_history.created_at', '>=', $starttime);
                } else if (!empty($endtime)) {
                    $query->where('message_send_history.created_at', '<=', $endtime);
                }
                if (preg_match("/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i",$keyword)){
                    $query->where('message_send_history.user', '=', $keyword);
                }else{
                    $query->where('message.title', 'like', '%'.$keyword.'%');
                }
                $query->where('message.user_id', $user_id);
            })
            ->paginate(20);
        return view('admin.messageSendHistory.index',['data'=>$data,'page'=>$data->links()]);
    }


    /*
     * 删除记录
     */
    public function deleteMessageSendHistory(Request $request,$id)
    {
        $user = MessageSendHistory::findOrFail($id);
        $user->delete();
        return $this->return_ajax('1','/admin/message/messageSendHistory','成功！');
    }


    /*
     * 邮件详情
     */
    public function messageInfo(Request $request,$id)
    {
        $message = Message::findOrFail($id);
        return view('admin.messageSendHistory.email_info',['message'=>$message]);
    }
}
?>