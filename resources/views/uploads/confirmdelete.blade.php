@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="card">
            <h3 class="card-header">{{$upload->name}}</h3>
            <div class="card-body">
                <b>Size: </b>{{$size}}<br />
            </div>
            <h5 class="card-footer">Created {{$upload->created_at}} by {{$upload->owner->username}}</h5>
            <form action="/uploads/{{$upload->id}}" method="post">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-block">Permanently Delete This File</button>
            </form>
        </div>
    </div>
@endsection