@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-1">
                <br>
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Xác thực 2 Bước</strong></div>
                    <div class="panel-body">
                        <p>Để tăng tính bảo mật thông tin. Vui lòng làm theo hướng dẫn dưới đây.</p>
                        <br/>
                        <strong>
                            <ol>
                                <li>Click vào nút bên dưới để kích hoạt chức năng xác thực 2 bước.</li>
                                <li>Nhập mã xác thực OTP (One Time Password) trong ứng dụng Google Authenticator trên điện thoại smartphone của bạn</li>
                            </ol>
                        </strong>
                        <br/>

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif


                        @if(!count($data['user']->passwordSecurity))
                            <form class="form-horizontal" method="POST" action="{{ route('generate2faSecret') }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Tạo dữ liệu xác thực hai bước
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @elseif(!$data['user']->passwordSecurity->google2fa_enable)
                            <strong>1. Quét barcode này bằng ứng dụng Google Authenticator:</strong><br/><br>
                            <img src="{{$data['google2fa_url'] }}" alt="">
                            <br/><br/>
                            <strong>2.Nhập mã OTP để kích hoạt 2FA (xác thực 2 bước)</strong><br/><br/>
                            <form class="form-horizontal" method="POST" action="{{ route('enable2fa') }}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('verify-code') ? ' has-error' : '' }}">
                                    <label for="verify-code" class="col-md-4 control-label">Mã OTP</label>

                                    <div class="col-md-6">
                                        <input id="verify-code" type="password" class="form-control" name="verify-code" required>

                                        @if ($errors->has('verify-code'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('verify-code') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary btn-flat">
                                            Bật 2FA
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @elseif($data['user']->passwordSecurity->google2fa_enable)
                            <div class="alert alert-success">
                                2FA dã được <strong>kích hoạt</strong> cho tài khoản của bạn.
                            </div>
                            <h3 style="color: orangered; font-weight: 900">Nếu bạn muốn vô hiệu hóa chức năng 2FA. Vui lòng nhập mật khẩu của bạn và click vào nút bên dưới.</h3>
                            <form class="form-horizontal" method="POST" action="{{ route('disable2fa') }}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                                    <label for="change-password" class="col-md-4 control-label">Mật khẩu hiện tại</label>

                                    <div class="col-md-6">
                                        <input id="current-password" type="password" class="form-control" name="current-password" required>

                                        @if ($errors->has('current-password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('current-password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-md-offset-5">
                                    <button type="submit" class="btn btn-primary btn-flat">Vô hiệu hóa 2FA</button>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection