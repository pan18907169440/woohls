<?php
namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Entity\AdminPermission;
use App\Entity\AdminRole;
use App\Entity\AdminUsers;
use DB;
use Illuminate\Support\Facades\Input;

/*
 * 用户角色管理
 */
class RoleController extends CommonController
{

    /*
     * 角色列表
     */
    public function index()
    {
        $data =  DB::table('admin_roles')
            ->where('parent_id','0')
            ->orderBy('sort','asc')
            ->paginate(30);
        foreach ($data AS $value)
        {
            $value->sub = DB::table('admin_roles')
                ->where('parent_id',$value->id)
                ->orderBy('sort','asc')
                ->get();
        }
        return view('admin.role.index',['data'=>$data,'page'=>$data->links()]);
    }

    /*
     * 添加角色
     */
    public function addRole(Request $request)
    {
        if($_POST){
            $role_add = new AdminRole;
            $role_add->parent_id       = $request->input('pid');
            $role_add->name            = $request->input('name');
            $role_add->deccription    = $request->input('deccription');
            $role_add->sort             = $request->input('sort');

            $role_add->save();
            return $this->return_ajax('1','/admin/admin/role','成功！');
        }else{
            $role = DB::table('admin_roles')
                ->where('parent_id','0')
                ->orderBy('sort','asc')
                ->get();
            return view('admin.role.add_role',['role'=>$role]);
        }
    }

    public function editRole(Request $request,$id)
    {
        if($_POST) {
            $role_edit = AdminRole::findOrFail($id);
            $role_edit->parent_id       = $request->input('pid');
            $role_edit->name            = $request->input('name');
            $role_edit->deccription    = $request->input('deccription');
            $role_edit->sort            = $request->input('sort');

            $role_edit->save();
            return $this->return_ajax('1','/admin/admin/role','成功！');
        }else{
            $data = AdminRole::findOrFail($id);
            $role = DB::table('admin_roles')
                ->where('parent_id','0')
                ->orderBy('sort','asc')
                ->get();
            return view('admin.role.edit_role',['data'=>$data,'role'=>$role]);
        }
    }

    /*
    * 删除权限组
    */
    public function deleteRole(Request $request,$id)
    {
        $admin = AdminRole::findOrFail($id);
        $admin->delete();
        return $this->return_ajax('1','/admin/admin/role','成功！');
    }

    /*
     * 修改权限组状态
     */
    public function roleStatus(Request $request,$id,$status)
    {
        $admin = AdminRole::findOrFail($id);
        $admin->status = $status;
        $admin->save();
        return $this->return_ajax('1','/admin/admin/role','成功！');
    }
    /*
     * 给角色分配权限
     */
    public function toPermission($id,Request $request)
    {

        if($_POST){
            $role_admin = AdminRole::find($id);
            $roleId = $request->input('roleId');

            //清空之前的权限，添加新权限
            DB::table('permission_role')->where('role_id',$id)->delete();
            foreach ($roleId AS $value)
            {
                $permission = AdminPermission::find($value);
                $role_admin->givePermissionTo($permission);
            }
            return $this->return_ajax('1','/admin/admin/role','成功！');
        }else {
            $role = AdminRole::find($id);

            $permission = DB::table('admin_permissions')
                    ->where('parent_id', '0')
                    ->orderBy('sort', 'ASC')
                    ->get();

            foreach ($permission AS $value) {
                $value->sub = DB::table('admin_permissions')
                    ->where('parent_id', $value->id)
                    ->get();
                foreach ($value->sub AS $value2) {
                    $value2->sub2 = DB::table('admin_permissions')
                        ->where('parent_id', $value2->id)
                        ->get();
                }
            }
            $permission_id = DB::table('permission_role')
                ->where('role_id',$id)
                ->get();

            foreach ($permission_id AS $value)
            {
                $permissionId[] = $value->permission_id;//将用户是权限组装成单个数组
            }
            $permissionId = empty($permissionId)?[]:$permissionId;
            return view('admin.role.to_permission', ['permission' => $permission, 'id' => $role->id,'permissionId'=>$permissionId]);
        }

    }

}
?>