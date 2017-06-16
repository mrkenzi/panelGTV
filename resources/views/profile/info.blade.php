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

@section('content')
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <img class="profile-user-img img-responsive img-circle" src="/resources/assets/avatar_default.png" alt="User profile picture">

                            <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Mã Đối Tác: </b> <p>{{ Auth::user()->partnerCode }}</p>
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
                        <!-- /.box-header -->
                        {{--<div class="box-body">
                            <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

                            <p class="text-muted">
                                B.S. in Computer Science from the University of Tennessee at Knoxville
                            </p>

                            <hr>

                            <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

                            <p class="text-muted">Malibu, California</p>

                            <hr>

                            <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

                            <p>
                                <span class="label label-danger">UI Design</span>
                                <span class="label label-success">Coding</span>
                                <span class="label label-info">Javascript</span>
                                <span class="label label-warning">PHP</span>
                                <span class="label label-primary">Node.js</span>
                            </p>

                            <hr>

                            <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                        </div>--}}
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#statistical" data-toggle="tab">Thống Kê Giao Dịch</a></li>
                            <li><a href="#timeline" data-toggle="tab">Thống Kê Lần Nạp Tiền</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="active tab-pane" id="statistical">
                                <div class="row">
                                    <div class="col-lg-3 col-xs-6">
                                        <!-- small box -->
                                        <div class="small-box bg-aqua">
                                            <div class="inner">
                                                <h3>{{ Auth::user()->money }}</h3>

                                                <p>Số Dư Còn Lại</p>
                                            </div>
                                            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                    <!-- ./col -->
                                    <div class="col-lg-3 col-xs-6">
                                        <!-- small box -->
                                        <div class="small-box bg-green">
                                            <div class="inner">
                                                <h3>{{$countToday}}</h3>

                                                <p>Số Lần Mua Thẻ Hôm Nay</p>
                                            </div>
                                            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                    <!-- ./col -->
                                    <div class="col-lg-3 col-xs-6">
                                        <!-- small box -->
                                        <div class="small-box bg-yellow">
                                            <div class="inner">
                                                <h3>{{$allRequest}}</h3>

                                                <p>Tổng Đã Mua Thẻ</p>
                                            </div>
                                            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-xs-6">
                                        <!-- small box -->
                                        <div class="small-box bg-maroon">
                                            <div class="inner">
                                                <h3>{{$allResponse}}</h3>

                                                <p>Tổng số lần yêu cầu</p>
                                            </div>
                                            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                    <!-- ./col -->

                                    <!-- ./col -->
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="timeline">
                                <h2>Hiện chưa có</h2>
                            </div>
                            <!-- /.tab-pane -->


                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

@stop