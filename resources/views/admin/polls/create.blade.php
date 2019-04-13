@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row page-title-row">
        <div class="col-md-12">
            <h3>{{ config('answer.polls') }} <small>» 新建</small></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">新建{{ config('answer.polls') }}窗口</h3>
                </div>
                <div class="panel-body">
                    @include('partials.errors')
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('polls.store') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @include('admin.polls._form')
                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-3">
                                <button type="submit" class="btn btn-primary btn-md">
                                    添加新{{ config('answer.polls') }}
                                </button>
                            </div>
                        </div>
                    </form>
                 </div>
             </div>
        </div>
    </div>
</div>
@stop
