@extends('layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            QUẢN TRỊ VIÊN
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li><a href="{{ route('users.index') }}">Quản trị viên</a></li>
            <li class="active"><a href="{{ route('users.create') }}">Thêm</a></li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-9 col-xs-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thêm quản trị viên</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" action="{{ route('users.store') }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="box-body">

                            {{-- họ tên --}}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-sm-3 control-label">Họ Tên</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Tên quản trị viên">
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {{--email--}}
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-sm-3 control-label">Email</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Email quản trị viên">
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {{--mật khẩu--}}
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-sm-3 control-label">Mật khẩu</label>

                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu quản trị viên">
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {{--nhập lại mật khẩu--}}
                            <div class="form-group{{ $errors->has('confirm-password') ? ' has-error' : '' }}">
                                <label for="confirm-password" class="col-sm-3 control-label">Nhập lại mật khẩu</label>

                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Nhập lại mật khẩu quản trị viên">
                                    @if ($errors->has('confirm-password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('confirm-password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {{--vai trò--}}
                            <div class="form-group{{ $errors->has('street') ? 'errors' : '' }}">
                                <label for="roles" class="col-sm-3 control-label">Vai trò</label>

                                <div class="col-sm-9">
                                    <select name="roles" id="roles" class="form-control">
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->display_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <a href="{{ route('users.index') }}" class="btn btn-default btn-flat"><i class="fa fa-chevron-left"></i>&nbsp;&nbsp;Hủy</a>
                            <button type="submit" class="btn btn-success pull-right btn-flat"><i class="fa fa-plus"></i>&nbsp;&nbsp;Thêm</button>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function () {

            // địa chỉ thường trú
            // ajax get district
            $('#province').change(function(){
                var pro_id = $(this).val();
                var path = window.location.pathname;

                path = path.substring(0, path.lastIndexOf("departments")) + "departments"; // muc dich: lay /hrm/admin/departments

                $.ajax({
                    url : path + '/province/' + pro_id,
                    type: 'get',
                    dataType: 'html',

                    success: function (result) {

                        $('#district').html(result);
                    },
                    error: function () {
                        alert('Không thành công');
                    }
                });
            });


            // ajax get ward
            $('#district').change(function(){
//                alert('district khác 0');
                var dis_id = $(this).val();
                var pro_id = $('#province').val();
                var path = window.location.pathname;

                path = path.substring(0, path.lastIndexOf("departments")) + "departments";

                $.ajax({
                    url : path + '/province/' + pro_id + '/district/' + dis_id,
                    type: 'get',
                    dataType: 'html',

                    success: function (result) {

                        $('#ward').html(result);
                    },
                    error: function () {
                        alert('Không thành công');
                    }
                });
            });

            // autocomplete lay nguoi dai dien
            var options = {
                url: "{{ route('departments.introduced') }}", // path tren route lay du lieu

                getValue: "name", // ten cot can lay du lieu

                template: {
                    type: "description",
                    fields: {
                        description: "religion_name"
                    }
                },

                list: {
                    match: {
                        enabled: true
                    },
                    onSelectItemEvent: function() {
                        var index = $("#leader").getSelectedItemData().id;

                        $("#leader_id").val(index).trigger("change");
                    }
                },

                theme: "plate-dark"
            };

            $("#leader").easyAutocomplete(options);
        });
    </script>
@endsection