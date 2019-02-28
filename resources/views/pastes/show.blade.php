@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <h3 class="card-header">{{$paste->name}}</h3>
            <div class="card-body">
                {!! $paste->body !!}
            </div>
            <h5 class="card-footer">Created {{$paste->created_at}} by {{$paste->owner->username}}</h5>
        </div>
    </div>
    @can('update', $paste)
        
    @endcan
@endsection