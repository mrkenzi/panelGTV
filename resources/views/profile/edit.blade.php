@extends('adminlte::page')

@section('title', 'AdminLTE')
@section('content_header')
    <h1>
        Thông Tin Tài Khoản
    </h1>
    <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="admin/profile">Admin Panel</a></li>
        <li class="active">User profile</li>
    </ol>
@stop
@include('layouts.sidebar')
@section('content')
    <div class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="http://i.imgur.com/AKj34fA.png"
                         alt="User profile picture">

                    <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Mã Đối Tác: </b>
                            <p>{{ Auth::user()->partnerCode }}</p>
                        </li>
                        <li class="list-group-item">
                            <b>Số Dư: </b> <a class="pull-right">{{ Auth::user()->money }}</a>
                        </li>
                    </ul>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

            <!-- About Me Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Dịch Vụ Đang Sử Dụng</h3>
                </div>
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            @include ('errors.list')
            @if (Session::has('error_mes'))
                <div class="alert alert-danger">{{ Session::get('error_mes') }}</div>
            @endif
            @if (Session::has('success_mes'))
                <div class="alert alert-success">{{ Session::get('success_mes') }}</div>
            @endif
            {{ Form::model($userInfo, array('route' => array('profile.update', $userInfo->id), 'method' => 'PUT')) }}
            <h3>Đổi mật khẩu - {{$userInfo->name}}</h3>
            <div class="form-group">
                {{ Form::label('email', 'Email Đã Đăng Ký') }}
                {{ Form::text('email', null,array('class' => 'form-control','placeholder'=>'Email Đã Đăng Ký')) }}<br>
                {{ Form::label('newpassword', 'Mật Khẩu Mới') }}
                {{ Form::password('newpassword', array('class' => 'form-control','placeholder'=>'Mật Khẩu Mới')) }}
                <br>
                {{ Form::label('repassword', 'Nhập Lại Mật Khẩu Mới') }}
                {{ Form::password('repassword', array('class' => 'form-control','placeholder'=>'Nhập Lại Mật Khẩu Mới')) }}
                <br>
                {{ Form::submit('Save', array('class' => 'btn btn-primary btn-block')) }}
                {{ Form::close() }}
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

@stop