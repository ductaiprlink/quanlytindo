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
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title pull-left">KẾT QUẢ TÌM KIẾM</h3>

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


                    <!-- /.box-header -->

                    <div class="box-body">

                        <h3><strong class="text-aqua">Từ khóa tìm kiếm là: {{ $keyword }}</strong></h3>

                        @if (count($employees) == 0)
                            <h4 class="text-danger"><strong>Không tìm thấy kết quả tương ứng</strong></h4>

                        @elseif (count($employees))
                            <h3><strong class="text-danger">Tìm thấy {{ count($employees) }} kết quả</strong></h3>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Số</th>
                                        <th>Tên</th>
                                        <th>Địa chỉ</th>
                                        <th>Tình trạng</th>
                                        <th>Thao tác</th>
                                    </tr>

                                    @foreach($employees as $emp)
                                        <tr>
                                            <td>{{ $emp->id }}</td>
                                            <td>{{ $emp->name }}</td>
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
                                </tbody>
                            </table>

                        @endif
                        <hr>
                        <a href="{{ route('employees.index') }}" class="btn btn-flat btn-primary"><i class="fa fa-chevron-left"></i>&nbsp;&nbsp;Quay lại danh sách</a>
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
            // search by name
            {{--var options = {--}}
                {{--url: "{{ route('employees.searchbyname') }}",--}}

                {{--getValue: "name",--}}

                {{--template: {--}}
                    {{--type: "links",--}}
                    {{--fields: {--}}
                        {{--link: "show"--}}
                    {{--}--}}
                {{--},--}}

                {{--theme: "plate-dark"--}}
            {{--};--}}

            {{--$("#employee-links").easyAutocomplete(options);--}}

            {{--// search Advance--}}
            {{--var options2 = {--}}
                {{--url: "{{ route('employees.createintroduced') }}",--}}

                {{--getValue: "name",--}}

                {{--template: {--}}
                    {{--type: "description",--}}
                    {{--fields: {--}}
                        {{--description: "religion_name"--}}
                    {{--}--}}
                {{--},--}}

                {{--list: {--}}
                    {{--match: {--}}
                        {{--enabled: true--}}
                    {{--},--}}
                    {{--onSelectItemEvent: function() {--}}
                        {{--var index = $("#introduced").getSelectedItemData().id;--}}

                        {{--$("#introduced_id").val(index).trigger("change");--}}
{{--//                        $("#introduced_id").val(index).trigger("change");--}}
                    {{--}--}}
                {{--},--}}

                {{--theme: "plate-dark"--}}
            {{--};--}}

            {{--$("#introduced").easyAutocomplete(options2);--}}
        });
    </script>
@endsection