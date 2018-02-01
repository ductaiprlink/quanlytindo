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
            <li class="active">Sửa</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Sửa nhóm người dùng</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" action="{{ route('roles.update', ['id' => $id]) }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="box-body">
                            <div class="form-group{{ $errors->has('role_name') ? ' has-error' : '' }}">
                                <label for="role_name" class="col-sm-3 control-label">Tên nhóm</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="role_name" name="role_name" placeholder="Tên nhóm người dùng" value="{{ $role->role_name }}">

                                    @if ($errors->has('role_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('role_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="display_name" class="col-sm-3 control-label">Tên hiển thị</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="display_name" name="display_name" value="{{ $role->display_name }}" placeholder="Display Name">

                                    @if ($errors->has('display_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('display_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            {{-- description --}}
                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-sm-3 control-label">Mô tả</label>

                                <div class="col-sm-9">
                                <textarea name="description" id="description" cols="30" rows="5" placeholder="Description" class="form-control">{{ $role->description }}</textarea>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>

                            {{-- danh sách quyền--}}
                            <div class="form-group">
                                <label for="" class="col-sm-12 text-center"><h4><strong>DANH SÁCH QUYỀN</strong></h4></label>
                                <div class="col-sm-12">
                                    <table class="table table-bordered">
                                    <tbody>
                                    <tr>
                                        <th class="text-center">Đối tượng</th>
                                        <th class="text-center">Danh sách</th>
                                        <th class="text-center">Thêm</th>
                                        <th class="text-center">Sửa</th>
                                        <th class="text-center">Xóa</th>
                                    </tr>

                                    @php $i = 0;  @endphp
                                    @foreach($permission as $value)
                                        @if ($i % 4 == 0)
                                            <tr>
                                                <td><strong>{{ strtoupper($value->object) }}</strong></td>
                                        @endif
                                        @php $i++; @endphp


                                        <td><label class="checkbox-inline"><input type="checkbox" value="{{ $value->id }}" name="permission[]"

                                              @foreach($rolePermissions as $rolePer)
                                                  @if ($value->id == $rolePer->permission_id) checked @endif
                                            @endforeach

                                                > {{ $value->display_name }}</label></td>


                                        @if ($i % 4 == 0) </tr> @endif
                                    @endforeach

                                    </tbody></table>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <a href="{{ route('roles.index') }}" class="btn btn-default"><i class="fa fa-chevron-left"></i>&nbsp;&nbsp;Hủy</a>
                            <button type="submit" class="btn btn-success pull-right"><i class="fa fa-plus"></i>&nbsp;&nbsp;Cập nhật</button>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection