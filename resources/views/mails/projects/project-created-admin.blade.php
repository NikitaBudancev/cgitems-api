@extends('mails.layouts.default')

@section('content')
    <div
        style="text-align: center; padding: 20px;font-family: Whitney,Helvetica Neue,Helvetica,Arial,Lucida Grande,sans-serif;">
        <span style="font-size: 23px;">New Project {{$project->name}}</span>
    </div>
@endsection
