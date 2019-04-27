@extends('layouts.app')
@section('content')
<div class="container">
        <div class="row page-title-row">
            <div class="col-md-6">
                <h3>答题记录 <small>» 列表</small></h3>
            </div>
            <div class="col-md-6 text-right">
                <a type="button" class="btn btn-warning btn-md" href="{{ route('polls.index') }}">
                    <span class="glyphicon glyphicon-chevron-left"></span>返回
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
                            <th>用户</th>
                            <th>活动</th>
                            <th>投票</th>
                            <th>选择</th>                        
                            <th>答题时间</th>
                        </tr>
                     </thead>
                    <tbody>
                    @foreach ($answerrecords as $answerrecord)
                        <tr>
                            <td>{{ $answerrecord->answerUser->name }}</td>
                            <td>{{ $answerrecord->poll->title }}</td>
                            <td>{{ $answerrecord->votes->title }}</td>
                            @if($answerrecord->option)
                            <td>{{ $answerrecord->option->info }}</td>
                            @else
                            <td>未选择</td>
                            @endif
                            <td>{{ $answerrecord->created_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-2 col-md-8 text-center"> 
                {{ $answerrecords->links() }}
            </div>
        </div>
    </div>
@stop