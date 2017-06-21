@extends('adminlte::page')

@section('title', 'AdminLTE')
@section('content_header')
    <h1>
        Tìm Kiếm
        <small> Lịch Sử</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tìm Kiếm</a></li>
        <li class="active">Dữ Liệu Tìm Kiếm</li>
    </ol>
@stop
@include('layouts.sidebar')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{$msgResult}}</h3>
                    <div class="box box-info">
                        <div class="box-body">
                            {{ Form::open(['method' =>'GET','url' => ['history/q']])}}
                            <div class="row">
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
                                <div class="col-xs-4">
                                    {{Form::submit('Tìm Kiếm',['class'=>'btn btn-block btn-success btn-flat'])}}
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Nhà Mạng</th>
                            <th>Giá Trị Thẻ</th>
                            <th>Số Lượng</th>
                            <th>Hàm Kết Nối</th>
                            <th>Mã Giao Dịch</th>
                            <th>Kết Quả</th>
                            <th>Ngày Giao Dịch</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($dataResults as $dataRq)
                            @php
                                $mapMsg = [
                                    '00' =>'Giao dịch thành công',
                                    '01' =>'Hàm xử lý không tồn tại',
                                    '02' =>'Version của hàm xử lý không tồn tại',
                                    '03' =>'Mã đại lý không tồn tại',
                                    '04' =>'Tài khoản đang bị khóa hoặc bị phong tỏa',
                                    '05' =>'Số dư tài khoản không đủ',
                                    '06' =>'Mã Token không chính xác',
                                    '07' =>'Dữ liệu mã hóa không chính xác',
                                    '08' =>'IP của đại lý không được phép kết nối',
                                    '09' =>'Mã dịch vụ không tồn tại hoặc tài khoản của đại lý không được cấu hình để sử dụng dịch vụ này',
                                    '10' =>'Dịch vụ đang tạm ngưng hoặc lỗi kết nối tới nhà cung cấp',
                                    '11' =>'Mã đơn hàng đã tồn tại - Yêu cầu mã đơn hàng là duy nhất',
                                    '12' =>'Mệnh giá thẻ không đúng ',
                                    '13' =>'Số lượng thẻ yêu cầu bán không phù hợp (Tối đa 1 lần mua là 10 thẻ)',
                                    '14' =>'Định dạng dữ liệu không đúng - Thiếu tham số đầu vào',
                                    '15' =>'Dịch vụ tạm ngưng do lỗi'
                                    ];
                                $msgShow = $mapMsg[$dataRq->resCode];

                            @endphp
                            <tr>
                                <td>{{$dataRq->telco}}</td>
                                <td>{{$dataRq->cardPrice}}</td>
                                <td>{{$dataRq->cardQuanlity}}</td>
                                <td>{{$dataRq->func}}</td>
                                <td>{{$dataRq->refName}}</td>
                                <td>@if($dataRq->resCode == '00')
                                        <span class="badge bg-green">{{$dataRq->resCode.":".$msgShow}}</span>
                                    @else
                                        <span class="badge bg-red">{{$dataRq->resCode.":".$msgShow}}</span>
                                    @endif
                                </td>
                                <td>{{$dataRq->created_at}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$dataResults->links()}}
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <!-- /.col -->
    </div>
@stop