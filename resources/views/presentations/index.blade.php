@extends('layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            TRỤ SỞ
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li><a href="{{ route('presents.index') }}">Người đại diện</a></li>
            <li class="active">Danh sách</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title pull-left">Danh sách</h3>

                        @permission('department-create')
                        <p><a href="{{ route('departments.create') }}" class="btn btn-flat btn-success btn-sm pull-right"><i class="fa fa-plus"></i>&nbsp; Thêm trụ sở</a></p>
                        @endpermission

                    </div>
                    <!-- /.box-header -->

                    @include('pages.success')
                    @include('pages.confirm')

                    <div class="box-body">
                        <table class="table table-bordered">
                            <tbody><tr>
                                <th>Số</th>
                                <th>Họ tên</th>
                                <th>Địa chỉ</th>
                                <th>Thao tác</th>
                            </tr>

                            @foreach($presentations as $presents)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $presents-> }}</td>
                                    <td>{{ $dept->address }}</td>
                                    <td>{{ $dept->leader->name }}</td>
                                    <td>@if ($dept->showhide == 1)
                                            <span class="label label-info">{{ $dept->status->status }}</span>
                                        @else <span class="label label-important">{{ $dept->status->status }}</span> @endif</td>
                                    <td>
                                        <a href="{{ route('departments.edit', ['id' => $dept->id]) }}" class="btn btn-flat btn-warning"><i class="fa fa-edit"></i>&nbsp Sửa</a>
                                        <button data-toggle="modal" data-target="#confirm-delete" data-href="{{ route('departments.destroy', ['id' => $dept->id]) }}" class="btn btn-danger btn-flat" id="delete-btn"><i class="fa fa-trash"></i> Delete</button>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody></table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix text-center">
                        {{ $departments->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection