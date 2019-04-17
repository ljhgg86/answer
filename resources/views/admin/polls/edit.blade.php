@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row page-title-row">
        <div class="col-md-12">
            <h3>{{ config('answer.polls') }} <small>» 编辑</small></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">编辑{{ config('answer.polls') }}窗口</h3>
                </div>
                <div class="panel-body">
                    @include('partials.errors')
                    @include('partials.success')
                    @if($poll->id)
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('polls.update',$poll->id) }}">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id" value="{{ $poll->id }}">
                        <div class="form-group">
                            <label for="id" class="col-md-2 control-label">
                                活动序号
                            </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="id" name="id" value="{{ $poll->id }}" readonly>
                            </div>
                        </div>
                    @else
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('polls.store') }}">
                    @endif
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @include('admin.polls._form')
                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-3">
                                <button type="submit" class="btn btn-primary btn-md">
                                    保存
                                </button>
                                @if($poll->Id)
                                <button type="button" class="btn btn-danger btn-md" data-toggle="modal" data-target="#modal-delete">
                                    删除
                                </button>
                                @endif
                                <a type="button" class="btn btn-primary btn-md" href="{{ route('polls.index') }}">
                                    返回
                                </a>
                            </div>
                        </div>
                    </form>
                 </div>
             </div>
        </div>
    </div>
</div>
@include('upload._modals')
@stop
@section('scripts')
    <script type="text/javascript"
     src="{{ URL::asset('js/jquery.form.js')  }}">
    </script>
    <script type="text/javascript">
            $(document).ready(function() {
                var options = {
                    //beforeSubmit:  showRequest,
                    success: showResponse,
                    dataType: 'json'
                };
                var videoOptions = {
                    //beforeSubmit:  showRequest,
                    success: videoResponse,
                    error: funerr,
                    dataType: 'json'
                };
                $('#file').on('change', function(){
                    $('#imgForm').ajaxForm(options).submit();
                });
                $('#imgPrev').on('click',function(){
                    $('#preview-image').attr("src",$("#videoposter").val());
                });
                $('#videoFile').on('change', function(){
                    $('#videoForm').ajaxForm(videoOptions).submit();
                });
                $('#videoPrev').on('click',function(){
                    $('#preview-video').attr("src",$("#videosrc").val());
                });
            });
            function showResponse(response)  {
                if(!response.success)
                {
                    var responseErrors = response.errors;
                    $('#myModal').modal('hide');
                    alert(responseErrors);
                } else {
                    let imageSrc=response.imageSrc;
                    $("#videoposter").val(imageSrc);
                    $('#myModal').modal('hide');
                }
            }
            function videoResponse(response)  {
                if(!response.success)
                {
                    var responseErrors = response.errors;
                    $('#myVideoModal').modal('hide');
                    alert(responseErrors);
                } else {
                    let videoSrc=response.videoSrc;
                    $("#videosrc").val(videoSrc);
                    $('#myVideoModal').modal('hide');
                }
            }
            function funerr(err){
                console.log(err);
            }
    </script>
@stop