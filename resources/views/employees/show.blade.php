@extends('layouts.master')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="box box-success">
                    <div class="box-header with-border hidden-print">
                        <h3 class="box-title pull-left">XEM TÍN ĐỒ</h3>
                        <p class="pull-right"><a href="{{ route('employees.index') }}" class="btn btn-flat btn-default btn-sm"><i class="fa fa-bars"></i>&nbsp; Danh sách tín đồ</a>
                            <a href="{{ route('employees.edit', ['id' => $employee->id]) }}" class="btn btn-flat btn-sm btn-success"><i class="fa fa-pencil"></i> Sửa</a>
                        </p>
                    </div>

                    <div class="box-body">

                        {{-- THÔNG TIN TÍN ĐỒ--}}
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
                            @if ($employee->image != null)
                                <img src="{{ url('avatar') }}\{{ $employee->image }}" alt="" class="img-thumbnail">
                            @else
                                <img src="{{ url('avatar\no_avatar.png') }}" alt="" class="img-thumbnail">
                            @endif

                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-8">
                            <table class="table table-bordered table-responsive">
                                <tr>
                                    <td class="left-column-40"><strong>Họ tên: </strong></td>
                                    <td>{{ $employee->name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Ngày sinh: </strong></td>
                                    <td>{{ Carbon\Carbon::parse($employee->date)->format('d-m-Y') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tên gọi khác: </strong></td>
                                    <td>{{ $employee->religion_name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Nghề nghiệp: </strong></td>
                                    <td>{{ $employee->career }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Trình độ học vấn: </strong></td>
                                    <td>{{ $employee->education->education_name }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="visible-print-inline-block">
                                <br>
                            </div>
                            <table class="table table-bordered table-responsive">
                                <tr>
                                    <td class="left-column"><strong>Mã số: </strong></td>
                                    <td>{{ $employee->id }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Giới tính: </strong></td>
                                    <td>
                                        {{ ($employee->gender == 1) ? 'Nam' : 'Nữ' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>CMND: </strong></td>
                                    <td>{{ $employee->identity_card_number }}</td>
                                </tr>
                                <tr>
                                    <td><strong>SDT: </strong></td>
                                    <td>{{ $employee->phone }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tình trạng hôn nhân: </strong></td>
                                    <td>{{ $employee->marriage->marriage_name }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <br>
                            <table class="table table-bordered table-responsive">
                                <tr>
                                    <td><strong>Địa chỉ thường trú: </strong></td>
                                    <td>{{ $employee->address }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Địa chỉ tạm trú: </strong></td>
                                    <td>{{ $employee->tabernacle }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Người giới thiệu: </strong></td>
                                    <td>
                                        @if ($introduced != '')
                                            {{ $introduced->name }} (<strong>Mã số : </strong>{{ $introduced->id }})
                                        @else {{ $introduced }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Ngày vào: </strong></td>
                                    <td>{{ Carbon\Carbon::parse($employee->dateofjoining)->format('d-m-Y') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Nơi công tác: </strong></td>
                                    <td>
                                        @if ($employee->department_id != null)
                                            {{ $employee->department->department_name }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Chức vụ: </strong></td>
                                    <td>
                                        @if ($employee->position != null)
                                            {{ $employee->position->position_name }}
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>


                        {{-- thành tích - khuyết điểm --}}
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <table class="table table-bordered table-responsive">
                                <tr>
                                    <th colspan="3" class="text-center">BẢNG THÀNH TÍCH - KHUYẾT ĐIỂM</th>
                                </tr>
                                <tr>
                                    <th>Ngày</th>
                                    <th>Thành tích</th>
                                    <th>Khuyết điểm</th>
                                </tr>

                                @if (isset($achievements) && count($achievements))
                                @foreach ($achievements as $achie)
                                <tr>
                                    <td>{{ $achie->date }}</td>
                                    <td>{{ $achie->advantage }}</td>
                                    <td>{{ $achie->disadvantage }}</td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                <td colspan="3" class="text-center">Chưa có thành tích - khuyết điểm nào</td>
                                </tr>
                                @endif

                            </table>
                        </div>



                        {{-- thành viên trong gia đình --}}

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <table class="table table-bordered table-responsive">
                                <tr>
                                    <th colspan="3" CLASS="text-center">CÁC THÀNH VIÊN TRONG GIA ĐÌNH</th>
                                </tr>
                                <tr>
                                    <th>No</th>
                                    <th>Thành viên</th>
                                    <th>Mối liên hệ</th>
                                </tr>
                                @if (isset($members) && count($members))
                                <?php $i = 0; ?>
                                @foreach ($members as $member)
                                <?php $i++; ?>
                                <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $member->member2->name }}</td>
                                <td>{{ $member->m1_m2->relation_name }}</td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                <td colspan="3" class="text-center">Chưa có thành viên gia đình nào</td>
                                </tr>
                                @endif
                            </table>
                        </div>
                        {{--END THÔNG TIN TÍN ĐỒ--}}

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection