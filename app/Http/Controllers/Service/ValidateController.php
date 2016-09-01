<?php

namespace App\Http\Controllers\Service;

use App\Tool\SMS\SendTemplateSMS;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ValidateController extends Controller
{
    public function sendSMS(Request $request)
    {
        $phone = $request->input('phone', '');
        $sendTemplateSMS = new SendTemplateSMS();
        //生成随机六位数字验证码
        $code = '';
        $rand_str = '1234567890';
        for ($i=0; $i<6; $i++){
            $code .= $rand_str[mt_rand(0, (strlen($rand_str)-1))];
        }
        //获取当前数据库该号码是否有接受过短信验证码
        //if(){}
        $sendTemplateSMS->sendTemplateSMS($phone, [$code, 10], 1);
        return 111;
    }
}
