<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Entity\AdminPermission;
use App\Entity\AdminRole;
use App\Entity\AdminUsers;
use DB;
/*
 * 用户权限管理
 */
class PermissionController extends CommonController
{
    /*
     * 权限列表
     */
    public function index()
    {
       // $admin_permission = new AdminPermission;
        $data =  DB::table('admin_permissions')
            ->where('parent_id','0')
            ->orderBy('sort','asc')
            ->get();
        foreach ($data AS $value)
        {
            $value->sub = DB::table('admin_permissions')
                ->where('parent_id',$value->id)
                ->orderBy('sort','asc')
                ->get();
            foreach ($value->sub AS $value2)
            {
                $value2->sub2 = DB::table('admin_permissions')
                    ->where('parent_id',$value2->id)
                    ->orderBy('sort','asc')
                    ->get();
            }
        }
        return view('admin.permission.index',['data'=>$data]);
    }

    /*
     * 添加权限
     */
    public function addPremission(Request $request)
    {
        if($_POST){
            $permission_add = new AdminPermission;
            $permission_add->parent_id       = $request->input('pid');
            $permission_add->name            = $request->input('name');
            $permission_add->icon            = $request->input('icon');
            $permission_add->display_name    = $request->input('display_name');
            $permission_add->sort               = $request->input('sort');

            $permission_add->save();
            return $this->return_ajax('1','/admin/admin/permission','成功！');
        }else{
            $role = DB::table('admin_permissions')
                ->where('parent_id','0')
                ->get();
            foreach ($role AS $value) {
                $value->sub = DB::table('admin_permissions')
                    ->where('parent_id', $value->id)
                    ->orderBy('sort', 'asc')
                    ->get();
            }
            return view('admin.permission.add_permission',['role'=>$role]);
        }
    }

    /*
     * 编辑菜单
     */
    public function editPermission(Request $request,$id)
    {
        if($_POST) {
            $permission_edit = AdminPermission::findOrFail($id);
            $permission_edit->parent_id       = $request->input('pid');
            $permission_edit->name            = $request->input('name');
            $permission_edit->icon            = $request->input('icon');
            $permission_edit->display_name    = $request->input('display_name');
            $permission_edit->sort              = $request->input('sort');

            $permission_edit->save();
            return $this->return_ajax('1','/admin/admin/permission','成功！');
        }else{
            $permission = AdminPermission::findOrFail($id);
            $role = DB::table('admin_permissions')
                ->where('parent_id','0')
                ->orderBy('sort', 'asc')
                ->get();
            foreach ($role AS $value) {
                $value->sub = DB::table('admin_permissions')
                    ->where('parent_id', $value->id)
                    ->orderBy('sort', 'asc')
                    ->get();
            }
            return view('admin.permission.edit_permission',['permission'=>$permission,'role'=>$role]);
        }
    }

    /*
     * 修改菜单状态
     */
    public function permissionStatus(Request $request,$id,$status)
    {
        $admin = AdminPermission::findOrFail($id);
        $admin->status = $status;
        $admin->save();
        return $this->return_ajax('1','/admin/admin/permission','成功！');
    }

    /*
    * 删除菜单
    */
    public function deletePermission($id)
    {
        $permission = AdminPermission::findOrFail($id);
        $permission->delete();
        return $this->return_ajax('1','/admin/admin/permission','成功！');
    }
}
?>