@extends('layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            CHỨC VỤ
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active"><a href="{{ route('positions.index') }}">Chức vụ</a></li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-9 col-xs-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Sửa chức vụ</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" action="{{ route('positions.update', ['id' => $position->id]) }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="box-body">
                            <div class="form-group{{ $errors->has('position_name') ? ' has-error' : '' }}">
                                <label for="position_name" class="col-sm-3 control-label">Chức vụ</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="position_name" name="position_name" placeholder="Tên chức vụ" value="{{ $position->position_name }}">
                                    @if ($errors->has('position_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('position_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <a href="{{ route('positions.index') }}" class="btn btn-default"><i class="fa fa-chevron-left"></i>&nbsp;&nbsp;Hủy</a>
                            <button type="submit" class="btn btn-success pull-right"><i class="fa fa-pencil"></i>&nbsp;&nbsp;Cập nhật</button>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection