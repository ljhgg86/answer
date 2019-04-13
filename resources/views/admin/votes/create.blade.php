@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row page-title-row">
        <div class="col-md-12">
            <h3>{{ config('answer.votes') }} <small>» 新建</small></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">新建{{ config('answer.votes') }}窗口</h3>
                </div>
                <div class="panel-body">
                    @include('partials.errors')
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('votes.store') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @include('admin.votes._form')
                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-3">
                                <button type="submit" class="btn btn-primary btn-md">
                                    添加新{{ config('answer.votes') }}
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
