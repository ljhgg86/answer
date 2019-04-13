
<div class="form-group">
    <label for="title" class="col-md-2 control-label">
        {{ config('answer.votes') }}标题
    </label>
    <div class="col-md-8">
        <input type="text" class="form-control" id="title" name="title" value="{{ $vote->title }}">
    </div>
</div>
<div class="form-group">
    <label for="start_at" class="col-md-2 control-label">
         开始时间(S)
    </label>
    <div class="col-md-8">
         <input type="number" class="form-control" name="start_at"  id="start_at" value="{{ $vote->start_at }}" >
    </div>
</div>
<div class="form-group">
    <label for="staytime" class="col-md-2 control-label">
         停留时间(S)
    </label>
    <div class="col-md-8">
         <input type="number" class="form-control" name="staytime"  id="staytime" value="{{ $vote->staytime }}" >
    </div>
</div>
<div class="form-group">
    <label for="description" class="col-md-2 control-label">
     活动描述
    </label>
    <div class="col-md-8">
        <textarea class="form-control" rows="3">
            {{ $vote->description }}
        </textarea>
    </div>
 </div>
