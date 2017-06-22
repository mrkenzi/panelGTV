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
                    <h2><i class='fa fa-user-plus'></i>Tạo Mới Tài Khoản</h2>
                    <div class="box-body">
                        @include ('errors.list')
                        @if (Session::has('error_mes'))
                            <div class="alert alert-danger">{{ Session::get('error_mes') }}</div>
                        @endif
                        @if (Session::has('success_mes'))
                            <div class="alert alert-success">{{ Session::get('success_mes') }}</div>
                        @endif
                        {{-- @include ('errors.list') --}}

                        {{ Form::open(array('url' => 'users-manager')) }}

                        <div class="form-group">
                            {{ Form::label('name', 'Tên Đầy Đủ') }}
                            {{ Form::text('name', '', array('class' => 'form-control')) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('email', 'Email') }}
                            {{ Form::email('email', '', array('class' => 'form-control')) }}
                        </div>
                        <h5><b>Loại Tài Khoản</b></h5>
                        <div class="form-group">
                            {{ Form::select('userType',$userType, null, ['class' => 'form-control']) }}
                        </div>
                        <h5><b>Quyền Hạn Trên Tool</b></h5>
                        <div class='form-group'>
                            @foreach ($roles as $role)
                                {{ Form::checkbox('roles[]',  $role->id ) }}
                                {{ Form::label($role->name, ucfirst($role->name)) }}<br>
                            @endforeach
                        </div>

                        <div class="form-group">
                            {{ Form::label('password', 'Password') }}<br>
                            {{ Form::password('password', array('class' => 'form-control')) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('password', 'Confirm Password') }}<br>
                            {{ Form::password('password_confirmation', array('class' => 'form-control')) }}
                        </div>

                        {{ Form::submit('Add', array('class' => 'btn btn-primary btn-block')) }}

                        {{ Form::close() }}

                    </div>
                </div>
            </div>
        </div>
        <!-- /.col -->
    </div>
@stop