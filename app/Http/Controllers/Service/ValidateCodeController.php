<?php
namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;
use App\Tool\ValidateCode\ValidateCode;
use App\Http\Controllers\Controller;

class ValidateCodeController extends Controller
{
    public function create(Request $request)
    {
        $validateCode = new ValidateCode;
        //缓存验证码
        $request->session()->put('validate_code',$validateCode->getCode());
        return $validateCode->doimg();
    }
}
