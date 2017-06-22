@extends('adminlte::page')

@section('title', 'AdminLTE')
@section('content_header')
    <h1>Quản lý thông tin khách hàng</h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Thống Kê</a></li>
        <li class="active">Quản Lý Tài Khoản</li>
    </ol>
@stop
@include('layouts.sidebar')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h2><i class='fa fa-user-plus'></i>Sửa Đổi Quyền Hạn: {{$user->name}}</h2>
                    <div class="box-body">
                        @include ('errors.list')
                        @if (Session::has('error_mes'))
                            <div class="alert alert-danger">{{ Session::get('error_mes') }}</div>
                        @endif
                        @if (Session::has('success_mes'))
                            <div class="alert alert-success">{{ Session::get('success_mes') }}</div>
                        @endif
                        {{ Form::model($user, array('route' => array('users-manager.update', $user->id), 'method' => 'PUT')) }} {{-- Form model binding to automatically populate our fields with user data --}}

                        <div class="form-group">
                            {{ Form::label('name', 'Name') }}
                            {{ Form::text('name', null, array('class' => 'form-control','disabled' => 'disabled')) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('email', 'Email') }}
                            {{ Form::email('email', null, array('class' => 'form-control','disabled' => 'disabled')) }}
                        </div>
                        <h5><b>Loại Tài Khoản</b></h5>
                        <div class="form-group">
                            {{ Form::select('userType',$userType, null, ['class' => 'form-control']) }}
                        </div>
                        <h5><b>Quyền Hạn Trên Tool</b></h5>
                        <div class='form-group'>
                            @foreach ($roles as $role)
                                {{ Form::checkbox('roles[]',  $role->id, $user->roles ) }}
                                {{ Form::label($role->name, ucfirst($role->name)) }}<br>
                            @endforeach
                        </div>
                        <h5><b>Vô Hiệu Tài Khoản</b></h5>
                        <div class="form-group">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="active" id="optionsRadios3" value="1" checked>
                                    Kích Hoạt Lại Tài Khoản
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="active" id="optionsRadios2" value="0">
                                    Vô Hiệu Tài Khoản Này
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('repassword', 'Mật Khẩu Quản Trị') }}
                            {{ Form::password('repassword', ['class' => 'form-control','placeholder'=>'Mật Khẩu Quản Trị']) }}
                        </div>

                        {{ Form::submit('Đồng Ý Sửa', ['class' => 'btn btn-primary btn-block']) }}
                        {{ Form::close() }}

                    </div>
                </div>
            </div>
        </div>
        <!-- /.col -->
    </div>
@stop