@extends('layouts.app')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@stop
@section('content')
<div class="container">
    <div class="row page-title-row">
        <div class="col-md-12">
            <h3>{{ config('answer.votes') }} <small>» 编辑</small></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <voterow :voteid={{ $voteid }}>
            </voterow>
        </div>
    </div>
</div>
@stop