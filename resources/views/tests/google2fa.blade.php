@extends('layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            GOOGLE 2FA
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active"><a href="{{ route('google2fa') }}">Google 2FA</a></li>
        </ol>
    </section>

    <section class="content">
        <img src="{{ $google2fa_url }}" alt="">
        <form action="{{ route('google2fa.active') }}" method="post">
            {{ csrf_field() }}
            <input type="text" name="secret">
            <input type="hidden" name="google2fa_secret" value="{{ $google2fa_secret }}">

            <button type="submit" class="btn btn-flat btn-default">Active</button>
        </form>

    </section>
@endsection