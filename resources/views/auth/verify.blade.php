@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address ยืนยันที่อยู่อีเมลของคุณ') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address. ลิงก์ยืนยันใหม่ได้ถูกส่งไปยังที่อยู่อีเมลของคุณแล้ว') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link. ก่อนดำเนินการต่อ โปรดตรวจสอบอีเมลของคุณเพื่อดูลิงก์ยืนยัน') }}
                    {{ __('If you did not receive the email หากคุณไม่ได้รับอีเมล') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another คลิกที่นี่เพื่อขออีก') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
