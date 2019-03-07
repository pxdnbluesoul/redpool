@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="card">
            <h3 class="card-header">Editing {{$upload->name}}</h3>
            <div class="card-body">
                <form action="/uploads/{{$upload->id}}" method="post">
                    @csrf
                    @method('PATCH')
                    <input type="text" name="name" id="name" value="{{ $upload->name }}" class="form-control">
                    <input type="hidden" name="actiontype" value="rename">
                    <button class="btn btn-warning btn-block mt-2">Rename This File</button>
                </form>
            </div>
            <h5 class="card-footer">Created {{$upload->created_at}} by {{$upload->owner->username}}</h5>
        </div>
    </div>
@endsection