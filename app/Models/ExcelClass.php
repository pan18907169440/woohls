<?php
namespace App\Models;

use Excel;

class ExcelClass
{
    /**
     * @param string $title
     * @param $result
     * Excel文件导出功能 By Laravel学院
     */
    public function export($title='',$titleDate='',$result=''){
        $expTitle = $title;
        $result = $result;
        $count = count($result);
        for ($i=0;$i<$count;$i++){
            $tableDate[] = array_values(get_object_vars($result[$i]));
            //get_object_vars 将对象转为数组
            //array_values 去掉数组键名
        }

        //array_merge 合并数组
        $cellData = array_merge($titleDate,$tableDate);
        //导出文件并存到 /storage/exports/ 目录下
      return Excel::create(iconv('UTF-8', 'GBK', $expTitle),function($excel) use ($cellData){
            $excel->sheet('score', function($sheet) use ($cellData){
                $sheet->rows($cellData);
            });
        })->store('xls')->export('xls');
    }

    //Excel文件导入功能 By Laravel学院
    public function import(){
        $filePath = '/storage/exports/'.iconv('UTF-8', 'GBK', '学生成绩').'.xls';
        Excel::load($filePath, function($reader) {
            $data = $reader->all();
            //dd($data);
        });
    }


}