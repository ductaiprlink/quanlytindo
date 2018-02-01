@extends('layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            THÀNH TÍCH - KHUYẾT ĐIỂM
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active"><a href="{{ route('achievements.index', ['id' => $id]) }}">Thành tích - khuyết điểm</a></li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title pull-left">Tín đồ: {{ $employee->name }} - Mã số: {{ $id }}</h3>
                        <p class="pull-right">
                            <a href="{{ route('employees.edit', ['id' => $id]) }}" class="btn btn-default"><i class="fa fa-chevron-left"></i>&nbsp;Quay lại</a>
                            <a href="{{ route('achievements.create', ['id' => $id]) }}" class="btn btn-flat btn-success"><i class="fa fa-plus"></i>&nbsp; Thêm thành tích</a>
                            <a href="{{ route('members.index', ['id' => $id]) }}" class="btn btn-flat btn-default"><i class="fa fa-users"></i>&nbsp; Xem thành viên gia đình</a>
                            <a href="{{ route('employees.show', ['id' => $id]) }}" class="btn btn-flat btn-info"><i class="fa fa-eye"></i>&nbsp;Xem chi tiết</a>
                        </p>
                    </div>

                    @include('pages.success')
                    @include('pages.confirm')

                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Ngày</th>
                                <th>Thành tích</th>
                                <th>Khuyết điểm</th>
                                <th>Thao tác</th>
                            </tr>

                            @isset($achievements)
                                @foreach($achievements as $achie)
                                    <tr>
                                        <td>{{ $achie->date }}</td>
                                        <td>{{ $achie->advantage }}</td>
                                        <td>{{ $achie->disadvantage }}</td>
                                        <td>
                                            <a href="{{ route('achievements.edit', ['id' => $id, 'achie_id' => $achie->id]) }}" class="btn btn-flat btn-warning"><i class="fa fa-edit"></i>&nbsp Sửa</a>
                                            <button data-toggle="modal" data-target="#confirm-delete" data-href="{{ route('achievements.destroy', ['id' => $id, 'achie_id' => $achie->id]) }}" class="btn btn-danger btn-flat" id="delete-btn"><i class="fa fa-trash"></i> Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endisset

                            @if (count($achievements) == 0)
                                <tr>
                                    <td colspan="4" class="text-center">Chưa có thành tích - khuyết điểm nào</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection