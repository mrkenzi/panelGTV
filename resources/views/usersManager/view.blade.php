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
                    <h2><i class='fa fa-user-plus'></i>Thông Tin Tài Khoản: {{$user->name}}</h2>
                    <div class="box-body">
                        @include ('errors.list')
                        @if (Session::has('error_mes'))
                            <div class="alert alert-danger">{{ Session::get('error_mes') }}</div>
                        @endif
                        @if (Session::has('success_mes'))
                            <div class="alert alert-success">{{ Session::get('success_mes') }}</div>
                        @endif
                        <div class="box-body box-profile">
                            <img class="profile-user-img img-responsive img-circle" src="http://i.imgur.com/AKj34fA.png" alt="User profile picture">

                            <h3 class="profile-username text-center">{{$user->name}}</h3>

                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>{{$userType->userTypeName}}</b>
                                </li>
                                <li class="list-group-item">
                                    <b>Đã Tiêu: </b>{{$user->sumUsed}}
                                </li>
                                <li class="list-group-item">
                                    <b>Ngày Tài Khoản:</b>{{$user->created_at}}
                                </li>
                            </ul>

                            <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col -->
    </div>
@stop