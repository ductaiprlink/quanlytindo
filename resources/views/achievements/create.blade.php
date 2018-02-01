@extends('layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            THÊM THÀNH TÍCH - KHUYẾT ĐIỂM
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active"><a href="{{ route('achievements.index', ['id' => $id]) }}">Thành tích - khuyết điểm</a></li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tín đồ: {{ $employee->name }} - Mã số: {{ $id }}</h3>
                    </div>

                    <form class="form-horizontal" action="{{ route('achievements.store', ['id' => $id]) }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="employee_id" value="{{ $id }}">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="date" class="col-sm-2 control-label">Ngày</label>

                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="date" placeholder="Ngày" name="date">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="advantage" class="col-sm-2 control-label">Thành tích</label>

                                <div class="col-sm-10">
                                    <textarea name="advantage" id="advantage" cols="30" rows="3" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="disadvantage" class="col-sm-2 control-label">Khuyết điểm</label>

                                <div class="col-sm-10">
                                    <textarea name="disadvantage" id="disadvantage" cols="30" rows="3" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <a href="{{ route('achievements.index', ['id' => $id]) }}" class="btn btn-default"><i class="fa fa-chevron-left"></i>&nbsp;Quay lại</a>
                            <button type="submit" class="btn btn-success pull-right"><i class="fa fa-plus"></i>&nbsp;Thêm</button>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection

