@extends('layouts.master')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            THÊM TÍN ĐỒ
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active"><a href="{{ route('employees.index') }}">Tín đồ</a></li>
        </ol>
    </section>

    <section class="content">

        @include('pages.success')

        <form action="{{ route('employees.store') }}" method="post" enctype="multipart/form-data">
            <input type="hidden" value="{{ csrf_token() }}" name="_token">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-user fa-fw"></i> Thông tin cá nhân 1</h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <tr>
                                        <td class="left-column-40"><strong>Hình đại diện : <span style="color:red;"> *</span></strong></td>
                                        <td>
                                            <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                                                <input type="file" name="avatar" class="form-control" value="{{ old('avatar') }}" title="hình đại diện">

                                                @if ($errors->has('avatar'))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first('avatar') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong><label for="name">Họ tên : <span style="color:red;"> *</span></label></strong>
                                        </td>
                                        <td>
                                            <div class="form-group{{ $errors->has('name') ? 'errors' : '' }}">
                                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">

                                                @if ($errors->has('name'))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong><label for="date">Ngày sinh : <span style="color:red;"> *</span></label></strong></td>
                                        <td>
                                            <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                                                <input type="date" name="date" id="date" class="form-control" value="{{ old('date') }}">

                                                @if ($errors->has('date'))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first('date') }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong><label for="gender">Giới tính : <span style="color:red;"> *</span></label></strong>
                                        </td>
                                        <td>
                                            @for($i = 1; $i <= 2; $i++)
                                                <label class="radio-inline">
                                                    <input type="radio" name="gender" id="gender" value="{{ $i }}" @if ($i == 1) checked @endif>@if ($i == 1) Nữ @else Nam  @endif
                                                </label>
                                            @endfor
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong><label for="phone">Số điện thoại : <span style="color:red;"> *</span></label></strong></td>
                                        <td>
                                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                                <input type="tel" name="phone" id="phone" class="form-control" value="{{ old('phone') }}">

                                                @if ($errors->has('phone'))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first('phone') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong><label for="career">Nghề nghiệp : <span style="color:red;"> *</span></label></strong></td>
                                        <td>
                                            <div class="form-group{{ $errors->has('career') ? ' has-error' : '' }}">
                                                <input type="text" name="career" id="career" class="form-control" value="{{ old('career') }}">

                                                @if ($errors->has('career'))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first('career') }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong><label for="marriage">Tình trạng hôn nhân : <span style="color:red;"> *</span></label></strong></td>
                                        <td>
                                            <select name="marriage_id" id="marriage" class="form-control">
                                                @foreach($marriages as $marriage)
                                                    <option value="{{ $marriage->id }}">{{ $marriage->marriage_name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong><label for="identity_card_number">CMND : <span style="color:red;"> *</span></label></strong></td>
                                        <td>
                                            <div class="form-group{{ $errors->has('identity_card_number') ? 'errors' : '' }}">
                                                <input type="text" name="identity_card_number" id="identity_card_number" class="form-control" value="{{ old('identity_card_number') }}">

                                                @if ($errors->has('identity_card_number'))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first('identity_card_number') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-user fa-fw"></i> Thông tin cá nhân 2</h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">

                                    <tr>
                                        <td><strong>Trụ sở : <span style="color:red;"> *</span></strong></td>
                                        <td>
                                            <select name="department_id" class="form-control">
                                                @foreach($departments as $department)
                                                    <option value="{{ $department->id }}">{{ $department->department_name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Chức vụ : <span style="color:red;"> *</span></strong></td>
                                        <td>
                                            <select name="position_id" class="form-control">
                                                @foreach($positions as $pos)
                                                    <option value="{{ $pos->id }}">{{ $pos->position_name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong><label for="dateofjoining">Ngày vào : <span style="color:red;"> *</span></label></strong></td>
                                        <td>
                                            <div class="form-group{{ $errors->has('dateofjoining') ? ' has-error' : '' }}">
                                                <input type="date" name="dateofjoining" id="dateofjoining" class="form-control" value="{{ old('dateofjoining') }}">

                                                @if ($errors->has('dateofjoining'))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first('dateofjoining') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong><label for="dateofleaving">Ngày ra : <span style="color:red;"> *</span></label></strong></td>
                                        <td>
                                            <input type="date" name="dateofleaving" id="dateofleaving" class="form-control" value="{{ old('dateofleaving') }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Là người đại diện : <span style="color:red;"> *</span></strong></td>
                                        <td>
                                            @for($i = 0; $i < 2; $i++)
                                                <label class="radio-inline">
                                                    <input type="radio" name="is_leader" value="{{ $i }}" @if ($i == 0) checked @endif>@if ($i == 0) Không @else Có  @endif
                                                </label>
                                            @endfor
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong><label for="introduced">Người giới thiệu : <span style="color:red;"> *</span></label></strong></td>
                                        <td>
                                            <div class="form-group">
                                                <input id="introduced" value="{{ old('introduced') }}" name="introduced">
                                                <input type="hidden" name="introduced_id" id="introduced_id">
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><strong><label for="religion_name">Tên gọi khác : <span style="color:red;"> *</span></label></strong></td>
                                        <td>
                                            <div class="form-group{{ $errors->has('religion_name') ? ' has-error' : '' }}">
                                                <input type="text" name="religion_name" id="religion_name" class="form-control" value="Hồng Danh Chưa Có">

                                                @if ($errors->has('religion_name'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('religion_name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Trình độ học vấn : <span style="color:red;"> *</span></strong></td>
                                        <td>
                                            <select name="education_id" class="form-control">
                                                @foreach($educations as $education)
                                                    <option value="{{ $education->id }}">{{ $education->education_name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>

                                    {{--<tr>--}}
                                        {{--<td><strong>Thành tích - khuyết điểm : <span style="color:red;"> *</span></strong></td>--}}
                                        {{--<td>--}}
                                            {{--<a href="{{ route('achievements.index', ['id' => $employee->id]) }}" class="btn btn-info btn-flat">Thành tích - khuyết điểm</a>--}}
                                        {{--</td>--}}
                                    {{--</tr>--}}
                                    {{--<tr>--}}
                                        {{--<td><strong>Quan hệ gia đình : <span style="color:red;"> *</span></strong></td>--}}
                                        {{--<td>--}}
                                            {{--<a href="{{ route('members.index', ['id' => $employee->id]) }}" class="btn btn-info btn-flat">Quan hệ gia đình</a>--}}
                                        {{--</td>--}}
                                    {{--</tr>--}}

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-user fa-fw"></i> Địa chỉ</h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">

                                    <tr>
                                        <td><strong>Địa chỉ thường trú</strong></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tỉnh/Thành Phố : <span style="color:red;"> *</span></strong></td>
                                        <td>
                                            <select name="province_id" id="province" class="form-control">
                                                <option value="0" selected>-- Chọn tỉnh/thành phố --</option>
                                                @foreach( $provinces as $province )
                                                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Quận/Huyện : <span style="color:red;"> *</span></strong></td>
                                        <td>
                                            <select name="district_id" id="district" class="form-control">
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Xã/Phường : <span style="color:red;"> *</span></strong></td>
                                        <td>
                                            <select name="ward_id" id="ward" class="form-control">
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong><label for="street">Đường : <span style="color:red;"> *</span></label></strong></td>
                                        <td><input type="text" name="street" id="street" class="form-control" value="{{ old('street') }}"></td>
                                    </tr>
                                    <tr>
                                        <td><br><br></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Địa chỉ tạm trú</strong></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tỉnh/Thành Phố : <span style="color:red;"> *</span></strong></td>
                                        <td>
                                            <select name="province_tabernacle_id" id="province_tamtru" class="form-control">
                                                <option value="0" selected>-- Chọn tỉnh/thành phố --</option>
                                                @foreach( $provinces as $province )
                                                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Quận/Huyện : <span style="color:red;"> *</span></strong></td>
                                        <td>
                                            <select name="district_tabernacle_id" id="district_tamtru" class="form-control">
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Xã/Phường : <span style="color:red;"> *</span></strong></td>
                                        <td>
                                            <select name="ward_tabernacle_id" id="ward_tamtru" class="form-control">
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong><label for="street_tamtru">Đường : <span style="color:red;"> *</span></label></strong></td>
                                        <td><input type="text" name="street_tabernacle" id="street_tamtru" class="form-control" value="{{ old('street_tabernacle') }}"></td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <a href="{{ route('employees.index') }}" class="btn btn-flat btn-default "><i class="fa fa-chevron-left"></i>&nbsp;Hủy</a>
                    <button type="submit" class="btn btn-flat btn-success pull-right"><i class="fa fa-plus"></i>&nbsp;Thêm</button>
                </div>
            </div>
        </form>

        {{--<a href="{{ route('employees.index') }}" class="btn btn-default"><i class="fa fa-bars"></i>&nbsp;Danh sách</a>--}}
        {{--<a href="{{ route('employees.show', ['id' => $employee->id]) }}" class="btn btn-info"><i class="fa fa-eye"></i>&nbsp;Chi tiết</a>--}}
    </section>

@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function(){

            // địa chỉ thường trú
            // ajax get district
            $('#province').change(function(){
                var pro_id = $(this).val();
                var path = window.location.pathname;

                path = path.substring(0, path.lastIndexOf("employees")) + "employees"; // muc dich: lay path//employees

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

                path = path.substring(0, path.lastIndexOf("employees")) + "employees"; // muc dich: lay path//employees

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

            // địa chỉ tạm trú
            // ajax get district
            $('#province_tamtru').change(function(){
                var pro_id = $(this).val();
                var path = window.location.pathname;

                path = path.substring(0, path.lastIndexOf("employees")) + "employees"; // muc dich: lay path//employees

                $.ajax({
                    url : path + '/province/' + pro_id,
                    type: 'get',
                    dataType: 'html',

                    success: function (result) {

                        $('#district_tamtru').html(result);
                    },
                    error: function () {
                        alert('Không thành công');
                    }
                });
            });


            // ajax get ward
            $('#district_tamtru').change(function(){
//                alert('district khác 0');
                var dis_id = $(this).val();
                var pro_id = $('#province_tamtru').val();
                var path = window.location.pathname;

                path = path.substring(0, path.lastIndexOf("employees")) + "employees"; // muc dich: lay path//employees

                $.ajax({
                    url : path + '/province/' + pro_id + '/district/' + dis_id,
                    type: 'get',
                    dataType: 'html',

                    success: function (result) {

                        $('#ward_tamtru').html(result);
                    },
                    error: function () {
                        alert('Không thành công');
                    }
                });
            });

            // auto complete nguoi gioi thieu
            var options = {
                url: "{{ route('employees.createintroduced') }}", // path tren route lay du lieu

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
                        var index = $("#introduced").getSelectedItemData().id;

                        $("#introduced_id").val(index).trigger("change");
//                        $("#introduced_id").val(index).trigger("change");
                    }
                },

                theme: "plate-dark"
            };

            $("#introduced").easyAutocomplete(options);

        });
    </script>
@endsection