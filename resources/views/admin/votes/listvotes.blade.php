@extends('layouts.app')
@section('content')
<div class="container">
        <div class="row page-title-row">
            <div class="col-md-6">
                <h3>{{ config('answer.votes') }} <small>» 列表</small></h3>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route('admin.votes.editvotes', [0,$pollid]) }}" class="btn btn-success btn-md">
                     新建{{ config('answer.votes') }}
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">

                @include('partials.errors')
                @include('partials.success')

                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>编号</th>
                            <th>{{ config('answer.votes') }}名称</th>                            
                            <th data-sortable="false">操作</th>
                        </tr>
                     </thead>
                    <tbody>
                    @foreach ($votes as $key=>$vote)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $vote->title }}</td>
                            
                            <td>
                                <a href="{{ route('admin.votes.editvotes', [$vote->id,$vote->poll_id]) }}" class="btn btn-xs btn-info">
                                    编辑
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <a href="{{ route('admin.polls.index') }}" class="btn btn-warning btn-md">
                    <span class="glyphicon glyphicon-arrow-left"></span> 返回
                </a>
            </div>
        </div>
    </div>
@stop
