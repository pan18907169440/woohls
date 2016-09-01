<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;


use App\Entity\AdminPermission;
use App\Entity\AdminRole;
use App\Entity\AdminUserRole;
use App\Entity\AdminUsers;
use DB;

class User extends Authenticatable
{
    protected $table = 'admin_users';

    public function roles()
    {
        return $this->belongsToMany(AdminRole::class,'admin_user_role','admin_user_id','role_id');
    }
// 判断用户是否具有某个角色
    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }

        return !! $role->intersect($this->roles)->count();
    }
// 判断用户是否具有某权限
    public function hasPermission($permission)
    {
        return $this->hasRole($permission->roles);
    }
// 给用户分配角色
    public function assignRole($role)
    {
        return $this->roles()->save(
            AdminRole::whereName($role)->firstOrFail()
        );
    }

    // 访问--判断用户是否具有某f权限
    public function roleUrl($userid)
    {
        //用户所能执行的权限
        $role_id =DB::table('admin_user_role')
            ->join('permission_role', 'admin_user_role.role_id', '=', 'permission_role.role_id')
            ->join('admin_permissions', 'permission_role.permission_id', '=', 'admin_permissions.id')
            ->select('admin_permissions.name')
            ->where('admin_user_role.admin_user_id',$userid)
            ->get();
        return $role_id;
    }

}
