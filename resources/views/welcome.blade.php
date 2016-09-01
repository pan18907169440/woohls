<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>
</head>
<body>
<h1>权限测试</h1>
<p>
    @can('admin.addAdmin')
        <a href="#">添加管理员</a>
    @endcan

    @can('edit-post')
        <a href="#">Edit Post</a>
    @endcan
</p>
<p>
    @can('delete-post')
        <a href="#">Delete Post</a>
    @endcan
</p>
</body>
</html>