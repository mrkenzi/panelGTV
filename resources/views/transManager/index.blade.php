@extends('adminlte::page')

@section('title', 'AdminLTE')
@section('content_header')
    <h1>Quản lý thông tin giao dịch khách hàng</h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Thống Kê</a></li>
        <li class="active">Quản Lý Giao Dịch</li>
    </ol>
@stop
@include('layouts.sidebar')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Thống Kê Yêu Cầu Mua Thẻ</h3>
                    <div class="box box-info">
                        <div class="box-body">
                            @include ('errors.list')
                            {{ Form::open(['method' =>'GET','url' => ['trans-manager/q']])}}
                            <div class="row">
                                <div class="col-xs-2">
                                    {{ Form::select('ma_doi_tac', $listUsers, null, ['class' => 'form-control']) }}
                                </div>
                                <div class="col-xs-2">
                                    {{Form::text('transId',null,['placeholder'=>'Tìm Theo Mã Giao Dịch', 'class'=>'form-control'])}}
                                </div>
                                <div class="col-xs-2">
                                    {{Form::text('func',null,['placeholder'=>'Tìm Theo Hàm Kết Nối', 'class'=>'form-control'])}}
                                </div>
                                <div class="col-xs-2">
                                    {{Form::select('telco', ['VTT' => 'Viettel', 'VMS' => 'MobiFone', 'VNP' => 'Vinaphone', 'VNM' => 'Vietnam Mobile', 'GTEL' => 'Gmobile', 'SFONE' => 'Sfone',''=>'Tất cả nhà mạng'],null,['class'=>'form-control','placeholder' => 'Chọn nhà mạng tìm kiếm'])}}
                                </div>
                                <div class="col-xs-2">
                                    {{Form::select('cardPrice', ['10000' => 'Thẻ 10.000', '20000' => 'Thẻ 20.000', '30.000' => 'Thẻ 30000', '50000' => 'Thẻ 50.000', '100000' => 'Thẻ 100.000', '200000' => 'Thẻ 200.000', '500000' => 'Thẻ 500.000',''=>'Tất cả mệnh giá'],null,['class'=>'form-control','placeholder' => 'Tìm Theo mệnh giá thẻ'])}}
                                </div>
                                <div class="col-xs-2">
                                    {{Form::submit('Tìm Kiếm',['class'=>'btn btn-block btn-success btn-flat'])}}
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-aqua">
                            <span class="info-box-icon"><i class="fa fa-info-circle"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Tổng Số Giao Dịch</span>
                                <span class="info-box-number">{{$sumRqs}}</span>

                                <div class="progress">
                                    <div class="progress-bar" style="width: 100%"></div>
                                </div>
                                <span class="progress-description">Tổng số giao dịch đã được xử lý</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-green">
                            <span class="info-box-icon"><i class="fa fa-info-circle"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Giao Dịch Trong Tháng</span>
                                <span class="info-box-number">{{$countMonth}}</span>

                                <div class="progress">
                                    <div class="progress-bar" style="width: 100%"></div>
                                </div>
                                <span class="progress-description">Tổng số giao dịch trong tháng này</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-yellow">
                            <span class="info-box-icon"><i class="fa fa-info-circle"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Tổng Số Đối Tác</span>
                                <span class="info-box-number">{{count($listUsers)}}</span>

                                <div class="progress">
                                    <div class="progress-bar" style="width: 100%"></div>
                                </div>
                                <span class="progress-description">
                    Tổng đối tác trên hệ thống
                  </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-red">
                            <span class="info-box-icon"><i class="fa fa-info-circle"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Tổng Số Tiền Đã Giao Dịch</span>
                                <span class="info-box-number">---</span>

                                <div class="progress">
                                    <div class="progress-bar" style="width: 70%"></div>
                                </div>
                                <span class="progress-description">
                    70% Increase in 30 Days
                  </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="box box-success">
                    {!! $chartdb->render() !!}
                    </div>
                </div>
                @section('js')
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.bundle.min.js"></script>
                    @endsection
                    <!-- /.box-body -->
            </div>
        </div>
        <!-- /.col -->
    </div>
@stop