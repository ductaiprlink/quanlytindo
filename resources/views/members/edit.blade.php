@extends('layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            SỬA THÀNH VIÊN
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active"><a href="{{ route('members.index', ['id' => $id]) }}">Thành viên</a></li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tín đồ: {{ $employee->name }} - Mã số: {{ $id }}</h3>
                    </div>

                    <form class="form-horizontal" action="{{ route('members.update', ['id' => $id, 'member_id' => $member->id]) }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="employee_id" value="{{ $id }}">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="member2" class="col-sm-3 control-label">Thành viên 2</label>

                                <div class="col-sm-9">
                                    <input id="member2" name="member2" value="{{ $member->member2->name }}">
                                    <input type="hidden" id="member2_id" name="member2_id">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="advantage" class="col-sm-3 control-label">Là</label>

                                <div class="col-sm-9">
                                    <select name="m1_m2_type" class="form-control">
                                        @foreach ($relations as $rela)
                                            <option value="{{ $rela->id }}" @if ($rela->id == $member->m1_m2_type) selected @endif>{{ $rela->relation_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="disadvantage" class="col-sm-3 control-label">Thành viên 1</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="{{ $employee->name }}" readonly>
                                    <input type="hidden" name="member1_id" value="{{ $employee->id }}">
                                </div>
                            </div>
                        </div>

                        <!-- /.box-body -->
                        <div class="box-footer">
                            <a href="{{ route('members.index', ['id' => $id]) }}" class="btn btn-default btn-flat"><i class="fa fa-chevron-left"></i>&nbsp;Quay lại</a>
                            <button type="submit" class="btn btn-success pull-right btn-flat"><i class="fa fa-plus"></i>&nbsp;Cập nhật</button>
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
        $(document).ready(function(){

            // auto complete thành viên trong gia đình
            var options = {
                url: "{{ route('members.member', ['id'=>$employee->id]) }}", // path tren route lay du lieu

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
                        var index = $("#member2").getSelectedItemData().id;

                        $("#member2_id").val(index).trigger("change");
                    }
                },

                theme: "plate-dark"
            };

            $("#member2").easyAutocomplete(options);

        });
    </script>
@endsection

