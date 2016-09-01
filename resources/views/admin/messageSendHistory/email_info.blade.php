@extends('admin.common.master')
@section('title','查看信息')
@section('content')
<body class="skin-blue">
<div  style="padding:20px;">
        <table class="table table-mailbox">
            <tbody>
            <tr class="unread">
                <center><h4>《{{$message->title}}》</h4></center>
            </tr>
            <tr class="unread">
                <div style="background: #ddd;padding:20px;">{!! $message->body !!}</div>
            </tr>
            </tbody>
        </table>
</div>
@endsection
@section('my-js')
@endsection
