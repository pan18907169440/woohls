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
class MessageController extends CommonController
{
    /*
     * 信息列表
     */
    public function index(Request $request)
    {
        $data =  DB::table('message')
            ->join('message_category', 'message.cate_id', '=', 'message_category.id')
            ->select('message.*', 'message_category.name as cate_name')
            ->where(function($query) use($request){
                $cate_id = $request->input('cate_id');
                $keyword = $request->input('keyword');

                $site =  $request->session()->get('user');
                if(!empty($site)){
                    $user_id = $request->session()->get('user')->id;
                    $query->where('message.user_id', $user_id);
                }
                if (!empty($cate_id)) {
                    $query->where('message.cate_id', '=',$cate_id);
                }
                if (!empty($keyword)) {
                    $query->where('message.title', 'like', '%'.$keyword.'%');
                }

            })
            ->get();
        $cate = DB::table('message_category')
            ->where('pid','0')
            ->orderBy('sort','asc')
            ->get();
        foreach ($cate AS $value) {
            $value->sub = DB::table('message_category')
                ->where('pid', $value->id)
                ->orderBy('sort','asc')
                ->get();
        }

        return view('admin.message.index',['data'=>$data,'cate'=>$cate]);
    }

    /*
     * 添加信息
     */
    public function addMessage(Request $request)
    {


        if($_POST){
            $message_add = new Message;
            $message_add->user_id       = $request->session()->get('user')->id;
            $message_add->cate_id       = $request->input('cate_id');
            $message_add->title         = $request->input('title');
            $message_add->body          = $request->input('body');

            $file  = implode(',',$request->input('file_url'));
            $message_add->file_url = $file;

            $file_id  = implode(',',$request->input('file_id'));
            $message_add->file_id = $file_id;

            $message_add->save();
            return $this->return_ajax('1','/admin/message/message','成功！');
        }else{
            $cate = DB::table('message_category')
                ->where('pid','0')
                ->where('status','1')
                ->orderBy('sort','asc')
                ->get();
            foreach ($cate AS $value) {
                $value->sub = DB::table('message_category')
                    ->where('pid', $value->id)
                    ->where('status','1')
                    ->orderBy('sort','asc')
                    ->get();
            }
            return view('admin.message.add_message',['cate'=>$cate]);
        }
    }

    /*
     * 编辑信息
     */
    public function editMessage(Request $request,$id)
    {
        if($_POST) {
            $message_edit = Message::findOrFail($id);
            $message_edit->cate_id       = $request->input('cate_id');
            $message_edit->title         = $request->input('title');
            $message_edit->body          = $request->input('body');

            $file  = implode(',',$request->input('file_url'));
            $message_edit->file_url = $file;

            $file_id  = implode(',',$request->input('file_id'));
            $message_edit->file_id = $file_id;

            $message_edit->save();
            return $this->return_ajax('1','/admin/message/message','成功！');
        }else{
            $message = Message::findOrFail($id);
            $file_url = explode(',',$message->file_url);
            $file_id = explode(',',$message->file_id);
            foreach ($file_url AS  $key=>$value){
                $file_urls[$key]['url'] = $file_url[$key];
                $file_urls[$key]['file_id'] = $file_id[$key];
            }
            $message->file_url = $file_urls;

            //dd($message);

            $cate = DB::table('message_category')
                ->where('pid','0')
                ->where('status','1')
                ->orderBy('sort','asc')
                ->get();
            foreach ($cate AS $value) {
                $value->sub = DB::table('message_category')
                    ->where('pid', $value->id)
                    ->where('status','1')
                    ->orderBy('sort','asc')
                    ->get();
            }
            return view('admin.message.edit_message',['message'=>$message,'cate'=>$cate]);
        }
    }

    /*
     * 修改信息状态
     */
    public function messageStatus(Request $request,$id,$status)
    {
        $message = Message::findOrFail($id);
        $message->status = $status;
        $message->save();
        return $this->return_ajax('1','/admin/message/message','成功！');
    }

    /*
    * 删除信息
    */
    public function deleteMessage($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();
        return $this->return_ajax('1','/admin/message/message','成功！');
    }

    /*
    * 邮件推送
    */
    public function ToUser(Request $request,$id)
    {
        if($_POST){
            $push = $request->input('push');
            $user = $request->input('user');

            if($push == '1'){
                $this->pushEmail($id,$user);//邮件推送
            }else{
                $this->pushMessage($id,$user);//消息推送
            }
            return $this->return_ajax('1','/admin/message/message','成功！');
        }else{
            $message = Message::findOrFail($id);
            $data = DB::table('admin_users_info')->get();

            foreach ($data AS $value){
                $role = DB::table('message_role')
                    ->join('admin_users_info','admin_users_info.id','=','message_role.user_role_id')
                    ->select('admin_users_info.*','message_role.*')
                    ->where(function($query) use($id,$value){
                        $query->where('user_role_id', '=',$value->id);
                        $query->where('message_id', '=',$id);
                    })
                    ->first();
                $value->message_status = (empty($role->id))?'':$role->status;
                $value->message_step = (empty($role->id))?'':$role->step;
                $value->message_created_at = (empty($role->id))?'无':$role->created_at;
                $value->message_updated_at = (empty($role->id))?'无':$role->updated_at;
            }
            return view('admin.message.to_user',['message'=>$message,'data'=>$data]);
        }
    }

    /**
     * @param $id
     * @param $title
     * @param $body
     * @param $user
     * @return int
     * 邮件推送
     */
    public function pushEmail($id,$user)
    {
        $mail = new MailClass;
        foreach ($user AS $value){
            $message = Message::findOrFail($id);

            $value = explode(',',$value);
            $mail->send($value[1],$message->title,$message->body);

            $mail_history = new MessageSendHistory;
            $mail_history->email_id     = $id;
            $mail_history->user_id      = $value[0];
            $mail_history->user_email  = $value[1];
            $mail_history->save();
        }

        return 1;
    }

    public function pushMessage($id,$user)
    {
        DB::table('message_role')->where('message_id',$id)->delete();
        foreach ($user AS $value){
            $value = explode(',',$value);

            $message = new MessageRole;
            $message->message_id     = $id;
            $message->user_role_id   = $value[0];
            $message->save();
        }
        return 1;

    }
    
}
?>