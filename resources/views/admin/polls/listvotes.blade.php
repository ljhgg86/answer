@extends('layouts.app')
@section('content')
{{-- <div class="container"> --}}
    <voteform :pollid={{ $pollid }}>
    </voteform>
{{-- </div> --}}
@stop
