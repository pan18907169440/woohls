<?php
namespace App\Models;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrcodeClass
{
    /*
     * 二维码生成
     */
    public function qrcode()
    {
        $body = "Hello,LaravelAcademy!";
        $path = "qrcodes/".md5(date('Y-m-d')).'.png';

        QrCode::format('png')
            ->size(100)
            ->color(255,0,255)
            ->backgroundColor(255,255,0)
            ->generate($body,$path);

        $img_arr = [
            'url' =>  asset($path),
        ];
        return $img_arr;
    }


}
?>