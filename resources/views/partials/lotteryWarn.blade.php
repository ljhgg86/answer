@if (Session::has('lotteryWarn'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ Session::get('lotteryWarn') }}
    </div>
@endif