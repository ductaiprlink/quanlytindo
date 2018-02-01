@extends('layouts.master')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            SỬA TÍN ĐỒ
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active"><a href="{{ route('employees.index') }}">Tín đồ</a></li>
        </ol>
    </section>

    <section class="content">

        @include('pages.success')

        <form action="{{ route('employees.update', ['id' => $employee->id]) }}" method="post" enctype="multipart/form-data">
            <input type="hidden" value="{{ csrf_token() }}" name="_token">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-user fa-fw"></i> Thông tin cá nhân</h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <tr>
                                        <td class="left-column-40"><strong>Hình đại diện : <span style="color:red;"> *</span></strong></td>
                                        <td>
                                            {{--<img src="{{ url('local\storage\avatar') }}\{{ $employee->image }}" alt="" class="img-thumbnail" style="width:70%; height: 200px;">--}}
                                            @isset($employee->image)
                                                <img src="{{ url('avatar') }}\{{ $employee->image }}" alt="" class="img-thumbnail" style="width:70%; height: 200px;">
                                            @endisset

                                            @if (!count($employee->image))
                                                <img src="{{ url('avatar') }}\no_avatar.png" alt="" class="img-thumbnail" style="width:70%; height: 200px;">
                                            @endif

                                            <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                                                <input type="file" name="avatar" class="form-control" value="{{ old('image') }}" title="hình đại diện">

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
                                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                                <input type="text" name="name" id="name" class="form-control" value="{{ $employee->name }}">

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
                                                <input type="date" name="date" id="date" class="form-control" value="{{ $employee->date }}">

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
                                            @for($i = 0; $i < 2; $i++)
                                                <label class="radio-inline">
                                                    <input type="radio" name="gender" id="gender" value="{{ $i }}" @if($employee->gender == $i) checked @endif>@if ($i == 0) Nữ @else Nam  @endif
                                                </label>
                                            @endfor
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong><label for="phone">Số điện thoại : <span style="color:red;"> *</span></label></strong></td>
                                        <td>
                                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                                <input type="tel" name="phone" id="phone" class="form-control" value="{{ $employee->phone }}">

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
                                                <input type="text" name="career" id="career" class="form-control" value="{{ $employee->career }}">

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
                                            <select name="marriage" id="marriage" class="form-control">
                                                @foreach($marriages as $marriage)
                                                    <option value="{{ $marriage->id }}" @if($marriage->id == $employee->marriage_id) selected @endif>{{ $marriage->marriage_name }}</option>
                                                @endforeach
                                            </select>
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
                            <h3 class="panel-title"><i class="fa fa-user fa-fw"></i> Thông tin cá nhân</h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">

                                    <tr>
                                        <td><strong>Trụ sở : <span style="color:red;"> *</span><strong/></td>
                                        <td>
                                            <select name="department" id="" class="form-control">
                                                @foreach($departments as $department)
                                                    <option value="{{ $department->id }}" @if ($department->id == $employee->department_id) selected  @endif>{{ $department->department_name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Chức vụ : <span style="color:red;"> *</span></strong></td>
                                        <td>
                                            <select name="position_id" id="" class="form-control">
                                                @foreach($positions as $pos)
                                                    <option value="{{ $pos->id }}" @if ($pos->id == $employee->designation_id) selected  @endif>{{ $pos->position_name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong><label for="dateofjoining">Ngày vào : <span style="color:red;"> *</span></label></strong></td>
                                        <td>
                                            <div class="form-group{{ $errors->has('dateofjoining') ? ' has-error' : '' }}">
                                                <input type="date" name="dateofjoining" id="dateofjoining" class="form-control" value="{{ $employee->dateofjoining }}">

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
                                                    <input type="radio" name="is_leader" value="{{ $i }}" @if($employee->is_leader == $i) checked @endif>@if ($i == 0) Không @else Có  @endif
                                                </label>
                                            @endfor
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong><label for="introduced">Người giới thiệu : <span style="color:red;"> *</span></label></strong></td>
                                        <td>
                                            <div class="form-group">
                                                <input id="introduced" value="{{ isset($introduced) ? $introduced->name : '' }}">
                                                <input type="hidden" name="introduced_id" id="introduced_id">
                                            </div>
                                        </td>
                                    </tr>
                                    {{--<tr>--}}
                                        {{--<td><strong>Là thành viên của : <span style="color:red;"> *</span></strong></td>--}}
                                        {{--<td>--}}
                                            {{--<select name="family_id" id="" class="form-control">--}}
                                                {{--<option value="0" selected>-- Mời chọn gia đình --</option>--}}
                                                {{--@foreach($families as $family)--}}
                                                    {{--<option value="{{ $family->id }}" @if ($family->id == $employee->family_id) selected @endif>{{ $family->family_name }}</option>--}}
                                                {{--@endforeach--}}
                                            {{--</select>--}}
                                        {{--</td>--}}
                                    {{--</tr>--}}
                                    <tr>
                                        <td><strong><label for="identity_card_number">CMND : <span style="color:red;"> *</span></label></strong></td>
                                        <td>
                                            <div class="form-group{{ $errors->has('identity_card_number') ? ' has-error' : '' }}">
                                                <input type="text" name="identity_card_number" id="identity_card_number" class="form-control" value="{{ $employee->identity_card_number }}">

                                                @if ($errors->has('identity_card_number'))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first('identity_card_number') }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong><label for="religion_name">Tên gọi khác : <span style="color:red;"> *</span></label></strong></td>
                                        <td>
                                            <div class="form-group{{ $errors->has('religion_name') ? 'errors' : '' }}">
                                                <input type="text" name="religion_name" id="religion_name" class="form-control" value="{{ $employee->religion_name }}">

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
                                            <select name="education" id="" class="form-control">
                                                @foreach($educations as $education)
                                                    <option value="{{ $education->id }}" @if ($education->id == $employee->education_id) selected  @endif>{{ $education->education_name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><strong>Thành tích - khuyết điểm : <span style="color:red;"> *</span></strong></td>
                                        <td>
                                            <a href="{{ route('achievements.index', ['id' => $employee->id]) }}" class="btn btn-info btn-flat">Thành tích - khuyết điểm</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Quan hệ gia đình : <span style="color:red;"> *</span></strong></td>
                                        <td>
                                            <a href="{{ route('members.index', ['id' => $employee->id]) }}" class="btn btn-info btn-flat">Quan hệ gia đình</a>
                                        </td>
                                    </tr>

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
                                        <td>{{ $employee->address }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tỉnh/Thành Phố : <span style="color:red;"> *</span></strong></td>
                                        <td>
                                            <select name="province" id="province" class="form-control">
                                                <option value="0" selected>-- Chọn tỉnh/thành phố --</option>
                                                @foreach( $provinces as $province )
                                                    <option value="{{ $province->id }}" @if($province->id == $employee->province_id) selected @endif>{{ $province->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Quận/Huyện : <span style="color:red;"> *</span></strong></td>
                                        <td>
                                            <select name="district" id="district" class="form-control">
                                                @foreach( $districts as $district )
                                                    <option value="{{ $district->id }}" @if($district->id == $employee->district_id) selected @endif>{{ $district->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Xã/Phường : <span style="color:red;"> *</span></strong></td>
                                        <td>
                                            <select name="ward" id="ward" class="form-control">
                                                @foreach( $wards as $ward )
                                                    <option value="{{ $ward->id }}" @if ($ward->id == $employee->ward_id) selected @endif>{{ $ward->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong><label for="street">Đường : <span style="color:red;"> *</span></label></strong></td>
                                        <td><input type="text" name="street" id="street" class="form-control" value="{{ $employee->street }}"></td>
                                    </tr>
                                    <tr>
                                        <td><br><br></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Địa chỉ tạm trú</strong></td>
                                        <td>{{ $employee->tabernacle }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tỉnh/Thành Phố : <span style="color:red;"> *</span></strong></td>
                                        <td>
                                            <select name="province_tamtru" id="province_tamtru" class="form-control">
                                                <option value="0" selected>-- Chọn tỉnh/thành phố --</option>
                                                @foreach( $provinces as $province )
                                                    <option value="{{ $province->id }}" @if($province->id == $employee->province_tabernacle_id) selected @endif>{{ $province->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Quận/Huyện : <span style="color:red;"> *</span></strong></td>
                                        <td>
                                            <select name="district_tamtru" id="district_tamtru" class="form-control">
                                                @foreach( $districts_tabernacles as $districts_tabernacle )
                                                    <option value="{{ $districts_tabernacle->id }}" @if($districts_tabernacle->id == $employee->district_tabernacle_id) selected @endif>{{ $districts_tabernacle->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Xã/Phường : <span style="color:red;"> *</span></strong></td>
                                        <td>
                                            <select name="ward_tamtru" id="ward_tamtru" class="form-control">
                                                @foreach( $wards_tabernacles as $wards_tabernacle )
                                                    <option value="{{ $wards_tabernacle->id }}" @if($wards_tabernacle->id == $employee->ward_tabernacle_id) selected @endif>{{ $wards_tabernacle->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong><label for="street_tamtru">Đường : <span style="color:red;"> *</span></label></strong></td>
                                        <td><input type="text" name="street_tamtru" id="street_tamtru" class="form-control" value="{{ $employee->street_tabernacle }}"></td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <a href="{{ route('employees.index') }}" class="btn btn-flat btn-default "><i class="fa fa-chevron-left"></i>&nbsp;Hủy</a>
                    <button type="submit" class="btn btn-flat btn-success pull-right"><i class="fa fa-pencil"></i>&nbsp;Cập nhật</button>
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
                url: "{{ route('employees.introduced', ['id' => $employee->id]) }}", // path tren route lay du lieu

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