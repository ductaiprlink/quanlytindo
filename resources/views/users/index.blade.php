@extends('layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            QUẢN TRỊ VIÊN
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active"><a href="{{ route('users.index') }}">Quản trị viên</a></li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title pull-left">Danh sách</h3>

                        @permission('user-create')
                            <p><a href="{{ route('users.create') }}" class="btn btn-flat btn-success btn-sm pull-right"><i class="fa fa-plus"></i>&nbsp; Thêm quản trị viên</a></p>
                        @endpermission

                    </div>
                    <!-- /.box-header -->

                    @include('pages.success')
                    @include('pages.confirm')

                    <div class="box-body">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <th>Số</th>
                                <th>Tên</th>
                                <th>Email</th>
                                <th>Vai trò</th>
                                <th>Thao tác</th>
                            </tr>

                            @foreach($users as $user)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if(!empty($user->roles))
                                            @foreach($user->roles as $v)
                                                <label class="label label-success">{{ $v->display_name }}</label>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        @permission('user-edit')
                                            <a href="{{ route('users.edit', ['id' => $user->id]) }}" class="btn btn-flat btn-warning"><i class="fa fa-edit"></i>&nbsp Sửa</a>
                                        @endpermission

                                        @permission('user-delete')
                                        <button data-toggle="modal" data-target="#confirm-delete" data-href="{{ route('users.destroy', ['id' => $user->id]) }}" class="btn btn-danger btn-flat" id="delete-btn"><i class="fa fa-trash"></i> Delete</button>
                                        @endpermission
                                    </td>
                                </tr>
                            @endforeach

                            </tbody></table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix text-center">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection