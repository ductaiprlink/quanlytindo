{{-- TIM KIEM NANG CAO BANG POST METHOD --}}
{{--<div class="panel box box-info">--}}
    {{--<div class="box-header with-border">--}}
        {{--<h4 class="box-title">--}}
            {{--<a data-toggle="collapse" data-parent="#accordion" href="#searchAdvanced" class="text-aqua" aria-expanded="true">--}}
                {{--Tìm Kiếm Nâng Cao--}}
            {{--</a>--}}
        {{--</h4>--}}
    {{--</div>--}}

    {{--<div id="searchAdvanced" class="panel-collapse collapse" aria-expanded="true" style="">--}}
        {{--<div class="box-body">--}}
            {{--<form action="{{ route('employees.searchAdvanced') }}" method="post" enctype="multipart/form-data">--}}
                {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}

                {{--<div class="row">--}}

                    {{-- Giới tính --}}
                    {{--<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">--}}
                        {{--<div class="form-group">--}}
                            {{--<label for="gender">Giới tính:</label>--}}

                            {{--<select name="gender" id="" class="form-control">--}}
                                {{--<option value="" selected>--- Giới tính ---</option>--}}
                                {{--<option value="0">Nữ</option>--}}
                                {{--<option value="1">Nam</option>--}}
                            {{--</select>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{-- Số điện thoại --}}
                    {{--<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">--}}
                        {{--<div class="form-group">--}}
                            {{--<label for="phone">Số điện thoại: </label>--}}

                            {{--<input type="text" name="phone" class="form-control">--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{-- gia đình --}}
                    {{--<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">--}}
                    {{--<div class="form-group">--}}
                    {{--<label for="family">Thuộc gia đình: </label>--}}

                    {{--<select name="family_id" id="" class="form-control">--}}
                    {{--<option value="" selected>--- Gia đình ---</option>--}}
                    {{--@foreach($families as $family)--}}
                    {{--<option value="{{ $family->id }}">{{ $family->family_name }}</option>--}}
                    {{--@endforeach--}}
                    {{--</select>--}}
                    {{--</div>--}}
                    {{--</div>--}}

                    {{-- Trụ sở --}}
                    {{--<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">--}}
                        {{--<div class="form-group">--}}
                            {{--<label for="department">Trụ sở: </label>--}}

                            {{--<select name="department_id" id="" class="form-control">--}}
                                {{--<option value="" selected>--- Trụ sở ---</option>--}}
                                {{--@foreach($departments as $department)--}}
                                    {{--<option value="{{ $department->id }}">{{ $department->department_name }}</option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{-- Chức vụ --}}
                    {{--<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">--}}
                        {{--<div class="form-group">--}}
                            {{--<label for="position_id">Chức vụ: </label>--}}

                            {{--<select name="position_id" id="position_id" class="form-control">--}}
                                {{--<option value="" selected>--- Chức vụ ---</option>--}}
                                {{--@foreach($positions as $pos)--}}
                                    {{--<option value="{{ $pos->id }}">{{ $pos->position_name }}</option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{-- CMND --}}
                    {{--<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">--}}
                        {{--<div class="form-group">--}}
                            {{--<label for="cmnd">CMND: </label>--}}

                            {{--<input type="text" name="identity_card_number" class="form-control">--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{-- Nghề nghiệp --}}
                    {{--<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">--}}
                        {{--<div class="form-group">--}}
                            {{--<label for="career">Nghề nghiệp: </label>--}}

                            {{--<select name="career" id="" class="form-control">--}}
                                {{--<option value="" selected>--- Nghề nghiệp ---</option>--}}
                                {{--@foreach($careers as $career)--}}
                                    {{--<option value="{{ $career->career }}">{{ $career->career }}</option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{-- Hôn nhân --}}
                    {{--<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">--}}
                        {{--<div class="form-group">--}}
                            {{--<label for="marriage_id">Hôn nhân: </label>--}}

                            {{--<select name="marriage_id" id="" class="form-control">--}}
                                {{--<option value="" selected>--- Gia đình ---</option>--}}

                                {{--@foreach($marriages as $marriage)--}}
                                    {{--<option value="{{ $marriage->id }}">{{ $marriage->marriage_name }}</option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                        {{--</div>--}}
                    {{--</div>--}}


                    {{-- Trình độ học vấn --}}
                    {{--<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">--}}
                        {{--<div class="form-group">--}}
                            {{--<label for="education_id">Trình độ học vấn: </label>--}}

                            {{--<select name="education_id" id="" class="form-control">--}}
                                {{--<option value="" selected>--- Trình độ học vấn ---</option>--}}

                                {{--@foreach($educations as $education)--}}
                                    {{--<option value="{{ $education->id }}">{{ $education->education_name }}</option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{-- Người giới thiệu --}}
                    {{--<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">--}}
                        {{--<div class="form-group">--}}
                            {{--<label for="introduced_id">Người giới thiệu: </label>--}}

                            {{--<input id="introduced" class="form-control">--}}
                            {{--<input type="hidden" id="introduced_id" name="introduced_id">--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{-- Tỉnh thành --}}
                    {{--<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">--}}
                        {{--<div class="form-group">--}}
                            {{--<label for="province_id">Tỉnh thành: </label>--}}

                            {{--<select name="province_id" id="" class="form-control">--}}
                                {{--<option value="" selected>--- Tỉnh thành ---</option>--}}

                                {{--@foreach($provinces as $province)--}}
                                    {{--<option value="{{ $province->id }}">{{ $province->name }}</option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">--}}
                        {{--<div class="form-group">--}}
                            {{--<label for="province_id" class=""></label>--}}
                            {{--<p><button type="submit" class="btn btn-info btn-block"><i class="fa fa-search"></i>&nbsp; Tìm</button></p>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                {{--</div>--}}
            {{--</form>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}

{{-- TIM KIEM NANG CAO BANG GET METHOD --}}
<div class="panel box box-info">
    <div class="box-header with-border">
        <h4 class="box-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#searchAdvanced" class="text-aqua" aria-expanded="true">
                Tìm Kiếm Nâng Cao
            </a>
        </h4>
    </div>

    <div id="searchAdvanced" class="panel-collapse collapse" aria-expanded="true" style="">
        <div class="box-body">
            <form action="{{ route('employees.filter') }}" method="get" enctype="multipart/form-data">
                <div class="row">

                    {{-- Giới tính --}}
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group">
                            <label for="gender">Giới tính:</label>

                            <select name="gender" id="" class="form-control">
                                <option value="2" selected>--- Giới tính ---</option>
                                <option value="0">Nữ</option>
                                <option value="1">Nam</option>
                            </select>
                        </div>
                    </div>

                    {{-- Số điện thoại --}}
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group">
                            <label for="phone">Số điện thoại: </label>

                            <input type="text" name="phone" class="form-control">
                        </div>
                    </div>

                    {{-- gia đình --}}
                    {{--<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">--}}
                    {{--<div class="form-group">--}}
                    {{--<label for="family">Thuộc gia đình: </label>--}}

                    {{--<select name="family_id" id="" class="form-control">--}}
                    {{--<option value="" selected>--- Gia đình ---</option>--}}
                    {{--@foreach($families as $family)--}}
                    {{--<option value="{{ $family->id }}">{{ $family->family_name }}</option>--}}
                    {{--@endforeach--}}
                    {{--</select>--}}
                    {{--</div>--}}
                    {{--</div>--}}

                    {{-- Trụ sở --}}
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group">
                            <label for="department">Trụ sở: </label>

                            <select name="department_id" id="" class="form-control">
                                <option value="0" selected>--- Trụ sở ---</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->department_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Chức vụ --}}
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group">
                            <label for="position_id">Chức vụ: </label>

                            <select name="position_id" id="position_id" class="form-control">
                                <option value="0" selected>--- Chức vụ ---</option>
                                @foreach($positions as $pos)
                                    <option value="{{ $pos->id }}">{{ $pos->position_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- CMND --}}
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group">
                            <label for="cmnd">CMND: </label>

                            <input type="text" name="identity_card_number" class="form-control">
                        </div>
                    </div>

                    {{-- Nghề nghiệp --}}
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group">
                            <label for="career">Nghề nghiệp: </label>

                            <select name="career" id="" class="form-control">
                                <option value="0" selected>--- Nghề nghiệp ---</option>
                                @foreach($careers as $career)
                                    <option value="{{ $career->career }}">{{ $career->career }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Hôn nhân --}}
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group">
                            <label for="marriage_id">Hôn nhân: </label>

                            <select name="marriage_id" id="" class="form-control">
                                <option value="0" selected>--- Gia đình ---</option>

                                @foreach($marriages as $marriage)
                                    <option value="{{ $marriage->id }}">{{ $marriage->marriage_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    {{-- Trình độ học vấn --}}
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group">
                            <label for="education_id">Trình độ học vấn: </label>

                            <select name="education_id" id="" class="form-control">
                                <option value="0" selected>--- Trình độ học vấn ---</option>

                                @foreach($educations as $education)
                                    <option value="{{ $education->id }}">{{ $education->education_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Người giới thiệu --}}
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group">
                            <label for="introduced_id">Người giới thiệu: </label>

                            <input id="introduced" class="form-control">
                            <input type="hidden" id="introduced_id" name="introduced_id">
                        </div>
                    </div>

                    {{-- Tỉnh thành --}}
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group">
                            <label for="province_id">Tỉnh thành: </label>

                            <select name="province_id" id="" class="form-control">
                                <option value="0" selected>--- Tỉnh thành ---</option>

                                @foreach($provinces as $province)
                                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group">
                            <label for="province_id" class=""></label>
                            <p><button type="submit" class="btn btn-info btn-block"><i class="fa fa-search"></i>&nbsp; Tìm</button></p>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>