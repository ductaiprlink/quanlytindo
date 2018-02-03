@extends('layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            TÍN ĐỒ
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li><a href="{{ route('employees.index') }}">Tín đồ</a></li>
            <li class="active"><a href="{{ route('employees.index') }}">Danh sách</a></li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-8 col-xs-12">
                <div class="panel box box-danger">
                    <div class="box-header with-border">
                        <h4 class="box-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#import" class="text-red" aria-expanded="true">
                                Thêm Tín Đồ Từ File Excel
                            </a>
                        </h4>
                    </div>
                    <div id="import" class="panel-collapse collapse" aria-expanded="true" style="">
                        <div class="box-body">
                            <p><a href="{{ route('employees.downloadExcelSample') }}" class="btn btn-success btn-flat"><i class="fa fa-file-excel-o"></i>&nbsp;Tải form Excel mẫu</a></p>

                            <form action="{{ route('employees.import') }}" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="file" name="list"><br>
                                <button type="submit" class="btn btn-danger btn-flat">Import list</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{--<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">--}}
                {{--@include('employees.searchAdvanced')--}}
            {{--</div>--}}
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title pull-left">Danh sách</h3>

                        {{-- CÁCH MỚI --}}
                        <div class="box-tools pull-right">
                            <form action="{{ route('employees.search') }}" method="get">
                                <div class="input-group input-group-sm" style="width: 150px; display: inline-table;">
                                    <input type="text" name="keyword" class="form-control" placeholder="Nhập tên, sdt, cmnd" required>
                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{--BỘ LỌC FILTER--}}
                    <div class="box-body">

                        @include('employees.filter')

                        {{--THONG BAO--}}
                        <div class="col-sm-12">
                            @include('pages.success')
                            @include('pages.confirm')
                        </div>

                        {{--SO LUONG TIN DO IMPORT THANH CONG--}}
                        <div class="col-sm-12">
                            @if (Session::has('total'))
                                <div class="alert alert-info">
                                    {{ session('total') }} tín đồ đã được thêm
                                </div>
                            @endif
                        </div>

                        {{--DANH SACH THANH VIEN IMPORT LOI--}}
                        <div class="col-sm-12">
                            @if (Session::has('errors'))
                                <div class="alert alert-danger">
                                    <h4>CÁC TÍN ĐỒ CHƯA ĐƯỢC THÊM</h4>
                                    @php $errors = session('errors') @endphp

                                    @foreach($errors as $err)
                                        <p>{{ $err }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        {{--CÁC YÊU CẦU TÌM KIẾM--}}
                        <div class="col-sm-12">
                        @if (Session::has('req'))
                            @php $requests = session('req') @endphp

                            <div class="alert alert-info">
                                <h4>Đang tìm kiếm thành viên cho:</h4>
                                @foreach($requests as $key => $value)
                                    <p>{{ $value }}</p>
                                @endforeach
                            </div>
                        @endif

                        {{-- Nếu đếm != 0 thì xuất ra kết quả, = 0 thì không có kết quả --}}
                        @if (Session::has('counter'))
                            @if (session('counter') != "0")
                                <div class="alert alert-success">
                                    Đã tìm thấy {{ session('counter') }} kết quả
                                </div>

                            @elseif (session('counter') == "0")
                                <div class="alert alert-danger">
                                    Không tìm thấy thành viên phù hợp với yêu cầu tìm kiếm
                                </div>
                            @endif
                        @endif
                        </div>
                        <br><br>

                        <h4 class="text-danger"><strong>Tìm thấy {{ $count }} kết quả</strong></h4>

                        <table class="table table-bordered">
                            <tbody><tr>
                                <th>Số</th>
                                <th>Tên</th>
                                <th>Địa chỉ</th>
                                <th>Tình trạng</th>
                                <th>Thao tác</th>
                            </tr>

                            @foreach($employees as $emp)

                                <tr>
                                    <td>{{ $emp->id }}</td>
                                    <td><a href="{{ route('employees.show', ['id' => $emp->id]) }}">{{ $emp->name }}</a></td>
                                    <td>{{ $emp->address }}</td>
                                    <td>@if ($emp->showhide == 1)
                                            <span class="label label-info">{{ $emp->status->status }}</span>
                                        @else <span class="label label-important">{{ $emp->status->status }}</span> @endif</td>
                                    <td>
                                        <a href="{{ route('employees.show', ['id' => $emp->id]) }}" class="btn btn-flat btn-info"><i class="fa fa-search-plus"></i>&nbsp Xem</a>
                                        <a href="{{ route('employees.edit', ['id' => $emp->id]) }}" class="btn btn-flat btn-warning"><i class="fa fa-edit"></i>&nbsp Sửa</a>
                                        <button data-toggle="modal" data-target="#confirm-delete" data-href="{{ route('employees.destroy', ['id' => $emp->id]) }}" class="btn btn-danger btn-flat" id="delete-btn"><i class="fa fa-trash"></i> Delete</button>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody></table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix text-center">
                        {{ $employees->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function(){


            // search Advance
            var options2 = {
                url: "{{ route('employees.createintroduced') }}",

                getValue: "name",

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
                    }
                },

                theme: "plate-dark"
            };

            $("#introduced").easyAutocomplete(options2);
        });
    </script>
@endsection