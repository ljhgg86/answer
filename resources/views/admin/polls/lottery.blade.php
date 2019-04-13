@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row page-title-row">
        <div class="col-md-12">
            <h3>{{ $poll->title }} <small>抽奖 >></small></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <lotteryform
            :pollid={{ $poll->id }}
            :rewarded={{ $poll->rewarded }}
            >
            </lotteryform>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <a href="{{ url()->previous() }}" class="btn btn-warning btn-md">
                <span class="glyphicon glyphicon-arrow-left"></span> 返回
            </a>
        </div>
    </div>
</div>
@stop
