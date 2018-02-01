@extends('layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            HỌC VẤN
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active"><a href="{{ route('educations.index') }}">Học vấn</a></li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-9 col-xs-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thêm Học vấn</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" action="" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="box-body">
                            <div class="form-group{{ $errors->has('education_name') ? 'errors' : '' }}">
                                <label for="education_name" class="col-sm-3 control-label">Học vấn</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="education_name" name="education_name" placeholder="Tên Học vấn">
                                    @if ($errors->has('education_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('education_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <a href="{{ route('educations.index') }}" class="btn btn-default"><i class="fa fa-chevron-left"></i>&nbsp;&nbsp;Hủy</a>
                            <button type="submit" class="btn btn-success pull-right"><i class="fa fa-plus"></i>&nbsp;&nbsp;Thêm</button>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection