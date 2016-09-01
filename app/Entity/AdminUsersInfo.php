<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;
use DB;

class AdminUsersInfo extends Model
{

    protected $table = 'admin_users_info';

    protected function user_info($user_id = '')
    {
        return $data = DB::table('admin_users')
                    ->join('admin_users_info','admin_users_info.id','=','admin_users.id')
                    ->select('admin_users.*','admin_users_info.*')
                    ->where(function($query) use($user_id){
                        $query->where('admin_users.id', $user_id);
                    })
                    ->first();
    }

}
