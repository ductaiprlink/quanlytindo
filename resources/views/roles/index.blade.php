@extends('layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            NHÓM NGƯỜI DÙNG
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active"><a href="{{ route('roles.index') }}">Nhóm người dùng</a></li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title pull-left">Danh sách</h3>
                        <p><a href="{{ route('roles.create') }}" class="btn btn-flat btn-success btn-sm pull-right"><i class="fa fa-plus"></i>&nbsp; Thêm nhóm người dùng</a></p>
                    </div>
                    <!-- /.box-header -->

                    @include('pages.success')
                    @include('pages.confirm')

                    <div class="box-body">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <th>Số</th>
                                <th>Vai trò</th>
                                <th>Tên hiển thị</th>
                                <th>Mô tả ngắn</th>
                                <th>Thao tác</th>
                            </tr>

                            @foreach($roles as $role)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $role->role_name }}</td>
                                    <td><span class="label label-success">{{ $role->display_name }}</span></td>
                                    <td>{{ $role->description }}</td>
                                    <td>
                                        <a href="{{ route('roles.show', ['id' => $role->id]) }}" class="btn btn-flat btn-info"><i class="fa fa-search-plus"></i>&nbsp;Xem</a>
                                        <a href="{{ route('roles.edit', ['id' => $role->id]) }}" class="btn btn-flat btn-warning"><i class="fa fa-edit"></i>&nbsp Sửa</a>
                                        <button data-toggle="modal" data-target="#confirm-delete" data-href="{{ route('roles.destroy', ['id' => $role->id]) }}" class="btn btn-danger btn-flat" id="delete-btn"><i class="fa fa-trash"></i> Delete</button>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody></table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix text-center">
                        {{ $roles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection