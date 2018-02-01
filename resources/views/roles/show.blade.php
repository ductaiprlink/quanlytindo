@extends('layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            NHÓM NGƯỜI DÙNG
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li><a href="{{ route('roles.index') }}">Nhóm người dùng</a></li>
            <li class="active">Xem</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Xem nhóm người dùng</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="role_name" class="col-sm-3 control-label">Tên nhóm</label>

                                <div class="col-sm-9">
                                    <input type="text" readonly class="form-control" id="role_name" name="role_name" value="{{ $role->role_name }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="display_name" class="col-sm-3 control-label">Tên hiển thị</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" readonly id="display_name" name="display_name" value="{{ $role->display_name }}">
                                </div>
                            </div>
                            {{-- description --}}
                            <div class="form-group">
                                <label for="description" class="col-sm-3 control-label">Mô tả</label>

                                <div class="col-sm-9">
                                    <textarea readonly name="description" id="description" cols="30" rows="5" class="form-control">{{ $role->description }}</textarea>
                                </div>
                            </div>
                            {{-- quyền --}}
                            <div class="form-group">
                                <label for="description" class="col-sm-3 control-label">Quyền (Permission)</label>

                                <div class="col-sm-9">
                                    @foreach($rolePermissions as $rolePer)
                                        <span class="label label-success">{{ $rolePer->name }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <a href="{{ route('roles.index') }}" class="btn btn-default"><i class="fa fa-chevron-left"></i>&nbsp;&nbsp;Hủy</a>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection