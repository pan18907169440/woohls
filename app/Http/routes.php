<?php


//Route::get('/admin/index', 'Admin\AdminController@index');


Route::group(['prefix' => 'admin','middleware' => 'role'], function(){
        Route::get('index/index', 'Admin\IndexController@index');

        Route::get('admin/index', 'Admin\AdminController@index');
        Route::get('admin/addAdmin', 'Admin\AdminController@addAdmin');
        Route::post('admin/addAdmin', 'Admin\AdminController@addAdmin');
        Route::get('admin/editAdmin/{id}', 'Admin\AdminController@editAdmin');
        Route::post('admin/editAdmin/{id}', 'Admin\AdminController@editAdmin');
        Route::get('admin/editAdminPwd/{id}', 'Admin\AdminController@editAdminPwd');
        Route::post('admin/editAdminPwd/{id}', 'Admin\AdminController@editAdminPwd');
        Route::get('admin/adminStatus/{id}/{status}', 'Admin\AdminController@adminStatus');
        Route::get('admin/deleteAdmin/{id}', 'Admin\AdminController@deleteAdmin');

        Route::get('admin/permission', 'Admin\PermissionController@index');
        Route::get('permission/addPermission', 'Admin\PermissionController@addPremission');
        Route::post('permission/addPermission', 'Admin\PermissionController@addPremission');
        Route::get('permission/editPermission/{id}', 'Admin\PermissionController@editPermission');
        Route::post('permission/editPermission/{id}', 'Admin\PermissionController@editPermission');
        Route::get('permission/permissionStatus/{id}/{status}', 'Admin\PermissionController@permissionStatus');
        Route::get('permission/deletePermission/{id}', 'Admin\PermissionController@deletePermission');

        Route::get('admin/role', 'Admin\RoleController@index');
        Route::get('role/addRole', 'Admin\RoleController@addRole');
        Route::post('role/addRole', 'Admin\RoleController@addRole');
        Route::get('role/editRole/{id}', 'Admin\RoleController@editRole');
        Route::post('role/editRole/{id}', 'Admin\RoleController@editRole');
        Route::get('role/roleStatus/{id}/{status}', 'Admin\RoleController@roleStatus');
        Route::get('role/deleteRole/{id}', 'Admin\RoleController@deleteRole');
        Route::get('role/toPermission/{id}', 'Admin\RoleController@toPermission');
        Route::post('role/toPermission/{id}', 'Admin\RoleController@toPermission');

        Route::get('message/message', 'Admin\MessageController@index');
        Route::get('message/addMessage', 'Admin\MessageController@addMessage');
        Route::post('message/addMessage', 'Admin\MessageController@addMessage');
        Route::get('message/editMessage/{id}', 'Admin\MessageController@editMessage');
        Route::post('message/editMessage/{id}', 'Admin\MessageController@editMessage');
        Route::get('message/messageStatus/{id}/{status}', 'Admin\MessageController@messageStatus');
        Route::get('message/deleteMessage/{id}', 'Admin\MessageController@deleteMessage');
        Route::get('message/ToUser/{id}', 'Admin\MessageController@ToUser');
        Route::post('message/ToUser/{id}', 'Admin\MessageController@ToUser');

        Route::get('message/messageCategory', 'Admin\MessageCategoryController@index');
        Route::get('message/addMessageCategory', 'Admin\MessageCategoryController@addMessageCategory');
        Route::post('message/addMessageCategory', 'Admin\MessageCategoryController@addMessageCategory');
        Route::get('message/editMessageCategory/{id}', 'Admin\MessageCategoryController@editMessageCategory');
        Route::post('message/editMessageCategory/{id}', 'Admin\MessageCategoryController@editMessageCategory');
        Route::get('message/messageCategoryStatus/{id}/{status}', 'Admin\MessageCategoryController@messageCategoryStatus');
        Route::get('message/deleteMessageCategory/{id}', 'Admin\MessageCategoryController@deleteMessageCategory');

        Route::get('message/messageSendHistory', 'Admin\MessageSendHistoryController@index');
        Route::get('message/messageInfo/{id}', 'Admin\MessageSendHistoryController@messageInfo');
        Route::get('message/deleteMessageSendHistory/{id}', 'Admin\MessageSendHistoryController@deleteMessageSendHistory');

        Route::get('message/messageRole', 'Admin\MessageRoleController@index');
        Route::post('message/messageRole/{id}', 'Admin\MessageRoleController@index');
        Route::get('message/deleteMessageRole/{id}', 'Admin\MessageRoleController@deleteMessageRole');

        Route::get('message/messageRoleHistory', 'Admin\MessageRoleHistoryController@index');
        Route::get('message/messageRoleHistoryRead/{id}', 'Admin\MessageRoleHistoryController@messageRoleHistoryRead');
        Route::post('message/messageRoleHistoryRead/{id}', 'Admin\MessageRoleHistoryController@messageRoleHistoryRead');
        Route::get('message/deleteMessageRoleHistory/{id}', 'Admin\MessageRoleHistoryController@deleteMessageRoleHistory');

        Route::get('public/login', 'Admin\PublicController@login');
        Route::post('public/login', 'Admin\PublicController@login');
        Route::get('public/logout', 'Admin\PublicController@getLogout');

});
//图片上传
Route::get('service/file_index','Service\UploadController@file_index');
Route::post('service/get_fiel','Service\UploadController@get_fiel');



Route::get('service/pages/queryList/{table}/{page}/{lineSize}', 'Service\PagesController@queryList');
Route::get('service/grcode/index', 'Service\QrcodeController@index');

Route::get('service/excel/export','Service\ExcelController@export');
Route::get('service/excel/import','Service\ExcelController@import');

Route::any('service/validate_phone/send', 'Service\ValidateController@sendSMS');
Route::any('service/validate_code/create','Service\ValidateCodeController@create');
Route::post('service/upload_img','Service\UploadController@imgUpload');