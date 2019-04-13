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
            <voterow
             :voteid={{ $voteid }}
             :pollid={{ $pollid }}>
            </voterow>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <a href="{{ route('admin.votes.listvotes', $pollid) }}" class="btn btn-warning btn-md">
                <span class="glyphicon glyphicon-arrow-left"></span> 返回
            </a>
        </div>
        <div class="col-md-2 pull-right">
            <a href="{{ route('admin.votes.destroyvote', [$pollid,$voteid]) }}" class="btn btn-danger btn-md">
                <span class="glyphicon glyphicon-trash"></span> 删除
            </a>
        </div>
    </div>
</div>
@stop