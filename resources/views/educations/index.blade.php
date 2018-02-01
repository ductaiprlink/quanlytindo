@extends('layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            TRÌNH ĐỘ HỌC VẤN
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li><a href="{{ route('educations.index') }}">Học vấn</a></li>
            <li class="active"><a href="{{ route('educations.index') }}">Danh sách</a></li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title pull-left">Danh sách</h3>
                        <p><a href="{{ route('educations.create') }}" class="btn btn-flat btn-success btn-sm pull-right"><i class="fa fa-plus"></i>&nbsp; Thêm Học vấn</a></p>
                    </div>
                    <!-- /.box-header -->

                    @include('pages.success')
                    @include('pages.confirm')

                    <div class="box-body">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <th>Số</th>
                                <th>Trình độ</th>
                                <th>Thao tác</th>
                            </tr>

                            @foreach($educations as $edu)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $edu->education_name }}</td>
                                    <td>
                                        <a href="{{ route('educations.edit', ['id' => $edu->id]) }}" class="btn btn-flat btn-warning"><i class="fa fa-edit"></i>&nbsp;Sửa</a>
                                        <button data-toggle="modal" data-target="#confirm-delete" data-href="{{ route('educations.destroy', ['id' => $edu->id]) }}" class="btn btn-danger btn-flat" id="delete-btn"><i class="fa fa-trash"></i> Delete</button>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix text-center">
                        {{ $educations->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection