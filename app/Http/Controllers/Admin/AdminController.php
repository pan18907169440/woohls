<?php
namespace App\Http\Controllers\Admin;

use App\Entity\AdminUserRole;
use Illuminate\Http\Request;
use App\Entity\AdminPermission;
use App\Entity\AdminRole;
use App\Entity\AdminUsers;
use App\Entity\AdminUsersInfo;

use DB;

/*
 * 管理员管理
 */
class AdminController extends CommonController
{
    /*
     * 
     */
    public function index(Request $request)
    {
        $data = DB::table('admin_users')
            ->join('admin_users_info','admin_users_info.id','=','admin_users.id')
            ->select('admin_users.*','admin_users_info.*')
            ->paginate(20);

        return view('admin.admin.index',['data'=>$data,'page'=>$data->links()]);
    }

    /*
     * 添加管理员
     */
    public function addAdmin(Request $request)
    {
        if($_POST){
            $admin_add = new AdminUsers;
            $admin_add->username    = $request->input('username');
            $admin_add->password    = $this->pd_md5($request->input('password'));

            $admin_info = new AdminUsersInfo;
            $admin_info->email       = $request->input('email');
            $admin_info->nickname    = $request->input('nickname');


            DB::transaction(function() use($admin_add,$admin_info,$request)
            {
                //添加用户账号
                $admin_add->save();
                //添加用户账号信息
                $admin_info->save();
                //添加用户至用户组
                $roleId = $request->input('roleId');
                foreach ($roleId AS $value)
                {
                    $admin_add->assignRole($value);
                }

            });
            return $this->return_ajax('1','/admin/admin/index','成功！');

        }else{

            $role = DB::table('admin_roles')
                ->where('parent_id','0')
                ->where('status', '1')
                ->orderBy('sort','asc')
                ->get();

            foreach ($role AS $value)
            {
                $value->sub = DB::table('admin_roles')
                    ->where('parent_id',$value->id)
                    ->where('status', '1')
                    ->orderBy('sort','asc')
                    ->get();
            }

            return view('admin.admin.add_admin',['role'=>$role]);
        }

    }

    /*
     * 编辑管理员
     */
    public function editAdmin(Request $request,$id)
    {
        if($_POST) {
            $admin = AdminUsers::findOrFail($id);
            $admin->username = $request->input('username');
            $admin->save();

            $admin_info = AdminUsersInfo::findOrFail($id);
            $admin_info->email = $request->input('email');
            $admin_info->nickname = $request->input('nickname');
            $admin_info->save();

            $roleId = $request->input('roleId');
            //先删除之前的权限
            DB::table('admin_user_role')->where('admin_user_id',$id)->delete();
            foreach ($roleId AS $value)
            {
                $admin->assignRole($value);
            }
            return $this->return_ajax('1','/admin/admin/index','成功！');
            //return redirect("/admin/admin/index")->withSuccess("成功！");
        }else{
            $admin = AdminUsersInfo::user_info($id);

            $role_id = DB::table('admin_user_role')
                ->where('admin_user_id',$id)
                ->get();

            foreach ($role_id AS $value)
            {
                $roleId[] = $value->role_id;//将用户是权限组装成单个数组
            }

            $role = DB::table('admin_roles')
                ->where('parent_id','0')
                ->where('status', '1')
                ->orderBy('sort', 'ASC')
                ->get();

            foreach ($role AS $value)
            {
                $value->sub = DB::table('admin_roles')
                    ->where('parent_id',$value->id)
                    ->where('status', '1')
                    ->get();
            }
            $roleId = empty($roleId)?[]:$roleId;
            return view('admin.admin.edit_admin',['role'=>$role,'admin'=>$admin,'roleId'=>$roleId]);
        }
    }

    /*
     * 修改管理员密码
     */
    public function editAdminPwd(Request $request,$id)
    {
        if($_POST){
            $admin = AdminUsers::findOrFail($id);
            $newpassword =  $this->pd_md5($request->input('newpassword'));
            //dd($newpassword);
            $password = $request->session()->get('user')->password;
            if($password != $this->pd_md5($request->input('password'))){
                return $this->return_ajax('0','/admin/admin/index','原始密码不正确！');
            }
            if(empty($newpassword)){
                return $this->return_ajax('0','/admin/admin/index','请输入新密码！');
            }
            $admin->password = $newpassword;
            $admin->save();
            return $this->return_ajax('1','/admin/admin/index','成功！');
        }else{
            return view('admin.admin.edit_adminPwd');
        }
    }

    /*
     * 修改管理员账号状态
     */
    public function adminStatus(Request $request,$id,$status)
    {
        $admin = AdminUsers::findOrFail($id);
        $admin->status = $status;
        $admin->save();
        return $this->return_ajax('1','/admin/admin/index','成功！');
    }

    /*
     * 删除管理员
     */
    public function deleteAdmin(Request $request,$id)
    {
        $admin = AdminUsers::findOrFail($id);
        $admin->delete();
        return $this->return_ajax('1','/admin/admin/index','成功！');
    }
}
?>