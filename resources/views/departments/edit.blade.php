@extends('layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            TRỤ SỞ
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li><a href="{{ route('departments.index') }}">Trụ sở</a></li>
            <li class="active">Sửa</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-9 col-xs-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Sửa trụ sở</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" action="{{ route('departments.update', ['id' => $department->id]) }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="box-body">
                            <div class="form-group{{ $errors->has('department_name') ? ' has-error' : '' }}">
                                <label for="department_name" class="col-sm-3 control-label">Trụ sở</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="department_name" name="department_name" placeholder="Tên trụ sở" value="{{ $department->department_name }}">
                                    @if ($errors->has('department_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('department_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="province" class="col-sm-3 control-label">Tỉnh/Thành Phố</label>

                                <div class="col-sm-9">
                                    <select name="province" id="province" class="form-control">
                                        <option value="0" selected>-- Chọn tỉnh/thành phố --</option>
                                        @foreach( $provinces as $province )
                                            <option value="{{ $province->id }}" @if($department->province_id == $province->id) selected @endif>{{ $province->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="district" class="col-sm-3 control-label">Quận/Huyện</label>

                                <div class="col-sm-9">
                                    <select name="district" id="district" class="form-control">
                                        @foreach( $districts as $district )
                                            <option value="{{ $district->id }}" @if($department->district_id == $district->id) selected @endif>{{ $district->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ward" class="col-sm-3 control-label">Xã/Phường</label>

                                <div class="col-sm-9">
                                    <select name="ward" id="ward" class="form-control">
                                        @foreach( $wards as $ward )
                                            <option value="{{ $ward->id }}" @if($department->ward_id == $ward->id) selected @endif>{{ $ward->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('street') ? ' has-error' : '' }}">
                                <label for="street" class="col-sm-3 control-label">Tên đường</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="street" name="street" placeholder="Tên đường" value="{{ $department->street }}">
                                    @if ($errors->has('street'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('street') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address" class="col-sm-3 control-label">Địa chỉ</label>

                                <div class="col-sm-9">
                                    <input type="text" readonly name="address" class="form-control" value="{{ $department->address }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="leader" class="col-sm-3 control-label">Người đại diện</label>

                                <div class="col-sm-9">
                                    {{--<select name="leader_id" id="leader_id" class="form-control">
                                        <option value="0" selected>-- Chọn Người đại diện --</option>
                                        @foreach( $presents as $pre )
                                            <option value="{{ $pre->id }}" @if ($pre->id == $department->leader_id) selected @endif>{{ $pre->name }}</option>
                                        @endforeach
                                    </select>--}}

                                    <input id="leader" name="leader" value="{{ $department->leader->name }}">
                                    <input type="hidden" name="leader_id" id="leader_id" value="{{ $department->leader_id }}">
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <a href="{{ route('departments.index') }}" class="btn btn-default"><i class="fa fa-chevron-left"></i>&nbsp;&nbsp;Hủy</a>
                            <button type="submit" class="btn btn-success pull-right"><i class="fa fa-pencil"></i>&nbsp;&nbsp;Cập nhật</button>
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