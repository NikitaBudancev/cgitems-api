@extends('mails.layouts.default')

@section('content')
    <div style="text-align: center; padding: 20px;font-family: Whitney,Helvetica Neue,Helvetica,Arial,Lucida Grande,sans-serif;">
        <span style="font-size: 23px;">Verify your email</span>
    </div>
    <div style="text-align: center; color: #737f8d; font-family: Whitney,Helvetica Neue,Helvetica,Arial,Lucida Grande,sans-serif;">
        <span>If did not make this request, just ignore this email. Otherwise, please click the button below to verify your email:</span>
    </div>
    <div style="background-color: #fff; text-align: center; padding: 50px 0;">
        <a style="background-color: #9B8CFF; padding: 20px 50px; display: inline-block; text-align: center; color: #fff; text-decoration: none;font-family: Whitney,Helvetica Neue,Helvetica,Arial,Lucida Grande,sans-serif;" href="{{ $verification_link }}">Verify Email</a>
    </div>
@endsection
