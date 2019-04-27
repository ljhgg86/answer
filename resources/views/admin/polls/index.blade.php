@extends('layouts.app')
@section('content')
<div class="container">
        <div class="row page-title-row">
            <div class="col-md-6">
                <h3>{{ config('answer.polls') }} <small>» 列表</small></h3>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route('polls.create') }}" class="btn btn-success btn-md">
                     新建{{ config('answer.polls') }}
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
                            <th>{{ config('answer.polls') }}名称</th>                            
                            <th data-sortable="false">操作</th>
                        </tr>
                     </thead>
                    <tbody>
                    @foreach ($polls as $key=>$poll)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $poll->title }}</td>
                            
                            <td>
                                <a href="{{ route('polls.edit', $poll->id) }}" class="btn btn-xs btn-info">
                                    编辑
                                </a>
                                <a href="{{ route('admin.votes.listvotes', $poll->id) }}" class="btn btn-xs btn-warning">
                                    投票管理
                                </a>
                                @if($poll->rewardflag)
                                <a href="{{ route('admin.polls.reward', $poll->id) }}" class="btn btn-xs btn-primary">
                                    抽奖
                                </a>
                                @else
                                <button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#rewardModal">
                                    抽奖
                                </button>
                                @endif
                                <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#pollslink" onclick="pollsLink({{ $poll->id }})">
                                    链接地址
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-offset-2 col-md-8 text-center"> 
                {{ $polls->links() }}
            </div>
        </div>
    </div>
@include('admin.polls._modals')
@stop
@section('scripts')
    <script type="text/javascript">
        function pollsLink(pollid){
            var addr="https://green.strtv.cn/answerclient/index.php?pollid="+pollid+"#/";
            $("#link_addr").text(addr);
        }
    </script>
@stop