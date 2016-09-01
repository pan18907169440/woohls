<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;
use DB;

class AdminRole extends Model
{
    protected $table = 'admin_roles';

    public function permissions()
    {
        return $this->belongsToMany(AdminPermission::class,'permission_role','role_id','permission_id');
    }
//给角色添加权限
    public function givePermissionTo($permission)
    {
        return $this->permissions()->save($permission);
    }


}
?>