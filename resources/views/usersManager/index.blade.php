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
                    <h3 class="box-title">Danh Sách Khách Hàng Đối Tác - Tổng số: {{count($users)}}</h3>
                    <a href="{{ route('users-manager.create') }}" class="btn btn-success btn-block">Tạo Tài Khoản Đối Tác</a>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Tên Khách Hàng</th>
                                <th>Email</th>
                                <th>Tổng Chi Tiêu </th>
                                <th>Quyền Hạn</th>
                                <th>Loại Tài Khoản</th>
                                <th>Created At</th>
                                <th>Hành Động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                                @php
                                switch ($user->typePartner){
                                    case 1:
                                    $partnerType = '<i class="fa fa-credit-card normal-type" aria-hidden="true"></i> Hạng Chuẩn';
                                    break;
                                    case 2:
                                    $partnerType = '<i class="fa fa-credit-card gold-type" aria-hidden="true"></i> Hạng Vàng';
                                    break;
                                    case 3:
                                    $partnerType = '<i class="fa fa-credit-card-alt platinum-type" aria-hidden="true"></i> Hạng Bạch Kim';
                                    break;
                                    case 4:
                                    $partnerType = '<i class="fa fa-diamond diamond-type" aria-hidden="true"></i> Hạng Kim Cương';
                                    break;
                                    default:
                                    $partnerType = '<i class="fa fa-credit-card normal-type" aria-hidden="true"></i> Hạng Không Biết';
                                    break;
                                }
                                @endphp
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->sumUsed }}</td>
                                    <td>{{ $user->roles()->pluck('name')->implode(' ') }}</td>{{-- Retrieve array of roles associated to a user and convert to string --}}
                                    <td>{!! $partnerType !!}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>
                                        <a href="{{ route('users-manager.edit', $user->id) }}" class="btn btn-success pull-left" style="margin-right: 3px;">Sửa</a>
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['users-manager.destroy', $user->id] ]) !!}
                                        {!! Form::submit('Xóa', ['class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$users->links()}}
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col -->
    </div>
@stop