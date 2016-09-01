<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Entity\MessageCategory;
use DB;
/*
 * 信息分类管理
 */
class MessageCategoryController extends CommonController
{
    /*
     * 分类列表
     */
    public function index()
    {
        $data = DB::table('message_category')
            ->where('pid','0')
            ->orderBy('sort','asc')
            ->get();
        foreach ($data AS $value) {
            $value->sub = DB::table('message_category')
                ->where('pid', $value->id)
                ->orderBy('sort','asc')
                ->get();
        }
        return view('admin.messageCategory.index',['data'=>$data]);
    }

    /*
     * 添加分类
     */
    public function addMessageCategory(Request $request)
    {
        if($_POST){
            $cate_add = new MessageCategory;
            $cate_add->pid       = empty($request->input('pid'))?0:$request->input('pid');
            $cate_add->name      = $request->input('name');
            $cate_add->user_id  = $request->session()->get('user')->id;
            $cate_add->sort      = $request->input('sort');

            $cate_add->save();
            return $this->return_ajax('1','/admin/message/messageCategory','成功！');
        }else{
            $cate = DB::table('message_category')
                ->where('pid','0')
                ->orderBy('sort','asc')
                ->get();
            return view('admin.messageCategory.add_messageCategory',['cate'=>$cate]);
        }
    }

    /*
     * 编辑分类
     */
    public function editMessageCategory(Request $request,$id)
    {
        if($_POST) {
            $message_edit = MessageCategory::findOrFail($id);
            $message_edit->pid       = empty($request->input('pid'))?0:$request->input('pid');
            $message_edit->name      = $request->input('name');
            $message_edit->sort     = $request->input('sort');

            $message_edit->save();
            return $this->return_ajax('1','/admin/message/messageCategory','成功！');
        }else{
            $message_cate =  MessageCategory::findOrFail($id);
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
            return view('admin.messageCategory.edit_messageCategory',['message_cate'=>$message_cate,'cate'=>$cate]);
        }
    }

    /*
     * 修改分类状态
     */
    public function messageCategoryStatus(Request $request,$id,$status)
    {
        $message_cate = MessageCategory::findOrFail($id);
        $message_cate->status = $status;
        $message_cate->save();
        return $this->return_ajax('1','/admin/message/messageCategory','成功！');
    }

    /*
    * 删除分类
    */
    public function deleteMessageCategory($id)
    {
        $message_cate = MessageCategory::findOrFail($id);
        $message_cate->delete();
        return $this->return_ajax('1','/admin/message/messageCategory','成功！');
    }
}
?>