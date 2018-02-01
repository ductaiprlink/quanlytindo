@extends('layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            THÀNH VIÊN TRONG GIA ĐÌNH
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active"><a href="{{ route('members.index', ['id' => $id]) }}">Thành viên trong gia đình</a></li>
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
                            <a href="{{ route('members.create', ['id' => $id]) }}" class="btn btn-flat btn-success"><i class="fa fa-plus"></i>&nbsp; Thêm thành viên</a>
                            <a href="{{ route('achievements.index', ['id' => $id]) }}" class="btn btn-flat btn-default"><i class="fa fa-trophy"></i>&nbsp; Xem thành tích - khuyết điểm</a>
                            <a href="{{ route('employees.show', ['id' => $id]) }}" class="btn btn-flat btn-info"><i class="fa fa-eye"></i>&nbsp;Xem chi tiết</a>
                        </p>
                    </div>

                    @include('pages.success')
                    @include('pages.confirm')

                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Thành viên 1</th>
                                <th>Là</th>
                                <th>Thành viên 2</th>
                                <th>Thao tác</th>
                            </tr>

                        @isset($members)
                            @foreach($members as $member)
                                <tr>
                                    <td>{{ $member->member2->name }}</td>
                                    <td>{{ $member->m1_m2->relation_name }}</td>
                                    <td>{{ $member->member1->name }}</td>
                                    <td>
                                        <a href="{{ route('members.edit', ['id' => $id, 'member_id' => $member->id]) }}" class="btn btn-flat btn-warning"><i class="fa fa-edit"></i>&nbsp Sửa</a>
                                        <button data-toggle="modal" data-target="#confirm-delete" data-href="{{ route('members.destroy', ['id' => $id, 'member_id' => $member->id]) }}" class="btn btn-danger btn-flat" id="delete-btn"><i class="fa fa-trash"></i> Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        @endisset

                        @if (count($members) == 0)
                            <tr>
                                <td colspan="4" class="text-center">Chưa có thành viên nào</td>
                            </tr>
                        @endif

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection