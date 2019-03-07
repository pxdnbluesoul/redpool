@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="card">
            <h3 class="card-header">Editing {{$paste->name}}</h3>
            <div class="card-body">
                <form action="/pastes/{{$paste->id}}" method="post">
                    @csrf
                    @method('PATCH')
                    <input type="text" name="name" id="name" value="{{ $paste->name }}" class="form-control">
                    <input type="hidden" name="actiontype" value="rename">
                    <button class="btn btn-warning btn-block mt-2">Rename This Paste</button>
                </form>
            </div>
            <h5 class="card-footer">Created {{$paste->created_at}} by {{$paste->owner->username}}</h5>
        </div>
    </div>
@endsection