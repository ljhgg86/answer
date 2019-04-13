
<div class="form-group">
    <label for="title" class="col-md-2 control-label">
        {{ config('answer.polls') }}标题
    </label>
    <div class="col-md-8">
        <input type="text" class="form-control" id="title" name="title" value="{{ $poll->title }}">
    </div>
</div>
<div class="form-group">
    <label for="videoposter" class="col-md-2 control-label">
         视频封面
    </label>
    <div class="col-md-5">
         <input type="text" class="form-control" name="videoposter" id="videoposter" value="{{ $poll->videoposter }}" >
    </div>
    <div class="col-md-3">
        <div class="btn-group">
             <button type="button" class="btn btn-warning plain" data-toggle="modal" data-target="#myModal">
                上传
             </button>
             <button type="button" class="btn btn-success plain" data-toggle="modal" data-target="#modal-image-view" id="imgPrev">
                预览
             </button>
        </div>
    </div>
</div>
<div class="form-group">
    <label for="videosrc" class="col-md-2 control-label">
         上传视频
    </label>
    <div class="col-md-5">
         <input type="text" class="form-control" name="videosrc"  id="videosrc" value="{{ $poll->videosrc }}" >
    </div>
    <div class="col-md-3">
        <div class="btn-group">
             <button type="button" class="btn btn-warning plain" data-toggle="modal" data-target="#myVideoModal">
                上传
             </button>
             <button type="button" class="btn btn-success plain" data-toggle="modal" data-target="#modal-video-view" id="videoPrev">
                预览
             </button>
        </div>
    </div>
</div>
<div class="form-group">
	<label for="starttime" class="col-md-2 control-label">
    开始时间
    </label>
    <div class="col-md-8">
    	<input type="datetime-local" class="form-control" id="starttime" name="starttime" value="{{$poll->starttime}}">
    </div>
</div>
<div class="form-group">
	<label for="endtime" class="col-md-2 control-label">
    结束时间
    </label>
    <div class="col-md-8">
    	<input type="datetime-local" class="form-control" id="endtime" name="endtime" value="{{$poll->endtime}}">
    </div>
</div>
<div class="form-group">
    <label for="rewardflag" class="col-md-2 control-label">
    抽奖功能
    </label>
    <div class="col-md-8">
        @if($poll->rewardflag)
        <label class="radio-inline">
            <input type="radio" name="rewardflag" id="rewardOpen" value="1" checked> 开启
        </label>
        <label class="radio-inline">
            <input type="radio" name="rewardflag" id="rewardClose"  value="0"> 关闭
        </label>
        @else
        <label class="radio-inline">
            <input type="radio" name="rewardflag" id="rewardOpen" value="1"> 开启
        </label>
        <label class="radio-inline">
            <input type="radio" name="rewardflag" id="rewardClose"  value="0" checked> 关闭
        </label>
        @endif
    </div>
</div>
<div class="form-group">
    <label for="description" class="col-md-2 control-label">
     活动描述
    </label>
    <div class="col-md-8">
        <textarea name="description" class="form-control" rows="3">{{ $poll->description }}</textarea>
    </div>
 </div>
