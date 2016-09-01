<?php
return [
    'use_alias'    => env('WECHAT_USE_ALIAS', false),
    'app_id'       => env('WECHAT_APPID', 'wx4c094e0da605ebb8'), // 必填
    'secret'       => env('WECHAT_SECRET', '56fab15bb00723c7829964e2852686c4'), // 必填
    'token'        => env('WECHAT_TOKEN', 'YourToken'),  // 必填
    'encoding_key' => env('WECHAT_ENCODING_KEY', 'YourEncodingAESKey') // 加密模式需要，其它模式不需要
	
	
];