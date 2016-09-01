<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;
use DB;

class AdminPermission extends Model
{

    protected $table = 'admin_permissions';

    public function roles()
    {
        return $this->belongsToMany(AdminRole::class,'permission_role','permission_id','role_id');
    }
}
