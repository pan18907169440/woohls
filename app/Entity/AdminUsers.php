<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;
use DB;

class AdminUsers extends Model
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
}
