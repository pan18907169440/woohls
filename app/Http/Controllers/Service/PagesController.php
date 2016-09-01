<?php
namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;

/*
 * 数据查询
 */
class PagesController extends Controller
{
    /*
     * 多条数据查询
     */
    public function queryList(Request $request,$table='hospital',$page='0',$lineSize='2',$where=[])
    {
        $table_arr = [
            '0'=>'hospital',
        ];
        if(in_array($table,$table_arr)){
            $results = DB::table($table)->paginate($lineSize)
                ->where(function($query) use($where) {
                    if (!empty($where['status'])) {//医院状态查询
                        $query->where('status','=',$where['status']);
                    }
                    if (!empty($where['name'])) {//模糊查询
                        $query->where('name','like','%'.$where['name'].'%');
                    }
                });
            $arr = [
                'status'    =>  '0',
                'message'   =>   '数据返回成功！',
                'list'      =>  $results,
            ];
            //dd($arr);
        }else{
            $arr = [
                'status' => '2',
                'message' => '该当前数据不存在！',
            ];
        }
        return response()->json($arr);
    }
    /*
     * 单条数据查询
     */
    public function query(Request $request,$table,$page='0',$lineSize='2',$where=[])
    {
        $table_arr = [
            '0'=>'hospital',
        ];
        if(in_array($table,$table_arr)){
            $results = DB::table('hospital')->paginate($lineSize)
                ->where(function($query) use($where) {
                    if (!empty($where['status'])) {
                        $query->where($this->table . '.status', '=',$where['status']);
                    }
                });
            $arr = [
                'status'    =>  '0',
                'message'   =>   '数据返回成功！',
                'list'      =>  $results,
            ];
            //dd($arr);
        }else{
            $arr = [
                'status' => '2',
                'message' => '该当前数据不存在！',
            ];
        }
        return response()->json($arr);
    }

}
?>